<?php
use App\Models\GeneralSetting;
$generalSetting    = GeneralSetting::find(1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$generalSetting->site_name?></title>
</head>
<body style="padding: 0; margin: 0;">
  <div style="max-width: 1000px;margin: 0 auto;">
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
      <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
          <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600"><img src="https://www.ccfc1792.com/img/logo.png" alt=""></a>
        </div>
        <p style="font-size:1.1em; margin-bottom: 0px;">Hi,</p>
        <p style="margin-top: 0px;"><?=$member_name?> (<?=$member_code?>) requests profile update </p>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="#" style="color: #000000; text-decoration: none;">Department :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"></td> 
            </tr>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="#" style="color: #000000; text-decoration: none;">Name :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"></td> 
            </tr>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="#" style="color: #000000; text-decoration: none;">Email :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"></td> 
            </tr>
            <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="#" style="color: #000000; text-decoration: none;">Phone :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="#" style="color: #000000; text-decoration: none;">Comment :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"></td> 
            </tr>
        </table>
        <p style="font-size:0.9em;">Regards,<br />Thanks</p>
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
          <p><?=$generalSetting->site_name?></p>
          <p><?=$generalSetting->site_address?></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>