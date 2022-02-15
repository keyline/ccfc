<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserDetailRequest;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Models\User;
use App\Models\UserDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetails = UserDetail::with(['user_code'])->get();

        return view('admin.userDetails.index', compact('userDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_codes = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userDetails.create', compact('user_codes'));
    }

    public function store(StoreUserDetailRequest $request)
    {
        $userDetail = UserDetail::create($request->all());

        return redirect()->route('admin.user-details.index');
    }

    public function edit(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_codes = User::pluck('user_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userDetail->load('user_code');

        return view('admin.userDetails.edit', compact('userDetail', 'user_codes'));
    }

    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        $userDetail->update($request->all());

        return redirect()->route('admin.user-details.index');
    }

    public function show(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->load('user_code');

        return view('admin.userDetails.show', compact('userDetail'));
    }

    public function destroy(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserDetailRequest $request)
    {
        UserDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
