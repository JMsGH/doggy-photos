<div class="card main-color">
  <div class="card-header">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  <div class="card-body">
    
    <p>プロフィール写真</p>
    
    @if (isset($user->photo)) 
    {

{{--      <img class="rounded img-fluid" src="{{ $user->photo, ['size' => 500] }}" alt="プロフィール写真">
      
    } @elseif (Auth::id() == $userId) {
      {!! Form::open(['route'=>'users.store', 'enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {!! Form::label('photo', 'プロフィール写真') !!}
        {!! Form::file('photo') !!}
      </div>
      {!! Form::submit('登録する', ['class'=>'btn btn-info'] !!}
      {!! Form::close() !!} --}}
    }
    @endif
  </div>
</div>

