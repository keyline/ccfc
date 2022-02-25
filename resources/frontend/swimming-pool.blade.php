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
                                    <img class="img-fluid" src="http://ccfc.keylines.net.in/storage/56/621718fa30d84_food_banner2.jpg" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="about-img">
                                    <img class="img-fluid" src="http://ccfc.keylines.net.in/storage/57/621718fe6b14f_food_banner1.jpg" alt="">
                                </div>
                            </div>
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
                                        swimming pool
                                    </div>
                                </div>
                                <div class="history-content text-left">
                                    <ul class="pool">
                                        <li>Children (Below 3 years) not allowed.</li>
                                        <li>No spitting allowed in the pool area and pool hygiene should be maintained at all times, life guards have been instructed to keep a strict eye on members pertaining to hygiene in the pool.</li>
                                        <li>No food allowed, alcoholic beverages or smoking is not permitted in the pool area.</li>
                                        <li>Please have a shower before entering the pool.</li>
                                        <li>Please sign the register and show your membership card to the security personal/attendant.</li>
                                        <li>All swimmers with long hair must wear caps.</li>
                                        <li>All swimmers must be attired in proper swimming gear.</li>
                                        <li>Dependant members (Below 18 years) must vacate the pool area by 7 pm.</li>
                                        <li>Please refrain from swimming if you are nursing an open cut/wound/or contagious disease.</li>
                                        <li>No ayahs, servants and drivers are allowed in the pool area.</li>
                                        <li>Diving is strictly forbidden in the shallow end of the pool.</li>
                                        <li>Lifeguards will be on duty during specified pool hours.</li>
                                        <li>The club will not be responsible for any accident or loss of personal articles left in the pool area.</li>
                                    </ul>
                                </div>
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
                        <div class="col-lg-8">
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                       Swimming Pool Timings
                                    </div>
                                </div>
                                    <ul class="pool-part">
                                    <li><b>Tuesday to Friday :</b> 6.00 am to 10.00 am / 2.00 pm to 9.00 pm</li>
                                <li><b>Saturday & Sunday :</b> 6.00 am to 9.00 pm</li>
                                    </ul>
                                <p><b>(Children below the age of 18 must vacate the Pool by 7.00 pm)</b></p>
                                
                            </div>
                               
                        </div>
                        <div class="col-lg-4">
                            <div class="project-item">
                                            <div class="gallery">
                                                <a href="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg" class="item-inner" data-fancybox="image">
                                                    <div class="item-img">
                                                        <img class="img-fluid" src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg" alt="">
                                                        <div class="hvr">
                                                            <i class="zmdi zmdi-search"></i>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
<!--
                            <div class="project-item">
                                            <div class="gallery">
                                                <a href="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg" class="item-inner" data-fancybox="image">
                                                    <div class="item-img">
                                                        <img class="img-fluid" src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg" alt="">
                                                        <div class="hvr">
                                                            <i class="zmdi zmdi-search"></i>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
-->
                        </div>
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
                .gym-general-sec .project-item .item-img{
                    position: relative;
                }
                .gym-general-sec .project-item .item-img .hvr {
        display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.51);
                    color: #fff;
                    font-size: 40px;
                    opacity: 0;
}
                .gym-general-sec .project-item .item-img:hover .hvr{
                    opacity: 1;
                }
                .gym-general-sec{
                    padding: 40px;
                }
                .gym-general-sec .project-item{
                    padding-bottom: 20px;
                }
                .gym-general-sec .project-item:last-child{
                    padding-bottom: 0px;
                }
                .gym-general-sec .gym-inner{
                    border-bottom: 1px solid var(--secondaryColor);
                        padding-bottom: 10px;
                        margin-bottom: 20px;
                }
                .gym-general-sec .gym-inner:last-child{
                    border-bottom: none;
                    padding: 0;
                    margin: 0
                }
                .gym-general-sec .project-item:first-child{
                    padding-top: 15px;
                }
                .gym-general-sec .gym-inner ul li{
                    font-family: 'Lato', sans-serif;
                    padding-bottom: 10px;
                    color: var(--textColor);
                    font-size: 16px;
                    letter-spacing: 0.5px;
                }
                .gym-general-sec .gym-inner ul{
                    padding-left: 16px;
                }
/*pool*/
                .history-sec .history-inner .pool li{
                    font-family: 'Lato', sans-serif;
                    padding-bottom: 10px;
                    color: var(--textColor);
                    font-size: 16px;
                    letter-spacing: 0.5px;
                }
                .history-sec .history-inner .pool{
                    padding-left: 16px;
                }
                .gym-general-sec .gym-inner .pool-part{
                    margin-bottom: 0;
                }
                              @media screen and (max-width: 767px) {
                .gym-general-sec {
                    padding: 40px 0px;
                    }
                }
            </style>

            </body>

</html>