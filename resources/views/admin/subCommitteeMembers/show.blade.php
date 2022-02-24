@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subCommitteeMember.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-committee-members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subCommitteeMember.fields.id') }}
                        </th>
                        <td>
                            {{ $subCommitteeMember->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCommitteeMember.fields.comittee_name') }}
                        </th>
                        <td>
                            {{ $subCommitteeMember->comittee_name->committee_name_master ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCommitteeMember.fields.member') }}
                        </th>
                        <td>
                            {{ $subCommitteeMember->member->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCommitteeMember.fields.head_of_the_committee') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $subCommitteeMember->head_of_the_committee ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-committee-members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection