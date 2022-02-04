@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pastPresident.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.past-presidents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pastPresident.fields.id') }}
                        </th>
                        <td>
                            {{ $pastPresident->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pastPresident.fields.name') }}
                        </th>
                        <td>
                            {{ $pastPresident->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pastPresident.fields.duration') }}
                        </th>
                        <td>
                            {{ $pastPresident->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pastPresident.fields.short_order') }}
                        </th>
                        <td>
                            {{ $pastPresident->short_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.past-presidents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection