<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePastPresidentRequest;
use App\Http\Requests\UpdatePastPresidentRequest;
use App\Http\Resources\Admin\PastPresidentResource;
use App\Models\PastPresident;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PastPresidentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('past_president_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PastPresidentResource(PastPresident::all());
    }

    public function store(StorePastPresidentRequest $request)
    {
        $pastPresident = PastPresident::create($request->all());

        if ($request->input('image', false)) {
            $pastPresident->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new PastPresidentResource($pastPresident))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PastPresidentResource($pastPresident);
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

        return (new PastPresidentResource($pastPresident))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pastPresident->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
