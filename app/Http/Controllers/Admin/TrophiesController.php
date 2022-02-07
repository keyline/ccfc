<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTrophyRequest;
use App\Http\Requests\StoreTrophyRequest;
use App\Http\Requests\UpdateTrophyRequest;
use App\Models\Trophy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TrophiesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('trophy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trophies = Trophy::with(['media'])->get();

        return view('admin.trophies.index', compact('trophies'));
    }

    public function create()
    {
        abort_if(Gate::denies('trophy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trophies.create');
    }

    public function store(StoreTrophyRequest $request)
    {
        $trophy = Trophy::create($request->all());

        if ($request->input('trophy_photo', false)) {
            $trophy->addMedia(storage_path('tmp/uploads/' . basename($request->input('trophy_photo'))))->toMediaCollection('trophy_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trophy->id]);
        }

        return redirect()->route('admin.trophies.index');
    }

    public function edit(Trophy $trophy)
    {
        abort_if(Gate::denies('trophy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trophies.edit', compact('trophy'));
    }

    public function update(UpdateTrophyRequest $request, Trophy $trophy)
    {
        $trophy->update($request->all());

        if ($request->input('trophy_photo', false)) {
            if (!$trophy->trophy_photo || $request->input('trophy_photo') !== $trophy->trophy_photo->file_name) {
                if ($trophy->trophy_photo) {
                    $trophy->trophy_photo->delete();
                }
                $trophy->addMedia(storage_path('tmp/uploads/' . basename($request->input('trophy_photo'))))->toMediaCollection('trophy_photo');
            }
        } elseif ($trophy->trophy_photo) {
            $trophy->trophy_photo->delete();
        }

        return redirect()->route('admin.trophies.index');
    }

    public function show(Trophy $trophy)
    {
        abort_if(Gate::denies('trophy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trophies.show', compact('trophy'));
    }

    public function destroy(Trophy $trophy)
    {
        abort_if(Gate::denies('trophy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trophy->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrophyRequest $request)
    {
        Trophy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('trophy_create') && Gate::denies('trophy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Trophy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
