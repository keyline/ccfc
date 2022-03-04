@extends('layouts.member')

@section('content')
<div class="col-lg-9 col-md-7 p-0">
    <div class="right-body">

        <section class="banner">
            <div class="banner-box">
                <div class="banner-box">
                    <div id="innerpage-banner" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="about-img">
                                <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="item">
                            <div class="about-img">
                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner_belowbanner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-sec">
                            <div class="title text-left">
                                Welcome to dashboard
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- printing member profile data  -->

                        <pre><code>{{ json_encode($userProfile, JSON_PRETTY_PRINT) }}</code></pre>

                        <pre><code>{{ json_encode($userTransactions, JSON_PRETTY_PRINT) }}</code></pre>




                    </div>
                </div>
            </div>
        </section>

        @endsection