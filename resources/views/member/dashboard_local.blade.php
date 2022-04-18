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

            @foreach($userProfile as $data)
            @foreach($data->userCodeUserDetails as $details)
            <!-- ********|| HISTORY START ||******** -->
            <section class="inner_belowbanner memberbelowinfo_section">
                <div class="container">
                    <div class="row">
                        <div class="dashboard_picname_section">
                            <div class="dashboardpic_items">

                                @if($details['member_image'] == '')


                                <div class="member_profileimg">
                                    <img class="img-fluid ifnotpic" src="{{ asset('img/Profile-Icon-01.svg') }}"
                                        alt="" />
                                </div>


                                @else

                                <div class="member_profileimg">
                                    <img class="img-fluid" src="         
                                    data:image/png;base64,                          
                                        {{ $details->member_image}}" alt="" />

                                </div>
                                @endif

                            </div>


                            <div class="dashboardpic_itemsinfo">
                                <div class="member_profiletop">
                                    <h4>Welcome</h4>

                                    <h2>{{ $data->name}}</h2>
                                    <p><strong>Ph No:</strong>
                                        {{ $details->mobile_no}}
                                    </p>
                                    <p><strong>Mail ID:</strong> {{ $data->email }}</p>
                                </div>
                            </div>
                        </div>


                        {{-- <hr class="divider_red"> --}}

                        <div class="dashboard_resetbtn">
                            <a href="{{route('change_password')}}">Reset Password</a>
                        </div>
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
                                    <p class="member_list_input">{{ $details->member_type}}</p>
                                </div>



                                <div class="member_profile_item">
                                    <p class="member_list_text">Member Code</p>
                                    <p class="member_list_input">{{ $data->user_code }}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $details->date_of_birth}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Member since</p>
                                    <p class="member_list_input">{{ $details->member_since}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Sex</p>
                                    <p class="member_list_input">{{ $details->sex}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone I</p>
                                    <p class="member_list_input">{{ $details->phone_1}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone II</p>
                                    <p class="member_list_input">{{ $details->phone_2}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone III</p>
                                    <p class="member_list_input">{{ $details->mobile_no}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text">Communication Address</p>
                                    <p class="member_list_input addressline">

                                        {{ $details->address_1}},{{ $details->address_2}},{{ $details->address_3}}
                                    </p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">City</p>
                                    <p class="member_list_input">{{ $details->city}}</p>
                                </div>



                                <div class="member_profile_item">
                                    <p class="member_list_text">State</p>
                                    <p class="member_list_input">{{ $details->state}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Pincode</p>
                                    <p class="member_list_input">{{ $details->pin}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Email</p>
                                    <p class="member_list_input">{{ $data->email}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Curent status</p>
                                    <p class="member_list_input">{{ $details->current_status}}</p>
                                </div>

                            </div>
                        </div>
                    </div>


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


                    @if($details['spouse_name'] == '')

                    @else

                    <div class="row">
                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">

                                @if($details['spouse_image'] == '')

                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/women_icon_profile.png') }}" alt="image">
                                </div>

                                @else

                                <div class="member_other-pro-img">
                                    <img class="img-fluid" src="data:image/png;base64,                          
                                    {{ $details['spouse_image'] }}" alt="" />

                                </div>

                                @endif




                                <h2>Spouse Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
                                    <p class="member_list_input">{{ $details->spouse_name}}</p>
                                </div>


                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $details->spouse_dob}}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">

                                <div class="member_profile_item">
                                    <p class="member_list_text"> Business</p>
                                    <p class="member_list_input">{{ $details->spouse_business_profession}}</p>
                                </div>

                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $details->spouse_mobile_no}}</p>
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




                    @if($details['children1_name'] == '')

                    @else
                    <div class="row">

                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">



                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/child_icon_profile.png') }}" alt="image">
                                </div>


                                <!-- <div class="member_other-pro-img">
                                        <img class="img-fluid" src="                          
                                    " alt="" />

                                    </div> -->







                                <h2>Children Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
                                    <p class="member_list_input">{{ $details->children1_name}}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $details->children1_dob}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $details->children1_phone1}}</p>
                                </div>

                            </div>
                        </div>





                    </div>

                    @endif

                    @if($details['children2_name'] == '')

                    @else

                    <div class="row">

                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">



                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/child_icon_profile.png') }}" alt="image">
                                </div>


                                <!-- <div class="member_other-pro-img">
                                        <img class="img-fluid" src="                          
                                    " alt="" />

                                    </div> -->







                                <h2>Children Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
                                    <p class="member_list_input">{{ $details->children2_name}}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $details->children2_dob}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $details->children2_phone1}}</p>
                                </div>

                            </div>
                        </div>





                    </div>

                    @endif

                    @if($details['children3_name'] == '')

                    @else

                    <div class="row">

                        <div class="col-md-12">
                            <div class="member_titlebg profil_oth_img">



                                <div class="member_other-pro-img">
                                    <img src="{{ asset('img/child_icon_profile.png') }}" alt="image">
                                </div>


                                <!-- <div class="member_other-pro-img">
                                        <img class="img-fluid" src="                          
                                    " alt="" />

                                    </div> -->







                                <h2>Children Details</h2>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="member_probile_list">
                                <div class="member_profile_item">
                                    <p class="member_list_text"> Name</p>
                                    <p class="member_list_input">{{ $details->children3_name}}</p>
                                </div>
                                <div class="member_profile_item">
                                    <p class="member_list_text">Date of Birth</p>
                                    <p class="member_list_input">{{ $details->children3_dob}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="member_probile_list">


                                <div class="member_profile_item">
                                    <p class="member_list_text">Phone </p>
                                    <p class="member_list_input">{{ $details->children3_phone1}}</p>
                                </div>

                            </div>
                        </div>





                    </div>
                    @endif





                </div>


            </section>
            <!-- ********|| HISTORY END ||******** -->
            @endforeach
            @endforeach



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>