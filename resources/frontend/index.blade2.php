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

                    <div id="home_banner" class="owl-carousel owl-theme">
                        @foreach($galleries->where("id","1") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)
                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />

                            </div>

                            <!-- <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/banner-1.jpg') }}" alt="" />

                            </div> -->

                        </div>



                        @endforeach
                        @endforeach
                        <!-- <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/banner-2.jpg') }}" alt="" />

                            </div>

                        </div> -->

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->

            <!-- ********|| ADVISE START ||******** -->
            <section class="advise">


                <div class="container">
                    <div class="row">

                        @foreach($galleries->where("id","2") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)

                        <div class="col-lg-6">
                            <div class="advise-img">
                                <a href="{{$media->getUrl('')}}" class="item-inner" data-fancybox="image">
                                    <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                                </a>
                            </div>
                        </div>


                        @endforeach
                        @endforeach

                        <!-- <div class="col-lg-6">
                            <div class="advise-img">
                                <img class="img-fluid" src="{{ asset('img/advise-1.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="advise-img">
                                <img class="img-fluid" src="{{ asset('img/advise-2.jpg') }}" alt="" />
                            </div>
                        </div> -->
                    </div>
                </div>




            </section>
            <!-- ********|| ADVISE END ||******** -->

            <!-- ********|| HISTORY START ||******** -->
            <section class="history-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="history-inner">
                                <div class="title-sec">
                                    <div class="title">
                                        HISTORY
                                    </div>
                                </div>
                                <!-- dynamic part starts -->
                                <div class="history-action">
                                    <div class="history-content">

                                        @foreach($contentPages->where("id","1") as $contentPage)

                                        <p class="ArticleBody">
                                            {!! \Illuminate\Support\Str::limit(($contentPage->excerpt),300,'') !!}
                                            @if (strlen($contentPage->excerpt) > 300)
                                            <span id="dots">...</span>
                                            <!-- <span id="more"
                                                style="display:none;">{{ substr($contentPage->page_text, 300) }}</span> -->
                                            <span id="more"
                                                style="display:none;">{{ substr( $contentPage->excerpt, 300) }}</span>
                                            <a class="read-btn" onclick="myFunction()" id="myBtn">+ Read More</a>
                                            @endif

                                            @endforeach
                                    </div>


                                </div>



                            </div>
                            <div class="history-img">
                                <div id="home_history" class="owl-carousel owl-theme">
                                    <!-- <div id="history" class="owl-carousel owl-theme"> -->

                                    <!-- dynamic part starts   -->

                                    <!-- @php
                                    var_dump($galleries);
                                    @endphp -->


                                    @foreach($galleries->where("id","3") as $key => $gallery)

                                    @foreach($gallery->images as $key => $media)
                                    <div class="item">
                                        <div class="project-item">
                                            <div class="gallery">
                                                <a href="{{$media->getUrl()}}" class="item-inner" data-fancybox="image">
                                                    <div class="item-img">
                                                        <img class="img-fluid" src="{{$media->getUrl('')}}" alt="">
                                                        <div class="hvr">
                                                            <i class="zmdi zmdi-search"></i>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endforeach


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- ********|| HISTORY END ||******** -->

            <!-- ********|| SERVICES START ||******** -->
            <section class="services-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="title-sec">
                                <div class="title">
                                    Amenities & Services
                                </div>
                            </div>
                            <div class="services-inner">
                                <div id="amenities-services" class="owl-carousel owl-theme">
                                    <div class="item">
                                        <div class="services-info">
                                            <div class="services-img">
                                                <img class="img-fluid" src="{{ asset('img/services-1.jpg') }}" alt="">
                                            </div>
                                            <div class="services-box">
                                                <div class="top-img">
                                                    <div class="trangle-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/services-box-01.svg') }}" alt="">
                                                    </div>
                                                    <div class="img-box">
                                                        <img class="img-fluid" src="{{ asset('img/food-01.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>

                                                <div class="services-body">
                                                    <div class="services-title">
                                                        FOOD
                                                    </div>
                                                    <div class="services-content">
                                                        The Club offers a wide range of delicious food in its dining
                                                        hall along with varieties of snacks...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('food_beverages') }}" class="read-btn" data-toggle="modal" data-target="#foodModal">+ Read
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="services-info">
                                            <div class="services-img">
                                                <img class="img-fluid" src="{{ asset('img/services-2.jpg') }}" alt="">
                                            </div>
                                            <div class="services-box">
                                                <div class="top-img">
                                                    <div class="trangle-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/services-box-01.svg') }}" alt="">
                                                    </div>
                                                    <div class="img-box gym-img">
                                                        <img class="img-fluid" src="{{ asset('img/gym-01.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="services-body">
                                                    <div class="services-title">
                                                        GYMMING REJUVENATED
                                                    </div>
                                                    <div class="services-content">
                                                        The Club gym went through refurbishment and up gradation this
                                                        February bringing a whole new face of health and fitness...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('gymming-rejuvenated') }}" class="read-btn" data-toggle="modal" data-target="#gymModal">+
                                                            Read
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="services-info">
                                            <div class="services-img">
                                                <img class="img-fluid" src="{{ asset('img/services-3-pool.jpg') }}" alt="">
                                            </div>
                                            <div class="services-box">
                                                <div class="top-img">
                                                    <div class="trangle-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/services-box-01.svg') }}" alt="">
                                                    </div>
                                                    <div class="img-box gym-img">
                                                        <img class="img-fluid" src="{{ asset('img/swim-01.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="services-body">
                                                    <div class="services-title">
                                                        POOL PUB
                                                    </div>
                                                    <div class="services-content">
                                                        This beautiful facility is let out to members for their
                                                        meetings/parties etc..
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('pool-pub') }}" class="read-btn" data-toggle="modal" data-target="#poolModal">+
                                                            Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="services-info">
                                            <div class="services-img">
                                                <img class="img-fluid" src="{{ asset('img/services-4.jpg') }}" alt="">
                                            </div>
                                            <div class="services-box">
                                                <div class="top-img">
                                                    <div class="trangle-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/services-box-01.svg') }}" alt="">
                                                    </div>
                                                    <div class="img-box gym-img">
                                                        <img class="img-fluid" src="{{ asset('img/bar-01.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="services-body">
                                                    <div class="services-title">
                                                        BAR
                                                    </div>
                                                    <div class="services-content">
                                                        The club has three bars each of them having a unique style &
                                                        decor..
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('club-bar') }}" class="read-btn" data-toggle="modal" data-target="#barModal">+ Read
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="services-info">
                                            <div class="services-img">
                                                <img class="img-fluid" src="{{ asset('img/services-3.jpg') }}" alt="">
                                            </div>
                                            <div class="services-box">
                                                <div class="top-img">
                                                    <div class="trangle-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/services-box-01.svg') }}" alt="">
                                                    </div>
                                                    <div class="img-box gym-img">
                                                        <img class="img-fluid" src="{{ asset('img/swim-01.svg') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="services-body">
                                                    <div class="services-title">
                                                        SWIMMING POOL
                                                    </div>
                                                    <div class="services-content">
                                                        The members can use the pool as per the specific timings...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('swimming-pool') }}" class="read-btn" data-toggle="modal" data-target="#swimmingModal">+ Read
                                                            More</a>
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
            <!-- ********|| SERVICES END ||******** -->

            <!-- ********|| SPORTS START ||******** -->
            <!-- ********|| SERVICES START ||******** -->
            <section class="sports-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="title-sec">
                                <div class="title">
                                    Sports
                                </div>
                            </div>
                            <div class="sports-inner">
                                <div id="home_sports" class="owl-carousel owl-theme">
                                    <!-- dynamic part starts -->
                                    @foreach($sportstypes as $sportstype)

                                    <!-- @php
                                                            var_dump($sportstypes)
                                                        @endphp -->
                                    <div class="item">
                                        <div class="sports-info">
                                            <div class="sports-img">
                                                <img class="img-fluid" src="{{$sportstype->getFirstMediaUrl('icon')}}"
                                                    alt="">

                                                <!-- <img class="img-fluid" src="{{ asset('img/sports-1-01.svg') }}" alt=""> -->
                                            </div>
                                            <div class="sports-box">
                                                <div class="sports-title">
                                                    <!-- cricket -->
                                                    {{$sportstype->sport_name}}
                                                </div>
                                                {{-- <div class="sports-content">
                                                    {{$sportstype->sport_details}}
                                            </div> --}}
                                            <div class="sports-action">
                                                <!-- <a href="{{ url('/pages', $sportstype->sport_name) }}" class="read-btn">+ Read More</a> -->

                                                <!-- <a href="{{ url('/sports', $sportstype->sport_name) }}"
                                                        class="read-btn">+
                                                        Read More</a> -->

                                                <a href="{{ url('/sports') }}" class="read-btn">+
                                                    Read More</a>

                                                <!-- <a href="{{ url('/sports') }}" class="read-btn">
                                                        +Read More
                                                    </a> -->


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <!-- ********|| SPORTS END ||******** -->

        <!-- ********|| CLUB START ||******** -->
        <section class="club-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="title-sec">
                            <div class="title">
                                Reciprocal Club
                            </div>
                        </div>

                        <div class="club-inner">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="indian-tab" data-toggle="tab" href="#indian"
                                        role="tab" aria-controls="indian" aria-selected="true">Indian</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="overseas-tab" data-toggle="tab" href="#overseas" role="tab"
                                        aria-controls="overseas" aria-selected="false">Overseas</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="indian" role="tabpanel"
                                    aria-labelledby="indian-tab">
                                    <div class="club-info">
                                        <div id="home_reciprocal_indian" class="owl-carousel owl-theme">

                                            @foreach($reciprocalClubs->where("cub_type","indian") as $key =>
                                            $reciprocalClub)

                                            <div class="item">

                                                <div class="club-body">

                                                    <div class="club-img">
                                                        <!-- <img class="img-fluid" src="{{ asset('img/club-1.png') }}" alt=""> -->
                                                        <img src=" {{$reciprocalClub->getFirstMediaUrl('club_image')}}"
                                                            alt="" />
                                                    </div>
                                                    <div class="club-title">

                                                        {{$reciprocalClub->reciprocal_club_name}}
                                                        <!-- Madras Cricket Club -->

                                                    </div>

                                                </div>

                                            </div>
                                            @endforeach




                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="overseas" role="tabpanel" aria-labelledby="overseas-tab">
                                    <div class="club-info">
                                        <div id="home_reciprocal_overseas" class="owl-carousel owl-theme">


                                            @foreach($reciprocalClubs->where("cub_type","overseas") as $key =>
                                            $reciprocalClub)

                                            <div class="item">

                                                <div class="club-body">

                                                    <div class="club-img">
                                                        <!-- <img class="img-fluid" src="{{ asset('img/club-1.png') }}" alt=""> -->
                                                        <img src=" {{$reciprocalClub->getFirstMediaUrl('club_image')}}"
                                                            alt="" />
                                                    </div>
                                                    <div class="club-title">

                                                        {{$reciprocalClub->reciprocal_club_name}}
                                                        <!-- Madras Cricket Club -->

                                                    </div>

                                                </div>

                                            </div>
                                            @endforeach





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ********|| CLUB END ||******** -->

        <!-- ***|| TESTIMONIAL START ||*** -->
        <section class="testimonial-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row">
                            <div class="col-lg-7 or-2">
                                 <img class="img-fluid" src="{{ asset('img/testimonial-part1.png') }}"
                                                        alt="">
                            </div>
                            <div class="col-lg-5 or-1">
                                                  <div class="testimonial-carousel">
                                    <div id="home_testimonial" class="owl-carousel owl-theme">
                                                 <div class="item">

                                            <div class="testimonial-body">
                                                <div class="testimonial-inner">

                                                    <div class="testimonial-info">
                                                        <div class="quote-icon">
                                                            <i class="zmdi zmdi-quote"></i>
                                                        </div>
                                                        <div class="testimonial-content">
                                                            The southern end of the present-day CC&FC pavilion is a small but elegant archway made of chunal stone, known as
