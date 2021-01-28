{{--投稿お気に入りボタンのフォーム--}}

<div class="post-button">
@if (Auth::user()->is_favorite($post->id))
  {{--お気に入りを外すボタンのフォーム--}}
  {!! Form::open(['route' => ['post.unfavorite', $post->id], 'method' => 'delete']) !!}
    {!! Form::submit('&#xf004;', ['class' => "fas fa-heart fav transp-btn "]) !!}
  {!! Form::close() !!}

@else
  {{--お気に入りにするボタンのフォーム--}}
  {!! Form::open(['route' => ['post.favorite', $post->id]]) !!}
    {!! Form::submit('&#xf004;', ['class' => "far unfav transp-btn"]) !!}
  {!! Form::close() !!}
@endif
</div>