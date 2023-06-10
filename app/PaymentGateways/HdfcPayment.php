<?php
//app/PaymentGateways/HdfcPayment.php
namespace App\PaymentGateways;
use App\PaymentGateways\PaymentGatewayInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class HdfcPayment implements PaymentGatewayInterface
{
	

    public function processPayment($amount, $user){

        if (env('HDFC_MODE') == 'LIVE') {
    		$url = 'https://pay.1paypg.in/payone/';
		} elseif (env('HDFC_MODE') == 'TEST') {
			$url = 'https://onepaypgtest.in/onepayVAS/payprocessorV2';
		}

        $data['merchantId']         = env('HDFC_MERCHANT_ID');
        $data['apiKey']             = env('HDFC_API_KEY');
        $data['txnId']              = Str::random(10);
        $data['amount']             = sprintf("%.2f", $amount);
        $data['dateTime']           = date('Y-m-d h:i:s');
        $data['custMail']           = $user->email ?? '';
        $data['custMobile']         = $user->phone_number_1 ?? '';
        $data['udf1']               = $user->id ?? 'NA';
        $data['udf2']               = $user->user_code ?? 'NA';
        $data['returnURL']          = route('member.paywithhdfc.status');
        $data['productId']          = 'DEFAULT';
        $data['channelId']          = 0;
        $data['isMultiSettlement']  = 0;
        $data['txnType']            ='DIRECT';
        $data['instrumentId']       = 'NA';
        $data['udf3']               = 'NA';
        $data['udf4']               = 'NA';
        $data['udf5']               = 'NA';
        $data['cardDetails']        ='NA';
        $data['cardType']           = 'NA';

		$jsondata = json_encode($data);
        $enc = $this->get_encrypt($jsondata);

		$data['enc'] = $enc;


        $data['action']             = $url;

		$this->storePayment($data);

		Session::put('hdfcTransactionId', $data['txnId']);
		Session::put('hdfcTransactionAmount', $data['amount']);

        //return view('member.hdfcredirectform', $data);
		return $data;

    }

    private function get_encrypt($input) {

        // Generate a 256-bit encryption key
        $encryption_key = env('HDFC_API_KEY');

        // Generate an initialization vector
        // This MUST be available for decryption as well
        //$iv = 'TD1zS3rL8Aj9Xz4o';
        $iv= substr(env('HDFC_API_KEY'), 0, 16);

        // Create some data to encrypt
        $endata = $input;

        $encrypted = openssl_encrypt($endata, env('HDFC_ENC_METHOD'), $encryption_key, 0, $iv);
        $data = $encrypted;
        return $data;
    }

    private function get_decrypt($respData) {
        $key = env('HDFC_API_KEY'); //'TD1zS3rL8Aj9Xz4oK7vv7FW3mh8kQ3yB';
        $iv = substr(env('HDFC_API_KEY'), 0, 16);//'TD1zS3rL8Aj9Xz4o';
        $decrypted = openssl_decrypt($respData, env('HDFC_ENC_METHOD'), $key, 0, $iv);
        return $decrypted;

    }

    public function verifyPayment($response){
        if (env('HDFC_MODE') == 'LIVE') {
    		$url = 'https://pay.1paypg.in/payone/getTxnDetails';
		} elseif (env('HDFC_MODE') == 'TEST') {
			$url = 'https://onepaypgtest.in/onepayVAS/';
		}

        if (isset($response)) {
			$resData = $response;				
		}else
		{
			//invalid return data
			//$this->session->data['error'] = "Transaction error ....";		
			//$this->response->redirect($this->url->link('checkout/checkout', '', true));
			$data['error'] = true;
			$data['status']= "Transaction error ....";

			return $data;

			//return redirect()->route('member.paymentstatusotherpgs')->with('data', $data);
		}

        //$verificationResult = $this->verify(array('respData'=>$resData,'url'=>$url));
    	$verificationResult= json_decode($this->get_decrypt($resData));
		//Staus Query API call
		$verificationResult= $this->statusQueryAPI(array('respData' => $verificationResult, 'url' => $url));
		//dd($verificationResult);
        $parsedtxnid = $verificationResult->txn_id;
        $parsedmerchantid = $verificationResult->merchant_id;
        $parsedtxnamount = $verificationResult->txn_amount;
        $parsedtxnstatus = $verificationResult->trans_status;
        $responseMessage = $verificationResult->resp_message;
		$pgTransactionRef= $verificationResult->pg_ref_id;
		$parsedUser= $verificationResult->udf1;
            		
		$orderid=explode("_",$parsedtxnid);
		$orderid=$orderid[0];
		$this->updatePaymentStatus($verificationResult);
        if (($responseMessage === 'Transaction Successful.') && ($parsedtxnstatus !== 'NA')) {
		// if(($txnid == $parsedtxnid )&& ($txnamount == $parsedtxnamount) && ($merchantid == $parsedmerchantid)){
			$vmessage = "Verified Transaction";
				if($parsedtxnstatus == 'Ok'){
					$status_msg = "success";
					$data['status']= $status_msg;
					$data['amount']= $parsedtxnamount;
					$data['transactionid']= $parsedtxnid;
					$data['user'] = $parsedUser;
					return $data;
					//$this->model_checkout_order->addOrderHistory($orderid, $this->config->get('payment_onepay_order_status_id'),'Payment Successful',true);
					//$this->response->redirect($this->url->link('checkout/success', '', true));			
					//return redirect()->route('member.paymentstatusotherpgs')->with('data', $data);
				}
				else if($parsedtxnstatus == 'To'){
					$status_msg = "Sorry!!Your Transaction is Timed Out";
					$data['status']= $status_msg;
					$data['transactionid']=$pgTransactionRef;
					$data['amount']= $parsedtxnamount;
					$data['error'] = true;
					$data['user'] = $parsedUser;
				}
				else{
					$status_msg = "Transaction Failed";
					$data['status']= $status_msg;
					$data['transactionid']=$pgTransactionRef;
					$data['error'] = true;
					$data['user'] = $parsedUser;
					$data['amount']= $parsedtxnamount;
				}
				return $data;
		}
		else
		{
			$vmessage = "Transaction  Failed";
					// if($txnid != $parsedtxnid)
					// {
					$status_msg = "Transaction Failed";
					//$this->model_checkout_order->addOrderHistory($orderid, $this->config->get('payment_onepay_order_fail_status_id'),$status_msg,true);					
					$data['error']= true;
					$data['transactionid']=$pgTransactionRef;
					$data['status'] = $status_msg;
					$data['amount']= $parsedtxnamount;
					return $data;
					//return redirect()->route('member.paymentstatusotherpgs')->with('data', $data);
					// }
					// if($txnStatus != $parsedtxnstatus)
					// {
					// 	$status_msg = "Transaction Failed beacuse of Status Mismatch in Verification";
					// 	$this->model_checkout_order->addOrderHistory($orderid, $this->config->get('payment_onepay_order_fail_status_id'),$status_msg,true);					
					// 	$this->session->data['error'] = "Onepay Response - ".$status_msg;
					// 	$this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
					// }
					// if($txnamount != $parsedtxnamount)
					// {
					// 	$status_msg = "Transaction Failed beacuse of Amount Mismatch in Verification";
					// 	$this->model_checkout_order->addOrderHistory($orderid, $this->config->get('payment_onepay_order_fail_status_id'),$status_msg,true);					
					// 	$this->session->data['error'] = "Onepay Response - ".$status_msg;
					// 	$this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
					// }
		}
    }

	private function storePayment($params=[])
	{
		if(!empty($params)){

		
		DB::table('payu_transactions')->insert([
    	'paid_for_id' => $params['udf1'],
    	'paid_for_type' => 'App\Models\User',
    	'transaction_id' => $params['txnId'],
		'gateway'		=> 'HDFC VAS',
		'body'			=> serialize($params),
		'destination'	=> route('member.paywithhdfc.status'),
		'hash'			=> $params['enc'],
		'response'		=> '',
		'status'		=> 'pending',
		'created_at'	=> Carbon::now('Asia/Kolkata'),
		'updated_at'	=> Carbon::now('Asia/Kolkata'),

		]);
	}

	}

	private function updatePaymentStatus($response=[])
	{
		if(!empty($response) 
		&& 
		Session::get('hdfcTransactionId') === $response->txn_id
		&&
		Session::get('hdfcTransactionAmount') === $response->txn_amount
		)
		{
			DB::table('payu_transactions')
				->where('transaction_id', Session::get('hdfcTransactionId'))
				->update(
					[
						'response' => json_decode(json_encode($response), true),
						'status'	=> ($response->trans_status =='Ok') ? 'successful' : (($response->trans_status === 'To' || $response->trans_status === 'F') ? 'failed' : 'invalid'),
						'updated_at' => Carbon::now('Asia/Kolkata'),

					]
					);
		}else{
			DB::table('payu_transactions')
				->where('transaction_id', Session::get('hdfcTransactionId'))
				->update(
					[
						'response' 	=> json_decode(json_encode($response), true),
						'status'   	=> 'failed',
						'updated_at'=> Carbon::now('Asia/Kolkata'),
					]
					);
		}

	}

	private function statusQueryAPI($data=array()){
		try {
			$txnid = $data['respData']->txn_id;
			$merchantid = $data['respData']->merchant_id;
			$url = $data['url'] . 'getTxnDetails';
			$postedFileds=[
				'merchantId' => $merchantid,
				'txnId'		 => $txnid
			];

			$tansactionUrl= $url .'?' . http_build_query($postedFileds);

			$response= Http::post($tansactionUrl);

			return json_decode($response);
		} catch (\Throwable $th) {
			throw $th;
		}
		

	}

	
}