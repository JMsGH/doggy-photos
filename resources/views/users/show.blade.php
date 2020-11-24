@extends('layouts.app')

@section('content')

  <div class="row main-color"></div>
    <aside class="col-sm-4">
      {{-- ユーザ情報 --}}
      @include('users.card')
    </aside>
    <div class="col-sm-8">
      {{-- タブ --}}
      // @include('users.navtabs')
      @if (Auth::id() == $user->id)
        {{-- 投稿フォーム --}}
        // @include('posts.form')
        <form action="/posts" method="post" enctype="multipart/form-data">
		@csrf
		<p>
				<input type="file" name="datafile">
		</p>
		<p>
				<input type="submit" value="送信する">
		</p>
	</form>
      @endif
      {{-- 投稿一覧 --}}
      // @include('posts.posts')
    </div>
  </div>

@endsection