<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = Category::orderBy('created_at', 'DESC')->get();
        return view("admin.category.show")->with('result', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_title' => 'required',
            /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ]);

        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }

        $image_file = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/categories');
            $image->move($destinationPath, $image_name);
            $image_file='/uploads/categories/'.$image_name;
        }

        try {
            Category::create([
                'category_title' => $request['category_title'],
                'featured_image' => $image_file,
            ]);

            Alert::success("Success", "Successfully category Updated");
        } catch (\Exception $exception) {

            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return "Show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return "Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [
            'category_title' => 'required',
            /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ]);


        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }

        $image_file = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/categories');
            $image->move($destinationPath, $image_name);
            $image_file='/uploads/categories/'.$image_name;
        }


        try {
            Category::where('id', $category->id)->update([
                'category_title' => $request['category_title'],
                'featured_image' => $image_file,
            ]);

            Alert::success("Success", "Successfully category Updated");

        } catch (\Exception $exception) {

            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {


        try {
            Category::where('id', $category->id)->delete();

            Alert::success("Success", "Successfully Deleted");

        } catch (\Exception $exception) {


            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }
}
