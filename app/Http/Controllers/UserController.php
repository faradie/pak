<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function fetch(){
        $users = User::all();
        // dd($users);
        return view('pages.manageusers', compact('users'));
    }
}
