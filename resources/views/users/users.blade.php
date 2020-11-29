@if (count($users) > 0)
  <ul class="list-unstyled">
    @foreach ($users as $user)
      <li class="media mt-4 mb-4">
        {{-- ユーザ登録の画像を取得して表示 --}}
        @if (isset($user->photo)) 
          <img class="mr-2 rounded users" src="{{$user->photo}}" alt="">
        @else
          <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email) }}" alt="">
        @endif
        <div class="media-body">
          <div>
          {{ $user->name }}
          </div>
          <div>
          {{-- ユーザ詳細ページへのリンク --}}
          <p>{!! link_to_route('users.show', 'プロフィールを表示', ['user' => $user->id]) !!}</p>
          </div>
        </div>
        <hr>
      </li>
  @endforeach
  </ul>
  {{-- ページネーションのリンク --}}
  {{ $users->links() }}
@endif