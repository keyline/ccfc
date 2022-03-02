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
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| ACTIVITIES START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    CLUB BAR
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

            <!-- ********|| ACTIVITIES END ||******** -->

            <!-- ********|| GYM GENERAL START ||******** -->
            <section class="gym-general-sec">
                <div class="container">
                    <div class="row">
                        @foreach($contentBlocks->where("id","6") as $contentBlock)
                        <div class="col-lg-8">
                            <div class="gym-inner">
                                {!! $contentBlock->body !!}
                            </div>
                            @endforeach
                            <!-- <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Main Bar
                                    </div>
                                </div>
                                <ul>
                                    <li><strong>Tuesday to Friday :</strong> 3.00 pm to 11.00 pm</li>
                                    <li><strong>Saturday / Sunday :</strong> 11.00 am to 11.00 pm</li>
                                    <li><strong>(Till 1.00 am on Saturday in case of late Bar Licence)</strong></li>
                                </ul>
                            </div> -->
                            <!-- <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Gazebo Bar
                                    </div>
                                </div>
                                <ul>
                                    <li><strong>Tuesday to Friday :</strong> 3.00 pm to 11.00 pm</li>
                                    <li><strong>Saturday / Sunday :</strong> 11.00 am to 11.00 pm</li>
                                </ul>
                            </div> -->
                            <!-- <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Lounge Bar
                                    </div>
                                </div>
                                <ul>
                                    <li><strong>Tuesday :</strong> 3.00 pm to 11.00 pm</li>
                                    <li><strong>Wednesday to Sunday :</strong> 12 Noon to 11.00 pm</li>
                                </ul>
                            </div> -->

                        </div>
                        <div class="col-lg-4">
                            @foreach($galleries->where("id","11") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)

                            <div class="project-item">
                                <div class="gallery">
                                    <a href="{{$media->getUrl('')}}" class="item-inner" data-fancybox="image">
                                        <div class="item-img">
                                            <img class="img-fluid" src="{{$media->getUrl('')}}" alt="">
                                            <div class="hvr">
                                                <i class="zmdi zmdi-search"></i>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>

                            @endforeach
                            @endforeach
                            <!-- <div class="project-item">
                                <div class="gallery">
                                    <a href="{{ asset('img/activities/right_sideimage_2.jpg') }}" class="item-inner"
                                        data-fancybox="image">
                                        <div class="item-img">
                                            <img class="img-fluid"
                                                src="{{ asset('img/activities/right_sideimage_2.jpg') }}" alt="">
                                            <div class="hvr">
                                                <i class="zmdi zmdi-search"></i>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>