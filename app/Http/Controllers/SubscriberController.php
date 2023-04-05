<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {

        $query= Subscriber::orderBy('id', 'DESC');
        if($request['search']!=null){
            $query->where('is_deleted', 'like', '%'.$request['search'].'%');
        }
        $results= $query->paginate(25);
        return view('admin.subscriber.index',compact('results'));

    }


    public function create()
    {
        return view('admin.subscriber.create');
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
            Subscriber::create($data);
            Alert::success("Success", getErrorMessage("Subscriber", "created"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function show(Subscriber $subscriber)
    {
        return view('admin.subscriber.show',compact('subscriber'));
    }


    public function edit(Subscriber $subscriber)
    {
        return view('admin.subscriber.edit',compact('subscriber'));
    }

    public function update(Request $request, Subscriber $subscriber)
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
            $subscriber->update($data);
            Alert::success("Success", getErrorMessage("Subscriber", "updated"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function destroy(Subscriber $subscriber)
    {
        try{
            $subscriber->delete();
            Alert::success("Success", getErrorMessage("Subscriber", "deleted"));
            return back();
        }catch(\Exception $exception){
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }
    }
}
