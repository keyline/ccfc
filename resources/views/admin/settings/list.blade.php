@extends('layouts.admin')
@section('content')
@can('content_block_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <h3>Settings</h3>
    </div>
</div>
@endcan
@if (session('status'))
    <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
@if (session('error_message'))
    <h6 class="alert alert-danger">{{ session('error_message') }}</h6>
@endif
<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">SMS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Email</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="pills-seo-tab" data-toggle="pill" href="#pills-seo" role="tab" aria-controls="pills-seo" aria-selected="false">SEO</a>
            </li> -->
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <!-- general settings Form -->
                <form method="POST" action="{{ url('admin/create/general-settings') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="site_name" class="col-md-4 col-lg-3 col-form-label">Site Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="site_name" type="text" class="form-control" id="site_name" value="<?=$setting->site_name?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_phone" class="col-md-4 col-lg-3 col-form-label">Site Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="site_phone" type="text" class="form-control" id="site_phone" value="<?=$setting->site_phone?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_mail" class="col-md-4 col-lg-3 col-form-label">Site Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="site_mail" type="email" class="form-control" id="site_mail" value="<?=$setting->site_mail?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="system_email" class="col-md-4 col-lg-3 col-form-label">System Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="system_email" type="email" class="form-control" id="system_email" value="<?=$setting->system_email?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="account_email" class="col-md-4 col-lg-3 col-form-label">Accounts Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="account_email" type="email" class="form-control" id="account_email" value="<?=$setting->account_email?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_url" class="col-md-4 col-lg-3 col-form-label">Site URL</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="site_url" type="url" class="form-control" id="site_url" value="<?=$setting->site_url?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="site_address" class="form-control" id="site_address" rows="5"><?=$setting->site_address?></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="clubman_api_token" class="col-md-4 col-lg-3 col-form-label">Clubman Api Token</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="clubman_api_token" class="form-control" id="clubman_api_token" rows="5"><?=$setting->clubman_api_token?></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="item_reporting_time_in_hrs" class="col-md-4 col-lg-3 col-form-label">Item Reporting Time (In Hours)</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="item_reporting_time_in_hrs" type="text" class="form-control" id="item_reporting_time_in_hrs" value="<?=$setting->item_reporting_time_in_hrs?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_timings" class="col-md-4 col-lg-3 col-form-label">Club Timings</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="site_timings" class="form-control" id="site_timings" rows="5"><?=$setting->site_timings?></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="spa_booking_days" class="col-md-4 col-lg-3 col-form-label">Spa Booking Days</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="spa_booking_days" type="text" class="form-control" id="spa_booking_days" value="<?=$setting->spa_booking_days?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="spa_booking_timings" class="col-md-4 col-lg-3 col-form-label">Spa Booking Timings</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="spa_booking_timings" type="text" class="form-control" id="spa_booking_timings" value="<?=$setting->spa_booking_timings?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="spa_booking_phone" class="col-md-4 col-lg-3 col-form-label">Spa Booking Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="spa_booking_phone" type="text" class="form-control" id="spa_booking_phone" value="<?=$setting->spa_booking_phone?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="gym_booking_phone1" class="col-md-4 col-lg-3 col-form-label">Gym Booking Phone 1</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="gym_booking_phone1" type="text" class="form-control" id="gym_booking_phone1" value="<?=$setting->gym_booking_phone1?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="gym_booking_phone2" class="col-md-4 col-lg-3 col-form-label">Gym Booking Phone 2</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="gym_booking_phone2" type="text" class="form-control" id="gym_booking_phone2" value="<?=$setting->gym_booking_phone2?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="theme_color" class="col-md-4 col-lg-3 col-form-label">Theme Color</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="theme_color" type="color" class="form-control" id="theme_color" value="<?=$setting->theme_color?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="font_color" class="col-md-4 col-lg-3 col-form-label">Font Color</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="font_color" type="color" class="form-control" id="font_color" value="<?=$setting->font_color?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="twitter_profile" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter_profile" type="text" class="form-control" id="twitter_profile" value="<?=$setting->twitter_profile?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="facebook_profile" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook_profile" type="text" class="form-control" id="facebook_profile" value="<?=$setting->facebook_profile?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="instagram_profile" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram_profile" type="text" class="form-control" id="instagram_profile" value="<?=$setting->instagram_profile?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="linkedin_profile" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin_profile" type="text" class="form-control" id="linkedin_profile" value="<?=$setting->linkedin_profile?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="youtube_profile" class="col-md-4 col-lg-3 col-form-label">Youtube Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="youtube_profile" type="text" class="form-control" id="youtube_profile" value="<?=$setting->youtube_profile?>">
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
                      <label for="site_logo" class="col-md-4 col-lg-3 col-form-label">Logo</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="site_logo" class="form-control" id="site_logo">
                        <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                        <?php if($setting->site_logo != ''){?>
                          <img src="<?=env('UPLOADS_URL').$setting->site_logo?>" alt="<?=$setting->site_name?>">
                        <?php } else {?>
                          <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                        <?php }?>
                        
                        <div class="pt-2">
                          <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove Image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_footer_logo" class="col-md-4 col-lg-3 col-form-label">Footer Logo</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="site_footer_logo" class="form-control" id="site_footer_logo">
                        <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                        <?php if($setting->site_footer_logo != ''){?>
                          <img src="<?=env('UPLOADS_URL').$setting->site_footer_logo?>" alt="<?=$setting->site_name?>">
                        <?php } else {?>
                          <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                        <?php }?>
                        
                        <div class="pt-2">
                          <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove Image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="site_favicon" class="col-md-4 col-lg-3 col-form-label">Favicon</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="site_favicon" class="form-control" id="site_favicon">
                        <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                        <?php if($setting->site_favicon != ''){?>
                          <img src="<?=env('UPLOADS_URL').$setting->site_favicon?>" alt="<?=$setting->site_name?>">
                        <?php } else {?>
                          <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                        <?php }?>
                      </div>
                    </div> -->
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              <!-- End general settings Form -->
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <!-- sms settings Form -->
                <form method="POST" action="{{ url('admin/create/sms-settings') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="sms_authentication_key" class="col-md-4 col-lg-3 col-form-label">Authentication Key Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="sms_authentication_key" class="form-control" id="sms_authentication_key" value="<?=$setting->sms_authentication_key?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="sms_authentication_password" class="col-md-4 col-lg-3 col-form-label">Authentication Key Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="sms_authentication_password" class="form-control" id="sms_authentication_password" value="<?=$setting->sms_authentication_password?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="sms_sender_id" class="col-md-4 col-lg-3 col-form-label">Sender ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="sms_sender_id" class="form-control" id="sms_sender_id" value="<?=$setting->sms_sender_id?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="sms_base_url" class="col-md-4 col-lg-3 col-form-label">Base URL</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="sms_base_url" class="form-control" id="sms_base_url" value="<?=$setting->sms_base_url?>">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- End sms settings Form -->
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <!-- email settings Form -->
                <form method="POST" action="{{ url('admin/create/email-settings') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="from_email" class="col-md-4 col-lg-3 col-form-label">From Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="from_email" class="form-control" id="from_email" value="<?=$setting->from_email?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="from_name" class="col-md-4 col-lg-3 col-form-label">From Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="from_name" class="form-control" id="from_name" value="<?=$setting->from_name?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="smtp_host" class="col-md-4 col-lg-3 col-form-label">SMTP Host</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="smtp_host" class="form-control" id="smtp_host" value="<?=$setting->smtp_host?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="smtp_username" class="col-md-4 col-lg-3 col-form-label">SMTP Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="smtp_username" class="form-control" id="smtp_username" value="<?=$setting->smtp_username?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="smtp_password" class="col-md-4 col-lg-3 col-form-label">SMTP Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="smtp_password" class="form-control" id="smtp_password" value="<?=$setting->smtp_password?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="smtp_port" class="col-md-4 col-lg-3 col-form-label">SMTP Port</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="<?=$setting->smtp_port?>">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              <!-- End email settings Form -->
              <a class="btn btn-success btn-sm" href="<?=url('admin/create/sendtestemail')?>">Test Email</a>
              <a class="btn btn-success btn-sm" href="<?=url('admin/create/sendtestpushnotification')?>">Test Push Notification</a>
            </div>
            <div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">
                <!-- seo settings Form -->
                <form method="POST" action="{{ url('admin/create/seo-settings') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="meta_title" class="col-md-4 col-lg-3 col-form-label">Meta Title</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea type="text" name="meta_title" class="form-control" id="meta_title" rows="5"><?=$setting->meta_title?></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="meta_description" class="col-md-4 col-lg-3 col-form-label">Meta Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea type="text" name="meta_description" class="form-control" id="meta_description" rows="5"><?=$setting->meta_description?></textarea>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- End seo settings Form -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection
@section('scripts')

@endsection