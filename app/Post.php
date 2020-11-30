<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'photo',
      'comment'
    ];
    
    
    /**
     * この投稿を所有するユーザ（Userモデルとの関係を定義）
     */
     public function user()
     {
       return $this->belongsTo(User::class);
     }
     
    /**
     * この投稿をお気に入りにしているユーザ（Userモデルとの関係を定義）
     */
     public function favorite_users()
     {
       return $this->belongsToMany(User::class, 'user_favorites', 'fav_post_id', 'user_id')->withTimestamps();
     }
}
