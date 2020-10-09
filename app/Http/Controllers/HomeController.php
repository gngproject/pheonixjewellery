<?php

namespace App\Http\Controllers;

use Sentinel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function faq()
    {
        return view('faq');
    }

    public function howuse()
    {
        return view('howtouse');
    }

    public function syaratketentuan()
    {
        if(Sentinel::check()){
            return view('syaratketentuan');
        } else {
            return redirect()->route('login')->with('error','Please Login or Register first.!');
        };
    }

    public function kebijakanprivasi()
    {
        return view('kebijakanprivasi');
    }
}
