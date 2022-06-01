<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view("admin.home.dashboard");
    }

    public function logOut()
    {
        Auth::logout();
        return Redirect::to("/login");
    }
}
