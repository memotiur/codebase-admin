<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use App\Models\KitchenAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class KitchenAdminController extends Controller
{
    public function index()
    {
        $results = KitchenAdmin::orderBy('id', 'DESC')->paginate(25);
        $kitchens = Kitchen::get();
        return view('admin.kitchen_admin.index', compact('results', 'kitchens'));

    }


    public function create()
    {

        return view('admin.kitchen_admin.create');
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
            $request->merge(['featured_image' => "/images/" . $image_name]);
        }

        if ($request['password'] != null) {
            $request['password'] = Hash::make($request['password']);
        }

        try {
            $data = $request->except('_token', '_method', 'image');
            KitchenAdmin::create($data);
            Alert::success("Success", getErrorMessage("KitchenAdmin", "created"));
            return back();
        } catch (\Exception $exception) {
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function show(KitchenAdmin $kitchenAdmin)
    {
        return view('admin.kitchen_admin.show', compact('kitchenAdmin'));
    }


    public function edit(KitchenAdmin $kitchenAdmin)
    {
        return view('admin.kitchen_admin.edit', compact('kitchenAdmin'));
    }

    public function update(Request $request, KitchenAdmin $kitchenAdmin)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->orientate()->fit(250, 300, function ($constraint) {
                /*$constraint->aspectRatio();*/
                $constraint->upsize();
            })->save(public_path('/images/' . $image_name));
            $request->merge(['featured_image' => "/images/" . $image_name]);
        }
        if ($request['password'] != null) {
            $request['password'] = Hash::make($request['password']);
        }


        try {
            $data = $request->except('_token', '_method', 'image');
            $kitchenAdmin->update($data);
            Alert::success("Success", getErrorMessage("KitchenAdmin", "updated"));
            return back();
        } catch (\Exception $exception) {
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }

    }


    public function destroy(KitchenAdmin $kitchenAdmin)
    {
        try {
            $kitchenAdmin->delete();
            Alert::success("Success", getErrorMessage("KitchenAdmin", "deleted"));
            return back();
        } catch (\Exception $exception) {
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
            return back();
        }
    }
}
