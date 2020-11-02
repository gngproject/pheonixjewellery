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
        

    //     $user = User::create([
    //             'name' => $request->name,
               
    //             'alamat'=> $request->alamat,
    //             'telp'=> $request->telp,
    //             'gender' => $request->gender
    //         ]);
    //    echo $user;
        // dd ($user_completed_data->email);
        // echo 'User registered';
     return redirect('/login');
    }
}
