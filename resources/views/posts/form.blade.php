<div class="row justify-content-center mt-5">
  <div class="col-sm-8">
    {!! Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data', 'class'=>'form-group']) !!}
      <h2 class="mb-4">投稿フォーム</h2>
      <h6 class="text-info">容量が2MB以下の写真を投稿できます。</h6>
      <div class="custom-file mb-2">
        {!! Form::file('photo',  ['class'=>'custom-file-input', 'id'=>'inputFile']) !!}    
        {!! Form::label('photo', '写真 (ドラッグ&ドロップ可)', ['class'=>'custom-file-label', 'for'=>'inputFile', 'data-browse'=>'参照']) !!}
      </div>
      <div class="form-group mt-3">
        {!! Form::label('comment', 'コメント', ['class' => 'font-weight-bold']) !!}
        {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
      </div>
        {!! Form::submit('投稿する', ['class'=>'btn btn-info btn-block-right']) !!}
    {!! Form::close() !!}
  </div>
</div>
<script src="{{ asset('/js/main.js') }}"></script>
<hr>

  