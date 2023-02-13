<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;
use App\Models\School;
use App\Models\Employee;
use App\Models\PaypalPayment;
use App\Models\MpesaPayment;
use Auth;

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
    //return the page that has payment instructions(mpesa and paypal)
    public function payment(){
        $school = School::find(Auth::user()->school_id);
        if($school->payment_status == 'Payment Complete'){
            return view('payments/addPayment', ['message'=>'Payment Complete']);
        }else{
            return view('payments/addPayment', ['message'=>'Payment Pending']);
        }
        
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
    //Processes successful paypal payment
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

                $payment = new PaypalPayment();
                $payment->transaction_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                if (Auth::check()){
                    $payment->paid_by = Auth::user()->school_id;

                    $school = School::find(Auth::user()->school_id);

                    $school->payment_status = 'Payment Complete';

                    $payment->save();
                    $school->save();
                }
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


    public function cancelPayment(){
        return view('payments/cancelled');
    }

    //C2B MPESA 

    //return the page with mpesa form
    public function mpesaPayment(){
        $phoneNo = Employee::find(Auth::user()->id)->telephone_number;
        $school = School::find(Auth::user()->school_id);

        if($school->payment_status == 'Payment Complete'){
            return view('payments/lipaNaMpesa', ['message'=>'Payment Complete', 'phoneNumber'=>$phoneNo]);
        }else{
            return view('payments/lipaNaMpesa', ['message'=>'Payment Pending', 'phoneNumber'=>$phoneNo]);
        }
        
    }

    //mpesa password generation
    public function lipaNaMpesaPassword(){
        //generate timestamp
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        //use passkey
        $passKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        //businessShortcode
        $businessShortCode = 174379;
        //generate password
        $mpesaPassword = base64_encode($businessShortCode.$passKey.$timestamp);

        return $mpesaPassword;
    }

    //mpesa generate access token request
    public function newAccessToken(){
        $consumer_key = "ubqH6wgnrcANAAJD2HN9AZNG6YF7tReY";
        $consumer_secret = "Ng4Z5Y6bvXnqG4bx";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

        //POST request using curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        curl_close($curl);

        return $access_token->access_token;
    }
    //mpesa send stk push request using the access token
    //if successful prompts user for pin to pay and payment is deducted
    public function stkPush(Request $request)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $phone =  $request->phoneNo;
        $formatedPhone = substr($phone, 1); //7*******
        $code = "254";
        $phoneNumber = $code.$formatedPhone; //2547*******

        $curl_post_data = [
            'BusinessShortCode' =>174379,
            'Password' => $this->LipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request->amount,
            'PartyA' => $phoneNumber,
            'PartyB' => 174379,
            'PhoneNumber' => $phoneNumber,
            //mpesa sends transaction response to this callback url
            'CallBackURL' => 'https://490e-105-162-23-59.ngrok.io/api/stk/push/callback/url',
            'AccountReference' => "Student Management System Payment",
            'TransactionDesc' => "Lipa Na M-PESA"
        ];

        $data_string = json_encode($curl_post_data);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->newAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return redirect('/mpesaconfirmation');
    }

    //Save MPESA data to database
    public function mpesaResponse(Request $request){
        $response = json_decode($request->getContent());

        $responseData = $response->Body->stkCallback->CallbackMetadata;
        $amount = $responseData->Item[0]->Value;
        $transactionID = $responseData->Item[1]->Value;
        $transactionDate = date("Y-m-d H:i:s", strtotime($responseData->Item[3]->Value));
        $phoneNumber = $responseData->Item[4]->Value;

        $transaction = new MpesaPayment();
        $transaction->transaction_id = $transactionID;
        $transaction->transaction_date = $transactionDate;
        $transaction->amount = $amount;
        $transaction->phone_number = $phoneNumber;

        if (Auth::check()){
            $transaction->paid_by = Auth::user()->school_id;
        }
        $transaction->save();
    }

    public function mpesaConfirmation(){
        $school = School::find(Auth::user()->school_id);
        if($school->payment_status == 'Payment Complete'){
            return view('payments/mpesaConfirmation', ['message'=>'Payment Complete']);
        }else{
            return view('payments/mpesaConfirmation', ['message'=>'Payment Pending']);
        }
    }
    public function checkTransaction(Request $request){
        $request->validate([
            'transaction' => 'required'
        ]);

        $transaction = $request->transaction;
        $dbTransaction = MpesaPayment::all()->where('transaction_id', $transaction)->first();

        if($dbTransaction){
            $dbTransaction->paid_by = Auth::user()->school_id;
            $school = School::find(Auth::user()->school_id);

            $school->payment_status = 'Payment Complete';

            $dbTransaction->save();
            $school->save();

            return redirect('/paymentsuccess');
        }else{
            return redirect()->back()->with('message', 'Transaction not found. Please try again');
        }
    }
    //convert kenyan shillings to USD and vice versa to use in paypal
    public static function exchangeRates($amount, $from){
        // Fetching JSON
        $req_url = 'https://v6.exchangerate-api.com/v6/bb190d74f640fa30bf8c5b35/latest/'.$from;
        $response_json = file_get_contents($req_url);

        // Continuing if we got a result
        if(false !== $response_json) {
            // Decoding
            $response = json_decode($response_json);

            // Check for success
            if('success' === $response->result) {
                // YOUR APPLICATION CODE HERE, e.g.
                $base_price = $amount; // Your price to convert from

                //From KES to USD
                if($from == 'KES'){
                    $intended_price = round(($base_price * $response->conversion_rates->USD), 2);
                }
                //From USD to KES
                else if($from == 'USD'){
                    $intended_price = round(($base_price * $response->conversion_rates->KES), 2);
                }
            }
        }
        return $intended_price;
    }

    //specific user transactions/payments
    public function myTransactions(){
        if(Auth::check()){
            $school = Auth::user()->school_id;
        }
        $paypal = PaypalPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->get();
        $mpesa = MpesaPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->get();

        $transaction = $paypal->concat($mpesa)->paginate(10);

        return view('payments/viewMyTransactions', ['transactions'=>$transaction]); 
    }

    //all users transactions/payments
    public function viewPayments(){
        $paypal = PaypalPayment::where('status', 'Active')->get();
        $mpesa = MpesaPayment::where('status', 'Active')->get();
        $transaction = $mpesa->concat($paypal)->paginate(10);

        return view('payments/ViewAllPayments', ['transactions'=>$transaction]);
    }

    public function filterAllPaymentsByMethod(){
        if(request('paymentMethod') == 'all'){
            $paypal = PaypalPayment::where('status', 'Active')->get();
            $mpesa = MpesaPayment::where('status', 'Active')->get();
            $transaction = $mpesa->concat($paypal)->paginate(10);
        }else if(request('paymentMethod') == 'mpesa'){
            $transaction = MpesaPayment::where('status', 'Active')->paginate(10);
        }else{
            $transaction = PaypalPayment::where('status', 'Active')->paginate(10);
        }
        return view('payments/ViewAllPayments', ['transactions'=>$transaction]);
    }

    public function filterMyPaymentsByMethod(){
        if(Auth::check()){
            $school = Auth::user()->school_id;
        }

        if(request('myPaymentMethod') == 'all'){
            $paypal = PaypalPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->get();
            $mpesa = MpesaPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->get();

            $transaction = $paypal->concat($mpesa)->paginate(10);
        }else if(request('myPaymentMethod') == 'mpesa'){
            $transaction = MpesaPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->paginate(10);
        }else{
            $transaction = PaypalPayment::orderBy('created_at', 'desc')->where('paid_by', $school)->where('status', 'Active')->paginate(10);
        }
        return view('payments/viewMyTransactions', ['transactions'=>$transaction]);
    }
}