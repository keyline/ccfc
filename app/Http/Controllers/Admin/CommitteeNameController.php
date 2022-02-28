<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommitteeNameRequest;
use App\Http\Requests\StoreCommitteeNameRequest;
use App\Http\Requests\UpdateCommitteeNameRequest;
use App\Models\CommitteeName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommitteeNameController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('committee_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committeeNames = CommitteeName::all();

        return view('admin.committeeNames.index', compact('committeeNames'));
    }

    public function create()
    {
        abort_if(Gate::denies('committee_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.committeeNames.create');
    }

    public function store(StoreCommitteeNameRequest $request)
    {
        $committeeName = CommitteeName::create($request->all());

        return redirect()->route('admin.committee-names.index');
    }

    public function edit(CommitteeName $committeeName)
    {
        abort_if(Gate::denies('committee_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.committeeNames.edit', compact('committeeName'));
    }

    public function update(UpdateCommitteeNameRequest $request, CommitteeName $committeeName)
    {
        $committeeName->update($request->all());

        return redirect()->route('admin.committee-names.index');
    }

    public function show(CommitteeName $committeeName)
    {
        abort_if(Gate::denies('committee_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.committeeNames.show', compact('committeeName'));
    }

    public function destroy(CommitteeName $committeeName)
    {
        abort_if(Gate::denies('committee_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committeeName->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommitteeNameRequest $request)
    {
        CommitteeName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}