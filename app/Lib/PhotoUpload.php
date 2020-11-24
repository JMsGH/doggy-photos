<?php

namespace App\Lib;

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
     
     function photoUpload () {
     $photo = $disk->put('', $request->file('photo'));
     }
}
    