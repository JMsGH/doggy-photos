@if (count($users) > 0)
  <ul class="list-unstyled">
    @foreach ($users as $user)
      <div class="row">
        <div class="col-sm-4 mb-4">
        {{-- ユーザ登録の画像を取得して表示 --}}
        @if (isset($user->photo)) 
          <img class="mr-2 rounded img-fluid following" src="{{$user->photo}}" alt="">
        @else
          <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email) }}" alt="">
        @endif
        </div>
        <div class="media-body col-sm-6">
          <div class="font-weight-bold">
          {{ $user->name }}
          </div>
          <div>
          {{-- ユーザ詳細ページへのリンク --}}
          <p>{!! link_to_route('users.show', 'ユーザ詳細を表示', ['user' => $user->id]) !!}</p>
          <p>{{ $user->about_me_and_dog }}</p>
          </div>
        </div>
      </div>
    <hr>
  @endforeach

  </ul>
  {{-- ページネーションのリンク --}}
  {{ $users->links() }}
@endif