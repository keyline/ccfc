<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSportsmanRequest;
use App\Http\Requests\UpdateSportsmanRequest;
use App\Http\Resources\Admin\SportsmanResource;
use App\Models\Sportsman;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SportsmenApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sportsman_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SportsmanResource(Sportsman::all());
    }

    public function store(StoreSportsmanRequest $request)
    {
        $sportsman = Sportsman::create($request->all());

        if ($request->input('image', false)) {
            $sportsman->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new SportsmanResource($sportsman))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sportsman $sportsman)
    {
        abort_if(Gate::denies('sportsman_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SportsmanResource($sportsman);
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

        return (new SportsmanResource($sportsman))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sportsman $sportsman)
    {
        abort_if(Gate::denies('sportsman_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sportsman->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
