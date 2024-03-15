@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenderupload.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tenderuploads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderupload.fields.id') }}
                        </th>
                        <td>
                            {{ $document->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_title') }}
                        </th>
                        <td>
                            {{ $document->ctd_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_archive_status') }}
                        </th>
                        <td>
                            {{ (! $document->ctd_archive_status) ? 'Archived' : 'Not Archived' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_files') }}
                        </th>
                        <td>
                            @if($document->getFiles())
                                {{ count($document->getFiles()) }}
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