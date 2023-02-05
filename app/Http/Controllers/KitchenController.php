<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class KitchenController extends Controller
{
    public function index()
    {
        $results= Kitchen::orderBy('id', 'DESC')->paginate(25);
        return view('admin.kitchen.index',compact('results'));

    }


    public function create()
    {
        return view('admin.kitchen.create');
    }


    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), [
                'title' => 'required',
             ]);
        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }*/

        if ($request->hasFile('image')) {
           $image = $request->file('image');
           $image_name = time() . '.' . $image->getClientOriginalExtension();
           $image_resize = Image::make($image->getRealPath());
           $image_resize->orientate()->fit(250, 300, function ($constraint) {
               /*$constraint->aspectRatio();*/
               $constraint->upsize();
           })->save(public_path('/images/' . $image_name));
           $request->merge(['featured_image' => "/images/".$image_name]);
        }

        if($request['password']!=null){
            $request['password'] = Hash::make($request['password']);
        }

        try{
            $data = $request->except('_token', '_method', 'image');
            Kitchen::create($data);
            Alert::success("Success", getErrorMessage("Kitchen", "created"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function show(Kitchen $kitchen)
    {
        return view('admin.kitchen.show',compact('kitchen'));
    }


    public function edit(Kitchen $kitchen)
    {
        return view('admin.kitchen.edit',compact('kitchen'));
    }

    public function update(Request $request, Kitchen $kitchen)
    {
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->orientate()->fit(250, 300, function ($constraint) {
                /*$constraint->aspectRatio();*/
                $constraint->upsize();
            })->save(public_path('/images/' . $image_name));
            $request->merge(['featured_image' => "/images/".$image_name]);
         }
         if($request['password']!=null){
            $request['password'] = Hash::make($request['password']);
         }


        try{
            $data = $request->except('_token', '_method', 'image');
            $kitchen->update($data);
            Alert::success("Success", getErrorMessage("Kitchen", "updated"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function destroy(Kitchen $kitchen)
    {
        try{
            $kitchen->delete();
            Alert::success("Success", getErrorMessage("Kitchen", "deleted"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }
    }
}
