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

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {

        //$user = User::where('id', '=', session('LoggedMember'))->first();
        $user= User::find(session('LoggedMember'))->first();
        
        if ($user) {
            $validated = $request->validate([
        'amount' => 'required|numeric|min:1'
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
            $data= $hdfcPaymentService->processPayment(100);
            //dd($data);
            return view('member.hdfcredirectform', $data);
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
            }
            return view('member.paymentstatusotherpgs', compact('status'));
        }
    }

    public function showPaymentStatus(Request $request)
	{
		$data = $request->session()->get('data');

		return view('member.paymentstatusotherpgs', compact('data'));


	}

    public function callback(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Process the payment callback logic here

        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), config('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'order_receipt', // Replace with your own unique identifier for the order
            'amount' => $request->axis_amount, // Replace with the actual amount from your form or request
            'currency' => 'INR', // Replace with your desired currency
            'payment_capture' => 1,
        ]);

        // Store the order ID or other necessary details in your database for future reference

        return view('payment.checkout', ['order' => $order]);
    }

}
