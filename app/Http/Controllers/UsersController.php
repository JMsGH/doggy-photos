<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;  // 追加

use App\Lib;  // 追加

class UsersController extends Controller
{
    public function index()
    {
      if (\Auth::check()){
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
      } else {
        return view('welcome');
      }
    }
    
     public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        // $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        // $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            // 'posts' => $posts,
        ]);
    }
    
    public function createPhoto ()
    {
      return view('users.create');
    }
    
    public function storePhoto (Request $request)
    {
        $data;
        $user = \Auth::user();
        // ファイル存在のチェック
        if ($request->hasFile('photo'))
        {
          $disk = Storage::disk('s3');
          
          // s3にファイルを保存し、保存したファイル名を取得する
          $photo = new PhotoUpload();
          
          $data = [
          'photo' => $photo,
          ];
          
          
          // $photoには
          // https://saitobucket3.s3.amazonaws.com/uhgKiZeJXMFhL9Vr7yT7XvlJqonPNx30xbJYoEo0.jpeg
          // のような画像へのフルパスが格納されている
          // このフルパスをDBに格納しておくと、画像を表示させるのは簡単になる
          dd($disk->url($fileName));
        }
    }
    
    /** ログインしているユーザのマイページを表示するアクション
        * 
        * @param $id ユーザのid
        * @return \Illumiate\Http\Response
        */
    // public function mypage($id)
    // {
    //   $id = \Auth::id();
      
    //   $user = User::findOrFail($id);
      
    //   // 関係するモデルの件数をロード
    //   // $user->loadRelationshipCounts();
      
    //   return view('users.mypage', [
    //     'user' => $user,
    //   ]);
    // }
}
