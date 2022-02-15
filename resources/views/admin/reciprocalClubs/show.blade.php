@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reciprocalClub.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reciprocal-clubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.id') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.reciprocal_club_name') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->reciprocal_club_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.address_1') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->address_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.address_2') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.phone') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.email') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.website') }}
                        </th>
                        <td>
                            {{ $reciprocalClub->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.details') }}
                        </th>
                        <td>
                            {!! $reciprocalClub->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.club_image') }}
                        </th>
                        <td>
                            @if($reciprocalClub->club_image)
                                <a href="{{ $reciprocalClub->club_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $reciprocalClub->club_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.cub_type') }}
                        </th>
                        <td>
                            {{ App\Models\ReciprocalClub::CUB_TYPE_RADIO[$reciprocalClub->cub_type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reciprocal-clubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection