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
       $credentials= [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $user = Sentinel::registerAndActivate($credentials);

        $user_completed_data = User::where('email','=', $user->email)
                ->update(
                    [
                        'name' => $request->name,
                        'gender' => $request->gender,
                        'alamat' => $request->alamat,
                        'telp'=>$request->telp
                    ]);

       
        return redirect('/login');
    }
}
