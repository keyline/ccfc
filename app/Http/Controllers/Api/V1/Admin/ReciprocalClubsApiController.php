<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReciprocalClubRequest;
use App\Http\Requests\UpdateReciprocalClubRequest;
use App\Http\Resources\Admin\ReciprocalClubResource;
use App\Models\ReciprocalClub;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReciprocalClubsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reciprocal_club_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReciprocalClubResource(ReciprocalClub::all());
    }

    public function store(StoreReciprocalClubRequest $request)
    {
        $reciprocalClub = ReciprocalClub::create($request->all());

        if ($request->input('club_image', false)) {
            $reciprocalClub->addMedia(storage_path('tmp/uploads/' . basename($request->input('club_image'))))->toMediaCollection('club_image');
        }

        return (new ReciprocalClubResource($reciprocalClub))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReciprocalClub $reciprocalClub)
    {
        abort_if(Gate::denies('reciprocal_club_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReciprocalClubResource($reciprocalClub);
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

        return (new ReciprocalClubResource($reciprocalClub))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ReciprocalClub $reciprocalClub)
    {
        abort_if(Gate::denies('reciprocal_club_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reciprocalClub->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
