<?php

namespace App\Http\Controllers\Inquiry;

use DB;
use Sentinel;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class Inquiry extends Controller
{
    public function inquiryespay(Request $request)
    {
        // Your Credentials provided by Espay Team
        $espaypassword      = "%KCO*U4QQW";
        $espaysignaturekey  = "osh9394oacjoyyeo";

        $order_id           = (!empty($_REQUEST['order_id']) ? $_REQUEST['order_id'] : '');
        $passwordServer     = (!empty($_REQUEST['password']) ? $_REQUEST['password'] : '');
        $signaturePostman   = (!empty($_REQUEST['signature']) ? $_REQUEST['signature'] : '');
        $rq_datetime        = (!empty($_REQUEST['rq_datetime']) ? $_REQUEST['rq_datetime'] : '');


        // Construct the signature
        // Format: ##KEY##rq_datetime##order_id##mode##
        $key = '##' . $espaysignaturekey . '##' . $rq_datetime . '##' . $order_id . '##' . 'INQUIRY' . '##';

        // Next, the string will have to be converted to UPPERCASE before hashing is done.
        $uppercase = strtoupper($key);
        $generatedSignature = hash('sha256', $uppercase);

        // validate the password
        // if ($espaypassword == $passwordServer) {

        // Validate Signature
            // if ($generatedSignature == $signaturePostman) {
                    
                    // Validate the given order id from espay inquiry request
                    // from your db or persistent
                    
                    // $transaction = Orders::where('status','new')->get();
                    $transaction = Orders::orderBy('id','DESC')->first();
    
                if (!$transaction) {
                    echo '1;Order Id Does Not Exist;;;;;'; // if order id not exist show plain reponse
                } else {
                    // if order id truly exist get order detail from database
                    // and give the response, format: error_code;error_message;order_id;amount;ccy;description;trx_date
                    // foreach($transaction as $transaction){
                        $order_id               = $transaction->code;
                        $grand_total            = $transaction->grand_total;
                        $currency               = "Rp";
                        $customer_first_name    = $transaction->customer_first_name;
                        $customer_last_name     = $transaction->customer_last_name;
                    // };
                    
                    // show response
                    // see TSD for more detail
                    echo '0;Success;' . $order_id . ';' . $grand_total . ';' . $currency . '; Pembayaran Order ' . $order_id . ' oleh ' . $customer_first_name . ' ' . $customer_last_name . ';' . date('Y/m/d H:i:s') . '';
                }
            // } else {
                // return '1;Invalid Signature Key;;;;;';
            // }
        // } else {
            // if password not true
            // return '1;Merchant Failed to Identified;;;;;';
        // }
    }

    public function paymentinquiry()
    {
        if(Sentinel::check()){
            // $transaction = Orders::where('status','new')->get();
            $sessionKey = session()->get("sessionKey");
            $transaction = Orders::where("user_id","=",$sessionKey)-> orderBy('id','DESC')->first();
        }

        
        // return view('Payment.paymenttransaction',compact('transaction
        // return view('Payment.paymenttransaction',['transaction' => $transaction]);
        // dd($transaction);
    }

}