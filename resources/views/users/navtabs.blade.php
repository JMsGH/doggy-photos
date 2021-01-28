<ul class="nav nav-tabs nav-justified mb-3">
  {{-- ギャラリータブ --}}
  <li class="nav-item">
    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'active' : '' }}">
      投稿 <i class="fas fa-images font-slight-larger"></i>
      <span class="badge badge-secondary">{{ $user->posts_count }}</span>
    </a>
  </li>
  
  {{-- フォロー一覧タブ --}}
  <li class="nav-item">
    <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link  {{ Request::routeIs('users.followings') ? 'active' : '' }}">
      フォロー中
      <span class="badge badge-secondary">{{ $user->followings_count }}</span>
    </a>
  </li>
    
  {{-- フォロワー一覧タブ --}}
  <li class="nav-item">
    <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link  {{ Request::routeIs('users.followers') ? 'active' : '' }}">
      フォロワー
      <span class="badge badge-secondary">{{ $user->followers_count }}</span>
    </a>
  </li>
  
  {{-- お気に入り一覧タブ --}}
  @if (Auth::id() == $user->id)
  <li class="nav-item">
    <a href="{{ route('user.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('user.favorites') ? 'active' : '' }}">
      <i class="fab fa-gratipay font-slight-larger"></i>
      <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
    </a>
  </li>
  @endif
  
  {{-- ユーザ情報変更ページ --}}
  @if (Auth::id() == $user->id)
  <li class="nav-item">
    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('user.edit') ? 'active' : '' }}">
      登録 <i class="fas fa-info-circle font-slight-larger"></i> 更新
    </a>
  </li>
  @endif
</ul>

