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
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 2,
                    dots: false,
                    nav: true,
                },
                600: {
                    items: 3,
                    dots: false,
                    nav: true,
                },
                1000: {
                    items: 5,
                    margin: 20,
                    nav: true,
                    dots: false,
                }
            }
        });

    </script>
    <script>
        $("#owldemo3").owlCarousel({
            loop: true,
            margin: 10,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                    nav: true,
                },
                600: {
                    items: 2,
                    dots: false,
                    nav: true,
                },
                1000: {
                    items: 3,
                    margin: 20,
                    nav: true,
                    dots: false,
                },
                 1400: {
                    items: 4,
                    margin: 20,
                    nav: true,
                    dots: false,
                },
            }
        });

    </script>
    <script>
        $("#owldemo4").owlCarousel({
            loop: true,
            margin: 10,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                    nav: true,
                },
                600: {
                    items: 2,
                    dots: false,
                    nav: true,
                },
                1000: {
                    items: 3,
                    margin: 20,
                    nav: true,
                    dots: false,
                },
                1400: {
                    items: 5,
                    margin: 20,
                    nav: true,
                    dots: false,
                }
            }
        });

    </script>
    <script>
        $("#owldemo5").owlCarousel({
            loop: true,
            margin: 10,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 3,
                    dots: false,
                    nav: false,
                },
                600: {
                    items: 5,
                    dots: false,
                    nav: false,
                },
                1000: {
                    items: 7,
                    margin: 20,
                    nav: false,
                    dots: false,
                }
            }
        });

    </script>
    <script>
        $("#owldemo6").owlCarousel({
            loop: true,
            margin: 10,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 3,
                    dots: false,
                    nav: false,
                },
                600: {
                    items: 5,
                    dots: false,
                    nav: false,
                },
                1000: {
                    items: 7,
                    margin: 20,
                    nav: false,
                    dots: false,
                }
            }
        });

    </script>
                       <script>
        $("#owldemo7").owlCarousel({
            loop: true,
            margin: 10,

            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                    nav: true,
                },
                600: {
                    items: 1,
                    dots: false,
                    nav: true
                },
                1000: {
                    items: 1,
                    margin: 20,
                    nav: true,
                    dots: false,
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