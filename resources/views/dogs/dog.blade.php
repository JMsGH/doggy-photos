@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="flash_message bg-info text-center py-2 my-0 mb-5">
        {{ session('flash_message') }}
    </div>
@endif

  <ul class="list-unstyled">
      <div class="row justify-content-center mb-4">
        <div class="col-sm-5 mb-4">
        {{-- 愛犬登録の画像を取得して表示 --}}
        @if (isset($dog->photo)) 
          <img class="mr-2 rounded img-fluid following" src="{{$dog->photo}}" alt="愛犬の写真">
          {{-- 愛犬の写真を登録／変更 --}}
          @if (\Auth::id() == $dog->user_id)
          {!! Form::open(['route'=>'dogs.photo', 'enctype'=>'multipart/form-data']) !!}
          <div class="form-group">
            {!! Form::label('photo', ($dog->photo) ? '写真を変更' : '写真を登録', ['class'=>'font-weight-bold']) !!}
            {!! Form::file('photo') !!}
            {!! Form::hidden('dogId', $dog->id) !!}
            {!! Form::submit(($dog->photo) ? '変更を保存' : '登録する', ['class'=>'btn btn-info btn-sm']) !!}
          {!! Form::close() !!}
          @endif
          </div>
        @endif
        </div>
        <div class="col-sm-7">
          <div class="font-weight-bold">
          <h4 class="mb-3">{{ $dog->dog_name }}</h4>
          @if ($dog->birthday)
            <p>誕生日: {{ $dog->birthday}} </p>
          @else
            <p>誕生日</p>
          @endif
          <p>コメント: {{ $dog->comment }} </p>
          </div>
          <div>
            @if (Auth::id() == $dog->user_id)
              {{-- 登録内容修正ページへのリンク --}}
              <div class="row">
              <div class="col-sm-7">
                {!! link_to_route('dogs.edit', '登録内容修正', ['dogId' => $dog->id], ['class' => 'btn-edit']) !!}
                {{-- 体重記録ページへのリンク --}}
                {!! link_to_route('weights.create', '体重記録ページへ',  ['dogId' => $dog->id], ['class' => 'btn-edit']) !!}                
              </div>
              <div class="col-sm-5">
                {{-- 愛犬登録解除ボタンのフォーム --}}
                {!! Form::open(['route' => ['dogs.destroy', $dog->id], 'method' => 'delete']) !!}
                    {!! Form::submit('登録を削除', ['class' => 'btn btn-danger btn-sm post-button']) !!}
                {!! Form::close() !!}
              </div>
              
            @endif
          </div>
        </div>
        <div class="row mt-5 justify-content-right">
          <div class="col-sm-3 ">
            {{-- 愛犬一覧ページへのリンク --}}
            {!! link_to_route('dogs.index', '愛犬一覧ページ', ['id' => \Auth::id()], ['class' => 'btn-link']) !!}
          </div>
        </div>
      </div>
    </div>

    <hr class="long">
  </ul>
  {{-- ページネーションのリンク --}}
  {{-- {{ $dogs->links() }} --}}

  
  
@endsection
