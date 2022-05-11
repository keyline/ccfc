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

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {

        //$user = User::where('id', '=', session('LoggedMember'))->first();
        $user= User::find(session('LoggedMember'))->first();
        
        if ($user) {
            $validated = $request->validate([
        'amount' => 'required|numeric'
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

        if (!empty($user)) {
            $emailInfo= array(
                'greeting' => "Dear, {$user->name}",
                'body'     => "Thank you for making payment of Rs.{$status['amount']}. Please note that payment is subject to realization and will reflect in your account in the next 24 hours."
            );

            Notification::send($user, new PayUEmailNotification($emailInfo));
        }

        return view('member.paymentstatus', compact('status'));
    }
}
