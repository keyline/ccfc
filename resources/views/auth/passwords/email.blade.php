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
            <section class="history-banner">
                <img class="img-fluid" src="{{ asset('img/history/history-banner.jpg') }}" alt="" />
            </section>
            <!-- ********|| BANNER PART END ||******** -->

            <!-- ********|| ADVISE START ||******** -->
            <section class="history-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title mb-3">
                                    Reset password
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="history-inner">

                                <!-- <div class="login-logo">
                                    <a href="{{ route('admin.home') }}">
                                        {{ trans('panel.site_title') }}
                                    </a>
                                </div> -->

                                <p>Please type your registered email id. We will send a password reset link to your mail
                                    id. If you do not remember your registered mail id, please contact Club
                                    Administrator.</p>
                                <div class="resetbox_section">
                                    <div class="card">
                                        <div class="card-body login-card-body">
                                            <!-- <p class="login-box-msg">
                                                {{ trans('global.reset_password') }}
                                            </p> -->

                                            @if(session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                            @endif

                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf

                                                <div>
                                                    <div class="form-group">

                                                        <input id="user_code" type="text"
                                                            class="form-control{{ $errors->has('usercode') ? ' is-invalid' : '' }}"
                                                            name="user_code" required autofocus placeholder="User Code"
                                                            value="{{ session()->get('user_code') }}" disabled>


                                                        <input id="user_code" type="hidden"
                                                            class="form-control{{ $errors->has('usercode') ? ' is-invalid' : '' }}"
                                                            name="user_code" required autofocus placeholder="User Code"
                                                            value="{{ session()->get('user_code') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="email" type="email"
                                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            name="email" required autocomplete="email" autofocus
                                                            placeholder="{{ trans('global.login_email') }}"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        @if($errors->has('email'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('email') }}
                                                        </span>
                                                        @endif
                                                        @if($errors->has('usercode'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('usercode') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-right">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-flat btn-block">
                                                            {{ trans('global.send_password') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <!-- ********|| ADVISE END ||******** -->



            @include('common.footer')
            <!-- ?php include 'assets/inc/footer.php';?> -->


            </body>

</html>






<!-- <div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('admin.home') }}">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ trans('global.reset_password') }}
            </p>

            @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <div class="form-group">
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required
                            autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                            value="{{ old('email') }}">

                        @if($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-flat btn-block">
                            {{ trans('global.send_password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->