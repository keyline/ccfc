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
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Name :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_name?></td> 
            </tr>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Email :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_email?></td> 
            </tr>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Phone 1 :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_phone1?></td> 
            </tr>
            <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Phone 2 :</a></td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_phone2?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Phone 3 :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_phone3?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member DOB :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_dob?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Since :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_since?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Sex :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_sex?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Address :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_address?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member City :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_city?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member State :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_state?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Pincode :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_pin?></td> 
            </tr>
            <?php if($member_dob_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member DOB Proof :</a></td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $member_dob_proof)?>" style="color: #000000; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>
            <?php if($member_address_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Member Address Proof :</a></td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $member_address_proof)?>" style="color: #000000; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>

            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Name :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_name?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Email :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_email?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Phone 1 :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone1?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Phone 2 :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone2?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Phone 3 :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone3?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse DOB :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_dob?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Sex :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_sex?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse Profession :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_profession?></td> 
            </tr>
            <?php if($spouse_dob_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Spouse DOB Proof :</a></td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $spouse_dob_proof)?>" style="color: #000000; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>

            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 1 Name :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_name?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 1 Phone :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_phone1?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 1 DOB :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_dob?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 1 Sex :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_sex?></td> 
            </tr>

            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 2 Name :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_name?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 2 Phone :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_phone1?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 2 DOB :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_dob?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 2 Sex :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_sex?></td> 
            </tr>

            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 3 Name :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_name?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 3 Phone :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_phone1?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 3 DOB :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_dob?></td> 
            </tr>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><a href="javascript:void(0);" style="color: #000000; text-decoration: none;">Children 3 Sex :</a></td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_sex?></td> 
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