@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="flash_message bg-info text-center py-2 my-0" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif



<h2 class="mt-5 mb-3 text-center"><i class="far fa-images lil-darker-light-green"></i> ギャラリー</h2>
<p class="font-smaller text-right mb-3">写真をお気に入りにするにはグレーのハートをクリックします。</p>

{{-- 投稿一覧を表示 --}}
<div class="row">
    <div class="col-6"></div>
@include('posts.posts_grid')
</div>

{{-- <script>
    @if (session('flash_message'))
            $(function () {
                    toastr.success('{{ session('flash_message') }}');
            });
    @endif
</script> --}}

@endsection
