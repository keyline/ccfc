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
                    <div class="banner-box">
                        <div id="innerpage-banner" class="owl-carousel owl-theme">


                            @foreach($galleries->where("id","31") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)

                            <div class="item">

                                <div class="about-img">

                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />

                                </div>

                            </div>
                            @endforeach
                            @endforeach
                            <!-- <div class="item">
                                <div class="about-img">
                                    <img class="img-fluid"
                                        src="http://ccfc.keylines.net.in/storage/56/621718fa30d84_food_banner2.jpg"
                                        alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="about-img">
                                    <img class="img-fluid"
                                        src="http://ccfc.keylines.net.in/storage/57/621718fe6b14f_food_banner1.jpg"
                                        alt="">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| ACTIVITIES START ||******** -->
            <section class="history-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="history-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        EVENTS MEMBERS ONLY
                                    </div>
                                </div>
                                <div class="history-content text-left">


                                    @foreach($contentPages->where("id","15") as $contentPage)
                                    {!! $contentPage->page_text !!}
                                    @endforeach

                                    <!-- <p>The Club gym went through refurbishment and up gradation this February bringing a
                                        whole new face of health and fitness to our club. With the installation of new
                                        equipment it promises to bring a more pleasant and satisfying work out
                                        experience.</p>
                                    <p>Completely new flooring has been done along with provision of new fresh towels
                                        and mats. The gym is now better equipped with a whole new set of dumbbells, two
                                        new treadmills, two new machines for lower body exercise and a machine for a
                                        full body workout. The gym also has been well spaced out now giving more room
                                        for our members to work out and walk around. With this new freshly renovated gym
                                        and new equipment we can be assured that there will be a more enjoyable and
                                        fulfilling workout.
                                    </p>
                                    <p>We hope to see more members use the gym to build on their fitness and strength.
                                        The gym timings are 6 am to 1.30 pm and 2.30 pm to 9 pm from Tuesday to Sunday
                                        and the trainer is there to assist you whenever called upon.</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| ACTIVITIES END ||******** -->

            <!-- ********|| GYM GENERAL START ||******** -->
            <section class="activities-sec">
                <div class="container">
                    <div class="row">
                        @foreach($event as $value)

                        <div class="col-lg-6">
                            <div class="activities-inner">
                                <div class="activities-img">
                                    <!-- <img class="img-fluid"
                                        src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                        alt=""> -->

                                    <img class="img-fluid" src="{{ asset('uploads/enentimg/'.$value->event_image)}}"
                                        alt="">


                                </div>
                                <div class="activities-info">
                                    <div class="activities-body">
                                        <div class="activities-time">
                                            <!-- {{$value->month}}day -->
                                            {{$value->month}}<br><span>{{$value->day}}</span>
                                        </div>
                                        <div class="activities-box-part">
                                            posted by CCFC<br><span>circular</span>
                                        </div>
                                    </div>
                                    <div class="activities-content">

                                        {{$value->details_1}}

                                        <!-- Tuesday to Friday : 6.00 am to 10.00 am / 2.00 pm to 9.00 pm -->
                                    </div>
                                    <div class="activities-action">
                                        <!--                                            <a href="#" class="read-btn">+ Read all</a>-->
                                        <button type="button" class="read-btn" data-toggle="modal"
                                            data-target="#exampleModal{{$value->id}}">
                                            + Read all
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        <!-- <div class="col-lg-6">
                            <div class="activities-inner">
                                <div class="activities-img">
                                    <img class="img-fluid"
                                        src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                        alt="">
                                </div>
                                <div class="activities-info">
                                    <div class="activities-body">
                                        <div class="activities-time">
                                            sep<br><span>28</span>
                                        </div>
                                        <div class="activities-box-part">
                                            posted by CCFC<br><span>circular</span>
                                        </div>
                                    </div>
                                    <div class="activities-content">
                                        Tuesday to Friday : 6.00 am to 10.00 am / 2.00 pm to 9.00 pm
                                    </div>
                                    <div class="activities-action">
                                        <button type="button" class="read-btn" data-toggle="modal"
                                            data-target="#exampleModal">
                                            + Read all
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->



                    </div>
                </div>
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            <!-- ********|| ACTIVITIES Menu Modal Start ||******** -->

            <!-- ******** Dining Room Modal ******* -->
            <div class="modal fade" id="activities-dinning" tabindex="-1" role="dialog"
                aria-labelledby="ModalCarouselLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div id="demo" class="carousel slide" data-interval="false" data-ride="carousel">

                            <!-- The slideshow -->
                            <div class="carousel-inner">


                                <div class="carousel-item active">

                                    <img src="" alt="Menu">
                                </div>
                                <div class="carousel-item">

                                </div>


                                <!-- <div class="carousel-item active">
                                    <img src="{{ asset('img/activities/dining-menu-1.jpeg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/dining-menu-2.jpeg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/dining-menu-3.jpeg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/dining-menu-4.jpeg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/dining-menu-5.jpeg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/dining-menu-6.jpeg') }}" alt="Menu">
                                </div> -->

                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <i class="zmdi zmdi-chevron-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <i class="zmdi zmdi-chevron-right"></i>
                            </a>

                        </div>

                    </div>

                </div>
            </div>


            <!-- ******** Club Kitchen Modal ******* -->
            <div class="modal fade" id="activities-clubkitchen" tabindex="-1" role="dialog"
                aria-labelledby="ModalCarouselLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div id="demo-clubkitchen" class="carousel slide" data-interval="false" data-ride="carousel">

                            <!-- The slideshow -->
                            <div class="carousel-inner">

                                <div class="carousel-item active">

                                    <img src="" alt="Menu">
                                </div>
                                <!-- <div class="carousel-item active">
                                    <img src="{{ asset('img/activities/club-kitchen-banner1.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner2.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner3.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner4.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner5.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner6.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner7.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner8.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner9.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner10.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner11.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner12.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner13.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner14.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner15.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner16.jpg') }}" alt="Menu">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/activities/club-kitchen-banner17.jpg') }}" alt="Menu">
                                </div> -->
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo-clubkitchen" data-slide="prev">
                                <!--<span class="carousel-control-prev-icon"></span>-->
                                <i class="zmdi zmdi-chevron-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#demo-clubkitchen" data-slide="next">
                                <!--<span class="carousel-control-next-icon"></span>-->
                                <i class="zmdi zmdi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>




            <div class="modal fade" id="activities-counter" tabindex="-1" role="dialog"
                aria-labelledby="ModalCarouselLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div id="demo-clubkitchen" class="carousel slide" data-interval="false" data-ride="carousel">

                            <!-- The slideshow -->
                            <div class="carousel-inner">

                                <div class="carousel-item active">

                                    <img src="" alt="Menu">
                                </div>

                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo-clubkitchen" data-slide="prev">
                                <!--<span class="carousel-control-prev-icon"></span>-->
                                <i class="zmdi zmdi-chevron-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#demo-clubkitchen" data-slide="next">
                                <!--<span class="carousel-control-next-icon"></span>-->
                                <i class="zmdi zmdi-chevron-right"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>









            <!-- ********|| ACTIVITIES Menu Modal End ||******** -->



            <!-- Modal Starts-->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <section class="activities-modal">

                @foreach($event as $value)
                <div class="modal fade" id="exampleModal{{$value->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-part">
                                    <div class="activities-img">
                                        <!-- <img class="img-fluid"
                                            src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                            alt=""> -->

                                        <img class="img-fluid" src="{{ asset('uploads/enentimg/'.$value->event_image)}}"
                                            alt="">
                                    </div>
                                    <div class="activities-inner">
                                        <div class="activities-title">
                                            circular
                                        </div>

                                        <div class="activities-content circularspopup">
                                            {!! $value->details_2 !!}
                                        </div>

                                        <!-- <div class="activities-content">
                                            The Club gym went through refurbishment and up gradation this February
                                            bringing a whole new face of health and fitness to our club.
                                        </div>
                                        <div class="activities-content">
                                            With the installation of new equipment it promises to bring a more pleasant
                                            and satisfying work out experience.
                                        </div>
                                        <div class="activities-title title">
                                            ₹ 270
                                        </div>
                                        <div class="activities-content">
                                            With the installation of new equipment it promises to bring.
                                        </div>
                                        <div class="activities-content">
                                            Email:<a href="#" class="mail">abcd@gmail.com</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
