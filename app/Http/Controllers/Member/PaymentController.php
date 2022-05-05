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

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {

        //$user = User::where('id', '=', session('LoggedMember'))->first();
        $user= User::find(session('LoggedMember'))->first();
        
        if ($user) {
            $data = $request->all();

            $customer = Customer::make()
                            ->firstName($user->name)
                            ->email($user->email);
            
            // Associate the transaction with your invoice
            $transaction = Transaction::make()
                            ->charge($request->amount)
                            ->for('Order of iPhone 12')
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
        
        dd($transaction->response);
        return view('member.paymentstatus', compact('status'));
    }
}
