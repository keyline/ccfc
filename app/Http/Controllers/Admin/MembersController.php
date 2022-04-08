<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Models\Sportstype;
use App\Models\Title;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $members = Member::with(['select_member', 'select_title', 'select_sport'])->get();

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_titles = Title::pluck('titles', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_sports = Sportstype::pluck('sport_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.members.create', compact('select_members', 'select_sports', 'select_titles'));
    }

    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->all());

        return redirect()->route('admin.members.index');
    }

    public function edit(Member $member)
    {
        abort_if(Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_members = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_titles = Title::pluck('titles', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_sports = Sportstype::pluck('sport_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member->load('select_member', 'select_title', 'select_sport');

        return view('admin.members.edit', compact('member', 'select_members', 'select_sports', 'select_titles'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->all());

        return redirect()->route('admin.members.index');
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->load('select_member', 'select_title', 'select_sport');

        return view('admin.members.show', compact('member'));
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberRequest $request)
    {
        Member::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}