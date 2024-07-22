<?php
session_start();
include "conn.php";
date_default_timezone_set("Asia/Kolkata");
/*Note : After completing transaction process it is recommended to make an enquiry call with PayU to validate the response received and then save the response to DB or display it on UI*/

$postdata = $_POST;
$msg = '';
// $salt="4R38IvwiV57FwVpsgOvTXBdLE4tHUXFW";
$salt="R6iCHXRS";
// echo '<pre>';print_r($postdata);
// echo $salt;die;
/* Response received from Payment Gateway at this page.

It is absolutely mandatory that the hash (or checksum) is computed again after you receive response from PayU and compare it with request and post back parameters. This will protect you from any tampering by the user and help in ensuring a safe and secure transaction experience. It is mandate that you secure your integration with PayU by implementing Verify webservice and Webhook/callback as a secondary confirmation of transaction response.

Process response parameters to generate Hash signature and compare with Hash sent by payment gateway 
to verify response content. Response may contain additional charges parameter so depending on that 
two order of strings are used in this kit.

Hash string without Additional Charges -
hash = sha512(SALT|status||||||udf5|||||email|firstname|productinfo|amount|txnid|key)

With additional charges - 
hash = sha512(additionalCharges|SALT|status||||||udf5|||||email|firstname|productinfo|amount|txnid|key)

*/
if (isset($postdata ['key'])) {
	$key							=   $postdata['key'];
	$txnid 						= 	$postdata['txnid'];
  $amount      			= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
	$firstname    		= 	$postdata['firstname'];
	$email        		=		$postdata['email'];
	$udf1							=   $postdata['udf1'];
	$udf5							=   $postdata['udf5'];
	$status						= 	$postdata['status'];
	$resphash					= 	$postdata['hash'];
	//Calculate response hash to verify	
	$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|'.$udf1.'||||'.$udf5.'|||||';
	$keyArray 	  		= 	explode("|",$keyString);
	$reverseKeyArray 	= 	array_reverse($keyArray);
	$reverseKeyString	=		implode("|",$reverseKeyArray);
	$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString)); //hash without additionalcharges
	
	//check for presence of additionalcharges parameter in response.
	$additionalCharges  = 	"";
	
	If (isset($postdata["additionalCharges"])) {
     $additionalCharges=$postdata["additionalCharges"];
	   //hash with additionalcharges
	   $CalcHashString 	= 	strtolower(hash('sha512', $additionalCharges.'|'.$salt.'|'.$status.'|'.$reverseKeyString));
	}
	//Comapre status and hash. Hash verification is mandatory.
	if ($status == 'success'  && $resphash == $CalcHashString) {
		$msg = "Transaction Successful, Hash Verified...<br />";
		//Do success order processing here...
			if($status == 'success'){

				$payment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `payment` WHERE `id` = '$productInfo'"));
				if($payment['amount'] == $amount){
					$amount=$postdata['amount'];
					$bill_trans_ref_no=@$_POST['txnid'];
					$decision='success';

					$message='Your payment was successful.';
					$serialyze_field=  serialize($postdata);
					$return_time=date("Y-m-d H:i:s");
					$status='success';
					$sql= "UPDATE payment SET amount = '$amount', bill_trans_ref_no = '$bill_trans_ref_no', decision = '$decision', message = '$message', serialyze_field = '$serialyze_field', return_time = '$return_time', status = '$status' WHERE id = $productInfo";
					mysqli_query($conn, $sql);

					
					$sql2= "UPDATE payment_bill SET amount = '$amount', status = '$status' WHERE id = $udf5";
					mysqli_query($conn, $sql2);
					
					/* insert into clubman */
						$club_account='A0146';
						$ch = curl_init();
				    $url = "https://bengalrowingclub.com/Hdfc_payment/insert_clubman/".$productInfo."/".$club_account;
				    // $dataArray = ['payment_id' => $productInfo, 'club_account' => $club_account];
				    $dataArray = ['payment_id' => $productInfo, 'club_account' => $club_account];
				    $data = http_build_query($dataArray);
				    // $getUrl = $url."?".$data;
				    $getUrl = $url;
				    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				    curl_setopt($ch, CURLOPT_URL, $getUrl);
				    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
				    $response = curl_exec($ch);
				    if(curl_error($ch)){
			        echo 'Request Error:' . curl_error($ch);
				    }else{
			        echo $response;
				    }			       
				    curl_close($ch);
			    /* insert into clubman */
			    /* email sms sent */
			    	$ch = curl_init();
				    $url = "https://bengalrowingclub.com/Hdfc_payment/send_email_sms/".$productInfo;
				    // $dataArray = ['payment_id' => $productInfo, 'club_account' => $club_account];
				    $dataArray = ['payment_id' => $productInfo, 'club_account' => $club_account];
				    $data = http_build_query($dataArray);
				    // $getUrl = $url."?".$data;
				    $getUrl = $url;
				    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				    curl_setopt($ch, CURLOPT_URL, $getUrl);
				    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
				    $response = curl_exec($ch);
				    if(curl_error($ch)){
			        echo 'Request Error:' . curl_error($ch);
				    }else{
			        echo $response;
				    }			       
				    curl_close($ch);
			    /* email sms sent */
				} else {
					$amount=$postdata['amount'];
					$bill_trans_ref_no=@$_POST['txnid'];
					$decision='failure2';

					$message='Amount Mismatch';
					$serialyze_field=  serialize($postdata);
					$return_time=date("Y-m-d H:i:s");
					$status='failure2';
					$sql= "UPDATE payment SET amount = '$amount', bill_trans_ref_no = '$bill_trans_ref_no', decision = '$decision', message = '$message', serialyze_field = '$serialyze_field', return_time = '$return_time', status = '$status' WHERE id = $productInfo";
					mysqli_query($conn, $sql);
				}
			} else {
				$amount=$postdata['amount'];
				$bill_trans_ref_no=@$_POST['txnid'];
				$decision='failure3';

				$message='Payment Failure';
				$serialyze_field=  serialize($postdata);
				$return_time=date("Y-m-d H:i:s");
				$status='failure3';
				$sql= "UPDATE payment SET amount = '$amount', bill_trans_ref_no = '$bill_trans_ref_no', decision = '$decision', message = '$message', serialyze_field = '$serialyze_field', return_time = '$return_time', status = '$status' WHERE id = $productInfo";
				mysqli_query($conn, $sql);
			}
		//Do success order processing here...
		//Additional step - Use verify payment api to double check payment.
		if(verifyPayment($key,$salt,$txnid,$status))
			$msg = "Transaction Successful, Hash Verified...Payment Verified...";
		else
			$msg = "Transaction Successful, Hash Verified...Payment Verification failed...";
	}
	else {
		//tampered or failed
		$msg = $postdata['error_Message'];
		$amount=$postdata['amount'];
		$bill_trans_ref_no=@$_POST['txnid'];
		$decision='failure4';

		$message='Payment Failure';
		$serialyze_field=  serialize($postdata);
		$return_time=date("Y-m-d H:i:s");
		$status='failure4';
		$sql= "UPDATE payment SET amount = '$amount', bill_trans_ref_no = '$bill_trans_ref_no', decision = '$decision', message = '$message', serialyze_field = '$serialyze_field', return_time = '$return_time', status = '$status' WHERE id = $productInfo";
		mysqli_query($conn, $sql);
	} 
}

