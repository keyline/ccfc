<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySportstypeRequest;
use App\Http\Requests\StoreSportstypeRequest;
use App\Http\Requests\UpdateSportstypeRequest;
use App\Models\Sportstype;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SportstypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sportstype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sportstypes = Sportstype::with(['media'])->get();

        return view('admin.sportstypes.index', compact('sportstypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('sportstype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportstypes.create');
    }

    public function store(StoreSportstypeRequest $request)
    {
        $sportstype = Sportstype::create($request->all());

        if ($request->input('icon', false)) {
            $sportstype->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($request->input('featured_image', false)) {
            $sportstype->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sportstype->id]);
        }

        return redirect()->route('admin.sportstypes.index');
    }

    public function edit(Sportstype $sportstype)
    {
        abort_if(Gate::denies('sportstype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportstypes.edit', compact('sportstype'));
    }

    public function update(UpdateSportstypeRequest $request, Sportstype $sportstype)
    {
        $sportstype->update($request->all());

        if ($request->input('icon', false)) {
            if (!$sportstype->icon || $request->input('icon') !== $sportstype->icon->file_name) {
                if ($sportstype->icon) {
                    $sportstype->icon->delete();
                }
                $sportstype->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($sportstype->icon) {
            $sportstype->icon->delete();
        }

        if ($request->input('featured_image', false)) {
            if (!$sportstype->featured_image || $request->input('featured_image') !== $sportstype->featured_image->file_name) {
                if ($sportstype->featured_image) {
                    $sportstype->featured_image->delete();
                }
                $sportstype->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($sportstype->featured_image) {
            $sportstype->featured_image->delete();
        }

        return redirect()->route('admin.sportstypes.index');
    }

    public function show(Sportstype $sportstype)
    {
        abort_if(Gate::denies('sportstype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportstypes.show', compact('sportstype'));
    }

    public function destroy(Sportstype $sportstype)
    {
        abort_if(Gate::denies('sportstype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sportstype->delete();

        return back();
    }

    public function massDestroy(MassDestroySportstypeRequest $request)
    {
        Sportstype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sportstype_create') && Gate::denies('sportstype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sportstype();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}