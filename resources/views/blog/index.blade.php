@extends('layouts.main')

@section("title", "| Blog")

@section('content')

  <div class="row">
    <div class="col-md-12">
      <h1>Posts</h1>
    </div>
  </div>

  @foreach ($posts as $post)
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h2>{{$post->title}}</h2>
      <h5>Published: {{ date("M j, Y", strtotime($post->created_at)) }}  Views:{{ $post->views}} Likes:{{ $post->votes}}</h5>
      <p>{{ substr($post->body, 0, 250) }}{{ strlen($post->body) > 64 ? "..." : ""}}</p>
      <a href="{{ route('blog.single', $post->slug) }}">Read More</a>
    </div>
  </div>
  @endforeach

  <div class="row">
    <div class="col-md-12">
      <div class="text-center">
        {!! $posts->links() !!}
      </div>
    </div>
  </div>

@endsection
