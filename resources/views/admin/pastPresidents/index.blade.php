@extends('layouts.admin')
@section('content')
@can('past_president_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.past-presidents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pastPresident.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pastPresident.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PastPresident">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pastPresident.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pastPresident.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.pastPresident.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.pastPresident.fields.short_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.pastPresident.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pastPresidents as $key => $pastPresident)
                        <tr data-entry-id="{{ $pastPresident->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pastPresident->id ?? '' }}
                            </td>
                            <td>
                                {{ $pastPresident->name ?? '' }}
                            </td>
                            <td>
                                {{ $pastPresident->duration ?? '' }}
                            </td>
                            <td>
                                {{ $pastPresident->short_order ?? '' }}
                            </td>
                            <td>
                                @if($pastPresident->image)
                                    <a href="{{ $pastPresident->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $pastPresident->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('past_president_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.past-presidents.show', $pastPresident->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('past_president_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.past-presidents.edit', $pastPresident->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('past_president_delete')
                                    <form action="{{ route('admin.past-presidents.destroy', $pastPresident->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('past_president_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.past-presidents.massDestroy') }}",
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
  let table = $('.datatable-PastPresident:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection