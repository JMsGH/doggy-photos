<div class="card" >
  <div class="card-header">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  
  <div class="card-body">
   
  @if (isset($user->photo)) 
      <img class="rounded-circle img-fluid" src="{{$user->photo}}" alt="プロフィール写真">
  @else
      <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
  @endif
  
    @if (Auth::id() == $user->id)

      {!! Form::open(['route'=>'user.photo', 'enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {!! Form::label('photo', '写真を登録') !!}
        {!! Form::file('photo') !!}
      </div>
      	{!! Form::submit(($user->photo) ? '変更する' : '登録する', ['class'=>'btn btn-info']) !!}
      {!! Form::close() !!}
    
    @else
      {{-- フォロー／アンフォローボタン --}}
      @include('user_follow.follow_button')
    @endif
  </div>
</div>


