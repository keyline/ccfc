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
            <section class="inner_belowbanner memberbelowinfo_section">
                <div class="container">
                    <div class="row">
                        <!-- <pre><code>{{ json_encode($userProfile, JSON_PRETTY_PRINT) }}</code></pre> -->
                        <div class="dashboardpic_items">

                            @if($userProfile['MemberImage'] == '')


                            <div class="member_profileimg">
                                <img class="img-fluid ifnotpic" src="{{ asset('img/Profile-Icon-01.svg') }}" alt="" />
                            </div>


                            @else

                            <div class="member_profileimg">
                                <img class="img-fluid" src="data:image/png;base64,                          
                                    {{ $userProfile['MemberImage'] }}" alt="" />

                            </div>

                            @endif
                        </div>

                        <div class="dashboardpic_itemsinfo">
                            <div class="member_profiletop">
                                <h4>Welcome</h4>
                                <h2>{{ $userProfile['MEMBER_NAME'] }}</h2>
                                <p><strong>Ph No:</strong>
                                    {{ $userProfile['MOBILENO'] }}
                                </p>
                                <p><strong>Mail ID:</strong> {{ $userProfile['EMAIL'] }}</p>
                            </div>
                        </div>
                        {{-- <hr class="divider_red"> --}}
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
                                @if($userProfile['MEMBERTYPE'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member Type</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBERTYPE'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['MEMBER_CODE'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member Code</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBER_CODE'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['DOB'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $userProfile['DOB'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['MEMBER_SINCE'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Member since</p>
                                    <p class="member_list_input">{{ $userProfile['MEMBER_SINCE'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['SEX'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Sex</p>
                                    <p class="member_list_input">{{ $userProfile['SEX'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['SEX'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone I</p>
                                    <p class="member_list_input">{{ $userProfile['PHONE1'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['PHONE2'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone II</p>
                                    <p class="member_list_input">{{ $userProfile['PHONE2'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['MOBILENO'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone III</p>
                                    <p class="member_list_input">{{ $userProfile['MOBILENO'] }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">

                                @if($userProfile['ADDRESS1'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address I</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS1'] }}</p>
                                </div>
                                @endif



                                @if($userProfile['ADDRESS2'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address II</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS2'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['ADDRESS3'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Address III</p>
                                    <p class="member_list_input">{{ $userProfile['ADDRESS3'] }}</p>
                                </div>
                                @endif


                                @if($userProfile['CITY'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">City</p>
                                    <p class="member_list_input">{{ $userProfile['CITY'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['STATE'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">State</p>
                                    <p class="member_list_input">{{ $userProfile['STATE'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['PIN'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Pincode</p>
                                    <p class="member_list_input">{{ $userProfile['PIN'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['EMAIL'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Email</p>
                                    <p class="member_list_input">{{ $userProfile['EMAIL'] }}</p>
                                </div>
                                @endif

                                @if($userProfile['CURENTSTATUS'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Curent status</p>
                                    <p class="member_list_input">{{ $userProfile['CURENTSTATUS'] }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($userProfile['SPOUSE_NAME'] == '')
                    <div class="row">

                        <div class="col-md-6">
                            <div class="member_probile_list">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                            </div>
                        </div>
                    </div>

                    @else


                    <div class="row">
                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">

                                @if($userProfile['SpouseImage'] == '')

                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/women_icon_profile.png') }}" alt="image">
                                </div>

                                @else

                                <div class="member_other-pro-img">
                                    <img class="img-fluid" src="data:image/png;base64,                          
                                    {{ $userProfile['SpouseImage'] }}" alt="" />

                                </div>

                                @endif


                                <h2>Spouse Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
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
                                    <p class="member_list_text"> Business</p>
                                    <p class="member_list_input"></p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $userProfile['SPOUSEMOBILENO'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif




                    <!-- <div class="row">

                        <div class="col-md-6">
                            <div class="member_probile_list">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                            </div>
                        </div>
                    </div> -->





                    <div class="row">
                        @foreach ($userProfile['children'] as $childrendetails)
                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">

                                @if($childrendetails['Image'] == '')

                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/child_icon_profile.png') }}" alt="image">
                                </div>

                                @else
                                <div class="member_other-pro-img">
                                    <img class="img-fluid" src="data:image/png;base64,                          
                                    {{ $childrendetails['Image'] }}" alt="" />

                                </div>

                                @endif





                                <h2>Children Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
                                    <p class="member_list_input">{{ $childrendetails['CHILDREN1_NAME']}}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $childrendetails['DOB']}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">

                                @if($childrendetails['PHONE1'] == '')

                                @else
                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $childrendetails['PHONE1']}}</p>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>




                </div>
            </section>
            <!-- ********|| HISTORY END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>