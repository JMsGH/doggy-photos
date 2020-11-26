<?php

namespace App\Lib;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

// use App\User;  // 追加

class PhotoUpload
{
    // S3に画像ファイルを保存する
    
    /**
     * S3に画像ファイルを保存する
     * 
     * 引数：ファイルオブジェクト
     * 戻り値：画像ファイルへのフルパス
     * 
     */ 
     public $photo = '';
     public $disk = '';
     
     function photoUpload (Request $request) 
     {
        $user = \Auth::user();
        
        // $this->validate($request, [
        //   'photo' => [
        //   // アップロードされたファイルであること
        //   'file',
        //   // 画像ファイルであること
        //   'image',
        //   // MIMEタイプを指定
        //   'mimes: jpeg, png'
        //   ]
        // ]);
       
        
        // ファイル存在とバリデーションのチェック
        if ($request->hasFile('photo'))
        {
    
          $disk = Storage::disk('s3');
          
          $photo = $disk->put('', $request->file('photo'));
             
          return $photo;
            
         } else {
           return false;
         }
     }
}
    