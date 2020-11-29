@if (count($posts) > 0)
  <div class="container">
  <div class="row">
    @foreach ($posts as $post)
      <div class="col-md-4 photo-grid">
        <div class="border border-info" style="padding:10px;">

       <a href="{{ route('posts.show', $post->id) }}">
        <img class="img-fluid mb-2" src="{{ $post->photo }}" alt="投稿写真"></a>

        @if (Auth::id() == $post->user_id)
          {{-- 投稿削除ボタンのフォーム --}}
          {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
              {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-sm delete-button']) !!}
          {!! Form::close() !!}
        @endif
        </div>
      </div>
    
    @endforeach
  </div>
  </div>
@else
  <div class="alert alert-secondary" role="alert">
    表示する投稿がありません。
  </div>

@endif

  {{-- ページネーションのリンク --}}
  {{ $posts->links() }}