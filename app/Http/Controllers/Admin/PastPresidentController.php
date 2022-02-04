<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPastPresidentRequest;
use App\Http\Requests\StorePastPresidentRequest;
use App\Http\Requests\UpdatePastPresidentRequest;
use App\Models\PastPresident;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PastPresidentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('past_president_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pastPresidents = PastPresident::all();

        return view('admin.pastPresidents.index', compact('pastPresidents'));
    }

    public function create()
    {
        abort_if(Gate::denies('past_president_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.create');
    }

    public function store(StorePastPresidentRequest $request)
    {
        $pastPresident = PastPresident::create($request->all());

        return redirect()->route('admin.past-presidents.index');
    }

    public function edit(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.edit', compact('pastPresident'));
    }

    public function update(UpdatePastPresidentRequest $request, PastPresident $pastPresident)
    {
        $pastPresident->update($request->all());

        return redirect()->route('admin.past-presidents.index');
    }

    public function show(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pastPresidents.show', compact('pastPresident'));
    }

    public function destroy(PastPresident $pastPresident)
    {
        abort_if(Gate::denies('past_president_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pastPresident->delete();

        return back();
    }

    public function massDestroy(MassDestroyPastPresidentRequest $request)
    {
        PastPresident::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
