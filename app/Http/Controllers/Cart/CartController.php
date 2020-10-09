<?php

namespace App\Http\Controllers\Cart;

use Cart;
use Sentinel;
use App\Voucher;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function cartview()
    {
        $discount       = session()->get('voucher')['discount'] ?? 0;
        $newsubtotal    = (Cart::getSubTotal() - $discount);
        $cartConditions = Cart::getConditions();

        if(Sentinel::check()){
            return view('Cart.cart-view')->with([
                'discount'          => $discount,
                'newsubtotal'       => $newsubtotal,
                'cartConditions'    => $cartConditions,
            ]);
        }

    }

    public function addcart(Request $request)
    {
        if(Sentinel::check()) {
            $product        = product::find($request->productID);
            $shoppingcart   = array(
                                'id'            => $product->productID,
                                'name'          => $product->Product_Name,
                                'price'         => $product->Price,
                                'quantity'      => 1 ,
                                'image'         => $product->Product_img_1,
                            );
            // dd($shoppingcart);
            Cart::add($shoppingcart);
            return redirect()->back()->with(['success' => "$product->Product_Name has successfully beed added to the shopping cart!"]);
        } else {
            return redirect()->back()->with(['error' => "Please Login Or Register First.!"]);
        }
    }


    public function remove(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->route('cart.view')->with(['success' => "The shopping cart has remove!"]);
    }

    // public function minusqtycart(Request $request)
    // {
    //     $quantity      = $request->quantity;
    //     $productID     = $request->id;
    //     $product       = product::findOrFail($productID);
    //     $stock         = $product->stock;

    //     $cartqty    = Cart::update($request->id, array(
    //             'quantity' => -1,
    //         ));

    //     $arr = array('msg' => 'Please check your qty is more than product stock', 'status' => false);
    //     if($cartqty){
    //         $arr = array('msg' => 'Successfully Your Quantity reduce', 'status' => true);
    //     }
    //     return Response()->json($arr);

    // }

    public function updateqtycart(Request $request)
    {
        $quantity      = $request->quantity;
        $productID     = $request->id;
        $product       = product::findOrFail($productID);
        $stock         = $product->stock;


        if($quantity<$stock) {
            $cartqty    = Cart::update($request->id, array(
                'quantity' => $request->quantity, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
              ));
            $arr = array('msg' => 'Successfully Your Quantity Update', 'status' => true);
        } else {
            $arr = array('msg' => 'Please check your qty is more than product stock', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function applyvoucher()
    {
        $vcrcode    = request('voucherCode');
        $vcrquery   = Voucher::where('voucherCode', $vcrcode)->first();

        if(!$vcrquery) {
            return redirect()->back()->with('error','Sorry, Voucher Does not Exits!');
        }

        $condition  = new \Darryldecode\Cart\CartCondition(array(
            'name'      => $vcrquery->voucherCode,
            'type'      => $vcrquery->type,
            'target'    => 'total',
            'value'     => $vcrquery->value,
        ));

        Cart::condition($condition);
        // Cart::addItemCondition($condition);

        return redirect()->back()->with('success','Voucher applied');
    }


}
