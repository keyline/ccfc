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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

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
        $("#home_banner").owlCarousel({
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

        // ============== 

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
        
        // =============== home history 
        $("#home_history").owlCarousel({
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
        
        // ================ home amenities services
        $("#amenities-services").owlCarousel({
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
                    nav: true,
                },
                600: {
                    items: 2,
                    dots: true,
                    nav: true,
                },
                1000: {
                    items: 3,
                    margin: 20,
                    nav: true,
                    dots: true,
                },
                1600: {
                    items: 4,
                    margin: 20,
                    nav: true,
                    dots: true,
                }
            }
        });

        // ==================== Home Sports
        $("#home_sports").owlCarousel({
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

        // ==================== Home Reciprocal Indian
        $("#home_reciprocal_indian").owlCarousel({
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

        // ================= Home Reciprocal Overseas
        $("#home_reciprocal_overseas").owlCarousel({
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


        // ================ Home Testimonial
        $("#home_testimonial").owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
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
                    nav: true,
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
    <script type="text/javascript">
        window.addEventListener("resize", function() {
            "use strict"; window.location.reload(); 
        });
    
        document.addEventListener("DOMContentLoaded", function(){
             // make it as accordion for smaller screens
            if (window.innerWidth < 992) {
                document.querySelectorAll('.topPanel .nav-link').forEach(function(element){             
                    element.addEventListener('click', function (e) {
                          let nextEl = element.nextElementSibling;
                          let parentEl  = element.parentElement;
                          let allSubmenus_array =	parentEl.querySelectorAll('.submenu');
                          if(nextEl && nextEl.classList.contains('submenu')) {	
                              e.preventDefault();	
                              if(nextEl.style.display == 'block'){
                                  nextEl.style.display = 'none';  
                              } else {
                                  nextEl.style.display = 'block';
                              }
    
                          }
                    });
                })
            }
            // end if innerWidth
    
        }); 
        // DOMContentLoaded  end
    </script>
    