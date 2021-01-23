@if (count($users) > 0)
  <ul class="list-unstyled">
    @foreach ($users as $user)
      <div class="row mt-4 mb-4">
        <div class="col-sm-4 mb-4">
        {{-- ユーザ登録の画像を取得して表示 --}}
        @if (isset($user->photo))
          <div class="center">
            <img class="mr-2 rounded img-fluid following user-profile-list" src="{{$user->photo}}" alt="">
          </div>
        @else
          <div class="center">        
            <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email) }}" alt="">
          </div>
        @endif
        </div>
        <div class="media-body col-sm-6">
          <div class="font-twice-larger mb-4">
          {{ $user->name }}
          </div>
          <p>{{ $user->about_me_and_dog }}</p>
          <div>
          {{-- ユーザ詳細ページへのリンク --}}
          <p>{!! link_to_route('users.show', 'ユーザ詳細を表示', ['user' => $user->id], ['class' => 'btn-link']) !!}</p>
          </div>
        </div>
      </div>
    <hr>
  @endforeach

  </ul>
  <div class="pagination justify-content-end mt-2">
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
  </div>
@endif