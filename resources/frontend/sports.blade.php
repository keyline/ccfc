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

                        @foreach($galleries->where("id","30") as $key => $gallery)

                        @foreach($gallery->images as $key => $media)

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{$media->getUrl('')}}" alt="" />

                            </div>

                        </div>
                        @endforeach
                        @endforeach


                    </div>

                </div>

            </section>
            <!-- ********|| BANNER PART END ||******** -->

            <!-- ********|| Sports START ||******** -->
            <section class="sports-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Sports
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($contentPages->where("id","13") as $contentPage)
                            {!! $contentPage->page_text !!}
                            @endforeach
                            <!-- <div class="content_inner">
                                <p>
                                    In the city of Calcutta, then just over a hundred years old and growing fast both in
                                    commercial and political significance, the British Raj was busy setting its roots.
                                    And sports were definitely a part of the social lore.
                                </p>
                                <p>
                                    Indeed, sports events were reckoned to be important enough for sub-continental
                                    reporters. Fortunately, a copy of the Madras Courier dated 23rd. February, 1792 has
                                    survived. The paper reported cricket fixtures between the Calcutta Cricket Club and
                                    Barrackpore and the Calcutta Cricket Club and Dum Dum. Clearly, the Calcutta Cricket
                                    Club was already in existence in 1792.
                                </p>
                                <p>
                                    The story of how CC&FC traced its origins is interesting and is preserved in its
                                    archives thanks to Past President H.J. Moorhouse. It began in 1955 with a letter to
                                    The Times, London from Alan R. Tait, Honorary Secretary of Oporto Cricket Club in
                                    Portugal. The Club was celebrating its centenary that year, and Tait claimed that it
                                    'must be one of the oldest cricket club outside Great Britain'.
                                </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>

            <section class="sports_tabsection">
                <div class="container">
                    <div class="row">
                        <div class="sport-tablist">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <div class="sport_listing owl-carousel owl-theme">
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="cricket-tab" data-toggle="tab"
                                                href="#cricket">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/cricket_sport.svg') }}" alt="" />
                                                    <h3>Cricket</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="football-tab" data-toggle="tab" href="#football">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/football_sport.svg') }}" alt="" />
                                                    <h3>Football</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="hockey-tab" data-toggle="tab" href="#hockey">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/hockey_sport.svg') }}" alt="" />
                                                    <h3>Hockey</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="rugby-tab" data-toggle="tab" href="#rugby">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/rugby_sport.svg') }}" alt="" />
                                                    <h3>Rugby</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="tennis-tab" data-toggle="tab" href="#tennis">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/tennis_sports.svg') }}" alt="" />
                                                    <h3>Tennis</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="cyclepolo-tab" data-toggle="tab" href="#cyclepolo">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/cyclepolo_sport.svg') }}" alt="" />
                                                    <h3>Cycle Polo</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="darts-tab" data-toggle="tab" href="#darts">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/darts_sport.svg') }}" alt="" />
                                                    <h3>Darts</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="golf-tab" data-toggle="tab" href="#golf">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/golf_sport.svg') }}" alt="" />
                                                    <h3>Golf</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="tablerennis-tab" data-toggle="tab"
                                                href="#tablerennis">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/tablerennis_sport.svg') }}" alt="" />
                                                    <h3>Table Tennis</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="badminton-tab" data-toggle="tab" href="#badminton">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/badminton_sport.svg') }}" alt="" />
                                                    <h3>Badminton</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="squash-tab" data-toggle="tab" href="#squash">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/squash_sport.svg') }}" alt="" />
                                                    <h3>Squash</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="swimming-tab" data-toggle="tab" href="#swimming">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/swimming.svg') }}" alt="" />
                                                    <h3>Swimming</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="bridge-tab" data-toggle="tab" href="#bridge">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/Bridge.svg') }}" alt="" />
                                                    <h3>Bridge</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                    <div class="item">
                                        <li class="nav-item">
                                            <a class="nav-link" id="gym-tab" data-toggle="tab" href="#gym">
                                                <div class="tab_icontext">
                                                    <img src="{{ asset('img/sports/Gym.svg') }}" alt="" />
                                                    <h3>Gym</h3>
                                                </div>
                                            </a>
                                        </li>
                                    </div>
                                </div>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="cricket" role="tabpanel"
                                    aria-labelledby="indian-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">

                                            @foreach($members->where("select_sport_id","1")->orderBy('select_title_id', 'asc') as $member)

                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">

                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" />
                                                        </a> -->

                                                    </div>

                                                    @endif



                                                    <div class=" sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">

                                                            <h4>{{ $member->select_member->name ?? '' }}
                                                            </h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $userDetail->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach


                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="football" role="tabpanel" aria-labelledby="football-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","2")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="hockey" role="tabpanel" aria-labelledby="hockey-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","3")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->

                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach


                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="rugby" role="tabpanel" aria-labelledby="rugby-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","4")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tennis" role="tabpanel" aria-labelledby="tennis-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","5")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />
                                                        </a>

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="cyclepolo" role="tabpanel"
                                    aria-labelledby="cyclepolo-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","6")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />


                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="darts" role="tabpanel" aria-labelledby="darts-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","7")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->

                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="golf" role="tabpanel" aria-labelledby="golf-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","8")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />


                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tablerennis" role="tabpanel"
                                    aria-labelledby="tablerennis-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","9")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="badminton" role="tabpanel"
                                    aria-labelledby="badminton-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">
                                            @foreach($members->where("select_sport_id","10")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)
                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">
                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>
                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="squash" role="tabpanel" aria-labelledby="squash-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">

                                            @foreach($members->where("select_sport_id","11")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">

                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>

                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="swimming" role="tabpanel" aria-labelledby="swimming-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">

                                            @foreach($members->where("select_sport_id","12")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">

                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>

                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="bridge" role="tabpanel" aria-labelledby="bridge-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">

                                            @foreach($members->where("select_sport_id","13")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">

                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>

                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="gym" role="tabpanel" aria-labelledby="gym-tab">
                                    <div class="sport_tab_content_section">
                                        <div class="row">

                                            @foreach($members->where("select_sport_id","14")->orderBy('select_title_id', 'asc') as $member)
                                            @foreach($userDetails->where("user_code_id",$member->select_member->id) as
                                            $key =>$userDetail)

                                            <div class="col-sm-6 col-md-6 col-lg-3 px-2">
                                                <div class="sports_tabcontent_inner">

                                                    @if($userDetail['member_image'] == '')

                                                    <div class="sport_tab_ceibity-img">
                                                        <img src="{{ asset('img/demopic.png') }}" alt="" />
                                                    </div>

                                                    @else

                                                    <div class="sport_tab_ceibity-img">

                                                        <img class="img-fluid" src="data:image/png;base64,                          
                                                                {{ $userDetail['member_image'] }}" alt="" />

                                                        <!-- <img class="img-fluid"
                                                            src="{{ asset('uploads/userimg/'.$userDetail->member_image_2)}}"
                                                            alt="" /> -->
                                                        </a>
                                                    </div>

                                                    @endif
                                                    <div class="sport_player">
                                                        <h3>{{ $member->select_title->titles ?? '' }}</h3>
                                                        <div class="sport_player_detail">
                                                            <h4>{{ $member->select_member->name ?? '' }}</h4>

                                                            <!-- <p><a
                                                                    href="tel:+91 {{ $member->select_member->phone_number_1 ?? '' }}">+91
                                                                    {{ $member->select_member->phone_number_1 ?? '' }}</a>
                                                            </p>
                                                            <p><a
                                                                    href="mailto:{{ $member->select_member->email  ?? '' }}">{{ $member->select_member->email  ?? '' }}</a>
                                                            </p> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ********|| Sports END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->

            <script>
            // $(document).ready(function() {
            //     if ($(window).width() < 767) {
            //         startCarousel();
            //     } else {
            //         $('.owl-carousel').addClass('off');
            //     }
            // });

            $('.sport_listing').owlCarousel({
                loop: true,
                margin: 2,
                responsiveClass: true,
                autoplayHoverPause: true,
                autoplay: false,
                dots: false,
                nav: true,
                slideSpeed: 400,
                paginationSpeed: 400,
                autoplayTimeout: 3000,
                navText: ["<i class='zmdi zmdi-chevron-left'></i>", "<i class='zmdi zmdi-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 2,
                    },
                    480: {
                        items: 3,
                    },
                    600: {
                        items: 3,
                    },
                    950: {
                        items: 3,
                    },
                    1000: {
                        items: 6,
                    }
                }
            })

            $(document).ready(function() {
                var li = $(".owl-item li a");
                $(".owl-item li a").click(function() {
                    li.removeClass('active');
                });
            });



            // $(window).resize(function() {
            //     if ($(window).width() < 767) {
            //         startCarousel();
            //     } else {
            //         stopCarousel();
            //     }
            // });



            function stopCarousel() {
                var owl = $('.owl-carousel');
                //owl.trigger('destroy.owl.carousel');
                //owl.addClass('off');
            }
            </script>

            </body>

</html>