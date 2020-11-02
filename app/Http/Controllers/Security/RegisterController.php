<?php

namespace App\Http\Controllers\Security;

 use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;


class RegisterController extends Controller
{
    public function register()
    {
        return view('security.register');
    }

    public function registeruser(Request $request)
    {
        // dd($request->all());
       $user = Sentinel::registerAndActivate($request->all());
        // $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'alamat'=> $request->alamat,
        //         'telp'=> $request->telp,
        //         'gender' => $request->gender
        //     ]);
       
       
        echo 'User registered';
        return redirect('/login');
    }
}
