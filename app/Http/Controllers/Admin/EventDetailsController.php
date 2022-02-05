<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventDetailRequest;
use App\Http\Requests\StoreEventDetailRequest;
use App\Http\Requests\UpdateEventDetailRequest;
use App\Models\EventDetail;
use App\Models\Gallery;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDetails = EventDetail::with(['gallery', 'media'])->get();

        return view('admin.eventDetails.index', compact('eventDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galleries = Gallery::pluck('gallery_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventDetails.create', compact('galleries'));
    }

    public function store(StoreEventDetailRequest $request)
    {
        $eventDetail = EventDetail::create($request->all());

        if ($request->input('event_image', false)) {
            $eventDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_image'))))->toMediaCollection('event_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eventDetail->id]);
        }

        return redirect()->route('admin.event-details.index');
    }

    public function edit(EventDetail $eventDetail)
    {
        abort_if(Gate::denies('event_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galleries = Gallery::pluck('gallery_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventDetail->load('gallery');

        return view('admin.eventDetails.edit', compact('eventDetail', 'galleries'));
    }

    public function update(UpdateEventDetailRequest $request, EventDetail $eventDetail)
    {
        $eventDetail->update($request->all());

        if ($request->input('event_image', false)) {
            if (!$eventDetail->event_image || $request->input('event_image') !== $eventDetail->event_image->file_name) {
                if ($eventDetail->event_image) {
                    $eventDetail->event_image->delete();
                }
                $eventDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_image'))))->toMediaCollection('event_image');
            }
        } elseif ($eventDetail->event_image) {
            $eventDetail->event_image->delete();
        }

        return redirect()->route('admin.event-details.index');
    }

    public function show(EventDetail $eventDetail)
    {
        abort_if(Gate::denies('event_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDetail->load('gallery');

        return view('admin.eventDetails.show', compact('eventDetail'));
    }

    public function destroy(EventDetail $eventDetail)
    {
        abort_if(Gate::denies('event_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventDetailRequest $request)
    {
        EventDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_detail_create') && Gate::denies('event_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EventDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
