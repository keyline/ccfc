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

                            @foreach($galleries->where("id","38") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)


                            <div class="item">
                                <div class="about-img">
                                    <!-- <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt=""> -->
                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                                </div>
                            </div>

                            @endforeach
                            @endforeach
                            <!-- <div class="item">
                                <div class="about-img">
                                    <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="">
                                </div>
                            </div> -->
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
                                    DAY SPA
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","19") as $contentPage)
                            {!! $contentPage->page_text !!}
                            @endforeach
                            <!-- <div class="content_inner">
                                <p>In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.</p>
                                <p>The club also offers food from its different counters like charcoal-grilled kebabs,
                                    quick bites of wraps, burgers, pastas etc. There is also a pastry shop and
                                    specialized tea & coffee counters serving wide varieties of tea and coffee.</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- ********|| ACTIVITIES END ||******** -->

            <!-- ********|| GYM GENERAL START ||******** -->
            <section class="gym-general-sec">
                <div class="container">
                    <div class="row">
                        @foreach($contentBlocks->where("id","19") as $contentBlock)
                        <div class="col-lg-8">
                            <div class="gym-inner">
                                {!! $contentBlock->body !!}
                            </div>
                            @endforeach



                        </div>
                        <div class="col-lg-4">
                            <div class="clubbar_sidebar">
                                @foreach($galleries->where("id","39") as $key => $gallery)

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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>