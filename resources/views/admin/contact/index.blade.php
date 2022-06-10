@extends('layouts.admin')
@section('content')
@can('amenities_service_create')
<div style="margin-bottom: 10px;" class="row">

</div>
@endcan
<div class="card">
    <div class="card-header">
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-AmenitiesService">
                <thead>
                    <tr>
                        <th width="10">Sl No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Add on</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ContactArr as $value)

                    <tr>
                        <td>
                            {{ $value -> id  }}

                        </td>

                        <td>
                            {{ $value -> name }}
                        </td>

                        <td>
                            {{ $value -> email }}
                        </td>

                        <td>
                            {{ $value -> phone }}
                        </td>

                        <td>
                            {{ $value -> message }}
                        </td>

                        <td>
                            {{ $value -> created_at }}
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
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('amenities_service_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.amenities-services.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).nodes(), function(entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('
                    global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('
                    global.areYouSure ') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 100,
    });
    let table = $('.datatable-AmenitiesService:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection