@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-info text-white font-weight-bolder" >ユーザー情報の編集</div>
        <div class="card-body">
          <form action ="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <table class="table">
          <tbody>
            <tr>
              <th scope="row">ユーザー名</th>
              <td><input type="text" name="name" value="{{ $user->name }}" /></td>
            </tr>
            <tr>
              <th scope="row">メールアドレス</th>
              <td><input type="text" name="email" value="{{ $user->email }}" /></td>
            </tr>
            <tr>
              <th scope="row">自己・愛犬紹介</th>
              <td><textarea name="about_me_and_dog">{{ $user->about_me_and_dog }}</textarea>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination justify-content-end">
          <input class="btn-weight" type="submit" value="変 更" />
        </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection