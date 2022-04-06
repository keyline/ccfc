<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubCommitteeMemberRequest;
use App\Http\Requests\StoreSubCommitteeMemberRequest;
use App\Http\Requests\UpdateSubCommitteeMemberRequest;
use App\Models\CommitteeName;
use App\Models\SubCommitteeMember;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCommitteeMembersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sub_committee_member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCommitteeMembers = SubCommitteeMember::with(['comittee_name', 'member'])->get();

        return view('admin.subCommitteeMembers.index', compact('subCommitteeMembers'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_committee_member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comittee_names = CommitteeName::pluck('committee_name_master', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subCommitteeMembers.create', compact('comittee_names', 'members'));
    }

    public function store(StoreSubCommitteeMemberRequest $request)
    {
        $subCommitteeMember = SubCommitteeMember::create($request->all());

        return redirect()->route('admin.sub-committee-members.index');
    }

    public function edit(SubCommitteeMember $subCommitteeMember)
    {
        abort_if(Gate::denies('sub_committee_member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comittee_names = CommitteeName::pluck('committee_name_master', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subCommitteeMember->load('comittee_name', 'member');

        return view('admin.subCommitteeMembers.edit', compact('comittee_names', 'members', 'subCommitteeMember'));
    }

    public function update(UpdateSubCommitteeMemberRequest $request, SubCommitteeMember $subCommitteeMember)
    {
        $subCommitteeMember->update($request->all());

        return redirect()->route('admin.sub-committee-members.index');
    }

    public function show(SubCommitteeMember $subCommitteeMember)
    {
        abort_if(Gate::denies('sub_committee_member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCommitteeMember->load('comittee_name', 'member');

        return view('admin.subCommitteeMembers.show', compact('subCommitteeMember'));
    }

    public function destroy(SubCommitteeMember $subCommitteeMember)
    {
        abort_if(Gate::denies('sub_committee_member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCommitteeMember->delete();

        return back();
    }

    public function massDestroy(MassDestroySubCommitteeMemberRequest $request)
    {
        SubCommitteeMember::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}