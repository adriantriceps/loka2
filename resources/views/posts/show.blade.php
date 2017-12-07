@extends('layouts.main')

@section('title', '| View Posts')

@section('content')

  <div class="row">
    <div class="col-md-8">
      <h1>{{ $post->title }}</h1>
      <p class="lead">{{ $post->body }}</p>
      <hr>
      <div class="tags">
        @foreach ($post->tags as $tag)
          <span class="label label-default">{{ $tag->name }}</span>
        @endforeach
      </div>
    </div>
    <div class="col-md-4">
      <div class="well">
        <dl class="dl-horizontal">
          <label>Views:</label>
          <p>{{ $post->views }}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Likes:</label>
          <p>{{ $post->votes }}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Created At:</label>
          <p>{{ date('M j, Y H:i',strtotime($post->created_at)) }}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Last Updated</label>
          <p>{{ date('M j, H:i',strtotime($post->updated_at)) }}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Creator</label>
          <p>{{ $post->creator }}</p>
        </dl>
        <dl class="dl-horizontal">
          <label>Url:</label>
          <a href="{{ url('blogs/'.$post->slug) }}">{{url("blog/".$post->slug)}}</a>
        </dl>
        <dl class="dl-horizontal">
          <label>Category:</label>
          <p>{{ $post->category->name }}</p>
        </dl>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            {!! Html::linkRoute('post.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block'))!!}
          </div>
          <div class="col-sm-6">
            {!! Form::open(['route' => ['post.destroy', $post->slug], 'method' => 'DELETE']) !!} {{-- ROUTE ACCEPTS ARRAY --}}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block'])!!}
            {!! Form::close() !!}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {{ Html::linkRoute('post.index', '<« Back To See All Posts', [], ['class' => 'btn btn-default btn-block btn-h1-spaceing'])}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
