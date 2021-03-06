@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.content-blocks.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.contentBlock.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contentBlock.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped table-hover datatable datatable-ContentBlock">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.name_of_the_block') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.heading') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.source_page') }}
                        </th>
                        <th>
                            <!-- {{ trans('cruds.contentPage.fields.excerpt') }} -->
                            {{ trans('cruds.contentBlock.fields.body') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contentBlocks as $key => $contentBlock)
                    <tr data-entry-id="{{ $contentBlock->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $contentBlock->id ?? '' }}
                        </td>
                        <td>
                            {{ $contentBlock->name_of_the_block ?? '' }}
                        </td>
                        <td>
                            {{ $contentBlock->heading ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\ContentBlock::STATUS_RADIO[$contentBlock->status] ?? '' }}
                        </td>
                        <td>
                            {{ $contentBlock->source_page->title ?? '' }}
                        </td>
                        <td>
                            <!-- {{ $contentBlock->source_page->excerpt ?? '' }} -->
                            {!! $contentBlock->body ?? '' !!}
                        </td>
                        <td>
                            @can('content_block_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.content-blocks.show', $contentBlock->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('content_block_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.content-blocks.edit', $contentBlock->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('content_block_delete')
                            <form action="{{ route('admin.content-blocks.destroy', $contentBlock->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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