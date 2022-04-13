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
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
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
                                                        <a href="{{ asset('food_beverages') }}" class="read-btn">+ Read
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
                                                        <a href="{{ asset('gymming-rejuvenated') }}" class="read-btn">+
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
                                                        POOL PUB
                                                    </div>
                                                    <div class="services-content">
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                                        euismod tincidunt ut sad asdlaoreet dolore...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('pool-pub') }}" class="read-btn">+
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
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                                        euismod tincidunt ut sad asdlaoreet dolore...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('club-bar') }}" class="read-btn">+ Read
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
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                                        euismod tincidunt ut sad asdlaoreet dolore...
                                                    </div>
                                                    <div class="services-action">
                                                        <a href="{{ asset('swimming-pool') }}" class="read-btn">+ Read
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
                                                <div class="sports-content">
                                                    <!-- Lorem ipsum dolor sit amet, consectetuer adipiscing elit... -->
                                                    {{$sportstype->sport_details}}
                                                </div>
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
                                        <a class="nav-link" id="overseas-tab" data-toggle="tab" href="#overseas"
                                            role="tab" aria-controls="overseas" aria-selected="false">Overseas</a>
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
                                    <div class="tab-pane fade" id="overseas" role="tabpanel"
                                        aria-labelledby="overseas-tab">
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
                                <div class="col-lg-8 or-2">

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
                                                                Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                                                                dolore magna aliquam erat volutpat. Ut wisi enim....
                                                            </div>
                                                            <div class="testimonial-name">
                                                                Sourav Ganguly
                                                            </div>
                                                            <div class="testimonial-profession">
                                                                BCCI President
                                                            </div>
                                                            <div class="testimonial-action">
                                                                <a href="#" class="read-btn">+ Read more</a>
                                                            </div>
                                                        </div>
                                                        <div class="testimonial-info-box"></div>
                                                    </div>
                                                    <div class="testimonial-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/testimonial-1.jpg') }}" alt="">
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
                                                                Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                                elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                                                                dolore magna aliquam erat volutpat. Ut wisi enim....
                                                            </div>
                                                            <div class="testimonial-name">
                                                                Sachin Tendulkar
                                                            </div>
                                                            <div class="testimonial-profession">
                                                                BCCI President
                                                            </div>
                                                            <div class="testimonial-action">
                                                                <a href="#" class="read-btn">+ Read more</a>
                                                            </div>
                                                        </div>
                                                        <div class="testimonial-info-box"></div>
                                                    </div>
                                                    <div class="testimonial-img">
                                                        <img class="img-fluid"
                                                            src="{{ asset('img/testimonial-2.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="testimonial-action-mobile">
                                            <a href="#" class="read-btn">+ Read all</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 or-1">
                                    <div class="testimonial-right">
                                        <div class="testimonial-logo">
                                            <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="" />
                                        </div>
                                        <div class="testimonial-order-part">
                                            <div class="title-sec">
                                                <div class="title">
                                                    Testimonials
                                                </div>
                                            </div>
                                            <div class="testimonial-content">
                                                Lorem ipsum dolor sit amet, ipsum dolor sit amet, consectetuer
                                                adipiscing elitconsectetuer adipiscing elit...
                                            </div>
                                        </div>
                                        <div class="testimonial-action">
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