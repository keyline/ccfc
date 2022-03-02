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
                                    GYMMING REJUVENATED
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content_inner">
                                <p>The Club gym went through refurbishment and up gradation this February bringing a
                                    whole new face of health and fitness to our club. With the installation of new
                                    equipment it promises to bring a more pleasant and satisfying work out experience.
                                </p>
                                <p>Completely new flooring has been done along with provision of new fresh towels and
                                    mats. The gym is now better equipped with a whole new set of dumbbells, two new
                                    treadmills, two new machines for lower body exercise and a machine for a full body
                                    workout. The gym also has been well spaced out now giving more room for our members
                                    to work out and walk around. With this new freshly renovated gym and new equipment
                                    we can be assured that there will be a more enjoyable and fulfilling workout.</p>
                                <p>We hope to see more members use the gym to build on their fitness and strength. The
                                    gym timings are 6 am to 1.30 pm and 2.30 pm to 9 pm from Tuesday to Sunday and the
                                    trainer is there to assist you whenever called upon.</p>
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

                        @foreach($contentBlocks->where("id","4") as $contentBlock)

                        <div class="col-lg-8">

                            <div class="gym-inner">


                                {!! $contentBlock->body !!}
                                <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        GENERAL
                                    </div>
                                </div>
                                <ul>
                                    <li>Discipline & Order should be maintained while using the facilities of the GYM.
                                    </li>
                                    <li>Direction and procedure of the instructors are binding on all members for their
                                        own good.</li>
                                    <li>Members' co-operation will enable the GYM to render best of services.</li>
                                </ul> -->

                                <!-- </div> -->
                                <!-- <div class="gym-inner">
                            </div> -->
                                @endforeach
                                <!-- <div class="gym-inner"> -->
                                <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        CAUTION
                                    </div>
                                </div>
                                <ul>
                                    <li>For their own safety and benefit, members must consult their personal physician
                                        on their suitability for taking up exercise offered at the GYM.</li>
                                    <li>The gym will not be responsible for any injuries, sprains, muscle pain or any
                                        such problem caused due to improper way of exercising.</li>
                                    <li>The minimum age for using the GYM is 16 years. In case of special requirement,
                                        kindly contact the club office for permission.</li>
                                    <li>The member will be responsible for any damage to gym properties, due to his/her
                                        mishandling.</li>
                                    <li>The member is also required to maintain club decorum while using the GYM.</li>
                                </ul> -->
                            </div>
                            <!-- <div class="gym-inner"> -->
                            <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        BEHAVIOUR CODE
                                    </div>
                                </div>
                                <ul>
                                    <li>Member should come in proper exercising dress. Members should carry their own
                                        clean shoes with them in a bag. Shoes worn from outside will not be allowed.
                                    </li>
                                    <li>Use of mobile phone is strictly prohibited inside the gym. This is for the
                                        convenience of co-members using the facility.</li>
                                    <li>For the convenience of other members, please change your t-shirts before coming
                                        to the GYM if you have been running / playing outside.</li>
                                    <li>Members are also requested to maintain minimum hygiene while in the GYM.</li>
                                    <li>Members are not allowed to bring in any Food and Alcoholic drinks inside the
                                        GYM.</li>
                                    <li>Members are requested to keep the weights, mats, towels, glasses, etc., after
                                        use in their rightful place. </li>
                                </ul> -->

                            <!-- </div> -->
                            <!-- <div class="gym-inner"> -->
                            <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        TERMINATION
                                    </div>
                                </div>
                                <ul>
                                    <li>The GYM reserves the right to stop any member from using the GYM for
                                        misbehaviour/misconduct in the interest of the Club without assigning that
                                        member any reason.</li>
                                </ul> -->
                            <!-- </div> -->
                            <!-- <div class="gym-inner"> -->
                            <!-- <div class="title-sec">
                                    <div class="title text-left">
                                        Tuesday to Sunday
                                    </div>
                                </div>
                                <p class="gym-time">6.00 am to 1.30 pm&2.30 pm to 9 pm</p> -->
                            <!-- </div> -->
                        </div>


                        <div class="col-lg-4">
                            @foreach($galleries->where("id","9") as $key => $gallery)

                            @foreach($gallery->images as $key => $media)

                            <div class="project-item">
                                <div class="gallery">

                                    <a href="{{$media->getUrl('')}}" class="item-inner" data-fancybox="image">
                                        <div class="item-img">

                                            <img class="img-fluid" src="{{$media->getUrl('')}}" alt="">
                                            <!-- <img class="img-fluid"
                                                src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                                alt=""> -->
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
                                    <a href="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                        class="item-inner" data-fancybox="image">
                                        <div class="item-img">
                                            <img class="img-fluid"
                                                src="http://ccfc.keylines.net.in/storage/58/62171940e4354_right_sideimage_1.jpg"
                                                alt="">
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





            <!-- Modal -->





            </body>

</html>