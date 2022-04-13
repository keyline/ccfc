@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a href="{{ url('admin/create/add-event')}}" class="btn btn-primary float-end">Add</a>
    </div>
</div>
@endcan
<div class="card">


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ContentBlock">
                <thead>
                    <tr>
                        <!-- <th width="10">

                        </th> -->

                        <th>
                            Sl No
                        </th>
                        <th>
                            Publish of date
                        </th>

                        <th>
                            Publish of month
                        </th>

                        <th>
                            Details 1
                        </th>

                        <th>
                            Details 2
                        </th>

                        <th>
                            Image
                        </th>

                        <th>
                            Edit
                        </th>

                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event as $value)
                    <tr>
                        <td>
                            {{$value->id}}
                        </td>

                        <td>
                            {{$value->day}}
                        </td>

                        <td>
                            {{$value->month}}
                        </td>

                        <td>
                            {{$value->details_1}}
                        </td>

                        <td>
                            {!! $value->details_2 !!}
                        </td>

                        <td>
                            <img src="{{ asset('uploads/enentimg/'.$value->event_image)}}" width="100px" height="100px"
                                alt="">
                        </td>


                        <td>
                            <a href="{{ url('admin/create/edit-event/'.$value->id)}}"
                                class="btn btn-primary btn-sm">Edit</a>
                        </td>


                        <td>
                            <a href="{{ url('admin/create/delete-event/'.$value->id)}}"
                                class="btn btn-danger btn-sm">Delete</a>

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
    @can('content_block_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.content-blocks.massDestroy') }}",
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
    let table = $('.datatable-ContentBlock:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection