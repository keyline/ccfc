@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sportstype.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sportstypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sportstype.fields.id') }}
                        </th>
                        <td>
                            {{ $sportstype->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sportstype.fields.sport_name') }}
                        </th>
                        <td>
                            {{ $sportstype->sport_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sportstype.fields.icon') }}
                        </th>
                        <td>
                            @if($sportstype->icon)
                                <a href="{{ $sportstype->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $sportstype->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sportstypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection