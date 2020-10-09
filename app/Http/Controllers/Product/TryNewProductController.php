<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class TryNewProductController extends Controller
{
    public function trysomethingnew()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        return view('trysomethingnew', ["item_carousel" => $getAdvertise]);
    }

    public function Liontinproduct()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataliontin = product::sortable()->where("Product_type","=","3")->paginate(6);
        return view("Product.liontin",["items" => $getdataliontin], ["item_carousel" => $getAdvertise]);
    }

    public function Ringproduct()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataring = product::sortable()->where("Product_type","=","5")->paginate(6);
        return view("Product.ring",["items" => $getdataring], ["item_carousel" => $getAdvertise]);
    }



}
