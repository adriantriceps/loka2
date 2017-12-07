@extends('layouts.main')

@section('title', '| Login')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
              {!! Form::open() !!}
                {{ Form::label('email', "Email:")}}
                {{ Form::email('email', null, ["class" => 'form-control'])}}

                {{ Form::label('password', "Password:")}}
                {{ Form::password('password', ["class" => 'form-control'])}}

                {{ Form::checkbox('remember') }}{{ Form::label('remember', "Remember Me")}}

                {{ Form::submit("Login", ["class" => "btn btn-primary btn-block form-spacing-top"])}}
              {!! Form::close() !!}

              <a href="{{ route("register") }}" class="btn btn-defailt btn-block form-spacing-top">Register</a>
              <a href="password/reset" class="btn btn-defailt btn-block form-spacing-top">Forgot Password</a>
        </div>
    </div>
@endsection
