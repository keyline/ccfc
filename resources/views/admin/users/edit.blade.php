@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>
    <pre><code>{{ json_encode($userProfile, JSON_PRETTY_PRINT) }}</code></pre>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]"
                    id="roles" multiple required>
                    @foreach($roles as $id => $role)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>
                        {{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>

            <!-- <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                    id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div> -->


            <div class="form-group">
                <label class="required" for="user_code">{{ trans('cruds.user.fields.user_code') }}</label>
                <input class="form-control {{ $errors->has('user_code') ? 'is-invalid' : '' }}" type="text"
                    name="user_code" id="user_code" value="{{ old('user_code', $user->user_code) }}" required>
                @if($errors->has('user_code'))
                <span class="text-danger">{{ $errors->first('user_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.user_code_helper') }}</span>
            </div>


            <div class="form-group">
                <label for="member_type_code">MEMBER TYPE CODE</label>
                <input class="form-control {{ $errors->has('member_type_code') ? 'is-invalid' : '' }}" type="text"
                    name="member_type_code" id="member_type_code" value="{{$userProfile['MEMBERTYPECODE'] }}">
            </div>
            <div class="form-group">
                <label for="name">MEMBER TYPE</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="membertype"
                    id="name" value="{{$userProfile['MEMBERTYPE'] }}">
            </div>

            <!-- <div class="form-group">
                <label for="name">MEMBERCODE</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="membertype"
                    id="name" value="{{$userProfile['MEMBER_CODE'] }}">
            </div> -->

            <div class="form-group">
                <label for="name">MEMBER NAME</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{$userProfile['MEMBER_NAME'] }}">
            </div>


            <div class="form-group">
                <label for="name">DOB</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="dob"
                    id="name" value="{{$userProfile['DOB'] }}">
            </div>


            <div class="form-group">
                <label for="name">MEMBER SINCE</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="membersince" id="name" value="{{$userProfile['MEMBER_SINCE'] }}">
            </div>


            <div class="form-group">
                <label for="name">SEX</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="sex"
                    id="name" value="{{$userProfile['SEX'] }}">
            </div>

            <div class="form-group">
                <label for="name">ADDRESS1</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="address1"
                    id="name" value="{{$userProfile['ADDRESS1'] }}">
            </div>

            <div class="form-group">
                <label for="name">ADDRESS2</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="address2"
                    id="name" value="{{$userProfile['ADDRESS2'] }}">
            </div>


            <div class="form-group">
                <label for="name">ADDRESS3</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="address3"
                    id="name" value="{{$userProfile['ADDRESS3'] }}">
            </div>


            <div class="form-group">
                <label for="name">CITY</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="city"
                    id="name" value="{{$userProfile['CITY'] }}">
            </div>


            <div class="form-group">
                <label for="name">STATE</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="state"
                    id="name" value="{{$userProfile['STATE'] }}">
            </div>


            <div class="form-group">
                <label for="name">PIN</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="pin"
                    id="name" value="{{$userProfile['PIN'] }}">
            </div>



            <div class="form-group">
                <label for="name">PHONE1</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="phone1"
                    id="name" value="{{$userProfile['PHONE1'] }}">
            </div>



            <div class="form-group">
                <label for="name">PHONE2</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="phone2"
                    id="name" value="{{$userProfile['PHONE2'] }}">
            </div>


            <div class="form-group">
                <label for="name">MOBILE NO</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="mobile"
                    id="name" value="{{$userProfile['MOBILENO'] }}">
            </div>


            <!-- <div class="form-group">
                <label for="name">EMAIL</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="email"
                    id="name" value="{{$userProfile['EMAIL'] }}">
            </div> -->




            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                    id="email" value="{{$userProfile['BUSINESS_EMAIL'] }}">
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>


            <div class="form-group">
                <label for="name">CURENTSTATUS</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="curentstatus" id="name" value="{{$userProfile['CURENTSTATUS'] }}">
            </div>

            <div class="form-group">
                <label for="name">REPRESENTED CLUB IN</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="represented" id="name" value="{{$userProfile['REPRESENTED_CLUB_IN'] }}">
            </div>


            <div class="form-group">
                <label for="name">BUSINESS EMAIL</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="businessemail" id="name" value="{{$userProfile['BUSINESS_EMAIL'] }}">
            </div>

            <div class="form-group">
                <label for="name">SPOUSE NAME</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="spousename"
                    id="name" value="{{$userProfile['SPOUSE_NAME'] }}">
            </div>

            <div class="form-group">
                <label for="name">SPOUSE_DOB</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="spousedob"
                    id="name" value="{{$userProfile['SPOUSE_DOB'] }}">
            </div>


            <div class="form-group">
                <label for="name">SPOUSE MOBILE NO</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="spousemobileno" id="name" value="{{$userProfile['SPOUSEMOBILENO'] }}">
            </div>


            <div class="form-group">
                <label for="name">ANNIVERSARY DATE</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                    name="anniversarydate" id="name" value="{{$userProfile['ANNIVERSARY_DATE'] }}">
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection