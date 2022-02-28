@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.committeeMemberMapping.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.committee-member-mappings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.committeeMemberMapping.fields.id') }}
                        </th>
                        <td>
                            {{ $committeeMemberMapping->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.committeeMemberMapping.fields.committee') }}
                        </th>
                        <td>
                            {{ $committeeMemberMapping->committee->committee_name_master ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.committeeMemberMapping.fields.member') }}
                        </th>
                        <td>
                            {{ $committeeMemberMapping->member->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.committeeMemberMapping.fields.designation') }}
                        </th>
                        <td>
                            {{ $committeeMemberMapping->designation ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.committee-member-mappings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection