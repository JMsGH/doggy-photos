@extends('layouts.app')

@section('content')
  <div class="row">
    <aside class="col-sm-4 mt-4">
      {{-- 写真 --}}
      <img class="img-fluid mb-2" src="{{ $post->photo }}" alt="投稿写真">

        @if (Auth::id() == $post->user_id)
          {{-- 投稿削除ボタンのフォーム --}}
          {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
              {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-sm delete-button']) !!}
          {!! Form::close() !!}
        @endif
    </aside>
    
    <div class="col-sm-8 mt-4">
      {{-- コメント --}}
      <h5 class="mb-3">コメント</h5>
      <p class="shadow-lg p-3 mb-5 bg-white rounded">{!! nl2br(e($post->comment)) !!}</p>
      
    </div>
    
  </div>
@endsection