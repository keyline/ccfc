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
                        @foreach($galleries->where("id","20") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)
                        <div class="item">

                            <div class="about-img">

                                <!-- <img class="img-fluid" src="{{ asset('img/past-president/banner1.jpg') }}" alt="" /> -->
                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />
                            </div>

                        </div>
                        @endforeach
                        @endforeach
                        <!-- <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

                            </div>

                        </div> -->

                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->



            <!-- ********|| SUB COMMITTEES START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Sub-Committee
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($contentPages->where("id","8") as $contentPage)
                            <!-- <div class="content_inner">
                                <p>In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.</p>
                                <p>The club also offers food from its different counters like charcoal-grilled kebabs,
                                    quick bites of wraps, burgers, pastas etc. There is also a pastry shop and
                                    specialized tea & coffee counters serving wide varieties of tea and coffee.</p>
                            </div> -->
                            {!! $contentPage->page_text !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="subcomminttees_tabsection">
                <div class="container">
                    <div class="row">
                        <div class="subcomminttees-tablist">
                            <ul class="nav nav-tabs form-tabs hideonmobile" role="tablist">

                                <!-- @foreach($committeeNames as
                                $committee)
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab"
                                        href="{{ $committee->committee_name_master ?? '' }}">
                                        <div class="tab_icontext">
                                            <h3>{{ $committee->committee_name_master ?? '' }}</h3>
                                        </div>
                                    </a>
                                </li>
                                @endforeach -->
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#entertainment-communications">
                                        <div class="tab_icontext">
                                            <h3>ENTERTAINMENT / COMUNICATIONS & WEBSITE</h3>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#catering">
                                        <div class="tab_icontext">
                                            <h3>CATERING</h3>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#staff-member-relations">
                                        <div class="tab_icontext">
                                            <h3>STAFF & MEMBER RELATIONS</h3>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#membership">
                                        <div class="tab_icontext">
                                            <h3>MEMBERSHIP</h3>
                                        </div>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ccfc-women-wing">
                                        <div class="tab_icontext">
                                            <h3>The Cc&fc Women's Wing</h3>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ccfc-kid-club">
                                        <div class="tab_icontext">
                                            <h3>The Cc&fc Kids Club</h3>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#children">
                                        <div class="tab_icontext">
                                            <h3>Childrens Broadway Musical</h3>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#sports-Co-ordinator">
                                        <div class="tab_icontext">
                                            <h3>Sports Co-ordinator</h3>
                                        </div>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#sponsorships">
                                        <div class="tab_icontext">
                                            <h3>Sponsorship</h3>
                                        </div>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#finance">
                                        <div class="tab_icontext">
                                            <h3>Finance</h3>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <select class="mb10 form-control hideondesktop" id="tab_selector">
                                <option value="0">ENTERTAINMENT / COMUNICATIONS & WEBSITE</option>
                                <option value="1">CATERING</option>
                                <option value="2">STAFF & MEMBER RELATIONS</option>
                                <option value="3">MEMBERSHIP</option>
                                <option value="4">Finance</option>

                                <!-- <option value="5">The Cc&fc Kids Club</option>
                                <option value="6">Childrens Broadway Musical</option>
                                <option value="7">Sports Co-ordinator</option>
                                <option value="8">Sponsorship</option>
                                <option value="9">Finance</option> -->

                            </select>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="entertainment-communications"
                                    role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","3") as
                                            $committeeMember)

                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">



                                                        <h3>{{ $committeeMember->member->name }}</h3>




                                                        <h4>{{ $committeeMember->designation ?? '' }}</h4>

                                                    </div>



                                                </div>
                                            </div>







                                            @endforeach
                                            @endforeach

                                            @foreach($userDetails->where("id","163")
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">



                                                        <h3>{{ $userDetail->spouse_name }}</h3>






                                                    </div>



                                                </div>
                                            </div>

                                            @endforeach

                                            @foreach($userDetails->where("id","166")
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">



                                                        <h3>BHAVNA JHINGAN</h3>






                                                    </div>



                                                </div>
                                            </div>

                                            @endforeach

                                            @foreach($userDetails->where("id","164")
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">



                                                        <h3>{{ $userDetail->spouse_name }}</h3>






                                                    </div>



                                                </div>
                                            </div>

                                            @endforeach


                                            @foreach($userDetails->where("id","165")
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">



                                                        <h3>DITIYA ROY CHOWDHRY</h3>






                                                    </div>



                                                </div>
                                            </div>

                                            @endforeach



                                            @foreach($userDetails->where("id","162")
                                            as $userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">

                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">
                                                            <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                        </a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">




                                                        <h3>SNEHA KARIWALA</h3>






                                                    </div>



                                                </div>
                                            </div>

                                            @endforeach








                                            <!-- <div class=" col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                            <div class="multiuse_tabcontent_inner">
                                                                <div class="multiuse_tab_ceibity-img">
                                                                    <a href="#" data-toggle="modal"
                                                                        data-target="#year1992_1"><img
                                                                            src="{{ asset('img/demopic.png') }}"
                                                                            alt="" /></a>
                                                                </div>
                                                                <div class="multiuse_bottom_general">
                                                                    <h3>Suhel Niyogi</h3>
                                                                    <h4>MEMBER</h4>
                                                                </div>
                                                            </div>
                                                    </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_general">
                                                        <h3>Ayushi Agarwal</h3>
                                                        <h4>MEMBER</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_general">
                                                        <h3>Davina Thacker</h3>
                                                        <h4>MEMBER</h4>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    <div class="multiuse_bottom_general">
                                                        <h3>Rajarshi Chakraborty</h3>
                                                        <h4>MEMBER</h4>
                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="catering" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">
                                            @foreach($subCommitteeMembers->where("comittee_name_id","4") as
                                            $committeeMember)



                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    @else
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            <!-- <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" /> -->


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}</h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}</h4>
                                                    </div>
                                                </div>
                                            </div>


                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class=" tab-pane fade" id="staff-member-relations" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","5")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)




                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    @else
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">



                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />

                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>

                                                </div>
                                            </div>

                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="membership" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","6")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">



                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="finance" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","7")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="tab-pane fade" id="ccfc-kid-club" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","8")
                                            as
                                            $committeeMember)

                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>

                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach

                                            @endforeach

                                        </div>
                                    </div>
                                </div> -->


                                <!-- <div class="tab-pane fade" id="children" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","9")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>
                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">


                                                           


                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    @endif


                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div> -->



                                <!-- <div class="tab-pane fade" id="sports-Co-ordinator" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","10")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else
                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            

                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div> -->



                                <!-- <div class="tab-pane fade" id="sponsorships" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","11")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            

                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>

                                                    @endif



                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div> -->



                                <!-- <div class="tab-pane fade" id="finance" role="tabpanel">
                                    <div class="multiuse_tab_content_section">
                                        <div class="row">

                                            @foreach($subCommitteeMembers->where("comittee_name_id","12")
                                            as
                                            $committeeMember)
                                            @foreach($userDetails->where("user_code_id",$committeeMember->member->id)
                                            as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2 mb-3">
                                                <div class="multiuse_tabcontent_inner">

                                                    @if($userDetail['member_image_2'] == '')

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1"><img
                                                                src="{{ asset('img/demopic.png') }}" alt="" /></a>
                                                    </div>

                                                    @else

                                                    <div class="multiuse_tab_ceibity-img">
                                                        <a href="#" data-toggle="modal" data-target="#year1992_1">

                                                            

                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                                alt="" />
                                                        </a>
                                                    </div>

                                                    @endif

                                                    <div class="multiuse_bottom_general">
                                                        <h3>{{ $committeeMember->member->name ?? '' }}
                                                        </h3>
                                                        <h4>{{ $committeeMember->designation ?? '' }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div> -->



                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ********|| SUB COMMITTEES END ||******** -->




            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->

            <script>
            $(document).ready(function() {
                $('#tab_selector').on('change', function(e) {
                    $('.form-tabs li a').eq($(this).val()).tab('show');
                });
            });
            </script>


            </body>

</html>