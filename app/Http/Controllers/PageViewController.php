<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Http\Request;

class PageViewController extends Controller
{

    public function traffic(Request $request)
    {
        $query = PageView::orderBy("created_at", "DESC");
        if ($request['ip_address'] != null) {
            $query->where("ip_address", "LIKE", "%" . $request['ip_address'] . "%");
        }
        if ($request['date'] != null) {
            $query->whereDate("created_at", $request['date']);
        }
        $count = $query->count();
        $data = $query->paginate(25);

        return view("admin.pageview.index")
            ->with('results', $data)
            ->with('count', $count)
            ->with('request', $request);
    }
}
