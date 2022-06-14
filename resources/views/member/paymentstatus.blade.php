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
                        <div class="col-md-12 col-lg-12">
                                <div class="title-sec pt-5">
                                    <div class="title mb-3">
                                        Payment Status : {{ $status['status'] }}
                                    </div>
                                </div>                           

                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="history-inner resetbox_section text-center pb-5">
                                <h4>Payment Ref. No.: {{ $status['mihpayid'] }}</h4>
                                    @if ($status['status'] == 'success')
                                    <span class="success-msg">Thank you for your payment. The paid amount will reflect in your account within next 24 working hours.</span>
                                    @else
                                    <div class="card">
                                    <button class="btn btn-primary btn-flat btn-block" onclick="location.href='{{ route('member.invoice')}}'">Try Again</button>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>

                </div>
            </section>




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>