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
            
            <p>Date : <?=date('d-m-Y')?></p>

            <h2 style="color:#334155;font-size:30px; text-align: center;">Thank you for your Feedback</h2>

            <p><strong>Invoice #<?=$billdetails?></strong></p>

            <p style="margin:0; line-height: 1.25;">User:</p>
            <p style="margin:0;"><strong><?=$name?></strong> (<?=$email?>) (<?=$user_code?>)</p>

            <p style="margin-bottom:0; line-height: 1.25;">Bill Date:</p>
            <p style="margin:0;"><strong><?=date_format(date_create($bill_date), "d M Y")?></strong></p>

            <p style="margin-bottom:0; line-height: 1.25;">Item Name:</p>
            <p style="margin:0;"><strong><?=$itemdesc?></strong></p>

            <p style="margin-bottom:0; line-height: 1.25;">Qty:</p>
            <p style="margin:0;"><strong><?=$qty?> Pcs</strong></p>

            <p style="margin-bottom:0; line-height: 1.25;"><strong>Feedback :</strong></p>
            <p style="line-height: 1.25;"><?=$comments?></p>
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