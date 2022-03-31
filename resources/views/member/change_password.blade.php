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



                    <div class="row">


                        <div class="col-md-10 offset-2">
                            <div class="panel panel-default">

                                <div class="panel-body">

                                    @if($errors)
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">

                                        <!-- {{ $error }} -->

                                        The confirm password and new password does not match.

                                    </div>
                                    @endforeach
                                    @endif

                                    <form action="{{ route('update_password') }}" id="change_password_form"
                                        method="post">

                                        @csrf

                                        <div class="form-group">
                                            <label for="old_password">Old Password</label>

                                            <input type="password" name="old_password" class="form-control"
                                                id="old_password" required>

                                            @if ($errors->any('old_password'))
                                            <span class="text-danger">
                                                {{ $errors->first('old_password') }}
                                            </span>
                                            @endif

                                        </div>

                                        <div class="form-group">
                                            <label for="password">New Password</label>

                                            <input type="password" name="new_password" class="form-control"
                                                id="new_password" required>



                                        </div>

                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>

                                            <input type="password" name="confirm_password" class="form-control"
                                                id="confirm_password" required>

                                            <!-- @if ($errors->any('confirm_password'))
                                            <span class="text-danger">
                                                 {{ $errors->first('confirm_password') }}

                                            The confirm password and new password does not match.
                                            </span>
                                            @endif -->

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