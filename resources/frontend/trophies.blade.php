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

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" />

                            </div>

                        </div>

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| TROPHIES START ||******** -->
            <section class="famoussport-page inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    TROPHIES
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","3") as $contentPage)
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

            <section class="trophies_tabsection">
                <div class="container">
                    <div class="row">
                        <div class="trophies-tablist">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="year1993-tab" data-toggle="tab" href="#year1992">
                                        <div class="tab_icontext">
                                            <img src="{{ asset('img/trophy/trophy-icon.png') }}" alt="" />
                                            <h3>1992</h3>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="year1993-tab" data-toggle="tab" href="#year1993">
                                        <div class="tab_icontext">
                                            <img src="{{ asset('img/trophy/trophy-icon.png') }}" alt="" />
                                            <h3>1993</h3>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="year1992" role="tabpanel"
                                    aria-labelledby="year1992-tab">
                                    <div class="trophies_tab_content_section">
                                        <div class="row">
                                            @foreach($trophies->where("year_of_award","1992") as $trophie)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal"><img
                                                                src="{{$trophie->getFirstMediaUrl('trophy_photo')}}"
                                                                alt="" /></a>

                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>{{$trophie->trophy}}</h3>
                                                        <h4>{{$trophie->year_of_award}} - {{$trophie->year_of_month}}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1992 - January</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_2"><img
                                                                src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1993 - February</h4>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/trophy/t-img1.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1992 - January</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_2"><img
                                                                src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1993 - February</h4>
                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="year1993" role="tabpanel" aria-labelledby="year1993-tab">
                                    <div class="trophies_tab_content_section">
                                        <div class="row">
                                            @foreach($trophies->where("year_of_award","1993") as $trophie)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{$trophie->getFirstMediaUrl('trophy_photo')}}"
                                                                alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>{{$trophie->trophy}}</h3>
                                                        <h4>{{$trophie->year_of_award}} - {{$trophie->year_of_month}}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_2"><img
                                                                src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1993 - February</h4>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/trophy/t-img1.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1992 - January</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="trophy_tabcontent_inner">
                                                    <div class="trophy_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_2"><img
                                                                src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" /></a>
                                                    </div>
                                                    <div class="trophy_player">
                                                        <h3>Champion</h3>
                                                        <h4>1993 - February</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| TROPHIES END ||******** -->


            <!-- ********|| Mddal ||******** -->
            <div class="modal fade" id="year1992_1" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content trophy-popup">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid" src="{{ asset('img/trophy/t-img1.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="year1992_2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content trophy-popup">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid" src="{{ asset('img/trophy/t-img2.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>


            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->

            <script>
            $('#tropphies_yearroll').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 8
                        //nav: false,
                    }
                }
            })
            $(document).ready(function() {
                var li = $(".item li ");
                $(".owl-item li").click(function() {
                    li.removeClass('active');
                });
            });
            </script>

            </body>

</html>