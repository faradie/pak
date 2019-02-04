<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        // return View::make('pages.about');
        return view('pages.about');
    }

    
    
    // public function guest_index()
    // {
    //     return view('auth.login');
    // }
}
