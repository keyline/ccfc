<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('common.home_header')
    <!-- ********|| RIGHT PART START ||******** -->

    <div class="col-lg-9 col-md-7 p-0">
        <div class="right-body">
            <!-- ********|| BANNER PART START ||******** -->

            <section class="banner">
                <div class="banner-box">
                    <div id="innerpage-banner" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="about-img"> <img class="img-fluid" src="{{ asset('img/sports-banner.jpg') }}"
                                    alt="" /> </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    <?php echo "Sports name is :" . $sport_name;
                                    //echo "<br>";
                                    ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <section class="sports_tabsection">
                <div class="sport_tab_content_section">
                    <div class="row">

                        @foreach($members as $key => $member)

                        @if ($member->select_sport->sport_name == $sport_name)
                        @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                        $key =>$userDetail)

                        <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                            <div class="sports_tabcontent_inner">
                                <div class="sport_tab_ceibity-img"> <img
                                        src="{{ $userDetail->member_image->getUrl('') }}" alt="">
                                </div>
                                <div class=" sport_player">
                                    <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                    <div class="sport_player_detail">
                                        <h4>{{ $member->select_member->name ?? '' }}</h4>
                                        <!-- <p><a href="tel:+91 4242420202">+91
                                                4242420202</a> </p> -->
                                        <p><a
                                                href="mailto:{{ $member->select_member->email ?? '' }}">{{ $member->select_member->email ?? '' }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach


                        @else

                        @endif



                        @endforeach
                    </div>
                </div>
            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| CONTACT END ||******** -->
            @include('common.footer')


            </body>

</html>