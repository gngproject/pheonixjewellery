<?php

namespace App\Http\Controllers\Product;

use App\User;
use Sentinel;
use Validator;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpecialProductController extends Controller
{

    public function index()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        return view("Product.spesialproduct", ["item_carousel" => $getAdvertise]);
    }

    public function spesialproductgia()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdatagia = product::sortable()->where("Product_type","=","2")->where("status","=",1)->paginate(6);
        return view("Product.GIA",["itemsGIA" => $getdatagia], ["item_carousel" => $getAdvertise]);
    }

    public function spesialproductlm()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataLM = product::sortable()->where("Product_type","=","7")->where("status","=",1)->paginate(6);
        return view("Product.LM",["itemsLM" => $getdataLM], ["item_carousel" => $getAdvertise]);
    }


}

