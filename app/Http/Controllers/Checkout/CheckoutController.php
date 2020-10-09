<?php

namespace App\Http\Controllers\Checkout;

use Cart;
use Redirect;
use Sentinel;
use App\City;
use App\Orders;
use App\Courier;
use App\voucher;
use App\product;
use App\Province;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CheckoutController extends Controller
{

    public function checkoutview()
    {
        return view('Checkout.checkout-view');
    }

    public function orderhistory()
    {
        if(Sentinel::check()) {
            $all_order = DB::table('orders')
                ->join('product','orders.ProductID','=',"product.productID")
                ->join('users','orders.user_id','=',"users.id")
                ->select('orders.*', 'product.*')
                ->where('orders.user_id', '=', Sentinel::getUser()->id)
                ->get();

                return view('Checkout.order-history', compact('all_order'));
        } else {
            return redirect()->back()->with(['error' => "Please Login Or Register First.!"]);
        }
    }

    public function checkout()
    {
        $kd="";
        $query = DB::table('transaction_detail')
        ->select(DB::raw('MAX(RIGHT(TransactionID,4)) as kd_max'))
        ->whereDate('created_at',Carbon::today());
        if ($query->count()>0) {
            foreach ($query->get() as $key ) {
                $tmp = ((int)$key->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
                $kd = "0001"; }
        $kodetransaksi = "PHOENIX-".date('dmy').$kd;

        $couriers       = Courier::pluck('title', 'code');
        $provinces      = Province::pluck('title', 'province_id');
        // $discount       = session()->get('voucher')['discount'] ?? 0;
        $cartConditions = Cart::getConditions();
        $cartTotal      = Cart::getTotal();

        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', 'https://sandbox-api.espay.id/rest/merchant/merchantinfo', [
        //     'form_params' => [
        //                         'key' => 'bd1e4ce8945808f8e6ef9c50c834d0c2',
        //                     ]
        // ]);
        // $result     = $response->getBody()->getContents();
        // $results    = json_decode($result, true);//jadi data array
        // $espay      = $results["data"];
        // dd($results);
        // $BCA        = $results[0]['productName'];
        // $BNI        = $results[1];
        // $BRI        = $results[3];
        // $CC         = $results[14];
        if(Sentinel::check()){
            if (Cart::getContent()->count() == 0) {
                return Redirect::to('product.all');
            } else {
                return View('Checkout.checkout-view', compact('couriers','provinces'))->with([
                    'kode'              => $kodetransaksi,
                    'cartConditions'    => $cartConditions,
                    'cartTotal'         => $cartTotal,
                    // 'discount'          => $discount,
                    // 'results'           => $espay,
                    // 'BCA'               => $BCA,
                    // 'BNI'               => $BNI,
                    // 'CC'                => $CC,
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_first_name'   => 'required',
            'customer_phone'        => 'required |max:12',
        ]);

        $data = Orders::create([
            'code'                  => 'PHOENIX-' . uniqid(),
            'user_id'               => $request->user_id,
            'ProductID'             => $request->ProductID,
            'status'                => "new",
            'order_date'            => Carbon::now(),
            'payment_status'        => "pending",
            'base_total_price'      => $request->base_total_price,
            'code_discount'         => $request->code_discount,
            'discount_amount'       => $request->discount_amount,
            'discount_percent'      => $request->discount_percent,
            'shipping_cost'         => $request->shipping_cost,
            'grand_total'           => $request->grand_total,
            'note'                  => $request->note,
            'customer_first_name'   => $request->customer_first_name,
            'customer_last_name'    => $request->customer_last_name,
            'customer_address'      => $request->customer_address,
            'customer_phone'        => $request->customer_phone,
            'customer_email'        => $request->customer_email,
            'customer_city_id'      => $request->customer_city_id,
            'customer_province_id'  => $request->customer_province_id,
            'customer_postcode'     => $request->customer_postcode,
            'customer_point'        => $request->customer_point,
            'quantity'              => $request->quantity,



        ]);
        dd($data);
        // $arr = array('msg' => 'Please check your form checkout', 'status' => false);
        // if($data){
        //     $arr = array('msg' => 'Tunggu beberapa saat untuk proses selanjutnya.', 'status' => true);
        // }
        // return Response()->json($arr);
        // return redirect()->route('inq.espay')->with('success',"Tunggu beberapa saat untuk proses selanjutnya.");

    }


    public function paymentdone()
    {
        if (Cart::getContent()->count() >= 1) {
            Cart::clear();
            return view('Payment.paymentdone');
        } else {
            return redirect('/order/detail');
        }
    }

    public function getCities($id)
    {
        $city   = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }
}