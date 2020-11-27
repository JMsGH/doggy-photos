@extends('layouts.app')

@section('content')

<h2>ギャラリー</h2>

@if (count($posts) > 0)
  <div class="container">
  <div class="row">
    @foreach ($posts as $post)
      <div class="col-sm-3">
        <img class="img-fluid" src="{{ $post->photo }}" alt="投稿写真">
      </div>
      <div>
        @if (Auth::id() == $post->user_id)
          {{-- 投稿削除ボタンのフォーム --}}
          {!! Form::model($post, ['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
          {!! Form::submit('削除', ['class' => 'btn btn-sm btn-outline-danger']) !!}
          {!! Form::close() !!}
        @endif
      </div>
    
    @endforeach
  </div>
  </div>
@else
  <div class="alert alert-secondary" role="alert">
    表示する投稿がありません。
  </div>

@endif

  {{-- ページネーションのリンク --}}
  {{ $posts->links() }}

@endsection
