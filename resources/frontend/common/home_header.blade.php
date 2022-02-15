    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!------------ZMDI ICON------------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
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

                        <div class="col-lg-3 col-md-3 p-0">
                            <header class="header">
                                <div class="top-header">
                                    <div class="brand">
                                        <a href="{{ asset('dev/ccfc-html/') }}" class="logo">
                                            <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="" title="Home">
                                        </a>
                                    </div>
                                    <div class="member-login">
                                        <div class="member-title">
                                            Member Login
                                        </div>
                                        <!-- <form> -->
                                        <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                            <div class="form-group">
                                                <!-- <input type="text" class="form-control" placeholder="User Name" autocomplete="off"> -->
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                                                <!-- <input type="password" class="form-control" placeholder="Password" readonly onfocus="this.removeAttribute('readonly')" onblur="this.setAttribute('readonly')"> -->
                                                <!--<input type="password" readonly onfocus="this.removeAttribute('readonly')" onblur="this.setAttribute('readonly')">-->
                                                @if($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                <button type="submit" class="login-btn">login
                                                <!-- {{ __('Log in') }} -->
                                                </button>
                                                    <!-- <button type="submit" class="login-btn">login</button> -->
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <a href="#" class="forgot">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="topPanel">

                                    <div class="nav-inner">
                                        <div class="nav-info">
                                            <nav class="navbar navbar-light">
                                                <!--
                                                    <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                    </button>
-->

                                                <!--                                                    <div class="collapse navbar-collapse h-md-100" id="navbarSupportedContent">-->
                                                <ul class="navbar-nav text-uppercase h-md-100" id="nav">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="https://keylines.net.in/dev/ccfc-html/">Home</a>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            about us
                                                        </a>
                                                        <ul class="dropdown-menu arrow-dropdown" aria-labelledby="seviceDropdownLink">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">1</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            MANAGEMENT
                                                        </a>
                                                        <ul class="dropdown-menu arrow-dropdown" aria-labelledby="seviceDropdownLink">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">1</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            ACTIVITIES
                                                        </a>
                                                        <ul class="dropdown-menu arrow-dropdown" aria-labelledby="seviceDropdownLink">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">1</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Members area
                                                        </a>
                                                        <ul class="dropdown-menu arrow-dropdown" aria-labelledby="seviceDropdownLink">
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">1</a>
                                                            </li>
                                                            <li class="dropdown-submenu">
                                                                <a class="dropdown-item" href="#">2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="javascript:void(0)">Gallery</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" href="javascript:void(0)">Contact Us</a>
                                                    </li>
                                                </ul>

                                                <!--                                                    </div>-->
                                            </nav>

                                        </div>
                                    </div>
                                </div>
                                <div class="ccfc-location">
                                    <div class="ccfc-location-inner">
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
                                    </div>
                                    <div class="ccfc-social">
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
                                    </div>
                                    <div class="copy-part">
                                        <div class="copy-title">
                                            Copyright © 2022 The CC&FC Club at Kolkata All Rights Reserved.
                                        </div>
                                        <div class="copy-content">
                                            Design & Developed by<a href="#" class="keyline"> KEYLINE</a>
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </div>
                        <!-- ********|| LEFT PART END ||******** -->
      
      
      
      
      