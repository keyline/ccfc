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
                <section class="history-banner">
                    <img class="img-fluid" src="{{ asset('img/history/history-banner.jpg') }}" alt="" />
                </section>
                <!-- ********|| BANNER PART END ||******** -->

                <!-- ********|| Sports START ||******** -->
                <section class="sports-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="title-sec">
                                        <div class="title text-left">
                                            Sports
                                        </div>
                                    </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content_inner">
                                    <p>
                                        In the city of Calcutta, then just over a hundred years old and growing fast both in commercial and political significance, the British Raj was busy setting its roots. And sports were definitely a part of the social lore.
                                    </p>
                                    <p>
                                        Indeed, sports events were reckoned to be important enough for sub-continental reporters. Fortunately, a copy of the Madras Courier dated 23rd. February, 1792 has survived. The paper reported cricket fixtures between the Calcutta Cricket Club and Barrackpore and the Calcutta Cricket Club and Dum Dum. Clearly, the Calcutta Cricket Club was already in existence in 1792.
                                    </p>
                                    <p>
                                        The story of how CC&FC traced its origins is interesting and is preserved in its archives thanks to Past President H.J. Moorhouse. It began in 1955 with a letter to The Times, London from Alan R. Tait, Honorary Secretary of Oporto Cricket Club in Portugal. The Club was celebrating its centenary that year, and Tait claimed that it 'must be one of the oldest cricket club outside Great Britain'.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="sports_tabsection">
                    <div class="container">
                        <div class="row">
                            <div class="sport-tablist">  
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    
                                        <li class="nav-item">
                                            
                                                <a class="nav-link active" id="cricket-tab" data-toggle="tab" href="#cricket">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/cricket_icon.png') }}" alt=""/>
                                                        <h3>Cricket</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="football-tab" data-toggle="tab" href="#football">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/football_icon.png') }}" alt=""/>
                                                        <h3>Football</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="rugby-tab" data-toggle="tab" href="#rugby">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/rugby_icon.png') }}" alt=""/>
                                                        <h3>Rugby</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="hockey-tab" data-toggle="tab" href="#hockey">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/hockey_icon.png') }}" alt=""/>
                                                        <h3>Hockey</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="tennis-tab" data-toggle="tab" href="#tennis">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/tennis_icon.png') }}" alt=""/>
                                                        <h3>Tennis</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="golf-tab" data-toggle="tab" href="#golf">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/golf_icon.png') }}" alt=""/>
                                                        <h3>Golf</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            
                                                <a class="nav-link" id="other-tab" data-toggle="tab" href="#other">
                                                    <div class="tab_icontext">
                                                        <img src="{{ asset('img/sports/other_icon.png') }}" alt=""/>
                                                        <h3>Other</h3>
                                                    </div>
                                                </a>
                                            
                                        </li>
                                    
                                </ul>
                                
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="cricket" role="tabpanel" aria-labelledby="indian-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo1.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Mainak Choudhury</h4>
                                                                <p><a href="tel:+91 7044066268">+91 7044066268</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">mainak8717@gmail.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo2.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>VICE CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo3.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="football" role="tabpanel" aria-labelledby="football-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo1.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Mainak Choudhury</h4>
                                                                <p><a href="tel:+91 7044066268">+91 7044066268</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">mainak8717@gmail.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo2.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>VICE CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="rugby" role="tabpanel" aria-labelledby="rugby-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo1.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Mainak Choudhury</h4>
                                                                <p><a href="tel:+91 7044066268">+91 7044066268</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">mainak8717@gmail.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo2.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>VICE CAPTAIN</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo3.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="hockey" role="tabpanel" aria-labelledby="hockey-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo3.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>JT. SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aditya Gupta</h4>
                                                                <p><a href="tel:+ 91 98303 50092"> + 91 98303 50092</a></p>
                                                                <p><a href="mailto:mainak8717@gmail.com">adi_wgsha@yahoo.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tennis" role="tabpanel" aria-labelledby="tennis-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo3.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="golf" role="tabpanel" aria-labelledby="golf-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo2.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                                        <div class="sport_tab_content_section">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                    <div class="sports_tabcontent_inner">
                                                        <div class="sport_tab_ceibity-img">
                                                            <img src="{{ asset('img/sports/demo4.png') }}" alt=""/>
                                                        </div>
                                                        <div class="sport_player">
                                                            <h3>SECRETARY</h3>
                                                            <div class="sport_player_detail">
                                                                <h4>Mr. Aadit Osatwal</h4>
                                                                <p><a href="tel:+91 98302 22255">+91 98302 22255</a></p>
                                                                <p><a href="mailto:aadit@angesbags.com">aadit@angesbags.com</a></p>
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
                    </div>
                </section>

                <!-- ********|| Sports END ||******** -->

                                
                                
@include('common.footer')
<!-- ?php include 'assets/inc/footer.php';?> -->

<script>
    $(document).ready(function() {
        if ( $(window).width() < 767 ) {
            startCarousel();
        } else {
            $('.owl-carousel').addClass('off');
        }
        });

        $(window).resize(function() {
            if ( $(window).width() < 767 ) {
            startCarousel();
            } else {
            stopCarousel();
            }
        });

        function startCarousel(){
            $("#owl_player_icon").owlCarousel({
                slideSpeed : 500,
                margin:10,
                paginationSpeed : 400,
                autoplay:true,
                items : 4,
                itemsDesktop : false,
                itemsDesktopSmall : false,
                itemsTablet: false,
                itemsMobile : false,
                loop:false,
                nav:true,
                navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 3,
                        dots: false,
                        nav: true,
                    },
                    400: {
                        items: 4,
                        dots: false,
                        nav: true,
                    },
                    500: {
                        items: 5,
                        dots: false,
                        nav: true,
                    },
                    600: {
                        items: 7,
                        dots: false,
                        nav: true,
                    },
                    767: {
                        items: 7,
                        nav: true,
                        dots: false,
                    }
                }
            });
        }
        function stopCarousel() {
        var owl = $('.owl-carousel');
        owl.trigger('destroy.owl.carousel');
        owl.addClass('off');
        }
</script>
                             
</body>

</html>
