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

        $page_views = PageVisitor::where('ip_address', $request->ip())->first();
        if (is_null($page_views)) {
            try {

                $url = "http://api.ipapi.com/" . $request->ip() . "?access_key=" . getIpAddressApikey();
                //http request
                $response = Http::get($url);
                //$data= json_decode($response->body());

                PageVisitor::create([
                    'ip_address' => $request->ip(),
                    'details' => $response->body(),
                ]);

                PageView::create([
                    'ip_address' => $request->ip(),
                    'details' => $response->body(),
                ]);

            } catch (\Exception $e) {

                //return $e->getMessage();
            }
        } else {
            try {
                PageView::create([
                    'ip_address' => $request->ip(),
                    'details' => $page_views->details,
                ]);
            } catch (\Exception $e) {
                //return $e->getMessage();
            }
        }

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
