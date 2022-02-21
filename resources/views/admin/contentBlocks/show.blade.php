@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contentBlock.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-blocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.id') }}
                        </th>
                        <td>
                            {{ $contentBlock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.name_of_the_block') }}
                        </th>
                        <td>
                            {{ $contentBlock->name_of_the_block }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.heading') }}
                        </th>
                        <td>
                            {{ $contentBlock->heading }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.body') }}
                        </th>
                        <td>
                            {!! $contentBlock->body !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ContentBlock::STATUS_RADIO[$contentBlock->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.source_page') }}
                        </th>
                        <td>
                            {{ $contentBlock->source_page->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-blocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection