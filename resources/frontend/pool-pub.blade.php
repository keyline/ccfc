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

                            @foreach($galleries->where("id","25") as $key => $gallery)

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



            <!-- ********|| ACTIVITIES START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Pool Pub
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            @foreach($contentPages->where("id","10") as $contentPage)
                            {!! $contentPage->page_text !!}
                            @endforeach
                            <!-- <div class="content_inner">
                                <p>This beautiful facility is let out to members for their meetings/parties etc. at a
                                    cost of Rs.6000 for 4 hours or so. This could comfortably accommodate about 60
                                    persons for dinner and about 70 persons for cocktails. Full Bar service is available
                                    and food/snacks can be ordered either from our club kitchen or the upstairs dining
                                    room. Food can also be ordered from outside and a cover charge will be payable to
                                    the club. This facility is very popular and always in demand. Members are advised to
                                    book well in advance. The Pool Lounge can also be used for office
                                    meetings/conferences. Please get in touch with the club office for details.</p>
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
                        <div class="col-lg-12">
                            <div class="gym-inner poolpub_midimg">
                                {{--<div class="title-sec">
                                     <div class="title text-left">
                                        comming soon
                                    </div> 
                                </div>--}}
                                @foreach($galleries->where("id","10") as $key => $gallery)

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
                        {{-- <div class="col-lg-4">
                            @foreach($galleries->where("id","10") as $key => $gallery)

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
                            
                        </div> --}}
                    </div>
                </div>
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>