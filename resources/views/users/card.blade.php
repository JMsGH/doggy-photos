<div class="card" >
  <div class="card-header card-header-color">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  
  <div class="card-body lil-darker-color">
   
  @if (isset($user->photo)) 
      <img class="rounded-circle img-fluid mb-1" src="{{$user->photo}}" alt="プロフィール写真">
  @else
      <img class="rounded img-fluid mb-2" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
  @endif
  
    @if (Auth::id() == $user->id)

      {!! Form::open(['route'=>'user.photo', 'enctype'=>'multipart/form-data', 'class'=>'form-group']) !!}
      <div class="custom-file">
        {!! Form::file('photo',  ['class'=>'custom-file-input', 'id'=>'inputFile']) !!}
        {!! Form::label('photo', ($user->photo) ? '写真を変更' : '写真を登録', ['class'=>'custom-file-label', 'for'=>'inputFile', 'data-browse'=>'
        参照']) !!}
        <p class="text-right font-smaller inline-display">（ドラッグ&ドロップ可）</p>
      </div>
      
      	{!! Form::submit(($user->photo) ? '変更する' : '登録する', ['class'=>'btn btn-info mt-1 mb-2']) !!}
      {!! Form::close() !!}
      
      {{-- 愛犬登録ページへのリンク --}}
      <p>{!! link_to_route('dogs.create', '愛犬を登録する', ['id' => \Auth::id()], ['class' => 'btn-link']) !!}</p>
    
    @else
      {{-- フォロー／アンフォローボタン --}}
      @include('user_follow.follow_button')
    @endif
  </div>
</div>


