<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use function GuzzleHttp\Promise\all;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy("created_at", "DESC")->get();
        return view("admin.page.show")->with("pages", $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.page.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ]);

        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }


        if ($request['is_active'] == null) {
            $request['is_active'] = false;
        }
        $request['slug'] = generateSlug($request['title']);
        //return $request->all();
        try {
            Page::create($request->except([
                '_token',
                '_method',
                'image',
            ]));

            Alert::success("Success", "Successfully Page Created");

        } catch (\Exception $exception) {

            return $exception->getMessage();
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view("admin.page.edit")->with("page", $page);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        try {
            Page::where("id", $page->id)->update($request->except([
                '_token',
                '_method',
                'image',
            ]));
            Alert::success("Success", "Successfully Page Created");
        } catch (\Exception $exception) {
            return $exception->getMessage();
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
