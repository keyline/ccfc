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
                                    Swimming Pool
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","12") as $contentPage)
                            {!! $contentPage->page_text !!}
                            @endforeach
                            <!-- <div class="content_inner">
                                <ul class="pool">
                                    <li>Children (Below 3 years) not allowed.</li>
                                    <li>No spitting allowed in the pool area and pool hygiene should be maintained at
                                        all times, life guards have been instructed to keep a strict eye on members
                                        pertaining to hygiene in the pool.</li>
                                    <li>No food allowed, alcoholic beverages or smoking is not permitted in the pool
                                        area.</li>
                                    <li>Please have a shower before entering the pool.</li>
                                    <li>Please sign the register and show your membership card to the security
                                        personal/attendant.</li>
                                    <li>All swimmers with long hair must wear caps.</li>
                                    <li>All swimmers must be attired in proper swimming gear.</li>
                                    <li>Dependant members (Below 18 years) must vacate the pool area by 7 pm.</li>
                                    <li>Please refrain from swimming if you are nursing an open cut/wound/or contagious
                                        disease.</li>
                                    <li>No ayahs, servants and drivers are allowed in the pool area.</li>
                                    <li>Diving is strictly forbidden in the shallow end of the pool.</li>
                                    <li>Lifeguards will be on duty during specified pool hours.</li>
                                    <li>The club will not be responsible for any accident or loss of personal articles
                                        left in the pool area.</li>
                                </ul>
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
                        @foreach($contentBlocks->where("id","7") as $contentBlock)

                        <div class="col-lg-8">
                            <div class="gym-inner">

                                {!! $contentBlock->body !!}
                                <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        Swimming Pool Timings
                                    </div>
                                </div>
                                <ul class="pool-part">
                                    <li><strong>Tuesday to Friday :</strong> 6.00 am to 10.00 am / 2.00 pm to 9.00 pm
                                    </li>
                                    <li><strong>Saturday & Sunday :</strong> 6.00 am to 9.00 pm</li>
                                </ul>
                                <p><strong>(Children below the age of 18 must vacate the Pool by 7.00 pm)</strong></p> -->

                            </div>

                        </div>
                        @endforeach


                        <div class="col-lg-4">
                            @foreach($galleries->where("id","12") as $key => $gallery)

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
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->

            </body>

</html>