The Lagden Gate’, 
This was erected as a memorial to Reggie Lagden, who....
                                                        </div>
<!--
                                                        <div class="testimonial-name">
                                                            
                                                        </div>
-->
                                                        <div class="testimonial-profession">
                                                            THE LAGDEN GATE
                                                        </div>
                                                        <div class="testimonial-action">
                                                            <a href="#" class="read-btn" data-toggle="modal" data-target="#gateModal">+ Read more</a>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info-box"></div>
                                                </div>
                                                <div class="testimonial-img">
                                                    <img class="img-fluid" src="{{ asset('img/testimonials/lageden-gate.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">

                                            <div class="testimonial-body">
                                                <div class="testimonial-inner">

                                                    <div class="testimonial-info">
                                                        <div class="quote-icon">
                                                            <i class="zmdi zmdi-quote"></i>
                                                        </div>
                                                        <div class="testimonial-content">
                                                            CC&FC is one of the few clubs of Calcutta to admit ladies as full members in their own right. This happened in 2000 but not before a raging debate in the Club as to whether....
                                                        </div>
<!--
                                                        <div class="testimonial-name">
                                                            
                                                        </div>
-->
                                                        <div class="testimonial-profession">
                                                            Pearson Surita
                                                        </div>
                                                        <div class="testimonial-action">
                                                            <a href="#" class="read-btn" data-toggle="modal" data-target="#suritaModal">+ Read more</a>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info-box"></div>
                                                </div>
                                                <div class="testimonial-img">
                                                    <img class="img-fluid" src="{{ asset('img/testimonials/021320a4-0f5c-4bd4-a17a-dcb282314d6b.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                                <div class="item">

                                            <div class="testimonial-body">
                                                <div class="testimonial-inner">

                                                    <div class="testimonial-info">
                                                        <div class="quote-icon">
                                                            <i class="zmdi zmdi-quote"></i>
                                                        </div>
                                                        <div class="testimonial-content">
                                                            In another match the next day when Hobbs came into bat he received a ball which bounced twice and he mistimed it and sent a dolly catch to mid-off. After the match, the bowler got hold of Hobbs...
                                                        </div>
