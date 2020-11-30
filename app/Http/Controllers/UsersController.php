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
        if (\Auth::check()){
            // idの値でユーザを検索して取得
            $user = User::findOrFail($id);
    
            // 関係するモデルの件数をロード
            $user->loadRelationshipCounts();
    
            // ユーザの投稿一覧を作成日時の降順で取得
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
    
            // ユーザ詳細ビューでそれらを表示
            return view('users.show', [
                'user' => $user,
                'posts' => $posts,
            ]);
        }else {
        return view('welcome');
      }
    }
    
    public function createPhoto ()
    {
      return view('users.create');
    }
    
    public function storePhoto (Request $request)
    {
        
          
          // s3にファイルを保存し、保存先のパスを取得する
          $userPhoto = new PhotoUpload();
          
          $path = $userPhoto->photoUpload($request);
          
          if ($path) {
            $user = \Auth::user();
            $user->photo = $path;
            $user->save();
          }
          
          return back();
        
      }
      
      /**
       * ユーザのフォロー一覧ページを表示するアクション
       * 
       * @param $id ユーザのid
       * @return \Illuminate\Http\Response
       */
       public function followings($id)
       {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロー一覧を取得
         $followings = $user->followings()->paginate(10);
         
         // フォロー一覧ビューでそれらを表示
         return view('users.followings', [
          'user' => $user,
          'users' => $followings,
          ]);
       }
       
      /**
       * ユーザのフォロワー一覧ページを表示するアクション
       * 
       * @param $id ユーザのid
       * @return \Illuminate\Http\Response
       */
       public function followers($id)
       {
         // idの値でユーザを検索して取得
         $user = User::findOrFail($id);
         
         // 関係するモデルの件数をロード
         $user->loadRelationshipCounts();
         
         // ユーザのフォロワー一覧を取得
         $followers = $user->followers()->paginate(10);
         
         // フォロワー一覧ビューでそれらを表示
         return view('users.followers', [
          'user' => $user,
          'users' => $followers,
          ]);
       }
       
       /** ユーザのお気に入り投稿の一覧を表示するアクション
        * 
        * @param $id ユーザのid
        * @return \Illuminate\Http\Response
        */
        public function favorites($id)
        {
            $user = \Auth::user();
            
            // 関係するモデルの件数をロード
            $user->loadRelationshipCounts();
            
            // ユーザのお気に入りの投稿の一覧を作成日の降順で取得
            $posts = $user->favorites()->orderBy('created_at', 'desc')->paginate(10);
            
            return view('users.favorites', [
                'user' => $user,
                'posts' => $posts,
                'id' => $user->id,
            ]);
        }
       
      
    
     
}
