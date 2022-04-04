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
                        @foreach($galleries->where("id","4") as $key => $gallery)

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

                                <img class="img-fluid" src="{{ asset('img/activities/banner-img.jpg') }}" alt="" />

                            </div>

                        </div>

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/activities/banner-img2.jpg') }}" alt="" />

                            </div>

                        </div> -->

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| ACTIVITIES START ||******** -->
            <section class="history-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="history-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        FOOD & BEVERAGES
                                    </div>
                                </div>
                                <div class="history-content text-left">

                                    @foreach($contentPages->where("id","2") as $contentPage)
                                    <p>{{$contentPage->excerpt}}</p>
                                    @endforeach
                                    <!-- <p>The Club offers a wide range of delicious food in its dining hall along with
                                        varieties of snacks in its well-stocked bars, pavilion and sit-out areas.</p>
                                    <p>The club also offers food from its different counters like charcoal-grilled
                                        kebabs, quick bites of wraps, burgers, pastas etc. There is also a pastry shop
                                        and specialized tea & coffee counters serving wide varieties of tea and coffee.
                                    </p>
                                    <p>Apart from sports, the club offers members and guests a wide range of
                                        entertainment all-round the year, from open-air music & dancing to traditional
                                        gourmet events.</p>
                                    <p>The club also offers excellent banquet facility to the members at the pool pub.
                                        It can comfortably accommodate about 60 persons for buffet lunch / dinner, 70
                                        persons for cocktails and about 30 persons for a theatre style meeting. For all
                                        catering queries please email catering@ccfc1792.com</p> -->
                                </div>



                            </div>

                            <!-- ********|| ACTIVITIES Menu END ||******** -->
                            <div class="activities_menulist_section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="activities_list_item">
                                                <div class="activities_list_item_left">
                                                    <div class="activities_list_item_leftinfo">

                                                        @foreach($contentBlocks->where("id","1") as $contentBlock)
                                                        <h3>{{$contentBlock->name_of_the_block}}</h3>

                                                        {!! $contentBlock->body !!}

                                                        @endforeach
                                                        <!-- <h3>Dining Room Timings</h3>
                                                        <ul>
                                                            <li>Tuesday to Friday & Sunday 12.30 hrs to 22.45 hrs.</li>
                                                            <li>Saturday 12 Noon to 23.30 hrs.</li>
                                                            <li>Monday Closed.</li>
                                                            <li><strong>Last order will be taken 15 minutes before
                                                                    close.</strong></li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                                <div class="activities_list_item_right">
                                                    <a href="#" data-toggle="modal" data-target="#activities-dinning">
                                                        <div class="activities_list_item_right_white">
                                                            <div class="activities_list_item_right_img"><img
                                                                    class="img-fluid"
                                                                    src="{{ asset('img/activities/menu_icon.png') }}"
                                                                    alt="" /></div>
                                                            <button type="button" class="btn" data-toggle="modal"
                                                                data-target="#activities-dinning">
                                                                View Menu
                                                            </button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="activities_list_item">
                                                <div class="activities_list_item_left">
                                                    <div class="activities_list_item_leftinfo">
                                                        @foreach($contentBlocks->where("id","2") as $contentBlock)
                                                        <h3>{{$contentBlock->name_of_the_block}}</h3>
                                                        {!! $contentBlock->body !!}

                                                        @endforeach


                                                        <!--<h3>Club Kitchen Timings</h3>
                                                        <ul>
                                                            <li>Tuesday, Thursday & Friday 3.30 pm to 11.00 pm</li>
                                                            <li>Wednesday : 3.30 pm to 11.30 pm</li>
                                                            <li>Saturday: 11.00 am to 1 am</li>
                                                            <li>Sunday : 11.00 am to 11.00 pm</li>
                                                            <li><strong>Last order will be taken 30 minutes before
                                                                    close.</strong></li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                                <div class="activities_list_item_right">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#activities-clubkitchen">
                                                        <div class="activities_list_item_right_white">
                                                            <div class="activities_list_item_right_img"><img
                                                                    class="img-fluid"
                                                                    src="{{ asset('img/activities/menu_icon.png') }}"
                                                                    alt="" /></div>
                                                            <button type="button" class="btn" data-toggle="modal"
                                                                data-target="#activities-clubkitchen">
                                                                View Menu
                                                            </button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="activities_list_item">
                                                <div class="activities_list_item_left">
                                                    <div class="activities_list_item_leftinfo">
                                                        @foreach($contentBlocks->where("id","3") as $contentBlock)

                                                        <h3>{{$contentBlock->name_of_the_block}}</h3>
                                                        {!! $contentBlock->body !!}

                                                        @endforeach

                                                        <!-- <h3>Counter Timings</h3>
                                                        <ul>
                                                            <li>Operational on all days i.e.<br>
                                                                Tuesday to Sunday<br>
                                                                with the exception of Monday (Club holiday)</li>
                                                            <li>Between :<br>
                                                                6.30 am to 8.30 am and 2.30 pm to 8.30 pm
                                                            </li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                                <div class="activities_list_item_right">
                                                    <a href="#">
                                                        <div class="activities_list_item_right_white">
                                                            <div class="activities_list_item_right_img"><img
                                                                    class="img-fluid"
                                                                    src="{{ asset('img/activities/menu_icon.png') }}"
                                                                    alt="" /></div>
                                                            <button type="button" class="btn">
                                                                Wine Menu
                                                            </button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ********|| ACTIVITIES Menu END ||******** -->

                        </div>

                        <div class="col-lg-4">
                            <div class="activites_rightside">

                                @foreach($galleries->where("id","5") as $key => $gallery)

                                @foreach($gallery->images as $key => $media)
                                <div class="active_rightimg">
                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                                </div>
                                @endforeach
                                @endforeach

                                <!-- <div class="active_rightimg">
                                    <img class="img-fluid" src="{{ asset('img/activities/right_sideimage_1.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="active_rightimg">
                                    <img class="img-fluid" src="{{ asset('img/activities/right_sideimage_2.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="active_rightimg">
                                    <img class="img-fluid" src="{{ asset('img/activities/right_sideimage_3.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="active_rightimg">
                                    <img class="img-fluid" src="{{ asset('img/activities/right_sideimage_4.jpg') }}"
                                        alt="" />
                                </div>
                                <div class="active_rightimg">
                                    <img class="img-fluid" src="{{ asset('img/activities/right_sideimage_4.jpg') }}"
                                        alt="" />
                                </div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- ********|| ACTIVITIES END ||******** -->




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

                                @foreach($galleries->where("id","6") as $key => $gallery)
                                @foreach($gallery->images as $key => $media)
                                <div class="carousel-item  {{ $loop->first ? ' active' : '' }} ">

                                    <img src="{{$media->getUrl('')}}" alt="Menu">
                                </div>
                                @endforeach
                                @endforeach


                                {{-- <div class="carousel-item active">
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
                            </div> --}}

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
                            @foreach($galleries->where("id","7") as $key => $gallery)
                            @foreach($gallery->images as $key => $media)

                            <div class="carousel-item {{ $loop->first ? ' active' : '' }}">

                                <img src="{{$media->getUrl('')}}" alt="Menu">
                            </div>
                            @endforeach
                            @endforeach
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
                        @foreach($galleries->where("id","8") as $key => $gallery)
                        @foreach($gallery->images as $key => $media)
                        <!-- The slideshow -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">

                                <img src="{{$media->getUrl('')}}" alt="Menu">
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
                        @endforeach
                        @endforeach
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




        </body>

</html>