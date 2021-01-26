@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="flash_message bg-info text-center py-2 my-0 mb-5" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif

  <ul class="list-unstyled">
      <div class="row mb-4">
        <div class="col-sm-5 mb-4">
          {{-- 愛犬登録の画像を取得して表示 --}}
        @if (!($dog->photo))
          <p class="mt-5"></p>
        @else
            <div class="center">
              <img class="mr-2 rounded img-fluid following dog-profile-normal" src="{{$dog->photo}}" />
            </div>
        @endif
            {{-- 愛犬の写真を登録／変更 --}}
            <div class="custom-file">
              @if (\Auth::id() == $dog->user_id)
              {!! Form::open(['route'=>'dogs.photo', 'enctype'=>'multipart/form-data']) !!}
              <div class="form-group">
                {!! Form::file('photo', ['class'=>'custom-file-input mb-2', 'id'=>'inputFile']) !!}
                {!! Form::label('photo', ($dog->photo) ? '写真を変更' : '写真を登録', ['class'=>'custom-file-label', 'for' => 'inputFile', 'data-browse'=>'参照']) !!}
                <div class="row">
                  <div class="col-sm-8">
                    <p class="font-smaller inline-display">（ドラッグ&ドロップ可）</p>  
                    {!! Form::hidden('dogId', $dog->id) !!}
                  </div>
                  <div class="col-sm-4 right">
                    {!! Form::submit(($dog->photo) ? '変更する' : '登録する', ['class'=>'btn btn-info btn-sm btn-right']) !!}
                  </div>
                </div>
              {!! Form::close() !!}
              @endif
              </div>
            </div>

          </div>
          <div class="col-sm-7">
            <div class="font-weight-bold mb-4">
              <h4 class="mb-3">{{ $dog->dog_name }}</h4>
              @if ($dog->birthday)
                <p>誕生日: {{ $dog->birthday}} </p>
              @else
                <p>誕生日</p>
              @endif
              <p>コメント: {{ $dog->comment }} </p>
            </div>
            <div>
              @if (Auth::id() == $dog->user_id)
                {{-- 登録内容修正ページへのリンク --}}
                <div class="row">
                  <div class="col-sm-7 mb-2">
                    <div>
                    {!! link_to_route('dogs.edit', '登録内容修正', ['id' => $dog->user_id, 'dogId' => $dog->id], ['class' => 'btn-edit mb-3']) !!}
                    </div>
                    
                    <div>
                    {{-- 体重記録ページへのリンク --}}
                    {!! link_to_route('weights.show', '体重記録ページ',  ['id' => $dog->user_id, 'dogId' => $dog->id], ['class' => 'btn-edit mb-2']) !!}
                    
                    {{-- 体重入力ページへのリンク --}}
                    {!! link_to_route('weights.create', '体重入力ページ',  ['id' => $dog->user_id, 'dogId' => $dog->id], ['class' => 'btn-edit mb-2']) !!}                    
                    </div>
                    
                    {{-- 愛犬一覧ページへのリンク --}}
                    {!! link_to_route('dogs.index', '愛犬一覧ページ', ['id' => \Auth::id()], ['class' => 'btn-link']) !!}
                  </div>
                  <div class="col-sm-5">
                    {{-- 愛犬登録解除ボタンのフォーム --}}
                    {!! Form::open(['route' => ['dogs.destroy', $dog->id], 'method' => 'delete']) !!}
                        {!! Form::submit('登録を削除', ['class' => 'btn btn-danger btn-sm post-button']) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              @endif
            </div>
          </div>
      </div>

    <hr class="long">
  </ul>
  {{-- ページネーションのリンク --}}
  {{-- {{ $dogs->links() }} --}}

{{-- <script>
    @if (session('flash_message'))
            $(function () {
                    toastr.success('{{ session('flash_message') }}');
            });
    @endif
</script> --}}
  
@endsection
