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
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-3">

                            @if($userProfile['MemberImage'] == '')


                            <div class="member_profileimg">
                                <img class="img-fluid" src="{{ asset('img/demopic.png') }}" alt="" />
                            </div>


                            @else

                            <div class="member_profileimg">
                                <img class="img-fluid" src="data:image/png;base64,                          
                                    {{ $userProfile['MemberImage'] }}" alt="" />
                            </div>

                            @endif
                        </div>
                        <!-- <pre><code>{{ json_encode($userProfile, JSON_PRETTY_PRINT) }}</code></pre> -->
                        <div class="col-lg-9 col-md-9">
                            <div class="member_profiletop">
                                <h4>Welcome</h4>
                                <h2>{{ $userProfile['MEMBER_NAME'] }}</h2>
                                <p><strong>Ph No:</strong> {{ $userProfile['PHONE1'] }}</p>
                                <p><strong>Mail ID:</strong> {{ $userProfile['EMAIL'] }}</p>
                            </div>
                        </div>
                        <hr class="divider_red">
                    </div>
                </div>
            </section>

            <section class="member_details_section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="member_titlebg">
                                <h2>Member Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member Type</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBERTYPE'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member Code</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBER_CODE'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $userProfile['DOB'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member since</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBER_SINCE'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Sex</p>
                                    <p class="member_list_input">{{ $userProfile['SEX'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone I</p>
                                    <p class="member_list_input">{{ $userProfile['PHONE1'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone II</p>
                                    <p class="member_list_input">{{ $userProfile['PHONE2'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone III</p>
                                    <p class="member_list_input">{{ $userProfile['MOBILENO'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address I</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS1'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address II</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS2'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address III</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS3'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">City</p>
                                    <p class="member_list_input">{{ $userProfile['CITY'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">State</p>
                                    <p class="member_list_input">{{ $userProfile['STATE'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Pincode</p>
                                    <p class="member_list_input">{{ $userProfile['PIN'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Email</p>
                                    <p class="member_list_input">{{ $userProfile['EMAIL'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Curent status</p>
                                    <p class="member_list_input">{{ $userProfile['CURENTSTATUS'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="member_titlebg">
                                <h2>Spouse Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Spouse Name</p>
                                    <p class="member_list_input">{{ $userProfile['SPOUSE_NAME'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $userProfile['SPOUSE_DOB'] }}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Anniversary Date</p>
                                    <p class="member_list_input">{{ $userProfile['ANNIVERSARY_DATE'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Spouse Business</p>
                                    <p class="member_list_input"></p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $userProfile['SPOUSEMOBILENO'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="member_titlebg">
                                <h2>Children Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Children Name</p>
                                    <p class="member_list_input"></p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| HISTORY END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>