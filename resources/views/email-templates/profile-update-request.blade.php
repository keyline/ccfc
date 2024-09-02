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
            <?php if($member_name != ''){?>
                <tr>
                    <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Name :</td>
                    <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_name?></td> 
                </tr>
            <?php }?>
            <?php if($member_email != ''){?>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Email :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_email?></td> 
            </tr>
            <?php }?>

            <?php if($member_phone1 != ''){?>
             <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Phone 1 :</td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;"><?=$member_phone1?></td> 
            </tr>
            <?php }?>

            <?php if($member_phone2 != ''){?>
            <tr>
                <td valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Phone 2 :</td>
                <td valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_phone2?></td> 
            </tr>
            <?php }?>

            <?php if($member_phone3 != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Phone 3 :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_phone3?></td> 
            </tr>
            <?php }?>

            <?php if($member_dob != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member DOB :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_dob?></td> 
            </tr>
            <?php }?>

            <?php if($member_since != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Since :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_since?></td> 
            </tr>
            <?php }?>

            <?php if($member_sex != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Sex :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_sex?></td> 
            </tr>
            <?php }?>

            <?php if($member_address != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Address :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_address?></td> 
            </tr>
            <?php }?>

            <?php if($member_city != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member City :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_city?></td> 
            </tr>
            <?php }?>

            <?php if($member_state != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member State :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_state?></td> 
            </tr>
            <?php }?>

            <?php if($member_pin != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Pincode :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$member_pin?></td> 
            </tr>
            <?php }?>

            <?php if($member_dob_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member DOB Proof :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $member_dob_proof)?>" style="color: #c23233; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>
            <?php if($member_address_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Member Address Proof :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $member_address_proof)?>" style="color: #c23233; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>

            <?php if($spouse_name != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Name :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_name?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_email != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Email :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_email?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_phone1 != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Phone 1 :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone1?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_phone2 != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Phone 2 :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone2?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_phone3 != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Phone 3 :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_phone3?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_dob != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse DOB :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_dob?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_sex != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Sex :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_sex?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_profession != ''){?>
            <tr>
                <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse Profession :</td>
                <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$spouse_profession?></td> 
            </tr>
            <?php }?>

            <?php if($spouse_dob_proof != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Spouse DOB Proof :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;">
                        <a href="<?=url('uploads/userimg/' . $spouse_dob_proof)?>" style="color: #c23233; text-decoration: none;">
                            View File
                        </a>
                    </td> 
                </tr>
            <?php }?>

            <?php if(($children1_name != '') && ($children1_phone1 != '' || $children1_dob != '' && $children1_sex != '')){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 1 Name :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_name?></td> 
                </tr>
            <?php }?>
            <?php if($children1_phone1 != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 1 Phone :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_phone1?></td> 
                </tr>
            <?php }?>
            <?php if($children1_dob != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 1 DOB :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_dob?></td>
                </tr>
            <?php }?>
            <?php if($children1_sex != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 1 Sex :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children1_sex?></td> 
                </tr>
            <?php }?>

            <?php if(($children2_name != '') && ($children2_phone1 != '' || $children2_dob != '' && $children2_sex != '')){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 2 Name :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_name?></td> 
                </tr>
            <?php }?>
            <?php if($children2_phone1 != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 2 Phone :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_phone1?></td> 
                </tr>
            <?php }?>
            <?php if($children2_dob != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 2 DOB :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_dob?></td> 
                </tr>
            <?php }?>
            <?php if($children2_sex != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 2 Sex :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children2_sex?></td> 
                </tr>
            <?php }?>

            <?php if(($children3_name != '') && ($children3_phone1 != '' || $children3_dob != '' && $children3_sex != '')){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 3 Name :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_name?></td> 
                </tr>
            <?php }?>

            <?php if($children3_phone1 != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 3 Phone :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_phone1?></td> 
                </tr>
            <?php }?>
            <?php if($children3_dob != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 3 DOB :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_dob?></td>
                </tr>
            <?php }?>
            <?php if($children3_sex != ''){?>
                <tr>
                    <td  valign="middle" width="16%" style="border: 1px solid #828282; color: #000000; font-weight: 400; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px;">Children 3 Sex :</td>
                    <td  valign="middle" width="28%" style="border: 1px solid #828282; color: #000000; font-weight: 600; font-size: 14px; font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.5em; margin: 0; padding: 10px; text-align: left;"><?=$children3_sex?></td>
                </tr>
            <?php }?>
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