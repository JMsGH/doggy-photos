@extends('layouts.app')

@section('content')
  <div class="text-center">
    <h1>ログイン</h1>
  </div>

  <div class="row">
    <div class="col-sm-6 offset-sm-3">

      {!! Form::open(['route' => 'login.post']) !!}
        <div class="form-group  mt-5">
          {!! Form::label('email', 'メールアドレス') !!}
          {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('password', 'パスワード') !!}
          {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group mt-5 text-center">
        {!! Form::submit('ログイン', ['class' => 'btn btn-info btn-default']) !!}
        {!! Form::close() !!}
        </div>

      {{-- ユーザ登録ページへのリンク --}}
      <p class="mt-5 text-center">登録がお済みでない方: </p>
      <p class="mt-2 text-center">{!! link_to_route('signup.get', '登録する') !!} </p>
    </div>
  </div>


@endsection