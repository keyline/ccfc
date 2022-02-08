<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventDetailRequest;
use App\Http\Requests\UpdateEventDetailRequest;
use App\Http\Resources\Admin\EventDetailResource;
use App\Models\EventDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventDetailsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventDetailResource(EventDetail::with(['gallery'])->get());
    }

    public function store(StoreEventDetailRequest $request)
    {
        $eventDetail = EventDetail::create($request->all());

        if ($request->input('event_image', false)) {
            $eventDetail->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_image'))))->toMediaCollection('event_image');
        }

        return (new EventDetailResource($eventDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventDetail $eventDetail)
    {
        abort_if(Gate::denies('event_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventDetailResource($eventDetail->load(['gallery']));
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

        return (new EventDetailResource($eventDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventDetail $eventDetail)
    {
        abort_if(Gate::denies('event_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
