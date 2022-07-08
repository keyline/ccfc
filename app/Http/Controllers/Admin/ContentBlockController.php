<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentBlockRequest;
use App\Http\Requests\StoreContentBlockRequest;
use App\Http\Requests\UpdateContentBlockRequest;
use App\Models\ContentBlock;
use App\Models\ContentPage;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ContentBlockController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('content_block_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlocks = ContentBlock::with(['source_page'])->get();

        return view('admin.contentBlocks.index', compact('contentBlocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_block_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $source_pages = ContentPage::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contentBlocks.create', compact('source_pages'));
    }

    public function store(StoreContentBlockRequest $request)
    {
        $contentblock = new ContentBlock;
        $contentblock->name_of_the_block = $request->input('name_of_the_block');
        $contentblock->heading = $request->input('heading');
        $contentblock->body = $request->input('body');
        $contentblock->status = $request->input('status');
        $contentblock->source_page_id = $request->input('source_page_id');
        if($request->hasfile('circularimage')){
            $file1 = $request->file('circularimage');
            $filename= date('YmdHi').$file1->getClientOriginalName();
            $file1->move('uploads/circularimg/',$filename);
            $contentblock->circularimage = $filename;
        }
        //echo '<pre>';print_r($contentblock);die;
        $contentblock->save();
        //$contentBlock = ContentBlock::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentBlock->id]);
        }

        return redirect()->route('admin.content-blocks.index');
    }

    public function edit(ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $source_pages = ContentPage::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contentBlock->load('source_page');
        //echo '<pre>';print_r($contentBlock);die;
        return view('admin.contentBlocks.edit', compact('contentBlock', 'source_pages'));
    }

    //public function update(UpdateContentBlockRequest $request, ContentBlock $contentBlock)
    public function update(Request $request, $id)
    {
        $contentblockrow = ContentBlock::find($id);

        //$contentBlock->update($request->all());
        $contentblock = new ContentBlock;
        //$circular = circular::find($id);
        $contentblock->name_of_the_block = $request->input('name_of_the_block');
        $contentblock->heading = $request->input('heading');
        $contentblock->body = $request->input('body');
        $contentblock->status = $request->input('status');
        $contentblock->source_page_id = $request->input('source_page_id');
        if($request->hasfile('circularimage')){
            $destination = 'uploads/circularimg/'.$contentblockrow->circularimage;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file1 = $request->file('circularimage');
            $filename= date('YmdHi').$file1->getClientOriginalName();
            $file1->move('uploads/circularimg/',$filename);
            $contentblock->circular_image = $filename;
        }
        //echo '<pre>';print_r($contentblock);die;
        $contentblock->update();

        return redirect()->route('admin.content-blocks.index');
    }

    public function show(ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlock->load('source_page');

        return view('admin.contentBlocks.show', compact('contentBlock'));
    }

    public function destroy(ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlock->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentBlockRequest $request)
    {
        ContentBlock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_block_create') && Gate::denies('content_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentBlock();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}