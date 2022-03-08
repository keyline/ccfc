@extends('layouts.member')
@section('content')
<div class="col-lg-9 col-md-7 p-0">
    <div class="right-body">
<section class="member-protected">
<div class="container">
    <div class="row">
        @if(Session::has('fail'))
            {{ Session::get('fail') }}
        @endif
    </div>
</div>
</section>
</div>
</div>

@endsection