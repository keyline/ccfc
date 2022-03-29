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


                        @foreach($galleries->where("id","28") as $key => $gallery)

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



            <!-- ********|| HISTORY START ||******** -->

            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Gallery
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content_inner">
                                <p>In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.</p>
                                <p>The club also offers food from its different counters like charcoal-grilled kebabs,
                                    quick bites of wraps, burgers, pastas etc. There is also a pastry shop and
                                    specialized tea & coffee counters serving wide varieties of tea and coffee.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ********|| HISTORY END ||******** -->


            <!------------|| GALLERY STARTS ||------------>
            <section class="therapy-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">Sport</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                    role="tab" aria-controls="v-pills-profile" aria-selected="false">Event</a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="tab-content galleytabimg" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <!--1-->

                                    <div class="product-content">
                                        <div class="product-image-content">
                                            <div class="product-image">
                                                <img class="img-fluid" id="myImage"
                                                    src="{{ asset('img/gallary/gal2.jpg') }}" alt="">
                                            </div>

                                            <div class="product-image-slider">
                                                <div id="sync2" class="owl-carousel owl-theme">
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImage').src='{{ asset('img/gallary/gal2.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal2.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImage').src='{{ asset('img/gallary/gal1.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal1.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImage').src='{{ asset('img/gallary/gal3.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal3.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImage').src='{{ asset('img/gallary/gal4.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal4.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">

                                    <div class="product-content">
                                        <div class="product-image-content">
                                            <div class="product-image">
                                                <img class="img-fluid" id="myImageevent"
                                                    src="{{ asset('img/gallary/gal7.jpg') }}" alt="">
                                            </div>

                                            <div class="product-image-slider">
                                                <div id="sync2" class="sync2event owl-carousel owl-theme">
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImageevent').src='{{ asset('img/gallary/gal7.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal7.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImageevent').src='{{ asset('img/gallary/gal6.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal6.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImageevent').src='{{ asset('img/gallary/gal5.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal5.jpg') }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="javascript:void(0)" class="item"
                                                            onclick="document.getElementById('myImageevent').src='{{ asset('img/gallary/gal4.jpg') }}'">
                                                            <img class="img-fluid"
                                                                src="{{ asset('img/gallary/gal4.jpg') }}" alt="">
                                                        </a>
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
            <!------------|| GALLERY ENDS ||------------>





            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->
            <style>
            #sync1 .item {
                /*    padding: 80px 0px;*/
                margin: 5px;
                color: #fff;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                text-align: center;
            }

            .nav-tabs {
                display: none;
            }

            .therapy-sec .product-content .product-image-content .product-image img {
                width: 100%;
            }

            @media (min-width: 768px) {
                .nav-tabs {
                    display: flex;
                    flex-flow: column nowrap;
                }

                .nav-tabs {
                    border-bottom: none;
                    border-right: 1px solid #ddd;
                    display: flex;
                }

                .nav-tabs {
                    margin: 0 15px;
                }

                .nav-tabs .nav-item+.nav-item {
                    margin-top: 0.25rem;
                }

                .nav-tabs .nav-link {
                    transition: border-color 0.125s ease-in;
                    white-space: nowrap;
                }

                .nav-tabs .nav-link:hover {
                    background-color: #f7f7f7;
                    border-color: transparent;
                }

                .nav-tabs .nav-link.active {
                    border-bottom-color: #ddd;
                    border-right-color: #fff;
                    border-bottom-left-radius: 0.25rem;
                    border-top-right-radius: 0;
                    margin-right: -1px;
                }

                .nav-tabs .nav-link.active:hover {
                    background-color: #fff;
                    border-color: #0275d8 #fff #0275d8 #0275d8;
                }

                .card {
                    border: none;
                }

                .card .card-header {
                    display: none;
                }

                .card .collapse {
                    display: block;
                }
            }





            /* namrata*/
            .therapy-sec {
                padding: 40px;
            }

            .therapy-sec .therapy-inner .my-box {
                display: flex;
                /*    align-items: center;*/
            }

            #sync2 .owl-nav.disabled {
                display: block !important;
                font-size: 36px;
            }

            .therapy-sec .product-image-slider {
                margin-top: 30px;
            }


            .therapy-sec .therapy-inner .my-doctor {
                border-bottom: 1px solid #4cbee6;
                padding-bottom: 10px;
                margin-bottom: 22px;
            }

            .therapy-sec .owl-carousel .owl-nav button.owl-next {
                position: absolute;
                right: 0;
                top: 0;
                background-color: var(--primaryColor);
                height: 100%;
                color: #fff;
                width: 22px;
                transition: ease all 0.3s;
            }

            .therapy-sec .owl-carousel .owl-nav button.owl-next:hover {
                background-color: #951014;
            }

            .therapy-sec .owl-carousel .owl-nav button.owl-prev {
                position: absolute;
                left: 0;
                top: 0;
                background-color: var(--primaryColor);
                height: 100%;
                color: #fff;
                width: 22px;
                transition: ease all 0.3s;
            }

            .therapy-sec .owl-carousel .owl-nav button.owl-prev:hover {
                background-color: #951014;
            }

            .therapy-sec .therapy-inner .doctor-images {
                border-bottom: 1px solid #4cbee6;
                padding-bottom: 10px;
                margin-bottom: 22px;
                display: flex;
            }

            .therapy-sec .therapy-inner .doctor-images .my-img {
                width: 10%;
                padding-right: 20px;
            }

            .therapy-sec .therapy-inner .doctor-images .my-content {
                width: 90%;
            }


            .therapy-sec .therapy-inner .doctor-images-2 {
                padding-bottom: 10px;
                /*    margin-bottom: 22px;*/
                display: flex;
            }

            .therapy-sec .therapy-inner .doctor-images-2 .my-img {
                width: 10%;
                padding-right: 20px;
            }

            .therapy-sec .therapy-inner .doctor-images-2 .my-content {
                width: 90%;
            }

            .therapy-sec .therapy-inner .my-doctor .card-part .card-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 12px;
                border: 1px solid var(--primaryColor);
            }

            .therapy-sec .therapy-inner .my-doctor .card-part {
                padding-bottom: 15px;
            }

            .therapy-sec .therapy-inner .my-doctor .card-part .aid-title {
                color: var(--primaryColor);
                font-size: 15px;
                font-weight: 500;
                font-family: 'Open Sans', sans-serif;
                letter-spacing: 0.5px;
                padding-bottom: 15px;
                text-align: center;
                padding-top: 10px;
                text-transform: capitalize;
            }

            .therapy-sec .title {
                font-family: 'IBM Plex Serif', serif;
                font-size: 24px;
                font-weight: 500;
                color: var(--secondaryColor);
                letter-spacing: 0.5px;
                padding-bottom: 10px;
                text-transform: uppercase;
            }

            .therapy-sec .therapy-inner .my-box .my-img {
                width: 10%;
            }

            .therapy-sec .therapy-inner .my-box .my-content {
                width: 90%;
            }

            .therapy-sec .therapy-inner .my-box .my-img img {
                /*    height: 200px;*/
                width: 200px;
                padding-right: 20px;
            }

            .therapy-sec .therapy-inner {
                border-bottom: 1px solid #4cbee6;
                margin-bottom: 15px;
                padding-bottom: 7px;
            }

            .therapy-sec .therapy-inner:last-child {
                border: none;
            }

            .therapy-sec .nav {
                position: sticky;
                top: 0px;
                /*    padding-top: 20px;*/
            }

            .therapy-sec .nav-pills .nav-link {
                margin-bottom: 1px;
                padding: 15px 10px;
                color: var(--textColor);
                text-transform: uppercase;
                font-size: 14px;
                font-weight: 600;
                font-family: 'Open Sans', sans-serif;
                letter-spacing: 0.5px;
                width: 100%;
                text-align: center;
                border: 1px solid var(--primaryColor);
            }

            .therapy-sec .nav-pills .nav-link.active,
            .therapy-sec .nav-pills .show>.nav-link {
                background-color: var(--primaryColor);
                color: #fff;
                position: relative;
                width: 100%
            }

            .therapy-sec .nav-pills .nav-link.active:after {
                position: absolute;
                content: '';
                background-color: var(--primaryColor);
                height: 10px;
                width: 10px;
                transform: rotate(45deg);
                right: -5px;
                top: 22px;
            }

            /*
                .therapy-sec .owl-nav {
                    position: absolute;
                    display: flex;
                    top: 32%;
                    justify-content: space-between;
                    width: 100%;
                    font-size: 50px;
                }
*/
            .therapy-sec .nav-pills .nav-link {
                margin-bottom: 10px;
            }

            #sync2 .item {
                display: block;
                margin: 0 auto;
                /* width: 140px; */
            }

            @media screen and (max-width: 991px) {
                .therapy-sec .nav-pills .nav-link.active:after {
                    background: none;
                }
            }

            @media screen and (max-width: 767px) {
                .therapy-sec {
                    padding: 40px 0px;
                }
            }

            /* namrata*/
            </style>


            <script>
            $("#sync2").owlCarousel({
                loop: true,
                margin: 10,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 2,

                    },
                    600: {
                        items: 3,
                        margin: 5,

                    },
                    1000: {
                        items: 4,
                        margin: 10,

                    },
                    1400: {
                        items: 6,
                        margin: 10,

                    }

                }
            });
            $(".sync2event").owlCarousel({
                loop: true,
                margin: 10,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 2,

                    },
                    600: {
                        items: 3,

                    },
                    1000: {
                        items: 4,
                        margin: 20,

                    },
                    1400: {
                        items: 6,
                        margin: 20,

                    }

                }
            });
            </script>

            </body>

</html>