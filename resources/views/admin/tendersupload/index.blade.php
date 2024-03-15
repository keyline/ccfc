@extends('layouts.admin')
@section('content')
@can('tenderupload_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.tenderuploads.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.tenderupload.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tenderupload.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-Sportstype">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tenderupload.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.tenderupload.fields.tender_files') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploadedTenders as $folder)
                        @if($folder->documents)
                        @foreach($folder->documents as $tender)
                    <tr data-entry-id="{{ $tender->ctd_id }}">
                        <td>

                        </td>
                        <td>
                            {{ $tender->ctd_id ?? '' }}
                        </td>
                        <td>
                            {{ $tender->ctd_title ?? '' }}
                        </td>
                        <td>
                            {{ $tender->ctd_description ?? '' }}
                        </td>
                        <td>
                            {{ $folder->cdo_name }}
                        </td>
                        <td>
                            @if($tenderFiles= $tender->getfiles())
                                <div class="tender_pdf">
                                    @foreach($tenderFiles AS $file)
                                    <a href="{{ $file->cfm_original_name }}" target="_blank" style="display: inline-block">
                                        <img src="{{ asset('img/pdf/quarterly_icon.png') }}">
                                    </a>
                                    @endforeach
                                </div>
                            @endif
                                
                        </td>
                        
                        <td>
                            @can('tenderupload_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.tenderuploads.show', $tender->ctd_id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('tenderupload_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.tenderuploads.edit', $tender->ctd_id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('tenderupload_delete')
                                    <form action="{{ route('admin.tenderuploads.destroy', $tender->ctd_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                           

                        </td>

                    </tr>
                    @endforeach
                    @endif
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
$(function() {
   

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 100,
    });
    let table = $('.datatable-Sportstype:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection