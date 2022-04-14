@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="card-header">
        <a href="{{ route("admin.user-details.index") }}" class="btn btn-primary float-end">Back</a>

    </div>
    <div class="col-lg-12">
    </div>

    @if (session('status'))

    <h6 class="alert alert-success">{{ session('status') }}</h6>

    @endif

    <div class="card-body">

        <form method="POST" action="{{ url('admin/create/update-details/'.$userDetail->id)}}"
            enctype="multipart/form-data">
            @csrf

            @method('PUT')


            <div class="form-group">
                <label class="required" for="user_code_id">{{ trans('cruds.userDetail.fields.user_code') }}</label>
                <select class="form-control select2 {{ $errors->has('user_code') ? 'is-invalid' : '' }}"
                    name="user_code_id" id="user_code_id" required>
                    @foreach($user_codes as $id => $entry)
                    <option value="{{ $id }}"
                        {{ (old('user_code_id') ? old('user_code_id') : $userDetail->user_code->id ?? '') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_code'))
                <span class="text-danger">{{ $errors->first('user_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.user_code_helper') }}</span>
            </div>



            <div class="form-group">
                <label for="name_of_the_block">Member Type Code</label>
                <input type="text" name="day" value="{{$userDetail->member_type_code}}" class="form-control">

            </div>
            <div class="form-group">
                <label for="name_of_the_block">Member Image(Club Man)</label>
                <a href="{{ $userDetail['member_image'] }}" target="_blank" style="display: inline-block">
                    <img src="data:image/png;base64,                          
                                        {{ $userDetail['member_image'] }}" height="90" width="100" alt="" />
                </a>
            </div><br><br>

            <div class="form-group">
                <label for="name_of_the_block">Member Image(Using for committee part and sports part)</label>

                <input type="file" name="userimage" class="form-control"><br>
                <img src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}" width="100px" height="100px"
                    alt=""><br>

            </div><br><br>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>



@endsection