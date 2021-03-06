@extends('layouts.main')

@section('title', '| Create new Thread')

@section('stylesheets')
  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <h1>Create New Post</h1>
    <hr>
    {{-- No need for CSFR with form helpers --}}
    {!! Form::open(['route' => 'post.store', 'data-parsley-validate' => '']) !!}
      {{ Form::label('title', 'Title:') }}
      {{-- Parsley to have real time client validation, tha's why there is required --}}
      {{ Form::text('title', null, array('class' => "form-control", 'required' => '', 'maxlength' => '86')) }}

      {{ Form::label('category_id', 'Category:')}}
      <select class="form-control" name="category_id">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}"> {{ $category->name }}</option>
        @endforeach
      </select>
      {{ Form::label('tags', 'Tags:')}}
      <select class="form-control select2-multi" name="tags[]" multiple="multiple">
        @foreach ($tags as $tag)
          <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
        @endforeach
      </select>

      {{ Form::label('body', 'Post Body:')}}
      {{-- Parsley to have real time client validation, tha's why there is required = empty string --}}
      {{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '7000')) }}

      {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => "margin-top: 3vh;")) }}
    {!! Form::close() !!}
  </div>
</div>
@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}

  <script type="text/javascript">
    $('.select2-multi').select2();
  </script>

@endsection
