<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BundleProductController extends Controller
{

    public function Bundleproduct()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdatabundle = product::sortable()->where("Product_type","=",8)->where("status","=",1)->paginate(6);
        return view('Product.bundle',['bundle' => $getdatabundle], ["item_carousel" => $getAdvertise]);
    }
}