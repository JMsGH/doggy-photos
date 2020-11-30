@if (Auth::id() == $post->user_id)
  {{-- 投稿削除ボタンのフォーム --}}
  {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
      {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
  {!! Form::close() !!}
@endif