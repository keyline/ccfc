@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $eventDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_title') }}
                        </th>
                        <td>
                            {{ $eventDetail->event_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_details') }}
                        </th>
                        <td>
                            {!! $eventDetail->event_details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_image') }}
                        </th>
                        <td>
                            @if($eventDetail->event_image)
                                <a href="{{ $eventDetail->event_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $eventDetail->event_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_date') }}
                        </th>
                        <td>
                            {{ $eventDetail->event_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventDetail.fields.gallery') }}
                        </th>
                        <td>
                            {{ $eventDetail->gallery->gallery_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection