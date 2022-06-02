<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view("admin.post.show")->with('result', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::where('is_active', true)->get();
        return view("admin.post.create")->with('result', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
        $validator = Validator::make($request->all(), [
            'post_title' => 'required',
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
            $destinationPath = public_path('/uploads/post');
            $image->move($destinationPath, $image_name);
            $image_file = '/uploads/post/' . $image_name;
        }

        if ($request['pin_post'] == null) {
            $request['pin_post'] = false;
        }
        $data = [
            'post_title' => $request['post_title'],
            'category_id' => $request['category_id'],
            'pin_post' => $request['pin_post'],
            'tags' => $request['tags'],
            'author_id' => Auth::user()->id,
            'post_details' => getSummernoteFormatter($request['post_details']),
            'featured_image' => $image_file,
        ];
        try {
            Post::create($data);

            Alert::success("Success", "Successfully Post Created");

        } catch (\Exception $exception) {

            return $exception->getMessage();
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $post = Post::where('id', $post->id)->first();
        $categories = Category::where('is_active', true)->get();
        return view("admin.post.edit")
            ->with('post', $post)
            ->with('result', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'post_title' => 'required',
            'category_id' => 'required',
            /* 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
        ]);


        if ($validator->fails()) {
            Alert::error("Error", getErrorMessage("Please Fil the input filed properly", "Please Fil the input filed properly"));
            return back();
        }

        $image_file = $post->featured_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/post');
            $image->move($destinationPath, $image_name);
            $image_file = '/uploads/post/' . $image_name;
        }

        if ($request['pin_post'] == null) {
            $request['pin_post'] = false;
        }
       $data = [
            'post_title' => $request['post_title'],
            'category_id' => $request['category_id'],
            'pin_post' => $request['pin_post'],
            'tags' => $request['tags'],
            'author_id' => Auth::user()->id,
            'post_details' => getSummernoteFormatter($request['post_details']),
            'featured_image' => $image_file,
        ];
        try {
            Post::where('id', $post->id)->update($data);

            Alert::success("Success", "Successfully Post Updated");

        } catch (\Exception $exception) {

            return $exception->getMessage();
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        try {
            Post::where('id', $post->id)->delete();
            Alert::success("Success", "Successfully Post Deleted");

        } catch (\Exception $exception) {

            // return $exception->getCode();
            Alert::error("Error", getErrorMessage($exception->getMessage(), "There is an Error. Try again Later"));
        }


        return back();
    }
}
