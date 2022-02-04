@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.news.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.news.fields.id') }}
                        </th>
                        <td>
                            {{ $news->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.news.fields.news_title') }}
                        </th>
                        <td>
                            {{ $news->news_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.news.fields.news_details') }}
                        </th>
                        <td>
                            {!! $news->news_details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.news.fields.event_image') }}
                        </th>
                        <td>
                            @foreach($news->event_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection