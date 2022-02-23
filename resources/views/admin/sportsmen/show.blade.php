@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sportsman.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sportsmen.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sportsman.fields.id') }}
                        </th>
                        <td>
                            {{ $sportsman->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sportsman.fields.name') }}
                        </th>
                        <td>
                            {{ $sportsman->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sportsman.fields.details') }}
                        </th>
                        <td>
                            {!! $sportsman->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sportsman.fields.image') }}
                        </th>
                        <td>
                            @if($sportsman->image)
                            <a href="{{ $sportsman->image->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $sportsman->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sportsmen.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection