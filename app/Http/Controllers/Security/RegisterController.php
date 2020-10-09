<?php

namespace App\Http\Controllers\Security;

use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    public function register()
    {
        return view('security.register');
    }

    public function registeruser(Request $request)
    {
        $user = Sentinel::registerAndActivate($request->all());
        echo 'User registered';
        return redirect('/login');
    }
}
