@extends('layouts.app')

@section('content')
  <h3>マイページ</h3>

  <div class="row"></div>
    <aside class="col-sm-4">
      {{-- ユーザ情報 --}}
      @include('users.card')
    </aside>
    <div class="col-sm-8">
      {{-- タブ --}}
      // @include('users.navtabs')
      @if (Auth::id() == $user->id)
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">ユーザ名</th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th scope="row">メールアドレス</th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th scope="row">自己・愛犬紹介</th>
              <td>{{ $user->about_me_and_dog }} <br />
                <form action ="{{ route('users.postEdit', ['id' => $user->id]) }}" method="post">
              <input type="submit" value="変更" />
              </td>
            </tr>
          </tbody>
        </table>
        {{-- 投稿フォームへのリンク --}}
        @include('posts.form')
      @endif
      {{-- 投稿一覧 --}}
      @include('posts.posts')
    </div>
  </div>
  <script src="{{ asset('/js/main.js') }}"></script>

@endsection