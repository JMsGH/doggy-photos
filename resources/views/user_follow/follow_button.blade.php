@if (Auth::id() != $user->id)
  @if (Auth::user()->is_following($user->id))
    {{-- アンフォローボタンのフォーム --}}
    {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
      {!! Form::submit('フォロー解除', ['class' => "btn btn-outline btn-danger btn-block"]) !!}
    {!! Form::close() !!}
  @else
    {{-- フォローボタンのフォーム --}}
    {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
      {!! Form::submit('フォローする', ['class' => "btn btn-outline btn-success btn-block"]) !!}
    {!! Form::close() !!}
  @endif
@endif
    