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

function getDateOnly($month, $employee_id)
{
    $data = InOutMonitor::where('user_id', $employee_id)
        ->whereDate('in_time', $month)
        ->first();
    if (is_null($data)) {
        return "-";
    } else {
        return $data;
    }
}

function getTimeOnly($date)
{
    return Carbon::createFromFormat('H:i:s', $date)->format('h:i:s');
}

function getLoginHistory()
{
    return LoginHistory::leftJoin('admin_roles', 'admin_roles.id', '=', 'login_histories.admin_id')->orderBy('login_histories.created_at', 'DESC')
        ->select('login_histories.created_at',
            'login_histories.updated_at',
            'admin_roles.name',
            'admin_roles.phone',
        )->limit(10)
        ->get();
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

function generateSlug($string)
{

    return preg_replace('#[ -]+#', '-', $string);
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


?>
