@extends('layouts.app')

@section('content')

  <div class="row"></div>
    <aside class="col-sm-4">
      {{-- ユーザ情報 --}}
      @include('users.card')
    </aside>
    <div class="col-sm-8">
      {{-- タブ --}}
      // @include('users.navtabs')
      @if (Auth::id() == $user->id)
        {{-- 投稿フォームへのリンク --}}
        // 
      @endif
      {{-- 投稿一覧 --}}
      // @include('posts.posts')
    </div>
  </div>

@endsection