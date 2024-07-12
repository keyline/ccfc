<?php
use App\Models\GeneralSetting;
$generalSetting    = GeneralSetting::find(1);
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>><?=$generalSetting->site_name?></title>
  </head>
  <body style="padding: 0; margin: 0;">
    <div style="max-width: 1000px;margin: 0 auto;">
      <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
          <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600"><img src="https://www.ccfc1792.com/img/logo.png" alt=""></a>
          </div>
          <p style="font-size:1.1em">Hi,</p>
          <p>Thank you for choosing <?=$generalSetting->site_name?>. Use the following OTP to complete your Sign In procedures. OTP is valid for 2 minutes</p>
          <h2 style="background: #be1f24;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;"><?=$otp?></h2>
          <p style="font-size:0.9em;">Regards,<br />Thanks</p>
          <hr style="border:none;border-top:1px solid #eee" />
          <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>><?=$generalSetting->site_name?></p>
            <p><?=$generalSetting->site_address?></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>