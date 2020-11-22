<header class="mb-4">
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    {{-- トップページへのリンク --}}
    @if (Auth::check())
    <a href="/" class="navbar-brand">投稿写真一覧</a>
    @else 
    <a href="/" class="navbar-brand">犬フォト！</a>
    @endif

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-bar">
      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">
        {{-- ユーザ登録ページへのリンク --}}
         <li class="nav-item">{!! link_to_route('signup.get', '登録する', [], ['class' => 'nav-link']) !!}</li>
        {{-- ログインページへのリンク --}}
        <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>     
      </ul>
    </div>
  </nav>
</header>