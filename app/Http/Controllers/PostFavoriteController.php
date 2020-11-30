<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostFavoriteController extends Controller
{
   /** postをお気に入りにするアクション
    *  
    * @param $id お気に入りにするpostのid
    * @return \Illuminate\Http\Response
    */
    public function store($id)
    {
      //認証済みユーザ（閲覧者）がidのpostをお気に入りにする
      \Auth::user()->favorite($id);
      // 前のURLへリダイレクトさせる
      return back();
    }
    
    /** postをお気に入りから外すアクション
    *  
    * @param $id お気に入りから外すpostのid
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      // 認証済みユーザ（閲覧者）がidのpostをお気に入りから外す
      \Auth::user()->unfavorite($id);
      // 前のURLへリダイレクトさせる
      return back();
    }
    
    
}
