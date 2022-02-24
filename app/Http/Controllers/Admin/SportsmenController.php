<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySportsmanRequest;
use App\Http\Requests\StoreSportsmanRequest;
use App\Http\Requests\UpdateSportsmanRequest;
use App\Models\Sportsman;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SportsmenController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sportsman_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sportsmen = Sportsman::with(['media'])->get();

        return view('admin.sportsmen.index', compact('sportsmen'));
    }

    public function create()
    {
        abort_if(Gate::denies('sportsman_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportsmen.create');
    }

    public function store(StoreSportsmanRequest $request)
    {
        $sportsman = Sportsman::create($request->all());

        if ($request->input('image', false)) {
            $sportsman->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sportsman->id]);
        }

        return redirect()->route('admin.sportsmen.index');
    }

    public function edit(Sportsman $sportsman)
    {
        abort_if(Gate::denies('sportsman_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportsmen.edit', compact('sportsman'));
    }

    public function update(UpdateSportsmanRequest $request, Sportsman $sportsman)
    {
        $sportsman->update($request->all());

        if ($request->input('image', false)) {
            if (!$sportsman->image || $request->input('image') !== $sportsman->image->file_name) {
                if ($sportsman->image) {
                    $sportsman->image->delete();
                }
                $sportsman->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sportsman->image) {
            $sportsman->image->delete();
        }

        return redirect()->route('admin.sportsmen.index');
    }

    public function show(Sportsman $sportsman)
    {
        abort_if(Gate::denies('sportsman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sportsmen.show', compact('sportsman'));
    }

    public function destroy(Sportsman $sportsman)
    {
        abort_if(Gate::denies('sportsman_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sportsman->delete();

        return back();
    }

    public function massDestroy(MassDestroySportsmanRequest $request)
    {
        Sportsman::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sportsman_create') && Gate::denies('sportsman_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sportsman();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}