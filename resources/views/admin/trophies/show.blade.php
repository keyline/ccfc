@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trophy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trophies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trophy.fields.id') }}
                        </th>
                        <td>
                            {{ $trophy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trophy.fields.trophy') }}
                        </th>
                        <td>
                            {{ $trophy->trophy }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trophy.fields.trophy_description') }}
                        </th>
                        <td>
                            {!! $trophy->trophy_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trophy.fields.trophy_photo') }}
                        </th>
                        <td>
                            @if($trophy->trophy_photo)
                                <a href="{{ $trophy->trophy_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $trophy->trophy_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trophy.fields.year_of_award') }}
                        </th>
                        <td>
                            {{ $trophy->year_of_award }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trophies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection