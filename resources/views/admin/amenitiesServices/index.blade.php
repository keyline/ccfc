@extends('layouts.admin')
@section('content')
@can('amenities_service_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.amenities-services.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.amenitiesService.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.amenitiesService.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-AmenitiesService">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.amenity_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.amenitiesService.fields.image_gallery') }}
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
                    @foreach($amenitiesServices as $key => $amenitiesService)
                        <tr data-entry-id="{{ $amenitiesService->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $amenitiesService->id ?? '' }}
                            </td>
                            <td>
                                {{ $amenitiesService->amenity_name ?? '' }}
                            </td>
                            <td>
                                {{ $amenitiesService->image_gallery->gallery_name ?? '' }}
                            </td>
                            <td>
                                @if($amenitiesService->image_gallery)
                                    {{ $amenitiesService->image_gallery::GALLERY_TYPE_SELECT[$amenitiesService->image_gallery->gallery_type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('amenities_service_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.amenities-services.show', $amenitiesService->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('amenities_service_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.amenities-services.edit', $amenitiesService->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('amenities_service_delete')
                                    <form action="{{ route('admin.amenities-services.destroy', $amenitiesService->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('amenities_service_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.amenities-services.massDestroy') }}",
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
  let table = $('.datatable-AmenitiesService:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection