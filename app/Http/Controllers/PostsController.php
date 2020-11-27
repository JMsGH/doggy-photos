<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lib\PhotoUpload; 

use App\Post;  // 追加

class PostsController extends Controller
{
    public function index()
    {
      $data = [];
      if (\Auth::check()) {
        // 認証済みの場合、postsテーブルの全データを取得
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
          'posts' => $posts,
        ];
        
      // postsビューでそれらを表示
      return view('posts.posts', $data);
        
      } else {
        return view('welcome');
      }
      
    }
    
    public function myIndex()
    {
      $data = [];
      if (\Auth::check()) {
        // 認証済みの場合、認証済みユーザを取得
        $user = \Auth::user();
        // ユーザ投稿の一覧を作成日の降順で取得
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
          'user' => $user,
          'posts' => $posts,
        ];
      }
      
      // postsビューでそれらを表示
      return view('posts.posts', $data);
    }
    
    // 投稿
    public function store(Request $request)
    {
      // バリデーション
      $request->validate([
        'photo' => 'required',
        'comment' => 'max:255',
      ]);
      
      // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値を基に作成）
      
      $post = new Post;
      // s3にファイルを保存し、保存したパスを取得する
        $postedPhoto = new PhotoUpload();
        
        $path = $postedPhoto->photoUpload($request);
        
        
        //この条件は必ずtrueになる
        if ($path) {
          $post->user_id = \Auth::id();
          $post->photo = $path;
          $post->comment = $request->comment;
          $post->save();
        }
        
        return back();
      
    }
    
    // 投稿の削除
    public function destroy(Request $request)
    {
      // idの値で投稿を検索して取得
      $post = \App\Post::findOrFail($id);
      
      // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
      if (\Auth::id() == $post->user_id) {
        $post->delete();
      }
      
      // 前のURLへリダイレクト
      return back();
      
    }
}
