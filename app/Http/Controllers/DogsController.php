<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加
use App\Dog; 
use App\Lib\PhotoUpload;

class DogsController extends Controller
{
    public function index ()
    {
      
      $data = [];
      if (\Auth::check()) { // 認証済みユーザの場合
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザの愛犬の一覧を作成日時の降順で取得
        $dogs = $user->dogs()->orderBy('created_at', 'desc')->paginate(5);
        //dd($dogs);
        $data = [
          'user' => $user,
          'dogs' => $dogs,
        ];
      }
    
    // 愛犬一覧viewで表示
    return view('dogs.dogs', $data);
    
    }
    
    public function store(Request $request)
    {
      
      // バリデーション
      $request->validate([
        'dog_name' => 'required | max:255',
      ]);
      
      // 認証済みユーザ（閲覧者）の愛犬として作成（リクエストされた値ともとに作成）
      $dog = new Dog;
      // s3にファイルを保存し、保存したパスを取得する
      $postedPhoto = new PhotoUpload();
        
      $path = $postedPhoto->photoUpload($request);
      
      $dog->user_id = \Auth::id();
      $dog->photo = $path;
      $dog->dog_name = $request->dog_name;
      $dog->birthday = $request->birthday;
      $dog->comment = $request->comment;
      $dog->save();
      
      // $userId = \Auth::id();
      // $user = \Auth::user();
      // $dogs = $user->dogs();
      //$dogs = $user->dogs()->orderBy('created_at', 'desc')->paginate(5);

      
      session()->flash('flash_message', '愛犬が登録されました');
      return view('dogs.dog', [
        'dog' => $dog,
      ]);

    }
    
    public function destroy($id)
    {
      
      // idの値で愛犬を検索して取得
      $dog = \App\Dog::findOrFail($id);
      
      // 認証済みユーザ（閲覧者）がその犬の所有者である場合は、犬の登録を削除
      if (\Auth::id() === $dog->user_id) {
        $dog->delete();
      }
      
      // 前のURLへリダイレクト
      session()->flash('flash_message', '愛犬情報が削除されました');
      return redirect('/');
    }
    
    public function create()
    {
      return view('dogs.dogs_create');
    }
    
    /**
     * 修正する愛犬データ1件を取得して表示
     */
    public function getEdit($dogId)
    {
      
      // dd($dogId);
      $dog = \App\Dog::findOrFail($dogId);
      
      // 'dogs.dogs_edit'は情報修正用ビュー
      return view('dogs.dogs_edit', [
        'dog' => $dog,
      ]);
      
    }
    
    /**
     * 愛犬情報を更新する関数
     * 
     * @param unknown $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
      // $requestedData = $request->all();
      
      $dog = \App\Dog::find($request->id);
      $dog->dog_name = $request->dog_name;
      $dog->birthday = $request->birthday;
      $dog->comment = $request->comment;
      
      // dd($dog);
      
      $dog->save();
      $userId = \Auth::id();
      $user = \Auth::user();
      $dog = \App\Dog::find($request->id);
      
      // dd($dog);

      
      // 愛犬一覧欄ページへリダイレクト
      // return view('dogs.dogs', ['id' => $userId, 'dogs' => $dogs ]);
      session()->flash('flash_message', '修正が保存されました');
      return view('dogs.dog',compact('dog'));
    }
    
    public function storePhoto (Request $request)
    {
          $dogId = $request->dogId;
          
          // s3にファイルを保存し、保存先のパスを取得する
          $dogPhoto = new PhotoUpload();
          
          $path = $dogPhoto->photoUpload($request);
          
          if ($path) {
            $dog = \App\Dog::find($dogId);
            
            $dog->photo = $path;
            $dog->save();
          }
          
          return back();
        
      }
    
    // 愛犬詳細ページへのリンク
    public function show ($dogId)
    {
      $dog = \App\Dog::find($dogId);
      
      return view('dogs.dog')->with([
        'dogId' => $dogId, 
        'dog' => $dog,
      ]);
    }
}
