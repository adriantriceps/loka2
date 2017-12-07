  @extends('layouts.main')

  @section('title', '| View Posts')

  @section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}
  @endsection

  @section('content')
    <div class="row">
      {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'PATCH']) !!} {{-- connect automaticly to right row, AND SET FORM METHOD AS PUT/PATCH ((DEFAULT IS POST))  --}}
      <div class="col-md-8">
        {{ Form::label('title', 'Title:')}}
        {{ Form::text('title', null, ['placeholer' => 'Title', 'required' => '', 'maxlength' => '255', 'class' => 'form-control input-lg'])}}

        {{ Form::label('body', 'Body:', ['class' => 'form-spaceing-top'])}}
        {{ Form::textarea('body', null, ['placeholder' => 'Body', 'required' => '', 'class' => 'form-control'])}}

        {{ Form::label('category_id', 'Category:', ['class' => 'form-spaceing-top'])}}
        {{ Form::select('category_id', $categories , null, ['class' => 'form-control form-spaceing-top'])}}

        {{ Form::label('slug', 'URL:', ['class' => 'form-spaceing-top'])}}
        {{ Form::text('slug', null, ['class' => 'form-control form-spaceing-top'])}}

        {{ Form::label("tags", "Tags:", ['class' => "form-spaceing-top"])}}
        {{ Form::select("tags[]", $tags, null, [ "class" => "form-control select2-multi", 'multiple' => "multiple"])}}
      </div>
      <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <dt>Views:</dt>
            <dd>{{ $post->views }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Likes:</dt>
            <dd>{{ $post->votes }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Created At:</dt>
            <dd>{{ date('M j, Y H:i',strtotime($post->created_at)) }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Last Updated</dt>
            <dd>{{ date('M j, H:i',strtotime($post->updated_at)) }}</dd>
          </dl>
          <hr>
          <div class="row">
            <div class="col-sm-6">
                {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
            </div>
            <div class="col-sm-6">
              {!! Html::linkRoute('post.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block'))!!}
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>{{-- end of .row (form) --}}



@endsection
@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $(".select2-multi").select2();
  </script>
@endsection
