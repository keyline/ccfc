   <!-- ********|| FOOTER START ||******** -->
                                <section class="footer_top">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="foot_copyright">  
                                                    <div class="copyright">Copyright © 2022 The CC&FC Club at Kolkata All Rights Reserved.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0">
                                                <div class="foot_social">  
                                                    <div class="footer_social_inner">
                                                        <ul>
                                                            <li class="social_follow">Follow Us on:</li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-facebook"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-twitter"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-instagram"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-pinterest"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-linkedin"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="social-icon">
                                                                    <i class="zmdi zmdi-youtube-play"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0 foot_webcomp">
                                                <div class="foot_copyright">  
                                                    <div class="foot_webcompany">
                                                        Design & Developed by<a href="#" class="keyline"> KEYLINE</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="footer-img">
                                    <img class="img-fluid" src="{{ asset('img/footer-ban.png') }}" alt="">
                                </section>
                                <!-- ********|| FOOTER END ||******** -->
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

                                <form method="POST" action="{{route('contact.send')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name*">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email*">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="phone" class="form-control"
                                            placeholder="Your Mobile No*">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="msg" placeholder="Your Message"
                                            rows="3"></textarea>
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

<!-- ********|| FOOTER START ||******** -->
<section class="footer-img">
    <img class="img-fluid" src="{{ asset('img/footer-ban.png') }}" alt="">
</section>
<!-- ********|| FOOTER END ||******** -->
</div>

<!-- ********|| RIGHT PART END ||******** -->
</div>
</div>
</div>



</div>
</div>
</section>
<!-- ********|| BODY PART END ||******** -->


<!--  *************************************************    -->

<!-- ********|| RIGHT PART START ||******** -->
<!-- ********|| RIGHT PART END ||******** -->




<!-- ********|| BANNER STARTS ||******** -->


<!-- ********|| BANNER ENDS ||******** -->







<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
<script defer="defer" type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<!------------fancybox------------>

<script defer="defer" type="text/javascript" src="{{ asset('fancybox/jquery.fancybox.min.js') }}"></script>

<script src="{{ asset('owl/owl-min.js') }}"></script>


<script>
$("#owldemo1").owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 1,
            dots: true,
            nav: false,
        },
        600: {
            items: 1,
            dots: true,
            nav: false,
        },
        1000: {
            items: 1,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo2").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 2,
            dots: true,
            nav: false,
        },
        600: {
            items: 3,
            dots: true,
            nav: false,
        },
        1000: {
            items: 5,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo3").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 1,
            dots: true,
            nav: false,
        },
        600: {
            items: 2,
            dots: true,
            nav: false,
        },
        1000: {
            items: 4,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo4").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 1,
            dots: true,
            nav: false,
        },
        600: {
            items: 3,
            dots: true,
            nav: false,
        },
        1000: {
            items: 5,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo5").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 3,
            dots: true,
            nav: false,
        },
        600: {
            items: 5,
            dots: true,
            nav: false,
        },
        1000: {
            items: 7,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo6").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 3,
            dots: true,
            nav: false,
        },
        600: {
            items: 5,
            dots: true,
            nav: false,
        },
        1000: {
            items: 7,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script>
$("#owldemo7").owlCarousel({
    loop: true,
    margin: 10,
    //            autoplay: true,
    //            autoplayTimeout: 4000,
    //            autoplayHoverPause: true,
    navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
    responsive: {
        0: {
            items: 1,
            dots: true,
            nav: false,
        },
        600: {
            items: 1,
            dots: true,
            nav: false,
        },
        1000: {
            items: 1,
            margin: 20,
            nav: false,
            dots: true,
        }
    }
});
</script>
<script type="text/javascript">
$(document).ready(function() {

    </script>
    <script>
        $("#innerpage-banner").owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 1,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo2").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 2,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 3,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 5,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo3").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 2,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 4,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo4").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 3,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 5,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo5").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 3,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 5,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 7,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo6").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 3,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 5,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 7,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script>
        $("#owldemo7").owlCarousel({
            loop: true,
            margin: 10,
            //            autoplay: true,
            //            autoplayTimeout: 4000,
            //            autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                600: {
                    items: 1,
                    dots: true,
                    nav: false,
                },
                1000: {
                    items: 1,
                    margin: 20,
                    nav: false,
                    dots: true,
                }
            }
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            var url = window.location;









    var str1 = url;

    var str2 = 'searchResult.php';

    //                    if(url.indexOf(str2)){

    //                       alert("found"); 

    //                    }





    // Will only work if string in href matches with location



    $('ul#nav a[href="' + url + '"]').parent().addClass('active');



    // Will also work for relative and absolute hrefs



    $('ul#nav a').filter(function() {



        return this.href == url;



    }).parent().addClass('active');



});
</script>