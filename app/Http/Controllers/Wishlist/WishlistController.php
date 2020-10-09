<?php

namespace App\Http\Controllers\Wishlist;

use Sentinel;
use App\product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class WishlistController extends Controller
{

    public function add($id_product)
    {
        if(Sentinel::check()) {
            $wishList = new Wishlist();
            $wishList->ProductID=$id_product;
            $wishList->UserID=Sentinel::getUser()->id;
            $res = $wishList->save();
            return redirect('Wishlist')->with('success', "successfully added to Wishlist !");
        } else {
            return back()->with('error', "Please Login First!");
        }
    }

    public function show()
    {
        $sessionKey = session()->all();
        $all_wishlist = DB::table('wishlist')
            ->join('product','wishlist.productID','=',"product.productID")
            ->join('users','wishlist.userID','=',"users.id")
            ->select('wishlist.*', 'product.*')
            ->where('wishlist.userID', '=', Sentinel::getUser()->id)
            ->get();

        return view('Product.wishlist',['wishlist_item' => $all_wishlist]);
    }


    public function delete($id_item)
    {
        echo $id_item;
        Wishlist::where('id','=',$id_item)->delete();
        return redirect('Wishlist')->with('error', "successfully been delete to Wishlist !");
    }

}
