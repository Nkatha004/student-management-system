<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Auth;
use App\Models\School;

class PaymentsController extends Controller
{
    private $gateway;
    //setup paypal
    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
    //return the page that has payment instructions(for now only paypal)
    public function payment(){
        return view('payments/addPayment');
    }
    //make payment using paypal
    public function pay(Request $request)
    {
        try {

            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    //Processes successful payment
    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            //Transaction details
            if ($response->isSuccessful()) {

                $arr = $response->getData();

                $payment = new Payment();
                $payment->transaction_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                if (Auth::check()){
                    $payment->paid_by = Auth::user()->id;

                    $school = School::find(Auth::user()->id);
                }
                $school->payment_status = 'Payment Complete';

                $payment->save();
                $school->save();

                return redirect('/paymentsuccess')->with('message', 'Payment is Successful');
            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return redirect('/cancelpayment')->with('message', 'Payment declined');
        }
    }
    //redirect upon successful payment
    public function paymentSuccess(){
        return view('payments/success');
    }

    //redirect upon error on payment
    public function errorOccured()
    {
        return redirect('/cancelpayment')->with('message', 'User declined the payment');
    }

    //specific user transactions/payments
    public function myTransactions(){
        if(Auth::check()){
            $user = Auth::user()->id;
        }
        $transactions = Payment::all()->where('paid_by', $user)->where('status', 'Active');

        return view('payments/viewMyTransactions', ['transactions'=>$transactions]);
    }

    public function cancelPayment(){
        return view('payments/cancelled');
    }

    //all users transactions/payments
    public function viewPayments(){
        $transactions = Payment::all()->where('status', 'Active');

        return view('payments/ViewAllPayments', ['transactions'=>$transactions]);
    }
}