@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-sm-7">
    <div class="mt-5">
      <h2 class="mb-4">愛犬登録フォーム <i class="fas fa-paw awesome"></i></h2>
      <h6 class="text-info">容量が2MB以下の写真を保存できます。</h6>
      <div class="custom-file">
        {!! Form::open(['route' => 'dogs.store', 'enctype' => 'multipart/form-data']) !!}
          <div class="form-group">
            {!! Form::file('photo', ['class'=>'custom-file-input mb-2', 'id'=>'inputFile']) !!}
            {!! Form::label('photo','写真 (ドラッグ&ドロップ可)', ['class'=>'custom-file-label', 'for' => 'inputFile', 'data-browse'=>'参照']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('dog_name', '名前', ['class' => 'font-weight-bold']) !!}
            {!! Form::text('dog_name', old('dog_name'), ['class' => 'form-control mb-3']) !!}
            {!! Form::label('birthday', '誕生日', ['class' => 'font-weight-bold']) !!}
            {!! Form::text('birthday', null, ['class' => 'form-control mb-3', 'id' => 'dog-bd-datepicker']) !!}
            {!! Form::label('comment', 'コメント', ['class' => 'font-weight-bold']) !!}
            {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
          </div>
            {!! Form::submit('登録する', ['class'=>'btn btn-info btn-block-right mt-4']) !!}
        {!! Form::close() !!}
      </div>
    </div>
</div>
</div>

{{--
<h2 class="mt-5 mb-5 text-center">愛犬登録フォーム <i class="fas fa-paw"></i></h2>
  <div class="container">
    <div class="row justify-content-center">
  <div class="col-sm-8">
    <form action="{{ route('dogs.store', ['id' => \Auth::id()]) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group mb-2">
        <label for="inputFile">愛犬の写真</label>
        <div class="custom-file">
          <input type="file" name="photo" class="custom-file-input" id="inputFile">
          <label class="custom-file-label" for="inputFile" data-browse="参照">写真を選択（ドラッグ&ドロップ可）</label>
        </div>
      </div>
      <div class="form-group">
        <label for="dog_name">名前</label>
        <input type="text" name="dog_name" class="form-control">   
      </div>
      <div class="form-group">
        <label for="birthday">生年月日</label>
        <input class="form-control" type="date" name="birthday">
      </div>
      <div class="form-group">
        <label for="comment">コメント</label>
        <input type="text" name="comment" class="form-control">   
      </div>
      <button type="submit" class="btn btn-info">登録する</button>
    </form>
  </div>
  </div>
</div>
--}}

<script type="text/javascript">
  $('#dog-bd-datepicker').datepicker({
    format: "yyyy/mm/dd",
    language: "ja"
});
</script>

@endsection