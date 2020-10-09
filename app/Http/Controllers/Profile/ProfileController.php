<?php

namespace App\Http\Controllers\Profile;

use DB;
use App\User;
use Sentinel;
use Validator;
use App\Orders;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profileuser()
    {
        return view('profileuser');
    }

    public function profileupdate($id)
    {
       $visitor = User::find($id);
       return view('profileupdate',['visitor' => $visitor]);
    }

    public function updatedata(Request $request, $id)
    {
        $user = Sentinel::findById($id);
        $user->name    = $request->get("name");
        $user->email   = $request->get("email");
        $user->gender  = $request->get("gender");
        $user->alamat  = $request->get("alamat");
        $user->telp    = $request->get("telp");

        if($request->hasFile("photoktp"))
        {
            $user->photoktp = strval(str_replace("public","storage", $request->file('photoktp')->store("public/PhotoKtp")));

            if($user->userID == null){
                $user->userID = "US".date('y').''.date('m').''.rand(0,5000);
            }
        }

        if($request->hasFile("photo")){
            if($user->photo!=null){
                $willdelete = str_replace("storage","public",$user->photo);
                Storage::delete($willdelete);
                //ganti foto yang lama dengan yang baru yang lama di destroy
            }

            $temp_photo = strval( str_replace("public","storage", $request->file('photo')->store("public/Photo")));
            //Ganti directory dari public ke storage biar bisa kebaca di viewnya.
            $user->photo = $temp_photo;
        }

        $user->save();
        return redirect("/Profile-User")->with('success','Profile has been Updated.');
    }

}