-->
                        </div>
                    </div>
                </div>

                @endforeach
            </section>
            <!-- Modal Ends-->

            <style>
            .activities-sec {
                padding: 40px;
            }

            .activities-sec .activities-inner {
                display: flex;
                background-color: #f6f6f6;
                padding: 20px;
                border-radius: 10px;
                margin: 10px 0px;
                transition: ease 0.3s;
                border: 1px solid #f6f6f6;
            }

            .activities-sec .activities-inner:hover {
                border: 1px solid var(--secondaryColor);
            }

            .activities-sec .activities-inner .activities-img {
                border-radius: 10px;
                overflow: hidden;
                height: 100%;
            }

            .activities-sec .activities-inner .activities-info {
                padding-left: 10px;
                position: relative;
            }

            .activities-sec .activities-inner .activities-info .activities-body {
                display: flex;
            }

            .activities-sec .activities-inner .activities-info .activities-body .activities-time {
                font-family: 'IBM Plex Serif', serif;
                font-size: 18px;
                font-weight: 500;
                color: var(--secondaryColor);
                letter-spacing: 0.5px;
                text-transform: uppercase;
                padding-top: 18px;
            }

            .activities-sec .activities-inner .activities-info .activities-body .activities-time span {
                font-size: 24px;
                position: absolute;
                top: -6px;
            }

            .activities-sec .activities-inner .activities-info .activities-body .activities-box-part {
                padding-left: 8px;
                font-family: 'IBM Plex Serif', serif;
                font-size: 12px;
                font-weight: 400;
                color: #146fd9;
                margin-left: 8px;
                letter-spacing: 0.5px;
                padding-top: 22px;
                border-left: 1px solid #333;
            }

            .activities-sec .activities-inner .activities-info .activities-body .activities-box-part span {
                font-size: 20px;
                font-family: 'IBM Plex Serif', serif;
                position: absolute;
                top: -2px;
                font-weight: 500;
                color: var(--secondaryColor);
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }

            .activities-sec .activities-inner .activities-info .activities-content {
                color: var(--textColor);
                font-family: 'IBM Plex Serif', serif;
                font-size: 14px;
                font-weight: 400;
                padding: 10px 0px;
                line-height: 18px;
            }

            .activities-sec .activities-inner .activities-info .activities-action .read-btn {
                border: 1px solid var(--secondaryColor);
                font-family: 'IBM Plex Serif', serif;
                font-size: 13px;
                font-weight: 500;
                color: var(--secondaryColor);
                border-radius: 50px;
                padding: 3px 10px;
                text-transform: uppercase;
                text-decoration: none;
                transition: ease 0.3s;
                background-color: #fff;
            }

            .activities-sec .activities-inner .activities-info .activities-action {
                margin-top: 10px;
            }

            .activities-modal .modal-body {
                border: 4px solid var(--secondaryColor);
                border-radius: 10px;
                background-color: #fff;
                padding: 10px 20px;
            }

            .activities-modal .modal-body .modal-part {
                display: flex;
            }

            .activities-modal .modal-content {
                border-radius: 12px;
                background-color: transparent;
                border: none;
            }

            .activities-modal .modal-dialog {
                max-width: 640px;
            }

            .activities-modal .modal-body .modal-part .activities-img {
                width: 40%;
                padding-top: 10px;
            }

            .activities-modal .modal-body .modal-part .activities-inner {
                width: 60%;
                padding-left: 10px;
            }

            .activities-modal .modal-body .modal-part .activities-inner .activities-title,
            .activities-modal .modal-body .modal-part .activities-inner .circularspopup strong {
                font-size: 20px;
                font-family: 'IBM Plex Serif', serif;
                font-weight: 500;
                color: var(--secondaryColor);
                letter-spacing: 0.5px;
                text-transform: uppercase;
                padding-bottom: 10px;
            }

            .activities-modal .modal-body .modal-part .activities-inner .activities-title.title,
            .activities-modal .modal-body .modal-part .activities-inner .circularspopup strong {
                border-bottom: 1px solid #9f9e9e;
                margin-bottom: 10px;
                width: 100%;
                display: block;
            }

            .activities-modal .modal-body .modal-part .activities-inner .activities-content {
                color: var(--textColor);
                font-family: 'IBM Plex Serif', serif;
                font-size: 14px;
                font-weight: 400;
                padding-bottom: 10px;
                line-height: 18px;
            }

            .activities-modal .modal-header {
                border: none;
                padding: 0px;
            }

            .activities-modal .modal-header .close {
                color: #fff;
                opacity: 1;
            }

            /*
                .activities-modal .modal-body{
                    padding: 10px 20px;
                }
*/

            @media screen and (max-width: 767px) {
                .activities-sec {
                    padding: 10px 0;
                }

                .activities-sec .activities-inner {
                    display: block !important;
                }

                .activities-modal .modal-body .modal-part {
                    display: block !important;
                }

                .activities-modal .modal-body .modal-part .activities-img {
                    width: 100%
                }

                .activities-modal .modal-body .modal-part .activities-inner {
                    width: 100%;
                }

                .activities-sec .activities-inner .activities-info {
                    padding-left: 0;
                    margin-top: 20px;
                }

                .activities-modal .modal-body .modal-part .activities-inner {
                    padding-left: 0;
                }
            }
            </style>

            </body>

</html>