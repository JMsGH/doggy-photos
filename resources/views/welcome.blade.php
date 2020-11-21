@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                <img src="{{ url('/images/welcome_page_img.png') }}" alt="doggy_img" class="profile-img img-thumbnail border-0">
            </div>
            <div class="col-sm-6 align-items-center">
                <h1 class="text-center">犬フォト！</h1>
            </div>
        </div>
    </div>
    

    
@endsection