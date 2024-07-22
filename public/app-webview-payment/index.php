<?php
error_reporting(E_ALL);
session_start();
include "conn.php";
$param 	= base64_decode(urldecode($_GET['param']));
$sql 	= "SELECT * FROM payment_details WHERE id=$param";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$membership_no = $result['membership_no'];

$member = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_code` = '$membership_no'"));
// echo '<pre>';
// print_r($result);
// die;
/*
Note : It is recommended to fetch all the parameters from your Database rather than posting static values or entering them on the UI.

POST REQUEST to be posted to below mentioned PayU URLs:

For PayU Test Server:
POST URL: https://test.payu.in/_payment

For PayU Production (LIVE) Server:
POST URL: https://secure.payu.in/_payment
*/

//Unique merchant key provided by PayU along with salt. Salt is used for Hash signature 
//calculation within application and must not be posted or transfered over internet. //-->
// $key="gtKFFx";
$key="p6MMWI";
// $salt="eCwWELxi";
// $salt="4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW";
$salt="uY91j8i2QiLpb000ug9zdRnUsKXR2QqV";

$action = 'https://test.payu.in/_payment';
// $action = 'https://secure.payu.in/_payment';

$html='';

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	/* Request Hash
	----------------
	For hash calculation, you need to generate a string using certain parameters 
	and apply the sha512 algorithm on this string. Please note that you have to 
	use pipe (|) character as delimeter. 
	The parameter order is mentioned below:
	
	sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT)
	
	Description of each parameter available on html page as well as in PDF.
	
	Case 1: If all the udf parameters (udf1-udf5) are posted by the merchant. Then,
	hash=sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT)
	
	Case 2: If only some of the udf parameters are posted and others are not. For example, if udf2 and udf4 are posted and udf1, udf3, udf5 are not. Then,
	hash=sha512(key|txnid|amount|productinfo|firstname|email||udf2||udf4|||||||SALT)

	Case 3: If NONE of the udf parameters (udf1-udf5) are posted. Then,
	hash=sha512(key|txnid|amount|productinfo|firstname|email|||||||||||SALT)
	
	In present kit and available PayU plugins UDF5 is used. So the order is -	
	hash=sha512(key|txnid|amount|productinfo|firstname|email|||||udf5||||||SALT)
	
	*/
	$postData = $_POST;
	// echo $key.'|'.$postData["txnid"].'|'.$postData["amount"].'|'.$postData["productinfo"].'|'.$postData["firstname"].'|'.$postData["email"].'|||||'.$postData["udf5"].'||||||'.$salt;
	// echo '<pre>';print_r($postData);die;
	//generate hash with mandatory parameters and udf5
	$hash=hash('sha512', $key.'|'.$postData["txnid"].'|'.$postData["amount"].'|'.$postData["productinfo"].'|'.$postData["firstname"].'|'.$postData["email"].'|'.$postData["udf1"].'||||'.$postData["udf5"].'||||||'.$salt);
	// echo $hash;die;
	$_SESSION['salt'] = $salt; //save salt in session to use during Hash validation in response
	
	$html = '<form action="'.$action.'" id="payment_form_submit" method="post">
			<input type="hidden" id="udf1" name="udf1" value="'.$_POST['udf1'].'" />
			<input type="hidden" id="udf5" name="udf5" value="'.$_POST['udf5'].'" />
			<input type="hidden" id="surl" name="surl" value="'.$_POST['surl'].'" />
			<input type="hidden" id="furl" name="furl" value="'.$_POST['furl'].'" />
			<input type="hidden" id="curl" name="curl" value="'.$_POST['curl'].'" />
			<input type="hidden" id="key" name="key" value="'.$key.'" />
			<input type="hidden" id="txnid" name="txnid" value="'.$_POST['txnid'].'" />
			<input type="hidden" id="amount" name="amount" value="'.$_POST['amount'].'" />
			<input type="hidden" id="productinfo" name="productinfo" value="'.$_POST['productinfo'].'" />
			<input type="hidden" id="firstname" name="firstname" value="'.$_POST['firstname'].'" />
			<input type="hidden" id="Lastname" name="Lastname" value="'.$_POST['Lastname'].'" />
			<input type="hidden" id="Zipcode" name="Zipcode" value="'.$_POST['Zipcode'].'" />
			<input type="hidden" id="email" name="email" value="'.$_POST['email'].'" />
			<input type="hidden" id="phone" name="phone" value="'.$_POST['phone'].'" />
			<input type="hidden" id="address1" name="address1" value="'.$_POST['address1'].'" />
			<input type="hidden" id="address2" name="address2" value="'.(isset($_POST['address2'])? $_POST['address2'] : '').'" />
			<input type="hidden" id="city" name="city" value="'.$_POST['city'].'" />
			<input type="hidden" id="state" name="state" value="'.$_POST['state'].'" />
			<input type="hidden" id="country" name="country" value="'.$_POST['country'].'" />
			<input type="hidden" id="Pg" name="Pg" value="'.$_POST['Pg'].'" />
			<input type="hidden" id="hash" name="hash" value="'.$hash.'" />
			</form>
			<script type="text/javascript"><!--
				document.getElementById("payment_form_submit").submit();	
			//-->
			</script>';
	
}
 
//This function is for dynamically generating callback url to be postd to payment gateway. Payment response will be
//posted back to this url. 
function getSuccessUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	// $uri = str_replace('/index.php','/',$_SERVER['REQUEST_URI']);
	$uri = '/app-webview-payment/';
	return $protocol . $_SERVER['HTTP_HOST'] . $uri . 'success.php';
}
function getFailureUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	// $uri = str_replace('/index.php','/',$_SERVER['REQUEST_URI']);
	$uri = '/app-webview-payment/';
	return $protocol . $_SERVER['HTTP_HOST'] . $uri . 'failure.php';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Payment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;		
	}
	body {
    background: #d2a240;
}
	.box_payment {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
	margin-bottom: 50px;
}
.box_payment .row:first-child {
    padding-bottom: 25px;
}
.box_payment_title h3 {
    color: #fff;
    padding: 40px 0;
}
.box_payment .row:first-child img {
    max-width: 115px;
}
.box_payment tr {
    display: flex;
    flex-direction: column;
    background: none !important;
}
.box_payment tr th {
    border: none !important;
}
.box_payment tr td {
    border: 1px solid #e18345 !important;
    border-radius: 20px;
    padding: 10px 20px !important;
}
.box_payment input#btnsubmit {
    background: #e86b0f;
    border: none;
    border-radius: 30px;
    width: 100%;
    padding: 11px 15px;
    font-size: 18px;
    max-width: 300px;
    text-transform: uppercase;
}
</style>
<body>
	<div class="payment_section">
	<div class="container">
		
		<div class="box_payment_title">
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-center">
					<h3>Payment</h3>
				</div>
			</div>
		</div>
		<div class="box_payment">
		<div class="row">
			<div class="col-xs-12 col-sm-12 text-center">
				<img src="images/brc-logo.png" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<table class="table table-striped">
					<tr>
						<th>Name</th>
						<td><?=$member['Name']?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?=$member['Email']?></td>
					</tr>
					<tr>
						<th>Phone</th>
						<td><?=$member['mobile']?></td>
					</tr>
					<tr>
						<th>Amount</th>
						<td><i class="fa fa-rupee-sign"></i> <?=$result['amount']?></td>
					</tr>
				</table>
			</div>
			<div class="col-xs-12 col-sm-12">
				<form action="" id="payment_form" method="post" style="text-align: center;">
					<!-- Contains information of integration type. Consult to PayU for more details.//-->
					<input type="text" id="udf1" name="udf1" value="<?=$membership_no?>" />
					<input type="text" id="udf5" name="udf5" value="<?=$result['pay_type_id']?>" />
					<input type="text" id="surl" name="surl" value="<?=getSuccessUrl()?>" />
					<input type="text" id="furl" name="furl" value="<?=getFailureUrl()?>" />
					<input type="text" id="curl" name="curl" value="<?=getSuccessUrl()?>" />
		    		
		    		<input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?=$result['payu_txnid']?>" />
		    		<input type="text" id="amount" name="amount" placeholder="Amount" value="<?=$result['amount']?>" />
		    		<input type="text" id="productinfo" name="productinfo" placeholder="Product Info" value="<?=$result['id']?>" />
		    		<input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?=$member['name']?>" />
		    		<input type="text" id="Lastname" name="Lastname" placeholder="Last Name" value="<?=$member['name']?>" />
		    		<input type="text" id="Zipcode" name="Zipcode" placeholder="Zip Code" value="" />
		    		<input type="text" id="email" name="email" placeholder="Email ID" value="<?=$member['email']?>" />
					<input type="text" id="phone" name="phone" placeholder="Mobile/Cell Number" value="<?=$member['phone_number_1']?>" />
					<input type="text" id="address1" name="address1" placeholder="Address1" value="<?=$member['user_code']?>" />
		    		<input type="text" id="address2" name="address2" placeholder="Address2" value="" />
					<input type="text" id="city" name="city" placeholder="City" value="Kolkata" />
					<input type="text" id="state" name="state" placeholder="State" value="West Bengal" />
					<input type="text" id="country" name="country" placeholder="Country" value="India" />
		    		<input type="text" id="Pg" name="Pg" placeholder="PG" value="" />
					<div><input type="button" id="btnsubmit" name="btnsubmit" value="Pay Now" class="btn btn-success btn-sm" onclick="frmsubmit(); return true;" /></div>
				</form>
			</div>
		</div>
		</div>
		<?php if($html) echo $html; //submit request to PayUBiz  ?>
		
		
	</div> 
	</div>	
	<!-- End of Main Div //-->
	
	<!-- Below script makes final submission of form to Payment Gateway. This script is for present Demo/Test request 
	form only. In case of live integration, other methods may be used for request form submission. Salt is confidential
	so should not be passed over internet.//-->
	<script type="text/javascript">		
		<!--
		function frmsubmit()
		{
			document.getElementById("payment_form").submit();	
			return true;
		}
		//-->
	</script>
	
</body>
</html>
	