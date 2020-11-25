<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;  // 追加

use App\Lib\PhotoUpload;  // 追加

use Illuminate\Support\Facades\Storage;  // 追加

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
          
          // s3にファイルを保存し、保存したファイル名を取得する
          $userPhoto = new PhotoUpload();
          
          $data = [
          'photo' => $userPhoto,
          ];
          
          return back();
        
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
