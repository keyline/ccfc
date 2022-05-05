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

                        @foreach($galleries->where("id","15") as $key => $gallery)

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
            <!-- ********|| TROPHIES START ||******** -->
            <section class="history-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="history-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Trophies
                                    </div>
                                </div>

                                <div class="pastpresident_imagebox">
                                    <div class="pastpresident_item">
                                        <div class="row">
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/1.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>International Trophy for Annual Competition Between Scotland and England.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/2.jpg') }}" alt="">
                                                    </div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>The Centenary Cup Women.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/3.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Calcutta Cup Men.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/4.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>The Centenary Cup Men.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/5.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Calcutta Club (Group B).</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/6.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>The Calcutta Club Women.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/7.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>All India Women's Rugby XV's Championship.</p>
                                                    </div>
                                                </div>
                                            </div> 
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/8.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>J. Thomas Cup (August 1973).</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/9.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Traditional Friendly Cricket Match Between Dhaka Club.</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/10.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Millenium Cricket Eleven.</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/11.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Constitution Club Trophy.</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/12.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>The St. James Cup for Anglo Indian School.</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/13.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>Calcutta Rugby Team Kicking Cup.</p>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember trophies">
                                                    <div class="trophies-img"><img
                                                            src="{{ asset('img/trophy/14.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
<!--                                                        <h2>Mr. R. B. Lagden</h2>-->
                                                        <p>St. James Trophy 1992.</p>
                                                    </div>
                                                </div>
                                            </div>
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