<!--
                                                        <div class="testimonial-name">
                                                           
                                                        </div>
-->
                                                        <div class="testimonial-profession">
                                                            A A LESLIE, M.C.
                                                        </div>
                                                        <div class="testimonial-action">
                                                            <a href="#" class="read-btn" data-toggle="modal" data-target="#leslieModal">+ Read more</a>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info-box"></div>
                                                </div>
                                                <div class="testimonial-img">
                                                    <img class="img-fluid" src="{{ asset('img/testimonials/bb5c1478-33eb-4749-933a-d80c5a15095a.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                                <div class="item">

                                            <div class="testimonial-body">
                                                <div class="testimonial-inner">

                                                    <div class="testimonial-info">
                                                        <div class="quote-icon">
                                                            <i class="zmdi zmdi-quote"></i>
                                                        </div>
                                                        <div class="testimonial-content">
                                                            In one BCC. vs C.C.C game, Calcutta were soon in dire trouble and we four wickets down for under 20. It fell to my lot to prop the side up and this I did in the end to the tune of about 80....
                                                        </div>
<!--
                                                        <div class="testimonial-name">
                                                            
                                                        </div>
-->
                                                        <div class="testimonial-profession">
                                                            TOM LONGFIELD
                                                        </div>
                                                        <div class="testimonial-action">
                                                            <a href="#" class="read-btn" data-toggle="modal" data-target="#longfieldModal">+ Read more</a>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info-box"></div>
                                                </div>
                                                <div class="testimonial-img">
                                                    <img class="img-fluid" src="{{ asset('img/testimonials/a5dd71bf-44e2-4342-b6e9-04a04b8e1567.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonial-action-mobile">
                                        <a href="#" class="read-btn">+ Read all</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- ***|| TESTIMONIAL END ||*** -->


        <!-- ********|| CONTACT START ||******** -->
        <section class="contact-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 pl-0">
                                <div class="contact-left">
                                    <div class="map">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3685.2201366718136!2d88.363747!3d22.533425!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc1c410a073b08b94!2sCalcutta%20Cricket%20and%20Football%20Club!5e0!3m2!1sen!2sin!4v1643977564770!5m2!1sen!2sin"
                                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
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
                                        <!-- <form method="POST" action="{{route('contact.send')}}"
                                                enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Your Name*">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Your Email*">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Your Mobile No*">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" placeholder="Your Message"
                                                        rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="send-btn">Send Message</button>
                                            </form> -->

                                        @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                            @php
                                            Session::forget('success');
                                            @endphp
                                        </div>
                                        @endif


                                        <form method="POST" action="{{ route('contact-us.store') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <input type="hidden" id="subject" name="subject"
                                                value="New enquiry from the website" size="30" required="">

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Your Name*">

                                                <!-- Show error -->
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Your Email*">

                                                <!-- Show error -->
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Your Mobile No*">

                                                <!-- Show error -->
                                                @if ($errors->has('phone'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                                @endif
                                            </div>


                                            <div class="form-group">
                                                <textarea class="form-control" name="message" id="message"
                                                    placeholder="Your Message" rows="3"></textarea>

                                                <!-- Show error -->
                                                @if ($errors->has('message'))
                                                <span class="text-danger">{{ $errors->first('message') }}</span>
                                                @endif
                                            </div>


                                            <button type="submit" class="send-btn">Send Message</button>
                                        </form>


                                    </div>
                                </div>
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
<!-- Modal -->
            <div class="amenities-modal">
<div class="modal fade" id="foodModal" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="foodModalLabel">FOOD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          The Club offers a wide range of delicious food in its dining hall along with varieties of snacks...
        </div>
    </div>
  </div>
</div>
</div>
                      <div class="amenities-modal">
<div class="modal fade" id="gymModal" tabindex="-1" aria-labelledby="gymModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gymModalLabel">GYMMING REJUVENATED</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          The Club gym went through refurbishment and up gradation this February bringing a whole new face of health and fitness...                                 
        </div>
    </div>
  </div>
</div>
</div>
                      <div class="amenities-modal">
<div class="modal fade" id="poolModal" tabindex="-1" aria-labelledby="poolModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="poolModalLabel">POOL PUB</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                        
           This beautiful facility is let out to members for their meetings/parties etc..   
        </div>
    </div>
  </div>
</div>
</div>
                      <div class="amenities-modal">
<div class="modal fade" id="barModal" tabindex="-1" aria-labelledby="barModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="barModalLabel">BAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                     
            The club has three bars each of them having a unique style & decor.. 
                                                                                               
        </div>
    </div>
  </div>
</div>
</div>
                      <div class="amenities-modal">
<div class="modal fade" id="swimmingModal" tabindex="-1" aria-labelledby="swimmingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="swimmingModalLabel">SWIMMING POOL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          The members can use the pool as per the specific timings...
        </div>
    </div>
  </div>
</div>
</div>
                               <div class="testimonial-modal">
<div class="modal fade" id="gateModal" tabindex="-1" aria-labelledby="gateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gateModalLabel">THE LAGDEN GATE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          The southern end of the present-day CC&FC pavilion is a small but elegant archway made of chunal stone, known as
The Lagden Gate’, 
This was erected as a memorial to Reggie Lagden, who died in tragic circumstances during World War II. Having been secretly flown to England on some assignment relating to tea, he was on his way back when his aircraft overran the landing strip at Karachi and exploded. All those on board were killed instantaneously.
Former President Alec Leslie recalled that “Reggie was held in such affectionate esteem in Calcutta that there was not an office in Clive Street or any club or public building in Calcutta that did not fly a flag at half- mast when the news of his death mmc through”.
Originally; the archway had been erected at the entrance to the Calcutta Cricket Club ground at the Eden Gardens.
Sometime after 1950, when the Calcutta Cricket Club had moved to its current venue, the Lagden Gate was shifted to BallyGunge, where it now stands.

        </div>
    </div>
  </div>
</div>
</div>
                                           <div class="testimonial-modal">
<div class="modal fade" id="suritaModal" tabindex="-1" aria-labelledby="suritaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="suritaModalLabel">PEARSON SURITA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          CC&FC is one of the few clubs of Calcutta to admit ladies as full members in their own right. This happened in 2000 but not before a raging debate in the Club as to whether it was good thing or not. Reproduced below, without comment, the letter that Pearson Surita wrote to the president in 1983. Its contents are self - explanatory
Dear Mr. President
I have recently returned from my holiday abroad to find your circular letter of the 21“June awaiting me.
While I appreciate the various strong arguments you have put forward for the creation of a category of members which would admit ladies I am strongly opposed to this idea. You yourself have pointed out that the Calcutta Cricket and Calcutta Football Clubs have existed originally' as separate organizations and later as a joint unit for two hundred years without the members considering it necessary to open the rolls to the ladies. You has quite rightly pointed out that under Rule 3(ii) a wife and unmarried daughters shall be entitled to the use of the Club.  This at least guarantees the exclusiveness of the organization which might be threatened were single or married women be permitted to join in their own rights. In fact, this would constitute a real danger to the physical or other well-being of unattached or even attached male members.
Let us remember that we are regarded as the Lords of India and I shudder to think of the consternation a similar proposal, if made to the members of MCC, might give rise to.
Finally, to end on a personal note, as an MCP, I would be extremely hesitant in future to accept an invitation to speak at the Annual General Meeting of the Club as the presence of women at the meeting, I am afraid, would cramp my style completely

Yours Sincerely

Pearson Surita


        </div>
    </div>
  </div>
</div>
</div>
                                           <div class="testimonial-modal">
<div class="modal fade" id="leslieModal" tabindex="-1" aria-labelledby="leslieModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="leslieModalLabel">A A LESLIE, M.C.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          In another match the next day when Hobbs came into bat he received a ball which bounced twice and he mistimed it and sent a dolly catch to mid-off. After the match, the bowler got hold of Hobbs and handing him some Club writing paper and asked if he would give him a ‘certificate’ to the effect that he had been bowled by him. Hobbs immediately obliged and was about to sign the certificate when the bowler said “And would you please, Mr. Hobby certify that the ball was a good one?” And Hobbs did!
        </div>
    </div>
  </div>
</div>
</div>
                                           <div class="testimonial-modal">
<div class="modal fade" id="longfieldModal" tabindex="-1" aria-labelledby="longfieldModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="longfieldModalLabel">TOM LONGFIELD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          In one BCC. vs C.C.C game, Calcutta were soon in dire trouble and we four wickets down for under 20. It fell to my lot to prop the side up and this I did in the end to the tune of about 80 runs but not before I had been dropped at first slip. This was off the then captain of Ballygunge, Tom Parker,and the defaulting slip was my old Cambridge friend George Brown, who had played a lot of cricket for Cambridge and for Essex. This all- important catch he had put down was indeed a very easy one. And the mutterings that went on behind in the slips and of course from the wicket- keeper lasted I thought a bit too long—mostly, of course, they were anti- Brown, but they did not forget to let me know how lucky I had been.
In the end, when it was really beginning to affect my concentration, I stopped the game in the middle of the over that George Brown himself was bowling at me and went up to Tom Parker and said, ”May we please change the conversation? I know I was lucky, I know George ought to have caught me and so does he, but let me tell you Mr Parker, George is a better cricketer than you have ever been or ever will be and as an Essex county cricketer I can assure you he does not drop catches on purpose.”
When I got down to George’s end, he said, ‘that went on up there?” and I told him. George said,‘"l'hanks a lot Tom, you have indeed done me a goo turn —Tom Parker is only my Burra-Sahib and I was hoping for a raise this January.
          
        </div>
    </div>
  </div>
</div>
</div>

        <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "+ Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "- Read less";
                moreText.style.display = "inline";
            }
        }
        </script>
        <!-- ********|| CONTACT END ||******** -->
        @include('common.footer')
        <!-- ?php include 'assets/inc/footer.php';?> -->


        </body>

</html>