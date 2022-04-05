<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ?php include 'assets/inc/header.php';?> -->

    <!-- header -->
    @include('common.home_header')
    <!-- ********|| RIGHT PART START ||******** -->

    <div class="col-lg-9 col-md-7 p-0">
        <div class="right-body">
            <!-- ********|| BANNER PART START ||******** -->
            <section class="banner">

                <div class="banner-box">

                    <div id="innerpage-banner" class="owl-carousel owl-theme">

                        @foreach($galleries->where("id","19") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)

                        <div class="item">

                            <div class="about-img">

                                <!-- <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" /> -->
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />

                            </div>

                        </div>
                        @endforeach
                        @endforeach
                        <!-- <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

                            </div>

                        </div> -->

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| General Committee START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Balloting Committee
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","7") as $contentPage)
                            <!-- <div class="content_inner">
                                <p>In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.</p>
                                <p>The club also offers food from its different counters like charcoal-grilled kebabs,
                                    quick bites of wraps, burgers, pastas etc. There is also a pastry shop and
                                    specialized tea & coffee counters serving wide varieties of tea and coffee.</p>
                            </div> -->
                            {!! $contentPage->page_text !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <section class="balloting_infolist inner_belowbox_wrapper">
                <div class="multiuse_tab_content_section">
                    <div class="container">
                        <div class="row">
                            @foreach($committeeMemberMappings->where("committee_id","2") as
                            $committeeMember)
                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id) as
                            $key =>$userDetail)

                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                <div class="multiuse_tabcontent_inner">

                                    @if($userDetail['member_image'] == '')
                                    <div class="multiuse_tab_ceibity-img">
                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                    </div>
                                    @else

                                    <div class="multiuse_tab_ceibity-img">
                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                            <img class="img-fluid" src="data:image/png;base64,                          
                                        {{ $userDetail['member_image'] }}" alt="" />
                                        </a>
                                    </div>

                                    @endif

                                    <div class="multiuse_bottom_general">
                                        <h3>{{ $committeeMember->member->name ?? '' }}</h3>
                                        <h4>{{ $committeeMember->designation ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @endforeach
                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                <div class="multiuse_tabcontent_inner">
                                    <div class="multiuse_tab_ceibity-img">
                                        <img src="{{ asset('img/balloting-committee/DINYAR M.jpg') }}" alt="" />
                                    </div>
                                    <div class="multiuse_bottom_general">
                                        <h3>Mr. Dinyar Mucadum</h3>
                                        <h4>Member</h4>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                <div class="multiuse_tabcontent_inner">
                                    <div class="multiuse_tab_ceibity-img">
                                        <img src="{{ asset('img/balloting-committee/PRONOB DASGUPTA.jpg') }}" alt="" />
                                    </div>
                                    <div class="multiuse_bottom_general">
                                        <h3>Dr. Pronab Dasgupta</h3>
                                        <h4>Member</h4>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                <div class="multiuse_tabcontent_inner">
                                    <div class="multiuse_tab_ceibity-img">
                                        <img src="{{ asset('img/balloting-committee/RAVI KIDWAI.jpg') }}" alt="" />
                                    </div>
                                    <div class="multiuse_bottom_general">
                                        <h3>Mr. Ravi Kidwai</h3>
                                        <h4>Member</h4>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                <div class="multiuse_tabcontent_inner">
                                    <div class="multiuse_tab_ceibity-img">
                                        <img src="{{ asset('img/balloting-committee/BABUL MITTER.jpg') }}" alt="" />
                                    </div>
                                    <div class="multiuse_bottom_general">
                                        <h3>Mr. Babul Mitter</h3>
                                        <h4>Member</h4>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| General Committee END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>