<?php

namespace App\Http\Controllers;


use App\Models\PageView;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function dashboard()
    {
        DB::statement("SET SQL_MODE=''");
        $result = PageView::groupBy('ip_address')->get();
        $today = PageView::whereDate('created_at', today())->count();
        $total_visitors = count($result);
        $total_page_views = PageView::count();
        $total_users = User::count();
        return view('admin.home.dashboard', compact('total_visitors', 'total_page_views', 'total_users', 'today'));
    }

    public function profile()
    {
        return view("admin.setting.profile");
    }

    public function profileUpdate(Request $request)
    {


        if ($request['password'] != null) {
            $data = [
                "name" => $request['name'],
                "email" => $request['email'],
                "password" => Hash::make($request['password']),
            ];
        } else {
            $data = [
                "name" => $request['name'],
                "email" => $request['email'],
            ];
        }

        try {
            User::where('id', Auth::user()->id)->update($data);
            Alert::success('Success ', "Profile Updated");

        } catch (\Exception $exception) {

            Alert::error('Error ', getErrorMessage($exception->getMessage(), "There is an error. Try later"));
        }

        return back();

    }

    public function logOut()
    {
        Auth::logout();
        return Redirect::to("/login");
    }
}
