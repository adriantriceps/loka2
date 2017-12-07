@extends('layouts.main')

@section('title', "| $post->title" )

@section("content")

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{ $post->title }}</h1>
      <hr>
      <p>{{ $post->body }}</p>
      <hr>
      <p>Posted In: {{ $post->category->name }}</p>
    </div>
  </div>

  <div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2">
      <hr>
      {{ Form::open(["route" => ["comments.store", $post->id], "method" => "POST"])}}
        {{-- <div class="col-md-6">
          {{ Form::label('name', "Name:") }}
          {{ Form::text('name', null , ["class" => "form-control"])}}
        </div>
        <div class="col-md-6">
          {{ Form::label('email', "Email:") }}
          {{ Form::text('email', null , ["class" => "form-control"])}}
        </div> --}}
        <div class="col-md-12">
          {{ Form::label('comment', "Comment:") }}
          {{ Form::textarea('comment', null , ["class" => "form-control", "rows" => "5"])}}

          {{ Form::submit("Add Comment", ["class" => "btn btn-success btn-block btn-h1-spaceing"] )}}
        </div>
      {{ Form::close() }}
    </div>

    <div class="col-md-8 col-md-offset-2">
      {{-- {{ dd($post)}} --}}
      @foreach ($post->comment as $comment)
        <div class="comment btn-h1-spaceing">
          <div class="panel panel-default">
            <div class="panel-heading"><strong>Creator </strong>{{ $comment->name }}   <strong>Created:</strong> {{ date("M j, Y", strtotime($comment->created_at)) }}</div>
            <div class="panel-body">{{ $comment->comment }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection
