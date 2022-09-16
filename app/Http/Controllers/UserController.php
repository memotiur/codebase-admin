<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::orderBy('created_at', 'DESC')->get();
        return view("admin.user.show")->with('results', $result);
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
            'name' => 'required',
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
            $destinationPath = public_path('/uploads/user');
            $image->move($destinationPath, $image_name);
            $image_file = '/uploads/user/' . $image_name;
        }

        $request['profile_pic'] = $image_file;
        $request['password'] = Hash::make($request['password']);


        try {
            User::create($request->except(['_token', '_method', 'image']));

            Alert::success("Success", "Successfully user Created");
        } catch (\Exception $exception) {

            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return "Show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return "Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ]);


        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }

        $image_file = $user->profile_pic;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user');
            $image->move($destinationPath, $image_name);
            $image_file = '/uploads/user/' . $image_name;
        }

        $request['profile_pic'] = $image_file;
        if ($request['password'] != null) {
            $request['password'] = Hash::make($request['password']);
        } else {
            unset($request['password']);
        }


        try {
            User::where('id', $user->id)->update($request->except(['_token', '_method', 'image']));

            Alert::success("Success", "Successfully user Updated");

        } catch (\Exception $exception) {

            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {


        try {
            User::where('id', $user->id)->delete();

            Alert::success("Success", "Successfully Deleted");

        } catch (\Exception $exception) {


            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }
}
