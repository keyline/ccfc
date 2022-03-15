<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserDetailRequest;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Models\User;
use App\Models\UserDetail;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class UserDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetails = UserDetail::with(['user_code', 'media'])->get();

        return view('admin.userDetails.index', compact('userDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_codes = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userDetails.create', compact('user_codes'));
    }

    public function store(StoreUserDetailRequest $request)
    {
        $userDetail = UserDetail::create($request->all());

        if ($request->input('member_image', false)) {
            $userDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('member_image'))))->toMediaCollection('member_image');
        }

        if ($request->input('spouse_image', false)) {
            $userDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('spouse_image'))))->toMediaCollection('spouse_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userDetail->id]);
        }

        return redirect()->route('admin.user-details.index');
    }

    // public function edit(UserDetail $userDetail)
    // {
    //     abort_if(Gate::denies('user_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $user_codes = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

    //     $userDetail->load('user_code');

    //     return view('admin.userDetails.edit', compact('userDetail', 'user_codes'));
    // }




    public function edit(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_codes = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userDetail->load('user_code');

        // return view('admin.userDetails.edit', compact('userDetail', 'user_codes'));
        
        $user = User::where('id', '=', session('LoggedMember'))->first();

        $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

        $fields= [
          'MCODE' => $user->user_code
        ];

        $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

    
        $profile = Http::withoutVerifying()
            ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                            'Content-Type' => 'application/json',])
            ->withOptions(["verify"=>false])
            ->post($url)->json()['data'];

            
            return view('admin.userDetails.edit',compact('userDetail', 'user_codes'), [
                
                'userProfile' => $profile,
            ]);


    }

    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        $userDetail->update($request->all());

        if ($request->input('member_image', false)) {
            if (!$userDetail->member_image || $request->input('member_image') !== $userDetail->member_image->file_name) {
                if ($userDetail->member_image) {
                    $userDetail->member_image->delete();
                }
                $userDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('member_image'))))->toMediaCollection('member_image');
            }
        } elseif ($userDetail->member_image) {
            $userDetail->member_image->delete();
        }

        if ($request->input('spouse_image', false)) {
            if (!$userDetail->spouse_image || $request->input('spouse_image') !== $userDetail->spouse_image->file_name) {
                if ($userDetail->spouse_image) {
                    $userDetail->spouse_image->delete();
                }
                $userDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('spouse_image'))))->toMediaCollection('spouse_image');
            }
        } elseif ($userDetail->spouse_image) {
            $userDetail->spouse_image->delete();
        }

        return redirect()->route('admin.user-details.index');
    }

    public function show(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->load('user_code');

        return view('admin.userDetails.show', compact('userDetail'));
    }

    public function destroy(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserDetailRequest $request)
    {
        UserDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_detail_create') && Gate::denies('user_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}