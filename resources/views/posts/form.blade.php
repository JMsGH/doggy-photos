<div class="mt-5 mb-5">
{!! Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data']) !!}
  <div class="form-group"></div>
  <div class="form-group">
    {!! Form::label('photo', '写真') !!}
    {!! Form::file('photo') !!}
  </div>
  <div class="form-group">
    {!! Form::label('comment', 'コメント', ['class' => 'font-weight-bold']) !!}
    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
  </div>
    {!! Form::submit('投稿する', ['class'=>'btn btn-info']) !!}
{!! Form::close() !!}
</div>
  