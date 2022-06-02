<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                Alert::error('Sorry! ', "Email or password does not match or Your are not active");
                return back()->withInput();
            }

        }
        return view("admin.auth.login");
    }

    public function forgetPassword(Request $request)
    {
        if ($request->isMethod("post")) {

            $user = User::where('email', $request['email'])->first();

            if (!is_null($user)) {

                 $msg = url("/") . "/reset-password/" . encryptString($user->id);
                mail($user->email, "Password Reset", $msg);

                alert()->success('Success', 'An email sent to you. Please check your Mail.');

                return back();
            } else {
                alert()->error('Error', 'Email not Found');
            }

            return back();
        } else {

            return view("admin.auth.forget-password");
        }
    }

    public function resetPassword($id, Request $request)
    {

        if ($request->isMethod("post")) {

            $id = decryptString($request['id']);
            try {
                User::where('id', $id)->update([
                    'password' => Hash::make($request['password'])]);
                alert()->success('Success', 'Password Reset Successfully');
                return Redirect::to("/login");

            } catch (\Exception $exception) {
                alert()->error('Error', $exception->getMessage());
                return back();
            }

        } else {
            return view("admin.auth.reset-password")->with('id', $id);
        }

    }
}
