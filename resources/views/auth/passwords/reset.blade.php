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
                                <p>Please type your registered email id and new password.</p>
                                <div class="login-logo">
                                    <div class="login-logo">

                                    </div>
                                </div>
                                <div class="resetbox_section">
                                    <div class="card">
                                        <div class="card-body login-card-body">
                                            <p class="login-box-msg">
                                                <!-- {{ trans('global.reset_password') }} -->
                                            </p>

                                            <form method="POST" action="{{ route('password.request') }}">
                                                @csrf

                                                <input name="token" value="{{ $token }}" type="hidden">

                                                <div>
                                                    <div class="form-group">

                                                        <input id="user_code" type="text" class="form-control"
                                                            name="user_code" value="{{ $user_code}}"
                                                            autocomplete="User Code" autofocus placeholder="User Code"
                                                            disabled>

                                                        <input id="user_code" type="hidden"
                                                            class="form-control{{ $errors->has('user_code') ? ' is-invalid' : '' }}"
                                                            name="user_code"
                                                            value="{{ $user_code ?? old('user_code') }}" required
                                                            autocomplete="User Code" autofocus placeholder="User Code">

                                                        @if($errors->has('user_code'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('user_code') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="email" type="email"
                                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            name="email" value="{{ $email ?? old('email') }}" required
                                                            autocomplete="email" autofocus
                                                            placeholder="{{ trans('global.login_email') }}">

                                                        @if($errors->has('email'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('email') }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- <input id="password" type="password"
                                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            name="password" required
                                                            placeholder="{{ trans('global.login_password') }}"> -->


                                                        <input id="password" type="password" class="form-control"
                                                            name="password" required
                                                            placeholder="{{ trans('global.login_password') }}">

                                                        <!-- @if($errors->has('password'))
                                                        <span class="text-danger">
                                                            {{ $errors->first('password') }}
                                                        </span>
                                                        @endif -->
                                                    </div>
                                                    <div class="form-group">
                                                        <input id="password-confirm" type="password"
                                                            class="form-control" name="password_confirmation" required
                                                            placeholder="{{ trans('global.login_password_confirmation') }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-flat btn-block">
                                                            {{ trans('global.reset_password') }}
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
                {{ trans('panel.site_title1') }}

            </a>
        </div>
    </div> -->
<!-- <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ trans('global.reset_password') }}
            </p>

            <form method="POST" action="{{ route('password.request') }}">
                @csrf

                <input name="token" value="{{ $token }}" type="hidden">

                <div>
                    <div class="form-group">
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            placeholder="{{ trans('global.login_email') }}">

                        @if($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-flat btn-block">
                            {{ trans('global.reset_password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
<!-- </div> -->