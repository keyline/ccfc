@extends('layouts.member')
@section('content')
<div class="col-lg-9 col-md-7 p-0">
    <div class="right-body">
        <section class="banner">
            <div class="banner-box">
                <div id="innerpage-banner" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="about-img">
                            <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="member-protected">
            
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('fail'))
                        <div class="membermustlogin_box">
                            <div class="membermustlogin_img"><img class="img-fluid" src="{{ asset('img/alerticon_memb.png') }}" alt="" /></div> 
                            <div class="menbt_text">{{ Session::get('fail') }}</div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        </section>
    

@include('common.footer')
</body>

</html>
@endsection