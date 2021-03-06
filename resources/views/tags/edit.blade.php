@extends('layouts.main')

@section('title', "|Edit Tag")

@section("content")

  {{ Form::model($tag, ["route" => ["tags.update", $tag->id], "method" => "PUT"])}}
    {{ Form::label("name", "Title:")}}
    {{ Form::text("name", null, ["class" => "form-control"])}}
    {{ Form::submit("Save Changes", ["class" => "btn btn-primary btn-h1-spaceing"]) }}
  {{Form::close()}}

@endsection
