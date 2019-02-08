<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function fetch(){
        $users = User::all()->where('is_approved','1');
        // $users = DB::table('users')->where('is_approved', '=', 1)->get();
        // dd($users);
        return view('pages.manageusers', compact('users'));
    }

    public function fetchnewapplicant(){
        $users = User::all()->where('is_approved','0');
        // $users = DB::table('users')->where('is_approved', '=', 1)->get();
        // dd($users);
        return view('pages.verifyapplicant', compact('users'));
    }
}
