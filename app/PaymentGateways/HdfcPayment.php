<?php
//app/PaymentGateways/HdfcPayment.php
namespace App\PaymentGateways;
use App\PaymentGateways\PaymentGatewayInterface;
use Illuminate\Support\Str;

class HdfcPayment implements PaymentGatewayInterface
{

    public function processPayment($amount){
        $data= [
            'merchantId'    => env('HDFC_MERCHANT_ID'),
            'apiKey'        => env('HDFC_API_KEY'),
            'txnId'         => Str::random(10),
            'amount'        => sprintf("%.2f", $amount),
            'dateTime'      => date('Y-m-d h:i:s'),
            'custMail'      => $user->email ?? 'shuvadeep@keylines.net',
            'custMobile'    => $user->mobileNo ?? '8910649429',
            'udf1'          => $user->somedetails ?? 'NA',
            'udf2'          => $user->somedata ?? 'NA',
            'returnURL'     => route('member.paywithhdfc.status'),
           'productId'      => 'DEFAULT',
           'channelId'      => 0,
           'isMultiSettlement' => 0,
           'txnType'           =>'DIRECT',
           'instrumentId'      => 'NA',
           'udf3'              => 'NA',
           'udf4'              => 'NA',
           'udf5'               => 'NA',
           'cardDetails'        =>'NA',
           'cardType'           => 'NA' ,

        ];

        $jsondata = json_encode($data);
        $enc = $this->get_encrypt($jsondata);

        $formInputs= [
            'merchantId' => env('HDFC_MERCHANT_ID'),
            'reqData'    => $enc   

        ];

        return view('redirect-form', $formInputs);

    }

    private function get_encrypt($input) {

        // Generate a 256-bit encryption key
        $encryption_key = env('HDFC_API_KEY');

        // Generate an initialization vector
        // This MUST be available for decryption as well
        //$iv = 'TD1zS3rL8Aj9Xz4o';
        $iv= substr(env('HDFC_API_KEY'), 0, 15);

        // Create some data to encrypt
        $endata = $input;

        $encrypted = openssl_encrypt($endata, env('HDFC_ENC_METHOD'), $encryption_key, 0, $iv);
        $data = $encrypted;
        return $data;
    }

    private function get_decrypt($respData) {
        $key = env('HDFC_API_KEY'); //'TD1zS3rL8Aj9Xz4oK7vv7FW3mh8kQ3yB';
        $iv = substr(env('HDFC_API_KEY'), 0, 15);//'TD1zS3rL8Aj9Xz4o';
        $decrypted = openssl_decrypt($respData, env('HDFC_ENC_METHOD'), $key, 0, $iv);
        return $decrypted;

    }

    public function request($url, $postData)
    {
        $ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data);
    }

    public function status(){
        $merchantId = $_POST['merchantId'];
        $respData = $_POST['respData'];
        $respDecrypt = $this->get_decrypt($respData);
        $verificationResult = json_decode($respDecrypt);
        dd($verificationResult);
    }
}