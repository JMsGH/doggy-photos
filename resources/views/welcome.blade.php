@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                <img src="https://dog-photos-bucket.s3-ap-northeast-1.amazonaws.com/welcome_page_img.png" class="profile-img rounded-circle img-thumbnail border-0">
            </div>
            <div class="col-sm-6 align-items-center">
                <h1 class="text-center">犬フォト！ <i class="fas fa-paw"></i></h1>
            </div>
        </div>
        
        <div class="mt-5 text-center">
        {{-- ユーザ登録ページへのリンク --}}
        {!! link_to_route('signup.get', '登録する', [], ['class' => 'btn btn-primary btn-default']) !!}
        </div>
        
        <div class="mt-5 text-center">
        {{-- ログインページへのリンク --}}
        {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-info btn-default']) !!}
        </div>


        
    </div>
    

    
@endsection