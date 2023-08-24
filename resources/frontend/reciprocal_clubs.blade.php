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
                        @foreach($galleries->where("id","17") as $key => $gallery)

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



            <!-- ********|| Reciprocal START ||******** -->
            <section class="reciprocal-page inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    RECIPROCAL CLUBS
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","5") as $contentPage)
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

            <section class="reciprocal_tabsection">
                <div class="container">
                    <div class="row">
                        <div class="reciprocal-tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="india-tab" data-toggle="tab" href="#india">
                                        <div class="tab_icontext">
                                            <img src="{{ asset('img/reciprocal/overseas_tabicon.png') }}" alt="" />
                                            <h3>Indian</h3>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="overseas-tab" data-toggle="tab" href="#overseas">
                                        <div class="tab_icontext">
                                            <img src="{{ asset('img/reciprocal/india_tabicon.png') }}" alt="" />
                                            <h3>Overseas</h3>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="india" role="tabpanel"
                                    aria-labelledby="india-tab">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">
                                            @foreach($reciprocal->where("cub_type","indian") as $key =>
                                            $recip)
                                            <div class="col-sm-6 col-md-12 col-lg-4 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{$recip->getFirstMediaUrl('club_image')}}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_info">
                                                        <h3>{{$recip->reciprocal_club_name}}</h3>
                                                        <p class="clubdetails_info"><i class="zmdi zmdi-pin"></i>
                                                            {{$recip->address_1}}</p>
                                                        <p class="clubdetails_info"><a href="tel:{{$recip->phone}}"><i
                                                                    class="zmdi zmdi-phone"></i>
                                                                {{$recip->phone}}</a>
                                                            <!-- /<a href="tel:{{$recip->phone}}">{{$recip->phone}}</a> -->
                                                        </p>
                                                        <p class="clubdetails_info"><a
                                                                href="mailto:{{$recip->email}}"><i
                                                                    class="zmdi zmdi-email"></i>
                                                                {{$recip->email}}</a></p>
                                                        @if(!empty($recip->website))        
                                                        <p class="clubdetails_info"><a href="https://{{$recip->website}}"
                                                                target="_blank" rel="nofollow"><i
                                                                    class="zmdi zmdi-wifi-alt"></i>
                                                                {{$recip->website}}</a></p>
                                                        @endif        
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            <!-- <div class="col-sm-6 col-md-12 col-lg-4 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/reciprocal/logo2.png') }}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_info">
                                                        <h3>Madras Boat Club</h3>
                                                        <p class="clubdetails_info"><i class="zmdi zmdi-pin"></i> No. 2,
                                                            3rd Avenue Raja Annamalaipuram, Chennai 600028</p>
                                                        <p class="clubdetails_info"><a href="tel:(044)2435-3190"><i
                                                                    class="zmdi zmdi-phone"></i> (044)2852-3976</a>/<a
                                                                href="tel:(044)2855-0341">2435-4751</a></p>
                                                        <p class="clubdetails_info"><a
                                                                href="mailto:contact@madrascricketclub.org"><i
                                                                    class="zmdi zmdi-email"></i>
                                                                contact@madrascricketclub.org</a></p>
                                                        <p class="clubdetails_info"><a href="tel:(044)2852-3976"><i
                                                                    class="zmdi zmdi-print"></i> (044) 2432-3235</a></p>
                                                        <p class="clubdetails_info"><a href="//www.madrasboatclub.in"
                                                                target="_blank" rel="nofollow"><i
                                                                    class="zmdi zmdi-wifi-alt"></i>
                                                                www.madrasboatclub.in</a></p>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="col-sm-6 col-md-6 col-lg-4 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/reciprocal/logo3.png') }}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_info">
                                                        <h3>BYC Royal Bombay Yacht Club</h3>
                                                        <p class="clubdetails_info"><i class="zmdi zmdi-pin"></i> 1,
                                                            BABU JAGJIVAN RAM ROAD CHENNAI600005</p>
                                                        <p class="clubdetails_info"><a href="tel:(044)2852-3976"><i
                                                                    class="zmdi zmdi-phone"></i> (044)2852-3976</a>/<a
                                                                href="tel:(044)2855-0341">2855-0341</a></p>
                                                        <p class="clubdetails_info"><a
                                                                href="mailto:contact@madrascricketclub.org"><i
                                                                    class="zmdi zmdi-email"></i>
                                                                contact@madrascricketclub.org</a></p>
                                                        <p class="clubdetails_info"><a href="tel:(044)2852-3976"><i
                                                                    class="zmdi zmdi-print"></i> (044) 2432-3235</a></p>
                                                        <p class="clubdetails_info"><a
                                                                href="//www.madrascricketclub.org" target="_blank"
                                                                rel="nofollow"><i class="zmdi zmdi-wifi-alt"></i>
                                                                www.madrascricketclub.org</a></p>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="col-sm-6 col-md-6 col-lg-4 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/reciprocal/logo8.jpg') }}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_info">
                                                        <h3>Amanora The Ferns Hotels & Club</h3>
                                                        <p class="clubdetails_info"><i class="zmdi zmdi-pin"></i> 1,
                                                            BABU JAGJIVAN RAM ROAD CHENNAI 600005</p>
                                                        <p class="clubdetails_info"><a href="tel:(044)2852-3976"><i
                                                                    class="zmdi zmdi-phone"></i> (044)2852-3976</a>/<a
                                                                href="tel:(044)2855-0341">2855-0341</a></p>
                                                        <p class="clubdetails_info"><a
                                                                href="mailto:contact@madrascricketclub.org"><i
                                                                    class="zmdi zmdi-email"></i>
                                                                contact@madrascricketclub.org</a></p>
                                                        <p class="clubdetails_info"><a
                                                                href="//www.madrascricketclub.org" target="_blank"
                                                                rel="nofollow"><i class="zmdi zmdi-wifi-alt"></i>
                                                                www.madrascricketclub.org</a></p>
                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="overseas" role="tabpanel" aria-labelledby="overseas-tab">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">
                                            @foreach($reciprocal->where("cub_type","overseas") as $key =>
                                            $recip)
                                            <div class="col-sm-6 col-md-6 col-lg-4 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{$recip->getFirstMediaUrl('club_image')}}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_info">
                                                        <h3>{{$recip->reciprocal_club_name}}</h3>
                                                        <p class="clubdetails_info"><i class="zmdi zmdi-pin"></i>
                                                            {{$recip->address_1}}</p>
                                                        <p class="clubdetails_info"><a href="tel:{{$recip->phone}}"><i
                                                                    class="zmdi zmdi-phone"></i>
                                                                {{$recip->phone}}</a>
                                                            <!-- /<a href="tel: {{$recip->phone}}">
                                                                {{$recip->phone}}</a> -->
                                                        </p>
                                                        <p class="clubdetails_info"><a
                                                                href="mailto:{{$recip->email}}"><i
                                                                    class="zmdi zmdi-email"></i>
                                                                {{$recip->email}}</a></p>
                                                        @if(!empty($recip->website))        
                                                        <p class="clubdetails_info"><a href="{{ url($recip->website) }}"
                                                                target="_blank" rel="nofollow"><i
                                                                    class="zmdi zmdi-wifi-alt"></i>
                                                                {{$recip->website}}</a></p>
                                                        @endif        
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| Reciprocal END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>