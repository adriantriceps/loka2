<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use Session;
use Auth;

class PostController extends Controller
{

    public function __construct(){
      $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Create a variable and store all the blog posts in it from the Database
        $posts = Post::where('posts.creators_id','=', Auth::user()->id)->orderBy('posts.id', 'desc')->paginate(13);
        //FOR ADMINS TO SEE EVERYTHING//$posts = Post::orderBy('posts.id', 'desc')->paginate(15);
        //return the view and pass in the above variable
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
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create")->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the Data
        $this->validate($request, array(
          'title'       => 'required|max:86|unique:posts,title',
          'body'        => 'required|max:7000',
          'category_id' => 'required|integer',
        ));
        //store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->slug = str_slug($request->title, "-");
        // $post->tags = $request->tags;
        $post->votes = 0;
        $post->views = 0;
        $post->creators_id = Auth::user()->id;
        $post->save();
        $post->tags()->sync($request->tags, false);
        Session::flash('success','The blog post was successfully saved!');

        return redirect()->route('post.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Laravel Eloquent for $id
        $post = Post::where("id", $id)->first();
        //dd($post);
        $post->views += 1;
        $post->save();
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //ADD IF NOT ADMIN, CANNOT ACCESS
      //IF CREATOR CAN EDIT
        // find the post in the database and save as a var
        $post = Post::find($id);
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
          $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag ) {
          $tags2[$tag->id] = $tag->name;
        }
        // return the view and pass in the car we perviously created
        return view('posts.edit')->with('post', $post)->withCategories($cats)->withTags($tags2);
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


        // Validate The Data
        $post = Post::find($id);
        if ($request->input("slug") == $post->slug) {
          $this->validate($request, array(
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'body' => 'required'
          ));
        } else {
          $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body' => 'required|max:5000'
          ));
        }
        //$post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        // Save The Data To Database
        $post->save();
        $post->tags()->sync($request->tags);
        // Set Flash Data With Success Message
        Session::flash('success','The blog post was successfully saved!');
        // Redirect With Flash Data To post.show
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ADMIN OR CREATOR CAN EDIT
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', 'The post was seccessfully deleted.');
        return redirect()->route('post.index');
    }
}
