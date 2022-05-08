@extends('layouts.admin')
@section('content')
@can('reciprocal_club_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.reciprocal-clubs.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.reciprocalClub.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.reciprocalClub.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ReciprocalClub">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.reciprocal_club_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.address_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.website') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.club_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.reciprocalClub.fields.cub_type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reciprocalClubs as $key => $reciprocalClub)
                    <tr data-entry-id="{{ $reciprocalClub->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $reciprocalClub->id ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->reciprocal_club_name ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->address_1 ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->address_2 ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->phone ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->email ?? '' }}
                        </td>
                        <td>
                            {{ $reciprocalClub->website ?? '' }}
                        </td>
                        <td>
                            @if($reciprocalClub->club_image)
                            <a href="{{ $reciprocalClub->club_image->getUrl() }}" target="_blank"
                                style="display: inline-block">
                                <img src="{{ $reciprocalClub->club_image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ App\Models\ReciprocalClub::CUB_TYPE_RADIO[$reciprocalClub->cub_type] ?? '' }}
                        </td>
                        <td>
                            @can('reciprocal_club_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.reciprocal-clubs.show', $reciprocalClub->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('reciprocal_club_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.reciprocal-clubs.edit', $reciprocalClub->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('reciprocal_club_delete')
                            <form action="{{ route('admin.reciprocal-clubs.destroy', $reciprocalClub->id) }}"
                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
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
$(function() {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('reciprocal_club_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.reciprocal-clubs.massDestroy') }}",
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
    let table = $('.datatable-ReciprocalClub:not(.ajaxTable)').DataTable({
        buttons: dtButtons
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

})
</script>
@endsection