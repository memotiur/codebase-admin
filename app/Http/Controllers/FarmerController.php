<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class FarmerController extends Controller
{
    public function index(Request $request)
    {

        $query= Farmer::orderBy('id', 'DESC');
        if($request['search']!=null){
            $query->where('password', 'like', '%'.$request['search'].'%');
        }
        $results= $query->paginate(25);
        return view('admin.farmer.index',compact('results'));

    }


    public function create()
    {
        return view('admin.farmer.create');
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
            Farmer::create($data);
            Alert::success("Success", getErrorMessage("Farmer", "created"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function show(Farmer $farmer)
    {
        return view('admin.farmer.show',compact('farmer'));
    }


    public function edit(Farmer $farmer)
    {
        return view('admin.farmer.edit',compact('farmer'));
    }

    public function update(Request $request, Farmer $farmer)
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
            $farmer->update($data);
            Alert::success("Success", getErrorMessage("Farmer", "updated"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function destroy(Farmer $farmer)
    {
        try{
            $farmer->delete();
            Alert::success("Success", getErrorMessage("Farmer", "deleted"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }
    }
}
