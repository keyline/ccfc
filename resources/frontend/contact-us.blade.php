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

                            @foreach($galleries->where("id","29") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)

                            <div class="item">
                                <div class="about-img">
                                    <!-- <img class="img-fluid"
                                        src="http://ccfc.keylines.net.in/storage/56/621718fa30d84_food_banner2.jpg"
                                        alt=""> -->

                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                                </div>
                            </div>

                            @endforeach
                            @endforeach

                            <!-- <div class="item">
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

            <section class="contact-us-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="map-location">
                                <div class="map-content">
                                    19/1 Gurusaday Road, Beckbagan,Ballygunge, Kolkata 700 019
                                </div>
                                <div class="contact-location">
                                    E:
                                    <a href="mailto:ccfcsecretary@ccfc1792.com" class="contact-btn">
                                        ccfcsecretary@ccfc1792.com
                                    </a>
                                </div>
                                <div class="contact-location">
                                    P:
                                    <a href="tel:033 24615060" class="contact-btn">
                                        033 24615060
                                    </a>
                                    <span>/</span>
                                    <a href="tel:033 24615059" class="contact-btn">
                                        033 24615059
                                    </a>
                                </div>
                                <div class="map-content">
                                    <i>( Monday to Saturday, 11am to 5pm )</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <section class="contact-sec contact-body">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 pl-0">
                            <div class="contact-left">
                                <div class="map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3685.2201366718136!2d88.363747!3d22.533425!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc1c410a073b08b94!2sCalcutta%20Cricket%20and%20Football%20Club!5e0!3m2!1sen!2sin!4v1643977564770!5m2!1sen!2sin"
                                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <!--
                                        <div class="map-location">
                                            <div class="map-content">
                                                19/1 Gurusaday Road, Beckbagan,Ballygunge, Kolkata 700 019
                                            </div>
                                            <div class="contact-location">
                                                E:
                                                <a href="#" class="contact-btn">
                                                    ccfcsecretary@ccfc1792.com
                                                </a>
                                            </div>
                                            <div class="contact-location">
                                                P:
                                                <a href="#" class="contact-btn">
                                                    033 24615060
                                                </a>
                                                <span>/</span>
                                                <a href="#" class="contact-btn">
                                                    033 24615059
                                                </a>
                                            </div>
                                            <div class="map-content">
                                                <i>( Monday to Saturday, 11am to 5pm )</i>
                                            </div>
                                        </div>
-->
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="contact-inner">
                                <div class="title-sec">
                                    <div class="title">
                                        CONTACT US
                                    </div>
                                </div>
                                <div class="contact-content">
                                    Have any questions?
                                </div>
                                <div class="contact-content">
                                    We’d love to hear from you.
                                </div>
                                <div class="contact-form">
                                    <form method="POST" action="http://ccfc.keylines.net.in/send-message"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your Name*">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email*">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Your Mobile No*">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Your Message"
                                                rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="send-btn">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--
                                    <div class="footer-ban">
                                        <img class="img-fluid" src="assets/img/footer-ban.png" alt="">
                                    </div>
-->
            </section>



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




            <div class="modal fade" id="activities-dinning1" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
                                    </li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img class="img-fluid" src="{{ asset('img/activities/dining-menu-1.jpeg') }}"
                                            alt="" />
                                        <div class="carousel-caption"> .332423 </div>
                                    </div>
                                    <div class="item">
                                        <img class="img-fluid" src="{{ asset('img/activities/dining-menu-2.jpeg') }}"
                                            alt="" />
                                        <div class="carousel-caption"> .sdfsd </div>
                                    </div>
                                    ...
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                                    data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
                                        aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a
                                    class="right carousel-control" href="#carousel-example-generic" role="button"
                                    data-slide="next"> <span class="glyphicon glyphicon-chevron-right"
                                        aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- ********|| ACTIVITIES Menu Modal End ||******** -->



            <!-- Modal -->


            <style>
            .contact-us-sec {
                background-color: #f6f6f6;
                padding: 40px;
                text-align: center;
            }

            .contact-us-sec {
                padding: 40px 0px;
            }

            .contact-us-sec .map-location .map-content {
                font-size: 16px;
                font-weight: 400;
                letter-spacing: 0.5px;
                padding-bottom: 5px;
                font-family: 'Lato', sans-serif;
                color: var(--textColor);
            }

            .contact-us-sec .map-location .contact-location {
                font-family: 'Lato', sans-serif;
                color: var(--textColor);
                font-size: 16px;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            .contact-us-sec .map-location .contact-location .contact-btn {
                font-family: 'Lato', sans-serif;
                color: var(--textColor);
                font-size: 16px;
                font-weight: 600;
                letter-spacing: 0.5px;
                text-decoration: none;
            }

            .contact-us-sec .map-location .map-content {
                font-family: 'Lato', sans-serif;
                color: var(--textColor);
                font-size: 16px;
                font-weight: 400;
                letter-spacing: 0.5px;
                padding-bottom: 5px;
            }

            .contact-sec.contact-body .contact-left .map iframe {
                width: 100%;
                height: 466px;
            }

            .contact-sec.contact-body .contact-inner .send-btn {
                margin-top: 5px;
            }

            .contact-sec.contact-body .contact-inner {
                padding-top: 30px;
            }


            @media screen and (max-width: 767px) {
                .contact-sec.contact-body .contact-left {
                    padding-left: 15px;
                }

                .contact-sec.contact-body {
                    padding-left: 0px;
                }
            }
            </style>

            </body>

</html>