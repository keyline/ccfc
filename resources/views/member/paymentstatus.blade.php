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

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| HISTORY START ||******** -->
            <section class="inner_belowbanner invoice_section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="row">
                                
                                <div class="col-lg-8 col-md-7">
                                    <div class="member_profiletop">
                                        <h4>Payment Status : {{ $status['status'] }}</h4>
                                        <h4>Payment Ref. No.: {{ $status['mihpayid'] }}</h4>
                                    </div>
                                    @if ($status['status'] == 'success')
                                    <span class="success-msg">Thank you for your payment. The paid amount will reflect in your account within next 24 hours.</span>
                                    @else
                                    <a class="btn btn-info" href="{{ route('member.invoice')}}">Try Again</a>
                                    @endif
                                </div>

                            </div>
                        </div>

                        

                    </div>

                </div>
            </section>




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>