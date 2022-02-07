@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.amenitiesService.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.id') }}
                        </th>
                        <td>
                            {{ $amenitiesService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.amenity_name') }}
                        </th>
                        <td>
                            {{ $amenitiesService->amenity_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.amenity_details') }}
                        </th>
                        <td>
                            {!! $amenitiesService->amenity_details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.image_gallery') }}
                        </th>
                        <td>
                            {{ $amenitiesService->image_gallery->gallery_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection