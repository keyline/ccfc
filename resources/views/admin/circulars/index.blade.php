@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a href="{{ url('admin/create/add-circular')}}" class="btn btn-primary float-end">Add</a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Publish of date</th>
                        <th>Publish of month</th>
                        <th>Details 1</th>
                        <th>Details 2</th>
                        <th>Image</th>
                        <th>Notice Image</th>
                        <th>Notice Validity</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1;?>
                    @foreach($circular as $value)
                    <tr>
                        <td>
                            <?=$sl++?>
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
                            <?php
                            $circular_image = $value->circular_image;
                            $fileURL = url('/').'/uploads/circularimg/'.$circular_image;
                            if($circular_image != ''){
                                $fileExtn = $ext = pathinfo($circular_image, PATHINFO_EXTENSION);
                                if($fileExtn == 'pdf' || $fileExtn == 'PDF'){
                                ?>
                                    <embed src="<?=$fileURL?>" width="300" height="200" type="application/pdf">
                                <?php
                                } else {
                                ?>
                                    <img src="<?=$fileURL?>" width="100" height="100" class="img-thumbnail">
                                <?php
                                }
                            }
                            ?>                            
                        </td>
                        <td>
                            <?php
                            $circular_image2 = $value->circular_image2;
                            $fileURL = url('/').'/uploads/circularimg/'.$circular_image2;
                            if($circular_image2 != ''){
                                $fileExtn = $ext = pathinfo($circular_image2, PATHINFO_EXTENSION);
                                if($fileExtn == 'pdf' || $fileExtn == 'PDF'){
                                ?>
                                    <embed src="<?=$fileURL?>" width="300" height="200" type="application/pdf">
                                <?php
                                } else {
                                ?>
                                    <img src="<?=$fileURL?>" width="100" height="100" class="img-thumbnail">
                                <?php
                                }
                            }
                            ?>
                            
                            <!-- <img src="{{ asset('uploads/circularimg/'.$value->circular_image2)}}" width="100px"
                                height="100px" alt=""> -->
                            <!-- <form action="{{ url('admin/create/remove-circular/'.$value->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> -->
                            <!-- <form action="{{ url('admin/create/remove-circular/'.$value->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$value->id}}" />
                                <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                            </form> -->
                        </td>
                        <td>
                            <?=(($value->validity != '')?date_format(date_create($value->validity), "d-M-Y"):'')?>
                        </td>
                        <td>
                            <a href="{{ url('admin/create/edit-circular/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <a href="{{ url('admin/create/delete-circular/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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