<?php

namespace App\Http\Controllers\Product;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function search_product(Request $request){
        $request->validate([
           'filter' => 'required|min:3',
        ]);

        $query = $request->input('filter');
        $filter = Product::where('Product_Name','like', '%'.$query.'%')->paginate(6);
        return view('Product.searchproduct')->with('filter', $filter);
    }

    public function homeslidertry()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdatahomeslider = product::orderBy('created_at','desc')->where("status","=",1)->take(6)->get();
        return view("/home",["item_slider" => $getdatahomeslider, "item_carousel" => $getAdvertise]);
    }

    public function productall()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataproductall = product::sortable()->where("status","=",1)->paginate(6);
        return view('Product.productall',['products' => $getdataproductall], ["item_carousel" => $getAdvertise] );
    }

    public function productallwomen()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataproductallwomen = product::sortable()->where("Gender","=",0)->where("status","=",1)->paginate(6);
        return view('Product.productwomen',['products' => $getdataproductallwomen], ["item_carousel" => $getAdvertise]);
    }

    public function productallmale()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataproductallmen = product::sortable()->where("Gender","=",1)->where("status","=",1)->paginate(6);
        return view('Product.productmale',['products' => $getdataproductallmen], ["item_carousel" => $getAdvertise]);
    }

    public function productallchild()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataproductallchild = product::sortable()->where("Gender","=",3)->where("status","=",1)->paginate(6);
        return view('Product.productchild',['products' => $getdataproductallchild], ["item_carousel" => $getAdvertise]);
    }

    public function productalluniv()
    {
        $getAdvertise = DB::table("advertise")->orderBy('created_at','desc')->where("status","=",1)->get();
        $getdataproductalluniversal = product::sortable()->where("Gender","=",2)->where("status","=",1)->paginate(6);
        return view('Product.productuniversal',compact('getdataproductalluniversal'), ["item_carousel" => $getAdvertise]);
    }


    public function detailproduct($id_product)
    {
        $getData        = product::where('productID',$id_product)->get();
        $getproducts    = DB::table("product")->orderBy("Product_type","desc")->take(6)->get();
        $gettype        = DB::table("product")->join('diamondtype', 'diamondtype.id', '=', 'product.typeID') ->where('productID',$id_product)->get();
        $getBerlian     = DB::table('product')->select('productID', 'berlian_karat1', 'berlian_karat2', 'berlian_karat3', 'berlian_karat4', 'quantity_berlian1', 'quantity_berlian2', 'quantity_berlian3', 'quantity_berlian4')->where('productID', $id_product)->first();
        $total_berlian  = ($getBerlian->berlian_karat1 * $getBerlian->quantity_berlian1) + ($getBerlian->berlian_karat2 * $getBerlian->quantity_berlian2) + ($getBerlian->berlian_karat3 * $getBerlian->quantity_berlian3) + ($getBerlian->berlian_karat4 * $getBerlian->quantity_berlian4);

        $getQuantity = DB::table('product')->select('productID', 'stock')->where('productID', $id_product)->first();
        if ($getQuantity->stock >= 1) {
            $stockLevel  = '<div class="badge badge-primary">In Stock</div>';
        } elseif($getQuantity->stock < 1 && $getQuantity->stock > 0) {
            $stockLevel  = '<div class="badge badge-warning">Low Stock</div>';
        } else {
            $stockLevel = '<div class="badge badge-danger">Not Available</div>';
        }

        return View('Product.detailproduct', compact('getData','getproducts','stockLevel', 'gettype', 'total_berlian'));
    }


}
