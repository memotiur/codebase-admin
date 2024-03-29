<?php

namespace App\Http\Controllers;

use App\Imports\DataImport;
use App\Models\PageView;
use App\Models\PageVisitor;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function home(Request $request)
    {
        return view("frontend.home.index");
    }

    public function postDetails($id)
    {

        $result = Post::where('id', $id)->first();
        return view("test")->with("result", $result);
    }

    public function mail()
    {

        $data = array(
            'invoice' => uniqid(),
            'full_name' => "Motiur Rahaman",
            'phone_number' => "017178499658",

            'date' => Carbon::now(),
            'url' => \url("/"),
        );
        $admin_email = "memotiur@gmail.com";
        Mail::send('email-template/confirm', $data, function ($message) use ($admin_email) {
            $message->to($admin_email)
                ->subject('Mail from CEO');
            $message->from('motiur@gmail.com', 'Motiur Rahaman would like to be your friend on e-Verify');
        });

        return "mail";
    }

    public function qrCode()
    {
        return QrCode::generate('Make me into a QrCode!');

        return QrCode::generate('Make me into a QrCode!', '../public/images/favicon.png');;
    }

    public function import()
    {
        $rows = Excel::toArray(new DataImport, 'users.xlsx');
        return response()->json(["rows" => $rows]);
    }


}
