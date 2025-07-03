<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tzsk\Payu\Concerns\Attributes;
use Tzsk\Payu\Concerns\Customer;
use Tzsk\Payu\Concerns\Transaction;
use Tzsk\Payu\Facades\Payu;

use Tzsk\Pay\Models\PayuTransaction;
use App\Notifications\PayUEmailNotification;
use Notification;
use App\PaymentGateways\PaymentGatewayInterface;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {

        //$user = User::where('id', '=', session('LoggedMember'))->first();
        $user= User::find(session('LoggedMember'))->first();
        
        if ($user) {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:1',
                'paymentGatewayOptions' => 'required',
            ]);

            $customer = Customer::make()
                            ->firstName($user->name)
                            ->email($user->email)
                            ->phone($user->phone_number_1 ?? 'NA');
            // This is entirely optional custom attributes
            $attributes = Attributes::make()
                            ->udf1($user->id);
                
            
            // Associate the transaction with your invoice
            $transaction = Transaction::make()
                            ->charge($request->amount)
                            ->for($user->user_code)
                            ->with($attributes) // Only when using any custom attributes
                            ->against($user)
                            ->to($customer);
            //dd($transaction);

            return Payu::initiate($transaction)->redirect(route('member.payment.status'));
        } else {
            dd($user);
        }
    }

    public function status()
    {
        $transaction = Payu::capture();

        $status= $transaction->response;
        
        $user= User::find($status['udf1']);

        if (!empty($user) && $transaction->successful()) {
            $emailInfo= array(
                'greeting' => "Dear, {$user->name}",
                'body'     => "Thank you for making payment of Rs.{$status['amount']}. Please note that payment is subject to realization and will reflect in your account in the next 24 working hours."
            );

            Notification::send($user, new PayUEmailNotification($emailInfo));
        }

        return view('member.paymentstatus', compact('status'));
    }

    public function PayWithHdfc(PaymentGatewayInterface $hdfcPaymentService, Request $request)
    {
            $user= User::find(session('LoggedMember'))->first();

            if($user)
            {
                $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'paymentGatewayOptions' => 'required',
    ]);

    $data= $hdfcPaymentService->processPayment($request->amount, $user);
    echo '<pre>';print_r($data);die;
    return view('member.hdfcredirectform', $data);

            }

            
            
            //dd($data);
            
            //dd($request);
    }

    public function statusForHdfc(PaymentGatewayInterface $hdfcPaymentService, Request $request)
    {
        //respData;
        //dd($_POST);
        $paymentStatus = $request->input('respData');
        $status= $hdfcPaymentService->verifyPayment($paymentStatus);
        //dd($status);
        if(!empty($status)){
            if(array_key_exists('error', $status)){


            }else{
                //send payment notification to user
                $user= User::find($status['user']);
                $emailInfo= array(
                'greeting' => "Dear, {$user->name}",
                'body'     => "Thank you for making payment of Rs.{$status['amount']}. Please note that payment is subject to realization and will reflect in your account in the next 24 working hours."
                );
                Notification::send($user, new PayUEmailNotification($emailInfo));
            }
            return view('member.paymentstatusotherpgs', compact('status'));
        }
    }

    public function callback(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Process the payment callback logic here
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $amount= number_format($payment->amount/100, 2, '.', '');

        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            try
                {
                    // Please note that the razorpay order ID must
                    // come from a trusted source (session here, but
                    // could be database or something else)
                    $attributes = array(
                        'razorpay_order_id' => $payment->order_id,
                        'razorpay_payment_id' => $input['razorpay_payment_id'],
                        'razorpay_signature' => $input['razorpay_signature']
                    );

                    $api->utility->verifyPaymentSignature($attributes);

                    DB::table('payu_transactions')
				        ->where('transaction_id', Session::get('axisTransactionId'))
                        ->update(
                            [
                                'response' => $payment->toArray(),
                                'status'	=> 'successful',
                                'updated_at' => Carbon::now('Asia/Kolkata'),

                            ]
                            );
                    //find user
                    $user= User::find($payment->notes->udf1);

                    

                    $emailInfo= array(
                        'greeting' => "Dear, {$user->name}",
                        'body'     => "Thank you for making payment of Rs.{ $amount }. Please note that payment is subject to realization and will reflect in your account in the next 24 working hours."
                    );

                    Notification::send($user, new PayUEmailNotification($emailInfo));
                    
                    

                    $status= ['status' => 'success', 'transactionid'=> $input['razorpay_payment_id'], 'amount' => $amount];



                    

                    
                }
                catch(SignatureVerificationError $e)
                {
                    $status= ['status' => 'Failed', 'message' => $e->getMessage(), 'amount' => $amount];

                    DB::table('payu_transactions')
				        ->where('transaction_id', Session::get('axisTransactionId'))
                        ->update(
                            [
                                'response' => $payment,
                                'status'	=> 'failed',
                                'updated_at' => Carbon::now('Asia/Kolkata'),

                            ]
                            );

                    
                }

        }

        return view('member.paymentstatusotherpgs', compact('status'));

        //Session::put('success', 'Payment successful');
        //dd([$payment, $input]);
        //return redirect()->back();

        //return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $user= User::find(session('LoggedMember'))->first();
        if($user)
        {
            $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'paymentGatewayOptions' => 'required',
    ]);

    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
            'receipt' => 'ord_axis_' . Str::random(10), // Replace with your own unique identifier for the order
            'amount' => $request->amount * 100, // Replace with the actual amount from your form or request
            'currency' => 'INR', // Replace with your desired currency
            'payment_capture' => 1,
            'notes' => [
            'udf1' => $user->id, // User Defined Field 1
            'udf2' => $user->user_code, // User Defined Field 2
            'name' => $user->name,
            'email'=> $user->email,
            'contact'=> $user->phone_number_1,
            // Add more UDFs as needed
        ]
        ]);
        // Store the order ID or other necessary details in your database for future reference
        DB::table('payu_transactions')->insert([
    	'paid_for_id' => $user->id,
    	'paid_for_type' => 'App\Models\User',
    	'transaction_id' => $order->id,
		'gateway'		=> 'AXIS Razor Pay',
		'body'			=> serialize($order),
		'destination'	=> route('member.axisstatus'),
		'hash'			=> '',
		'response'		=> '',
		'status'		=> 'pending',
		'created_at'	=> Carbon::now('Asia/Kolkata'),
		'updated_at'	=> Carbon::now('Asia/Kolkata'),

		]);

        Session::put('axisTransactionId', $order->id);

        return view('member.axisredirectform', ['order' => $order]);

        }
        

        
    }

}
