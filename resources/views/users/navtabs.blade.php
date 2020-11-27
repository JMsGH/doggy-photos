<ul class="nav nav-tabs nav-justified mb-3">
  {{-- ユーザ詳細タブ --}}
  <li class="nav-item">
    {{-- <a href="{{ route('users.posts', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.posts') ? 'active' : '' }}"> --}}
      ギャラリー
      {{-- <span class="badge badge-secondary">{{ $user->posts_count }}</span>
    </a> --}}
  </li>
  
  {{-- フォロー一覧タブ --}}
  <li class="nav-item"></li>
    <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'active' : '' }}">
      フォロー中
      <span class="badge badge-secondary">{{ $user->followings_count }}</span>
    </a>
    
  {{-- フォロワー一覧タブ --}}
  <li class="nav-item"></li>
    <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'active' : '' }}">
      フォロワー
      <span class="badge badge-secondary">{{ $user->followers_count }}</span>
    </a>
</ul>