else exit(0);


//This function is used to double check payment
function verifyPayment($key,$salt,$txnid,$status)
{
	$command = "verify_payment"; //mandatory parameter
	
	$hash_str = $key  . '|' . $command . '|' . $txnid . '|' . $salt ;
	$hash = strtolower(hash('sha512', $hash_str)); //generate hash for verify payment request

    $r = array('key' => $key , 'hash' =>$hash , 'var1' => $txnid, 'command' => $command);
	    
    $qs= http_build_query($r);
	//for production
    $wsUrl = "https://info.payu.in/merchant/postservice.php?form=2";
   
	//for test
	// $wsUrl = "https://test.payu.in/merchant/postservice.php?form=2";
	
	try 
	{		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $wsUrl);
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_SSLVERSION, 6); //TLS 1.2 mandatory
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
		$o = curl_exec($c);
		if (curl_errno($c)) {
			$sad = curl_error($c);
			throw new Exception($sad);
		}
		curl_close($c);		
		
		$response = json_decode($o,true);
		
		if(isset($response['status']))
		{
			// response is in Json format. Use the transaction_detailspart for status
			$response = $response['transaction_details'];
			$response = $response[$txnid];
			
			if($response['status'] == $status) //payment response status and verify status matched
				return true;
			else
				return false;
		}
		else {
			return false;
		}
	}
	catch (Exception $e){
		return false;	
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PayUBiz PHP7 Kit</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
	.info{
		color:#536152;	
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
.payment_section {
    margin-top: 40px;
}
</style>
<body>
<div class="payment_section">
	<div class="container">
			
			
		<div class="box_payment">
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-center">
					<img src="images/brc-logo.png" />
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-center">
					<h3 style="color: <?=(($status == 'success')?'green':'red')?>; font-weight: bold;"><?=$message?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-center">
					<table class="table table-striped">
						<tr>
							<th>Transaction/Order ID:</th>
							<td><?php echo $txnid; ?></td>
						</tr>
						<tr>
							<th>Amount:</th>
							<td><i class="fa fa-rupee-sign"></i> <?php echo $amount; ?></td>
						</tr>
						<!-- <tr>
							<th>Product Info:</th>
							<td><?php echo $productInfo; ?></td>
						</tr> -->
						<tr>
							<th>First Name:</th>
							<td><?php echo $firstname; ?></td>
						</tr>
						<tr>
							<th>Email ID:</th>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<th>Transaction Status:</th>
							<td style="color: <?=(($status == 'success')?'green':'red')?>; font-weight: bold;"><?php echo $decision; ?></td>
						</tr>
						<tr>
							<th>Message:</th>
							<td><?php echo $msg; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
	