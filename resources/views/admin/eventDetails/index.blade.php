@extends('layouts.admin')
@section('content')
@can('event_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.event-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.eventDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EventDetail">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.eventDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventDetail.fields.event_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventDetail.fields.gallery') }}
                        </th>
                        <th>
                            {{ trans('cruds.gallery.fields.gallery_type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventDetails as $key => $eventDetail)
                        <tr data-entry-id="{{ $eventDetail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventDetail->event_title ?? '' }}
                            </td>
                            <td>
                                @if($eventDetail->event_image)
                                    <a href="{{ $eventDetail->event_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $eventDetail->event_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $eventDetail->event_date ?? '' }}
                            </td>
                            <td>
                                {{ $eventDetail->gallery->gallery_name ?? '' }}
                            </td>
                            <td>
                                @if($eventDetail->gallery)
                                    {{ $eventDetail->gallery::GALLERY_TYPE_SELECT[$eventDetail->gallery->gallery_type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('event_detail_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.event-details.show', $eventDetail->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('event_detail_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.event-details.edit', $eventDetail->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('event_detail_delete')
                                    <form action="{{ route('admin.event-details.destroy', $eventDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-EventDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection