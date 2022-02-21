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



            <!-- ********|| HISTORY START ||******** -->
            <section class="history-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="history-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Annual Report
                                    </div>
                                </div>

                                <div class="pastpresident_imagebox">
                                    <div class="pastpresident_item">
                                        <div class="row">







                                            <!-- <div class="col-md-6 col-lg-3">
                                                <div class="pastpresdit_inner teamMember">
                                                    <div class="photoFrame"><img
                                                            src="{{ asset('img/past-president/2a.jpg') }}" alt=""></div>
                                                    <div class="passtpredi_name">
                                                        <h2>Mr. R. B. Lagden</h2>
                                                        <p>Mr. R. B. Lagden</p>
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
            <!-- ********|| HISTORY END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>