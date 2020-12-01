@extends('layouts.app')

@section('content')
  <div class="row">
    <aside class="col-sm-4 mt-4">
      {{-- 写真 --}}
      <img class="img-fluid mb-2" src="{{ $post->photo }}" alt="投稿写真">

        <div class="row post-button">
          {{-- お気に入りボタン --}}
          <div class="col-sm-9">
            @include('posts.favorite_button')
          </div>
          {{-- 削除ボタン --}}
          <div class="col-sm-3">
            @include('posts.posts_delete_form')
          </div>
        </div>
        
        
    </aside>
    
    <div class="col-sm-8 mt-4">
      {{-- コメント --}}
      <h5 class="mb-3">コメント</h5>
      <p class="shadow-lg p-3 mb-5 bg-white rounded">{!! nl2br(e($post->comment)) !!}</p>
      
    </div>
    
  </div>
@endsection