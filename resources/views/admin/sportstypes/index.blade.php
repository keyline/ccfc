@extends('layouts.admin')
@section('content')
@can('sportstype_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.sportstypes.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.sportstype.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sportstype.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-Sportstype">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sportstype.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sportstype.fields.sport_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.sportstype.fields.icon') }}
                        </th>
                        <th>
                            {{ trans('cruds.sportstype.fields.excerpt') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sportstypes as $key => $sportstype)
                    <tr data-entry-id="{{ $sportstype->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $sportstype->id ?? '' }}
                        </td>
                        <td>
                            {{ $sportstype->sport_name ?? '' }}
                        </td>
                        <td>
                            @if($sportstype->icon)
                            <a href="{{ $sportstype->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $sportstype->icon->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            <!-- @if($sportstype->featured_image)
                            <a href="{{ $sportstype->featured_image->getUrl() }}" target="_blank"
                                style="display: inline-block">
                                <img src="{{ $sportstype->featured_image->getUrl('thumb') }}">
                            </a>
                            @endif -->

                            {{ $sportstype->sport_details ?? '' }}

                        </td>
                        <td>
                            @can('sportstype_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.sportstypes.show', $sportstype->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('sportstype_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.sportstypes.edit', $sportstype->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            <!-- @can('sportstype_delete')
                                    <form action="{{ route('admin.sportstypes.destroy', $sportstype->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan -->

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
    @can('sportstype_delete')
    let deleteButtonTrans = '{{ trans('
    global.datatables.delete ') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.sportstypes.massDestroy') }}",
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