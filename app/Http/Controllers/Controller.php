<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {

       //
        // return view("test");
        return "home";
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
}
