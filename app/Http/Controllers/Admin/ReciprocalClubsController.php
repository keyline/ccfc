<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReciprocalClubRequest;
use App\Http\Requests\StoreReciprocalClubRequest;
use App\Http\Requests\UpdateReciprocalClubRequest;
use App\Models\ReciprocalClub;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ReciprocalClubsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reciprocal_club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reciprocalClubs = ReciprocalClub::with(['media'])->get();

        return view('admin.reciprocalClubs.index', compact('reciprocalClubs'));
    }

    public function create()
    {
        abort_if(Gate::denies('reciprocal_club_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reciprocalClubs.create');
    }

    public function store(StoreReciprocalClubRequest $request)
    {
        $reciprocalClub = ReciprocalClub::create($request->all());

        // $reciprocalClub -> addMediaFromRequest('club_image')->toMediaCollection('ck-media');

        if ($request->input('club_image', false)) {
            $reciprocalClub->addMedia(storage_path('tmp/uploads/' . basename($request->input('club_image'))))->toMediaCollection('club_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $reciprocalClub->id]);
        }

        return redirect()->route('admin.reciprocal-clubs.index');
    }

    public function edit(ReciprocalClub $reciprocalClub)
    {
        abort_if(Gate::denies('reciprocal_club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reciprocalClubs.edit', compact('reciprocalClub'));
    }

    public function update(UpdateReciprocalClubRequest $request, ReciprocalClub $reciprocalClub)
    {
        $reciprocalClub->update($request->all());

        if ($request->input('club_image', false)) {
            if (!$reciprocalClub->club_image || $request->input('club_image') !== $reciprocalClub->club_image->file_name) {
                if ($reciprocalClub->club_image) {
                    $reciprocalClub->club_image->delete();
                }
                $reciprocalClub->addMedia(storage_path('tmp/uploads/' . basename($request->input('club_image'))))->toMediaCollection('club_image');
            }
        } elseif ($reciprocalClub->club_image) {
            $reciprocalClub->club_image->delete();
        }

        return redirect()->route('admin.reciprocal-clubs.index');
    }

    public function show(ReciprocalClub $reciprocalClub)
    {
        abort_if(Gate::denies('reciprocal_club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reciprocalClubs.show', compact('reciprocalClub'));
    }

    public function destroy(ReciprocalClub $reciprocalClub)
    {
        abort_if(Gate::denies('reciprocal_club_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reciprocalClub->delete();

        return back();
    }

    public function massDestroy(MassDestroyReciprocalClubRequest $request)
    {
        ReciprocalClub::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('reciprocal_club_create') && Gate::denies('reciprocal_club_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ReciprocalClub();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
