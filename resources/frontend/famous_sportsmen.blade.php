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

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" />

                            </div>

                        </div>

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| Famous Sportsmen START ||******** -->
            <section class="famoussport-page inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Famous Sportsmen
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
            <section class="famoussport-details">
                <div class="container">
                    <div class="row">

                        @foreach($sportsmen as $key =>
                        $sport)

                        <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{$sport->getFirstMediaUrl('image')}}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>{{$sport->name}}</h3>
                                    <p>{!!$sport->details!!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{ asset('img/sportsman/sourav.jpg') }}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>Sourav Ganguly</h3>
                                    <p>Sourav Chandidas Ganguly (born 8 July 1972), affectionately known as Dada (meaning "elder brother" in Bengali), is an Indian cricket administrator, commentator and former national cricket team captain who is the 39th and current president of the Board of Control for Cricket in India.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{ asset('img/sportsman/leander.jpg') }}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>Leander Paes</h3>
                                    <p>Leander Adrian Paes (born 17 June 1973) is an Indian professional tennis player
                                        who is considered as one of the greatest doubles player in the history of the
                                        sport along with the record of most doubles wins in the Davis Cup.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{ asset('img/sportsman/arun.jpg') }}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>Arun Lal</h3>
                                    <p>Arun Lal (born 1 August 1955) is a retired Indian cricketer, and a cricket
                                        commentator. He played for India, as a right-handed batsman, between 1982 and
                                        1989. In 1982, he made his Test debut against Sri Lanka at Madras with 63 and
                                        shared a partnership of 156 with Sunil Gavaskar. In his next test, he scored 51
                                        against Pakistan and shared an opening partnership with Sunil Gavaskar for 105.
                                        His highest test innings score is 93 made against West Indies at Calcutta in
                                        1987.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{ asset('img/sportsman/shyam.jpg') }}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>Shyam Thapa</h3>
                                    <p>Shyam Thapa is a former Indian footballer who played for the India national
                                        football team. He also coached the Nepal national football team. He is currently
                                        the chairman of All India Football Federation technical committee. Shyam Thapa
                                        was first discovered when he scored the match winner for Gorkha Military Higher
                                        Secondary School (HSS) against Anjuman Islam Higher secondary school, Mumbai in
                                        the 1964 Subroto Mukherjee Cup final. The East Bengal supremo JC Guha, who had a
                                        good eye for talent, signed him for the 1966 season. Shyam made a memorable
                                        debut as a precocious 18-year-old in the 1966 Kolkata league, scoring a
                                        hat-trick against Rajasthan Football Club. Afterwards, he returned to Gorkha
                                        Brigade and played for them from 1967-1969.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-12 col-lg-6 col-sm-6 mb-4">
                            <div class="famoussport_item">
                                <div class="famoussport_img">
                                    <img class="img-fluid" src="{{ asset('img/sportsman/subimal.jpg') }}" alt="" />
                                </div>
                                <div class="famoussport_info">
                                    <h3>Subimal Goswami</h3>
                                    <p>Gurbakhsh Singh (born February 11, 1936) is a former field hockey player from
                                        India who was a member of the India national field hockey team that won the gold
                                        medal at the 1964 Summer Olympics. He was the Joint Captain at the 1968 Mexico
                                        City Olympic Games where India won Bronze Medal and the Coach to the Indian team
                                        at the 1976 Montreal Olympic Games. For his outstanding contribution to the
                                        country in the field of sports, Gurbuksh was given the Arjuna Award in the year
                                        1966.</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <!-- ********|| Famous Sportsmen END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>