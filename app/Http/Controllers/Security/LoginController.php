<?php

namespace App\Http\Controllers\Security;

use Mail;
use App\User;
use Sentinel;
use Reminder;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller
{
    public function login()
    {
        if(Sentinel::check()){
            return redirect('/');
        }
        return view('security.login');
    }

    public function postLogin(Request $request)
    {
        // Sentinel::disableCheckpoints();
        $errorMsgs = [
            'email.required'    => 'Please provide email id',
            'email.email'       => 'the email must be a valid email',
            'password.required' => 'password is required'
        ];

        $validator  = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required'
        ], $errorMsgs);

        if($validator->fails()){
            $returnData = array(
                'status'    => 'error',
                'message'   => 'Please review fields',
                'errors'    => $validator->errors()->all()
            );
            // return response()->json($returnData, 500);
            return redirect()->back()->with(['error'=>$validator->errors()->all()]);
        }

        if($request->remember == 'on'){
            try {
                $user   = Sentinel::authenticateAndRemember($request->all());
            } catch (ThrottlingException $e) {
                $delay      = $e->getDelay();
                $returnData = array(
                    'status'    => 'error',
                    'message'   => 'please review',
                    'errors'    => ["You are banned for $delay seconds."]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error'=>"You are banned for $delay seconds."]);
            } 
            catch(NotActivatedException $e){
                $returnData = array(
                    'status'    => 'error',
                    'message'   => 'please review',
                    'errors'    => ["please activate your account"]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error'=>"please activate your account."]);
            }
        } else {
            try {
                $user   = Sentinel::authenticate($request->all());
            } catch (ThrottlingException $e) {
                $delay      = $e->getDelay();
                $returnData = array(
                    'status'    => 'error',
                    'message'   => 'please review',
                    'errors'    => ["You are banned for $delay seconds."]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error'=>"You are banned for $delay seconds."]);
            } catch(NotActivatedException $e){
                $returnData = array(
                    'status'    => 'error',
                    'message'   => 'please review',
                    'errors'    => ["please activate your account"]
                );
                // return response()->json($returnData, 500);
                return redirect()->back()->with(['error'=>"please activate your account."]);
            }
        }

        if(Sentinel::check()){
            return redirect('/');
        } else {
            $returnData = array(
                'status'    => 'error',
                'message'   => 'please review',
                'errors'    => ["Email or password mismatched."]
            );
            return redirect()->back()->with(['error'=>"Email or password mismatched."]);
        }
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }

    public function forgot()
    {
        return view('security.forgotpassword');
    }

    public function forgotpassword(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if($user == null){
            return redirect()->back()->with(['error' => 'Email tidak ada']);
        }

        $user       = Sentinel::findById($user->id);
        $reminder   = Reminder::exists($user) ? : Reminder::create($user);
        // dd($reminder);
        $this->sendEmail($user, $reminder->code);
        return redirect()->back()->with(['success' => 'Reset Password kirim ke email anda']);
    }

    public function sendEmail($user, $code)
    {
        Mail::send(
            'email.forgot',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("$user->name, reset your password.");
            }
        );
    }

    public function reset($email, $code)
    {
        $user   = User::whereEmail($email)->first();

        if($user == null)
        {
            echo 'Email not exists';
        }

        $user       = Sentinel::findById($user->id);
        $reminder   = Reminder::exists($user);


        if($reminder){
            if($code){
                return view('security.resetpassword')->with(['user'=>$user, 'code'=>$code]);
            } else {
                return redirect('/');
            }
        } else {
            echo 'time expired';
        }
    }

    public function reset_password(Request $request, $email, $code)
    {
        $this->validate($request, [
            'password'              => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);

        $user   = User::whereEmail($email)->first();
        if($user == null){
            echo 'Email not exists';
        }

        $user       = Sentinel::findById($user->id);
        $reminder   = Reminder::exists($user);


        if($reminder){
            if($code){
                Reminder::complete($user, $code, $request->password);
                return redirect('/login')->with('success','Password reset. Please login with new password.');
            } else {
                return redirect('/');
            }
        } else {
            echo 'Time Expired';
        }
    }


}
