<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    //
    public function Index(){
      $posts = Post::orderBy('created_at', 'desc')->limit(4)->get(); // YOU CAN ALSO USE VOTES
      return view("pages.welcome")->with('posts', $posts);
    }

    public function About(){
      return view("pages.about");
    }

    public function Contact(){
      return view("pages.contact");
    }
}
