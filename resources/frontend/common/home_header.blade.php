    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>CCFC</title>

    <style>
:root {
    --primaryColor: #be1f24;
    --secondaryColor: #c23233;
    --trirdColor: #000;
    --textColor: #2f2f2f;
}
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">

    <!------------GOOGLE FONT------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!------------ZMDI ICON------------>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!------------OWL------------>
    <link rel="stylesheet" href="{{ asset('owl/owl3.css') }}">
    <!------------FANCYBOX------------>
    <link href="{{ asset('fancybox/jquery.fancybox.min.css') }}" rel="stylesheet" type="text/css">

    </head>

    <body>
        <!-- ********|| BODY PART START ||******** -->
        <section class="ccfc-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- ********|| LEFT PART START ||******** -->

                            <div class="col-lg-3 col-md-5 p-0 siteleft_panel" id="sidebar">
                                <header class="header">
                                    <div class="top-header">
                                        <div class="brand">
                                            <div class="brand_logo">
                                                <a href="{{ asset('/') }}" class="logo">
                                                    <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt=""
                                                        title="Home">
                                                </a>
                                            </div>
                                            <div class="mobile_menu">
                                                <span style="font-size:30px;cursor:pointer"
                                                    onclick="openNav()">&#9776;</span>
                                            </div>
                                        </div>

                                        <button class="btn collapsemember-button hideondesktop" type="button" data-toggle="collapse" data-target="#collapsemember-login" aria-expanded="false">
                                            Member Login
                                        </button>
                                        <!-- Logic for logged in or not   -->
                                        @if(session()->has('LoggedMember'))
                                        @include('common.header_afterlogin')
                                        @else
                                        @include('common.header_beforelogin')
                                        @endif
                                    </div>
                                    <div class="topPanel" id="topmenupanel">
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                        <div class="nav-inner">
                                            <div class="nav-info">
                                                <nav class="navbar navbar-light">
                                                    <ul class="navbar-nav text-uppercase h-md-100">
                                                        <li class="nav-item"><a class="nav-link"
                                                                href="{{ asset('/') }}">Home</a></li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0)">
                                                                About us <span class="submenu_arrow"><i
                                                                        class="zmdi zmdi-chevron-right"></i></span>
                                                            </a>
                                                            <ul class="submenu dropdown-menu">
                                                                <li><a href="{{ asset('history') }}">History</a></li>
                                                                <li><a href="{{ asset('past-president') }}">Past Presidents</a></li>
                                                                <li><a href="{{ asset('trophies') }}">Trophies</a></li>
                                                                <li><a href="{{ asset('famous_sportsmen') }}">Famous Sportsmen</a></li>
                                                                <li><a href="{{ asset('reciprocal_clubs') }}">Reciprocal Clubs</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0)"> MANAGEMENT <span class="submenu_arrow">
                                                                <i class="zmdi zmdi-chevron-right"></i></span>
                                                            </a>
                                                            <ul class="submenu dropdown-menu">
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="javascript:void(0)">
                                                                        Committees <span class="submenu_arrow"><i
                                                                                class="zmdi zmdi-chevron-right"></i></span>
                                                                    </a>
                                                                    <ul class="submenu dropdown-menu">
                                                                        <li><a href="{{ asset('general_committee') }}">General Committee</a></li>
                                                                        <li><a href="{{ asset('balloting_committee') }}">Balloting Committee</a></li>
                                                                        <li><a href="{{ asset('sub_committees') }}">Sub-Committees</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="{{ asset('president_corner') }}">President's Corner</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="{{ asset('annual_report') }}">Annual report </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0)">
                                                                ACTIVITIES <span class="submenu_arrow"><i
                                                                        class="zmdi zmdi-chevron-right"></i></span>
                                                            </a>
                                                            <!-- <ul class="submenu dropdown-menu">
                                                                <li><a class="nav-link"
                                                                        href="{{ asset('food_beverages') }}">Amenities &
                                                                        Services</a></li>
                                                                <li><a class="nav-link"
                                                                        href="{{ asset('sports') }}">Sports</a></li>
                                                            </ul> -->

                                                            <ul class="submenu dropdown-menu">
                                                                <li><a class="nav-link" href="{{ asset('amenities_services') }}">Amenities & Services</a></li>
                                                                <li><a class="nav-link"  href="{{ asset('sports') }}">Sports</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0)">
                                                                Members area <span class="submenu_arrow"><i
                                                                        class="zmdi zmdi-chevron-right"></i></span>
                                                            </a>
                                                            <ul class="submenu dropdown-menu">
                                                                <li><a class="nav-link"href="{{ route('member.dashboard') }}">Member  dashboard</a></li>
                                                                <li><a class="nav-link" href="{{ route('member.events_members_only') }}">Events</a></li>
                                                                <li><a class="nav-link"href="#/">News</a>
                                                                    <ul class="submenu dropdown-menu">
                                                                        <li><a href="{{ route('member.1792-newsletter') }}">1792</a></li>
                                                                        <li><a href="{{ route('member.notice-circulars') }}">Notice & Circulars</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li><a class="nav-link" href="{{ route('member.rules_regulation') }}">Rules & Regulations</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ asset('gallery') }}">Gallery</a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{ asset('contact-us') }}">Contact Us</a>
                                                        </li>
                                                    </ul>

                                                    <!--                                                    </div>-->
                                                </nav>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="ccfc-location">
                                        <!--<div class="ccfc-location-inner">
                                        <ul>
                                            <li>
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                                <a href="#" class="ccfc-icon">033 24615060</a>
                                                <span>/</span>
                                                <a href="#" class="ccfc-icon">24615059</a>
                                            </li>
                                            <li>
                                                <i class="zmdi zmdi-email mail"></i>
                                                <a href="#" class="ccfc-icon">ccfcsecretary@ccfc1792.com</a>
                                            </li>
                                        </ul>
                                    </div>-->
                                        <!--<div class="ccfc-social">
                                        <ul>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-pinterest"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-linkedin"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="social-icon">
                                                    <i class="zmdi zmdi-youtube-play"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>-->
                                        <!--<div class="copy-part">
                                        <div class="copy-title">
                                            Copyright © 2022 The CC&FC Club at Kolkata All Rights Reserved.
                                        </div>
                                        <div class="copy-content">
                                            Design & Developed by<a href="#" class="keyline"> KEYLINE</a>
                                        </div>
                                    </div>-->
                                    </div>
                                </header>
                            </div>
                            <!-- ********|| LEFT PART END ||******** -->