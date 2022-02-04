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
                            @foreach($eventDetail->event_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
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