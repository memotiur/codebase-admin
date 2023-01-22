<?php


use App\Models\Department;
use App\Models\InOutMonitor;
use App\Models\Leave;
use App\Models\LoginHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;


function gettotalDuration($inTime, $outTime)
{
    $startTime = Carbon::parse($inTime);
    $finishTime = Carbon::parse($outTime);
    $totalDuration = $finishTime->diffInSeconds($startTime);
    return gmdate('H:i:s', $totalDuration);
    $totalDuration = $finishTime->diffForHumans($startTime);
    return $totalDuration;
}

function getDateDifference($inTime, $outTime)
{
    $startTime = Carbon::parse($inTime);
    $finishTime = Carbon::parse($outTime);
    return $totalDuration = $finishTime->diffInDays($startTime);
    return gmdate('H:i:s', $totalDuration);
    $totalDuration = $finishTime->diffForHumans($startTime);
    return $totalDuration;
}


function getDateFormat($date)
{
    if ($date == null) {
        return "-";
    }
    $createdAt = Carbon::parse($date);
    return $createdAt->format('d M, Y g:i A');
}


function getTimeOnly($date)
{
    return Carbon::createFromFormat('H:i:s', $date)->format('h:i:s');
}


function getSummernoteFormatter($input_value)
{

    $detail = $input_value;
    $dom = new \domdocument();
    //$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $dom->loadHTML(mb_convert_encoding($detail, 'HTML-ENTITIES', 'UTF-8'));

    $images = $dom->getelementsbytagname('img');

    try {
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $image_name = time() . $k . '.png';
            $path = public_path() . '/uploads/summernote/' . $image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', '/uploads/summernote/' . $image_name);
        }
    } catch (\Exception $e) {

    }
    $detail = $dom->savehtml();
    return $detail;
}

function encryptString($data)
{
    return Crypt::encryptString($data);
}


function decryptString($data)
{
    return Crypt::decryptString($data);
}

function getErrorMessage($debug_message, $production_message)
{
    return $debug_message;
}

function validatePhoneNumber($phone)
{
    if ($phone == null) {
        return 0;
    }
    if (substr($phone, 0, 1) != '0') {
        $phone = "0" . $phone;
    }
    $pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
    if (preg_match($pattern, $phone)) {
        return 1;
    };
}

function getPlatformName()
{
    return "Qubit";
}


function getCopyright()
{
    return "Qubit Solution Lab";
}

function getCopyrightUrl()
{
    return "Qubit Solution Lab";
}


function isImage($image_file)
{
    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

    $explodeImage = explode('.', $image_file);
    $extension = end($explodeImage);

    if (in_array($extension, $imageExtensions)) {
        return 1;
    }
    $info = pathinfo($image_file);
    $ext = $info['extension'];
    if ($ext == "pdf") {
        return 2;
    }
    return 3;
}


function getYoutubeVideoId($link)
{
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    if ($matches != null) {
        $video = $matches[0];
    } else {
        $video = "";
    }
    return $video;
}

function getTextToUrl($link)
{
    return $link = preg_replace('/\s+/', '-', $link);

}


function getPosition($id)
{
    if ($id == 1) {
        return "Top bar";
    } elseif ($id == 2) {
        return "Navbar";
    }
    return "Footer";
}

function getIpAddressApikey()
{

    $key = [
        '508260a5c0fcef9a92d2deba2be95be7',
        'b26ebfcc565022a9471281f9c3413957',
        'b7f4193800273cc7a0d674f49bdf5655'
    ];
    return $key[array_rand($key)];
}

?>
