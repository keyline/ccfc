<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPastPresidentRequest;
use App\Http\Requests\StorePastPresidentRequest;
use App\Http\Requests\UpdatePastPresidentRequest;
use App\Models\PastPresident;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PastPresidentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('past_president_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pastPresidents = PastPresident::with(['media'])->get();

        return view('admin.pastPresidents.index', compact('pastPresidents'));
    }

    public function create()
    {
        abort_if(Gate::denies('past_president_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.create');
    }

    public function store(StorePastPresidentRequest $request)
    {
        $pastPresident = PastPresident::create($request->all());

        if ($request->input('image', false)) {
            $pastPresident->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pastPresident->id]);
        }

        return redirect()->route('admin.past-presidents.index');
    }

    public function edit(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.edit', compact('pastPresident'));
    }

    public function update(UpdatePastPresidentRequest $request, PastPresident $pastPresident)
    {
        $pastPresident->update($request->all());

        if ($request->input('image', false)) {
            if (!$pastPresident->image || $request->input('image') !== $pastPresident->image->file_name) {
                if ($pastPresident->image) {
                    $pastPresident->image->delete();
                }
                $pastPresident->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($pastPresident->image) {
            $pastPresident->image->delete();
        }

        return redirect()->route('admin.past-presidents.index');
    }

    public function show(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.show', compact('pastPresident'));
    }

    public function destroy(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pastPresident->delete();

        return back();
    }

    public function massDestroy(MassDestroyPastPresidentRequest $request)
    {
        PastPresident::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('past_president_create') && Gate::denies('past_president_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PastPresident();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}