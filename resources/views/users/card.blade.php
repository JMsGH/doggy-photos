<div class="card" style="width:15rem;">
  <div class="card-header">
    <h3 class="card-title">{{ $user->name }}</h3>
  </div>
  @if (isset($user->photo)) 
      <img class="rounded-circle img-fluid" src="{{ $user->photo }}" alt="プロフィール写真" style="height: 150px">
  @endif
  <div class="card-body">
    
    

    @if (Auth::id() == $user->id)
     {{-- <form action="/users" method="post" enctype="multipart/form-data">
    		@csrf
    		<p>
    				<input type="file" name="datafile">
    		</p>
    		<p>
    				<input type="submit" value="送信する">
    		</p>
	    </form> --}}
      
      {!! Form::open(['route'=>'user.photo', 'enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {!! Form::label('photo', '写真を登録') !!}
        {!! Form::file('photo') !!}
      </div>
      {!! Form::submit('登録する', ['class'=>'btn btn-info']) !!}
      {!! Form::close() !!}
    @endif
  </div>
</div>

