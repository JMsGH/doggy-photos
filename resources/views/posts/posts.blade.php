@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="flash_message bg-info text-center py-2 my-0">
        {{ session('flash_message') }}
    </div>
@endif


<h2 class="mt-5 mb-5 text-center">ギャラリー</h2>

{{-- 投稿一覧を表示 --}}
@include('posts.posts_grid')

@endsection
