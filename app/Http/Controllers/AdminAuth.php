<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuth extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod("post")) {

           // return $request->all();
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], true)) {
                return Redirect::to('/dashboard');
            } else {
                // Alert::error('Sorry! ', "Email or password does not match or Your are not active");
                return back()->withInput();
            }

        }
        return view("admin.auth.login");
    }
}
