<?php

namespace App\Http\Controllers\Payment;

use DB;
use Sentinel;
use App\Orders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentnotification()
    {
        // Your Credentials provided by Espay Team
        $espaypassword      = '%KCO*U4QQW';
        $espaysignaturekey  = 'osh9394oacjoyyeo';

        // Get detail from espay request
        $signatureFromEspay     = (!empty($_REQUEST['signature']) ? $_REQUEST['signature'] : '');
        $rq_datetime            = (!empty($_REQUEST['rq_datetime']) ? $_REQUEST['rq_datetime'] : '');
        $member_id              = (!empty($_REQUEST['member_id']) ? $_REQUEST['member_id'] : '');
        $order_id               = (!empty($_REQUEST['order_id']) ? $_REQUEST['order_id'] : '');
        $passwordServer         = (!empty($_REQUEST['password']) ? $_REQUEST['password'] : '');
        $debit_from             = (!empty($_REQUEST['debit_from']) ? $_REQUEST['debit_from'] : '');
        $credit_to              = (!empty($_REQUEST['credit_to']) ? $_REQUEST['credit_to'] : '');
        $product                = (!empty($_REQUEST['product_code']) ? $_REQUEST['product_code'] : '');
        $paidAmount             = (!empty($_REQUEST['amount']) ? $_REQUEST['amount'] : '');
        $paymentfee             = (!empty($_REQUEST['payment_fee']) ? $_REQUEST['payment_fee'] : 0);
        $payment_ref            = (!empty($_REQUEST['payment_ref']) ? $_REQUEST['payment_ref'] : '');
        $credit_to_name         = (!empty($_REQUEST['credit_to_name']) ? $_REQUEST['credit_to_name'] : '');
        $payment_datetime       = (!empty($_REQUEST['payment_datetime']) ? $_REQUEST['payment_datetime'] : '');
        $credit_to_bank         = (!empty($_REQUEST['credit_to_bank']) ? $_REQUEST['credit_to_bank'] : '');

        // Construct the signature
        // Format: ##KEY##rq_datetime##order_id##mode##
        $key = '##' . $espaysignaturekey . '##' . $rq_datetime . '##' . $order_id . '##' . 'PAYMENTREPORT' . '##';

        // Next, the string will have to be converted to UPPERCASE before hashing is done.
        $uppercase = strtoupper($key);
        $generatedSignature = hash('sha256', $uppercase);

        // validate the password
        if ($espaypassword == $passwordServer)
        {
            if ($generatedSignature == $signatureFromEspay) {
                // validate order id
                // #Code here ..
                if (!$invoiceId) {
                    echo '1,Order Id Does Not Exist,,,'; // if order id not exist show plain reponse
                } else {

                    // generate reconsile_id
                    $reconsile_id = $member_id . " - " . $order_id . date('YmdHis');

                    // Flag your transaction to be success here
                    //#Code here ..

                    // if done, show the response, format: success_flag,error message,reconcile_id, order_id,reconcile_datetime
                    echo '0,Success,' . $reconsile_id . ',' . $order_id . ',' . date('Y-m-d H:i:s') . '';

                }
            } else {
                    echo '1,Invalid Signature Key,,,';
                }
            } else {
                // if password not true
                echo '1,Password does not match,,,';
        }
    }
}
