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
                        <div class="col-lg-8">
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Do's:
                                    </div>
                                </div>
                                <ul>
                                    <li>Book appointments in advance to secure your preferred time slot <a href="tel:+91 6290930014">(+91 6290930014)</a>.</li>
                                    <li>Confirm or reschedule appointments at least 24 hours in advance.</li>
                                    <li>Arrive at least 10 minutes prior to your appointment.</li>
                                    <li>Follow all health and safety guidelines provided by the spa staff.</li>
                                    <li>Notify the spa of any health conditions or allergies before your treatment.</li>
                                    <li>Maintain a calm and quiet atmosphere to respect other guests' relaxation.</li>
                                    <li>Provide feedback to help us improve our services.</li>
                                </ul>
            
                            </div>
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Don'ts:
                                    </div>
                                </div>
                                <ul>
                                    <li>Arrive late as it may result in a shortened treatment time to accommodate other appointments.</li>
                                    <li>Use mobile phones or other devices that may disrupt the peaceful environment.</li>
                                    <li>Bring children unless they are receiving a treatment themselves.</li>
                                    <li>Overuse spa amenities beyond reasonable limits, affecting other guests' access.</li>
                                </ul>
                            </div>
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        Terms & Conditions:
                                    </div>
                                </div>
                                <ul>
                                    <li>A minimum of 24 hours’ notice is required for appointment cancellations or rescheduling.</li>
                                    <li>Please inform us of any health conditions, allergies, or injuries that may affect your treatment.</li>
                                    <li>Guests must be at least 18 years old unless accompanied by a parent or guardian.</li>
                                    <li>The spa is not liable for any lost or stolen items.</li>
                                </ul>
            
                            </div>
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        SPA Timings:
                                    </div>
                                </div>
                                <p class="spa-time"><i class="zmdi zmdi-calendar"></i> Tuesday to Sunday </p>
                                <p class="spa-time"><i class="zmdi zmdi-time"></i> 11.30 am to 7.30 pm</p>
                                <p class="spa-time"><i class="zmdi zmdi-smartphone-android"></i> <a href="tel:+916290930014"> +91 6290930014</a></p>
                            </div>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="gym-inner">
                                <div class="title-sec">
                                    <div class="title text-left">
                                        <!-- <a href="javascript: void(0)" style="color: #d24f50"><img src="{{ asset('img/hand-point.png') }}" alt=""> Spa Rate Chart (Members must be logged in to view full rate chart)</a>  -->
                                        <span style="color: #d24f50">Spa Rate Chart 
                                        @if (auth()->check()) @else {{'(Members must be logged in to view full rate chart)'}} @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->check())
                        <div class="col-lg-6">
                            
                            <div class="gym-inner">
                                <div class="table-box table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Sl. No.</th>
                                            <th>ITEMS</th>
                                            <th>TIME (MINS)</th>
                                            <th>MEMBERS’ RATE (INR)</th>
                                            <th>MEMBERS’ GUEST RATE (INR)</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>SWEDISH STRESS RELIEF</td>
                                                <td>45+15</td>
                                                <td>1500</td>
                                                <td>1875</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>DEEP TISSUE</td>
                                                <td>45+15</td>
                                                <td>1500</td>
                                                <td>1875</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>VEDIC ABHYANGAM</td>
                                                <td>45+15</td>
                                                <td>1200</td>
                                                <td>1500</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>POTLI</td>
                                                <td>45+15</td>
                                                <td>2000</td>
                                                <td>2500</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>NORMAL SWEDISH</td>
                                                <td>45+15</td>
                                                <td>1000</td>
                                                <td>1250</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>NORMAL SWEDISH WITH OIL</td>
                                                <td>45+15</td>
                                                <td>1200</td>
                                                <td>1500</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>HEAD MASSAGE</td>
                                                <td>30</td>
                                                <td>500</td>
                                                <td>625</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>FOOT MASSAGE</td>
                                                <td>30</td>
                                                <td>500</td>
                                                <td>625</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>ARM MASSAGE</td>
                                                <td>30</td>
                                                <td>500</td>
                                                <td>625</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>BACK & SHOULDER MASSAGE</td>
                                                <td>30</td>
                                                <td>700</td>
                                                <td>875</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>FACE CLEAN-UP</td>
                                                <td>45</td>
                                                <td>1200</td>
                                                <td>1500</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>FACIAL</td>
                                                <td>60</td>
                                                <td>1500</td>
                                                <td>1875</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>FACIAL WITH PACK</td>
                                                <td>60</td>
                                                <td>2000</td>
                                                <td>2500</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="gym-inner">
                                <div class="table-box table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Sl. No.</th>
                                            <th>ITEMS</th>
                                            <th>MEMBERS’ RATE (INR)</th>
                                            <th>MEMBERS’ GUEST RATE (INR)</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>FULL BACK (WAXING)</td>
                                                <td>1000</td>
                                                <td>1250</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>HALF BACK (WAXING)</td>
                                                <td>700</td>
                                                <td>875</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>TUMMY (WAXING)</td>
                                                <td>700</td>
                                                <td>875</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>CHEST (WAXING)</td>
                                                <td>1000</td>
                                                <td>1250</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>FULL BODY (WAXING)</td>
                                                <td>3000</td>
                                                <td>3750</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>BIKINI WAX (WAXING)</td>
                                                <td>3000</td>
                                                <td>3750</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>FEET (WAXING)</td>
                                                <td>200</td>
                                                <td>250</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>UPPER LIP/NOSE (WAXING)</td>
                                                <td>100</td>
                                                <td>125</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>CHIN (WAXING)</td>
                                                <td>150</td>
                                                <td>188</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>FULL FACE (WAXING)</td>
                                                <td>500</td>
                                                <td>625</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>UNDER ARMS (WAXING)</td>
                                                <td>300</td>
                                                <td>375</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>FULL ARMS (LADIES/GENTS) (WAXING)</td>
                                                <td>600/700</td>
                                                <td>750/875</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>HALF ARMS (LADIES/GENTS) (WAXING)</td>
                                                <td>400/500</td>
                                                <td>500/625</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>FULL LEGS (LADIES/GENTS) (WAXING)</td>
                                                <td>700/800</td>
                                                <td>875/1000</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>HALF LEGS (LADIES/GENTS) (WAXING)</td>
                                                <td>500/600</td>
                                                <td>625/750</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>EYEBROWS & FOREHEAD & CHIN (THREADING)</td>
                                                <td>100 (EACH)</td>
                                                <td>125</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>UPPER LIP (THREADING)</td>
                                                <td>80</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>FULL FACE (THREADING)</td>
                                                <td>400</td>
                                                <td>500</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        
                        @endif
                    </div>
                </div>
            </section>
            <!-- ********|| GYM GENERAL END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>