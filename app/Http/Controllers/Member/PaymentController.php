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


class PaymentController extends Controller
{
    //
    public function payment(Request $request){

        //$user = User::where('id', '=', session('LoggedMember'))->first();
        $user= User::find(session('LoggedMember'))->first();
        
        if($user)
        {
            $data = $request->all();

            $customer = Customer::make()
                            ->firstName('John Doe')
                            ->email('john@example.com');
            
            // Associate the transaction with your invoice
            $transaction = Transaction::make()
                            ->charge($request->amount)
                            ->for('Order of iPhone 12')
                            ->against($user)
                            ->to($customer);
                          //dd($transaction);

            return Payu::initiate($transaction)->redirect(route('member.payment.status')); 
            
        }else
        {
            dd($user);
        }
    }

    public function status(){
        $transaction = Payu::capture();
        // Get the payment status.
        $payment->isCaptured(); // Returns boolean - true / false

        dd($transaction);

    }
}
