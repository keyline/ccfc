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

                            <div class="resetbox_section">
                                <div class="card">
                                    <div class="card-body login-card-body">
                                        <div class="col-md-12 col-lg-12">
                                            <form name="updateme" method="POST" action="{{ route('member.updateme') }}">
                                                @csrf
                                                <input type="hidden" name="user_code" value="{{ $usercode ??  ''}}"
                                                    required>
                                                <button class="btn btn-primary btn-flat btn-block" type="submit"
                                                    name="updateme" value="yes">Update Your
                                                    Profile</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            </section>

            <section class="member_details_section">
                <div class="container">
                    <div class="row">


                    </div>





                </div>
            </section>
            <!-- ********|| HISTORY END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>