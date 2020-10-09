<?php

namespace App\Http\Controllers\Product;

use App\User;
use Sentinel;
use Validator;
use App\CustomizeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CustomizeProductController extends Controller
{
    public function customizeproductview()
    {
        if(sentinel::check()){
            return view('Product.customizeproduct');
        } else {
            return redirect()->back()->with('error','Please Login or Register first.!');
        }
    }

    public function customizeproductsave(Request $request)
    {
        $user       = Sentinel::getUser()->id;

        $this->validate($request, [
            'nama'      => 'required',
            'contact'   => 'required |max:12',
            'email'     => 'string|email|unique:users',
            'kebutuhan' => 'required',
            'referensi' => 'required',
        ]);

        $image = $request->file('referensi');
        $input['imagename'] = $image->getClientOriginalName();
        $destPath = public_path('/storage/CustomizeProductImg');
        $image->move($destPath, $input['imagename']);
        $data = CustomizeProduct::create([
            'user_id'   => $user,
            'nama'      => $request->nama,
            'contact'   => $request->contact,
            'email'     => $request->email,
            'kebutuhan' => $request->kebutuhan,
            'referensi' => $input['imagename'],
            'infotmbh'  => $request->infotmbh
            ]
        );
        return redirect()->route('home')->with('success',"Berhasil mengisi form, Tunggu beberapa saat admin kami akan mengirim pesan email untuk proses selanjutnya.");
    }
}
