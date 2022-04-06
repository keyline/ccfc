<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommitteeMemberMappingRequest;
use App\Http\Requests\StoreCommitteeMemberMappingRequest;
use App\Http\Requests\UpdateCommitteeMemberMappingRequest;
use App\Models\CommitteeMemberMapping;
use App\Models\CommitteeName;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommitteeMemberMappingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('committee_member_mapping_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committeeMemberMappings = CommitteeMemberMapping::with(['committee', 'member'])->get();

        return view('admin.committeeMemberMappings.index', compact('committeeMemberMappings'));
    }

    public function create()
    {
        abort_if(Gate::denies('committee_member_mapping_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committees = CommitteeName::pluck('committee_name_master', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.committeeMemberMappings.create', compact('committees', 'members'));
    }

    public function store(StoreCommitteeMemberMappingRequest $request)
    {
        $committeeMemberMapping = CommitteeMemberMapping::create($request->all());

        return redirect()->route('admin.committee-member-mappings.index');
    }

    public function edit(CommitteeMemberMapping $committeeMemberMapping)
    {
        abort_if(Gate::denies('committee_member_mapping_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committees = CommitteeName::pluck('committee_name_master', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $committeeMemberMapping->load('committee', 'member');

        return view('admin.committeeMemberMappings.edit', compact('committeeMemberMapping', 'committees', 'members'));
    }

    public function update(UpdateCommitteeMemberMappingRequest $request, CommitteeMemberMapping $committeeMemberMapping)
    {
        $committeeMemberMapping->update($request->all());

        return redirect()->route('admin.committee-member-mappings.index');
    }

    public function show(CommitteeMemberMapping $committeeMemberMapping)
    {
        abort_if(Gate::denies('committee_member_mapping_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committeeMemberMapping->load('committee', 'member');

        return view('admin.committeeMemberMappings.show', compact('committeeMemberMapping'));
    }

    public function destroy(CommitteeMemberMapping $committeeMemberMapping)
    {
        abort_if(Gate::denies('committee_member_mapping_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $committeeMemberMapping->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommitteeMemberMappingRequest $request)
    {
        CommitteeMemberMapping::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}