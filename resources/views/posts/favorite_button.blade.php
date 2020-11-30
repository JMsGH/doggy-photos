{{--投稿お気に入りボタンのフォーム--}}

<div class="post-button">
@if (Auth::user()->is_favorite($post->id))
  {{--お気に入りを外すボタンのフォーム--}}
  {!! Form::open(['route' => ['post.unfavorite', $post->id], 'method' => 'delete']) !!}
    {!! Form::submit('お気に入り解除', ['class' => "btn btn-sm btn-outline-danger w-80 post-button"]) !!}
  {!! Form::close() !!}

@else
  {{--お気に入りにするボタンのフォーム--}}
  {!! Form::open(['route' => ['post.favorite', $post->id]]) !!}
    {!! Form::submit('お気に入りにする❤', ['class' => "btn btn-sm btn-outline-success w-80 post-button"]) !!}
  {!! Form::close() !!}
@endif
</div>