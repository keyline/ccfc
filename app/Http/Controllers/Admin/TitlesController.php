<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTitleRequest;
use App\Http\Requests\StoreTitleRequest;
use App\Http\Requests\UpdateTitleRequest;
use App\Models\Title;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TitlesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('title_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titles = Title::all();

        return view('admin.titles.index', compact('titles'));
    }

    public function create()
    {
        abort_if(Gate::denies('title_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.titles.create');
    }

    public function store(StoreTitleRequest $request)
    {
        $title = Title::create($request->all());

        return redirect()->route('admin.titles.index');
    }

    public function edit(Title $title)
    {
        abort_if(Gate::denies('title_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.titles.edit', compact('title'));
    }

    public function update(UpdateTitleRequest $request, Title $title)
    {
        $title->update($request->all());

        return redirect()->route('admin.titles.index');
    }

    public function show(Title $title)
    {
        abort_if(Gate::denies('title_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.titles.show', compact('title'));
    }

    public function destroy(Title $title)
    {
        abort_if(Gate::denies('title_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $title->delete();

        return back();
    }

    public function massDestroy(MassDestroyTitleRequest $request)
    {
        Title::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
