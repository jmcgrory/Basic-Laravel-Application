<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
// use DB; // Could do SQL using db lib instead of using eloquent
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Auth Middleware
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'index',
                'show'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Can do a basic all
        // $posts = Post::all();

        // Bringing in App/Post to use it's model!
        // $posts = Post::orderBy('title', 'desc')->get();

        // Can also limit
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();

        // Could get just one
        // $post = Post::where('title', 'initial post')->get();
        // return $post;

        // Example with DB
        // $posts = DB::select('SELECT * FROM posts');

        // Can also paginate
        $posts = Post::orderBy('created_at', 'desc')->paginate(12);

        // Load for /posts index
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // posts/create
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
        // Storing Posts from /posts/create

        // Validate (built in)
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the ext
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File Name to sotre
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;
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
        // Show our post via /posts/{{id}}
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
        // Check User ID
        $post = Post::find($id);

        // Check for correct user
        if( auth()->user()->id !== $post->user_id ){
            return redirect('/posts')->with('error', 'Unauthorised Page');
        } else {
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
        // Adding our new Update function
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){

            // Get filename with the ext
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File Name to sotre
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }

        // Update Post, First find
        $post = Post::find($id);
        
        // Check for correct user
        if( auth()->user()->id !== $post->user_id ){
            return redirect('/posts')->with('error', 'Unauthorised Page');
        } else {
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            if($request->hasFile('cover_image')){
                if($post->cover_image!=='noimage.jpg'){
                    // Delete Image
                    Storage::delete('public/cover_images/'.$post->cover_image);
                }
                $post->cover_image = $fileNameToStore;
            }
            $post->save();
            return redirect('/posts')->with('success', 'Post Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete

        // Find the post
        $post = Post::find($id);

        if($post->cover_image!=='noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // Check for correct user
        if( auth()->user()->id !== $post->user_id ){
            return redirect('/posts')->with('error', 'Unauthorised Page');
        } else {
            $post->delete();
            return redirect('/posts')->with('success', 'Post Deleted');
        }
    }
}
