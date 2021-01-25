@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-5 col-md-5">
                <img src="https://dog-photos-bucket.s3-ap-northeast-1.amazonaws.com/welcome_page_img.png" class="profile-img rounded-circle img-thumbnail border-0 animated rollIn">
            </div>
            <div class="col-sm-6 align-items-center">
                <h1 class="text-center animated bounceInDown">犬フォト！ <i class="fas fa-paw awesome"></i></h1>
            </div>
            </div>
        
            <div class="mt-5 text-center">
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '登録する', [], ['class' => 'btn btn-primary btn-default']) !!}
            </div>
        
            <div class="mt-5 text-center mb-5">
            {{-- ログインページへのリンク --}}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-info btn-default']) !!}
            </div>
        </div>
    </div>

    <div class="s-body">
    <div class="wrapper mt-5">
        <div class="scroll-text">
            <h3 class="text-center mb-4 text-info">このサイトについて</h3>
            <div class="text-center mt-4 about-text">
            <p class="animated slideInLeft"><i class="fas fa-paw awesome"></i> 愛犬の写真を投稿して他のユーザに公開できます。</p>
            <p class="animated slideInRight"><i class="fas fa-paw awesome"></i> 他のユーザをフォローできます。</p>
            <p class="animated slideInLeft"><i class="fas fa-paw awesome"></i> 写真をお気に入りとして登録できます。</p>
            <p class="animated slideInRight"><i class="fas fa-paw awesome"></i> フィラリア予防の投薬スケジュールを登録できます。</p>
            <p class="animated slideInLeft"><i class="fas fa-paw awesome"></i> 愛犬を登録できます。</p>
            <p class="animated slideInRight"><i class="fas fa-paw awesome"></i> 登録した愛犬ごとに体重を記録しグラフを表示できます。</p>
            </div>
        </div>
    </div>
    </div>



        
    
    

    
@endsection