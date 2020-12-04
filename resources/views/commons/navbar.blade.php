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
        @if (Auth::check())
        {{-- ユーザ一覧ページへのリンク --}}
        <li class="nav-item">{!! link_to_route('users.index', 'ユーザ一覧', [], ['class' => 'nav-link']) !!}</li>
        
        {{-- お気に入り写真へのリンク --}}
        <li class="nav-item">{!! link_to_route('user.favorites', 'お気に入り写真', ['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
        
        <li class="nav-item">{!! link_to_route('users.show', 'マイページ',  ['user' => Auth::id()], ['class' => 'nav-link']) !!}</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
          <ul class="dropdown-menu dropdown-menu-right">
            {{-- 写真を投稿へのリンク --}}
            <li class="dropdown-item">{!! link_to_route('posts.posting', '写真を投稿',  ['user' => Auth::id()]) !!}</li>
            {{-- マイページへのリンク --}}
            {{-- 愛犬一覧稿へのリンク --}}
            {{-- フィラリア投薬へのリンク --}}
            <li class="dropdown-item">{!! link_to_route('medications.show', 'フィラリア投薬') !!}</li>
            {{-- お気に入り写真へのリンク --}}
            {{-- ログアウト --}}
            <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
          </ul>
        </li>
        
        @else
        {{-- ユーザ登録ページへのリンク --}}
         <li class="nav-item">{!! link_to_route('signup.get', '登録する', [], ['class' => 'nav-link']) !!}</li>
        {{-- ログインページへのリンク --}}
        <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
        @endif
      </ul>
    </div>
  </nav>
</header>