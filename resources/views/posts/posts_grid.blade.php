@if (count($posts) > 0)
  <div class="container">
  <div class="row">
    @foreach ($posts as $post)
      <div class="col-md-4 photo-grid">
        <div class="border border-info" style="padding:10px;">

       <a href="{{ route('posts.show', $post->id) }}">
        <img class="img-fluid mb-2" src="{{ $post->photo }}" alt="投稿写真"></a>

          <div class="row">
            <div class="col-sm-8">
            {{-- お気に入り／お気に入り解除ボタン --}}
            @include('posts.favorite_button')
            </div>
            
            <div class="col-sm-4">
            {{-- 投稿削除ボタンのフォーム --}}
            @include('posts.posts_delete_form')
            </div>
            
          </div>
        </div>
      </div>
    
    @endforeach
  </div>
  </div>
@else
  <div class="alert alert-secondary" role="alert">
    表示する投稿がありません。
  </div>
  </div>
@endif


  {{-- ページネーションのリンク --}}
  {{ $posts->links() }}