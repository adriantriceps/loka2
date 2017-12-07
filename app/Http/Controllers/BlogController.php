<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class BlogController extends Controller
{
    //
    public function Index(){
      $post = Post::paginate(10);

      return view('blog.index')->with('posts', $post);
    }

    public function getSingle($slug){
      //Fetch from the DB on slugs
      $post = Post::where('slug', '=', $slug)->first();
      // return the view and pass in the post object
      $post->views += 1;
      $post->save();
      return view("blog.single")->with("post", $post);
    }
}
