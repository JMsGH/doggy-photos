@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="flash_message bg-info text-center py-2 my-0 mb-5" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif

<div class="pagebody">
<h2 class="text-center mt-5 mb-5">うちの犬（たち） <i class="fas fa-paw awesome"></i></h2>
  @if (count($dogs)===0)
  <h5 class="text-center text-info">愛犬が登録されていません。</h5>
  @else
  <ul class="list-unstyled">
    @foreach ($dogs as $dog)
      <div class="row justify-content-center mb-4">
        <div class="col-sm-5 mb-4">
        {{-- 愛犬登録の画像を取得して表示 --}}
        @if (!($dog->photo))
          <p class="mt-5"></p>
        @else
          <div class="center mb-2">
            <img class="mr-2 rounded img-fluid following dog-profile-normal" src="{{$dog->photo}}" />
          </div>
        @endif
          {{-- 愛犬の写真を登録／変更 --}}
          <div class="custom-file">
            @if (\Auth::id() == $dog->user_id)
            {!! Form::open(['route'=>'dogs.photo', 'enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
              {!! Form::file('photo', ['class'=>'custom-file-input', 'id'=>'inputFile']) !!}
              {!! Form::label('photo', ($dog->photo) ? '写真を変更' : '写真を登録', ['class'=>'custom-file-label', 'for' => 'inputFile', 'data-browse'=>'参照']) !!}
              <div class="row mt-2">
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
          <div class="font-weight-bold">
          <h4 class="mb-3">{{ $dog->dog_name }}</h4>
          @if (is_null($dog->birthday))
            <p>誕生日</p>
          @else
            <p>誕生日:  {{ $dog->birthday }} </p>            
          @endif
          <p>コメント:</p>
          </div>
          <div>
          <p>{{ $dog->comment }}</p>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <div>
                @if (Auth::id() == $dog->user_id)
                {{-- 愛犬詳細ページへのリンク --}}
                {!! link_to_route('dogs.dog', '愛犬詳細を表示', ['dogId' => $dog->id], ['class' => 'btn-detail mb-2']) !!}
              </div>
              <div>
                  {{-- 登録内容修正ページへのリンク --}}
                  <div>
                  {!! link_to_route('dogs.edit', '登録内容を修正', ['dogId' => $dog->id], ['class' => 'btn-edit mb-2']) !!}
                  </div>
                
                  {{-- 体重記録へのリンク --}}
                  {!! link_to_route('weights.show', '体重記録ページ',  ['dogId' => $dog->id], ['class' => 'btn-weight mb-2']) !!}
                  
                  {{-- 体重入力ページへのリンク --}}
                  {!! link_to_route('weights.create', '体重入力ページ',  ['dogId' => $dog->id], ['class' => 'btn-weight']) !!}
                </div>
              </div>
                
              <div class="col-sm-5">
                  {{-- 愛犬登録解除ボタンのフォーム --}}
                  {!! Form::open(['route' => ['dogs.destroy', $dog->id], 'method' => 'delete']) !!}
                      {!! Form::submit('登録を削除', ['class' => 'btn btn-danger btn-sm post-button']) !!}
                  {!! Form::close() !!}
              </div>
              @endif
            </div>
          </div>
        </div>
    </div>

    <hr class="long">
    
  @endforeach

  </ul>
  {{-- ページネーションのリンク --}}
  {{-- {{ $dogs->links() }} --}}
@endif
</div>
  
  
@endsection
