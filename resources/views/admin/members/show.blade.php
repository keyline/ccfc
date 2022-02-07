@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.member.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <td>
                            {{ $member->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.select_member') }}
                        </th>
                        <td>
                            {{ $member->select_member->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.select_title') }}
                        </th>
                        <td>
                            {{ $member->select_title->titles ?? '' }}
                        </td>
                    </tr>
<<<<<<< HEAD
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.select_sport') }}
                        </th>
                        <td>
                            {{ $member->select_sport->sport_name ?? '' }}
                        </td>
                    </tr>
=======
>>>>>>> origin/quickadminpanel_2022_02_04_04_54_33
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection