@extends('layouts.app')

@section('content')

<h2 class="mt-5 mb-5 text-center">ギャラリー</h2>

{{-- 投稿一覧を表示 --}}
@include('posts.posts_grid')

@endsection
