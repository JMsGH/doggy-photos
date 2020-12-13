<div class="card" >
  <div class="card-header card-header-color">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  
  <div class="card-body lil-darker-color">
   
  @if (isset($user->photo)) 
      <img class="rounded-circle img-fluid" src="{{$user->photo}}" alt="プロフィール写真">
  @else
      <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
  @endif
  
    @if (Auth::id() == $user->id)

      {!! Form::open(['route'=>'user.photo', 'enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {!! Form::label('photo', ($user->photo) ? '写真を変更' : '写真を登録', ['class'=>'font-weight-bold']) !!}
        {!! Form::file('photo') !!}
      </div>
      	{!! Form::submit(($user->photo) ? '変更する' : '登録する', ['class'=>'btn btn-info']) !!}
      {!! Form::close() !!}
      
      {{-- 愛犬登録ページへのリンク --}}
      <p>{!! link_to_route('dogs.create', '愛犬を登録する', ['id' => \Auth::id()], ['class' => 'btn-link']) !!}</p>
    
    @else
      {{-- フォロー／アンフォローボタン --}}
      @include('user_follow.follow_button')
    @endif
  </div>
</div>


