<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);
            //handling images
            if($request->hasFile('cover_image')){
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('cover_image')-> storeAs('public/cover_images', $fileNameToStore);
            }
            else{
                $fileNameToStore = 'noname.jpg';
            }



        $post = new Post();
        $post->name = $request->input('name');
        $post->role = $request->input('role');
        $post->phone = $request->input('phone');
        $post->description = $request->input('description');
        //$post->cover_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        //
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized Page');
            return "You Cannot edit a post not yours";
        }
        else{
            return view('posts.edit')->with('post', $post);
        }

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);
        //handling images
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')-> storeAs('public/cover_images', $fileNameToStore);
        }
        $post = Post::find($id);
        $post->name = $request->input('name');
        $post->role = $request->input('role');
        $post->phone = $request->input('phone');
        $post->description = $request->input('description');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        
        $post->save();

        return redirect('/posts')->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized Page');
           
        }
        else{
            if($post->cover_image != "noname.jpg"){
                Storage::delete('public/cover_images/'.$post->cover_image);
                return redirect('/posts')->with('success', 'Post Deleted');
            }
            return redirect('/posts')->with('success', 'Post Deleted');
        }

        
    }
}
