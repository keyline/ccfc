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

                        <div class="item">

                            <div class="about-img">

                                <img class="img-fluid" src="{{ asset('img/past-president/banner2.jpg') }}" alt="" />

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
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    CHANGE PASSWORD
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                    </div>
                    @endif -->
                    <!-- @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                    </div>
                    @endif -->

                    <!-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif -->

                    <div class="row">


                        <div class="col-md-10 offset-2">
                            <div class="panel panel-default">
                                <!-- <h2>Change password</h2> -->

                                <div class="panel-body">
                                    <!-- @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif -->
                                    <!-- @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif -->
                                    @if($errors)
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('changePasswordPost') }}">
                                        {{ csrf_field() }}

                                        <div
                                            class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">Current
                                                Password</label>

                                            <div class="col-md-6">
                                                <input id="current-password" type="password" class="form-control"
                                                    name="current-password" required>

                                                @if ($errors->has('current-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">New
                                                Password</label>

                                            <div class="col-md-6">
                                                <input id="new-password" type="password" class="form-control"
                                                    name="new-password" required>

                                                @if ($errors->has('new-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New
                                                Password</label>

                                            <div class="col-md-6">
                                                <input id="new-password-confirm" type="password" class="form-control"
                                                    name="new-password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- 
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ trans('global.change_password') }}
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route("profile.password.update") }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="required" for="password">New
                                                            {{ trans('cruds.user.fields.password') }}</label>
                                                        <input
                                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                            type="password" name="password" id="password" required>
                                                        @if($errors->has('password'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="required" for="password_confirmation">Repeat New
                                                            {{ trans('cruds.user.fields.password') }}</label>
                                                        <input
                                                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                            type="password" name="password_confirmation"
                                                            id="password_confirmation" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger" type="submit">
                                                            {{ trans('global.save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
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