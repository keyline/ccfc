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
            <!-- ********|| ACTIVITIES START ||******** -->
            <section class="inner_belowbanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title-sec">
                                <div class="title text-left">
                                    Delete Account Form
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="" style="border: 1px solid #48974e73;padding: 15px;border-radius: 5px;">
                                @csrf
                                <?php if(session('success_message')){?>
                                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show hide-message" role="alert">
                                        <?=session('success_message')?>
                                    </div>
                                <?php }?>
                                <?php if(session('error_message')){?>
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show hide-message" role="alert">
                                        <?=session('error_message')?>
                                    </div>
                                <?php }?>
                                <input type="hidden" name="user_type" id="user_type" value="user">
                                <input type="hidden" name="is_email_verify" id="is_email_verify" value="1">
                                <input type="hidden" name="is_phone_verify" id="is_phone_verify" value="1">
                                <div class="form-group mb-3">
                                    <div class="row align-items-end">
                                        <div class="col-md-12">
                                            <label for="entity_name" class="fw-bold">Entity Name</label>
                                            <input type="text" class="form-control" id="entity_name" name="entity_name" placeholder="Entity Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-end">
                                        <div class="col-md-12">
                                            <label for="email" class="fw-bold">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row align-items-end">
                                        <div class="col-md-12">
                                            <label for="phone" class="fw-bold">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="comments" class="fw-bold">Comments</label>
                                    <textarea class="form-control" id="comments" name="comments" placeholder="Comments" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-success" id="submit-btn"><i class="fa fa-paper-plane"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ********|| ACTIVITIES END ||******** -->
            @include('common.footer')
            </body>
</html>