<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAmenitiesServiceRequest;
use App\Http\Requests\StoreAmenitiesServiceRequest;
use App\Http\Requests\UpdateAmenitiesServiceRequest;
use App\Models\AmenitiesService;
use App\Models\Gallery;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AmenitiesServicesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('amenities_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenitiesServices = AmenitiesService::with(['image_gallery'])->get();

        return view('admin.amenitiesServices.index', compact('amenitiesServices'));
    }

    public function create()
    {
        abort_if(Gate::denies('amenities_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image_galleries = Gallery::pluck('gallery_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.amenitiesServices.create', compact('image_galleries'));
    }

    public function store(StoreAmenitiesServiceRequest $request)
    {
        $amenitiesService = AmenitiesService::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $amenitiesService->id]);
        }

        return redirect()->route('admin.amenities-services.index');
    }

    public function edit(AmenitiesService $amenitiesService)
    {
        abort_if(Gate::denies('amenities_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image_galleries = Gallery::pluck('gallery_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenitiesService->load('image_gallery');

        return view('admin.amenitiesServices.edit', compact('amenitiesService', 'image_galleries'));
    }

    public function update(UpdateAmenitiesServiceRequest $request, AmenitiesService $amenitiesService)
    {
        $amenitiesService->update($request->all());

        return redirect()->route('admin.amenities-services.index');
    }

    public function show(AmenitiesService $amenitiesService)
    {
        abort_if(Gate::denies('amenities_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenitiesService->load('image_gallery');

        return view('admin.amenitiesServices.show', compact('amenitiesService'));
    }

    public function destroy(AmenitiesService $amenitiesService)
    {
        abort_if(Gate::denies('amenities_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenitiesService->delete();

        return back();
    }

    public function massDestroy(MassDestroyAmenitiesServiceRequest $request)
    {
        AmenitiesService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('amenities_service_create') && Gate::denies('amenities_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AmenitiesService();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
