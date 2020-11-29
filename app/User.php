<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
    * このユーザが所有する投稿（Postモデルとの関係を定義）
    */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    
    /**
    * このユーザがフォロー中のユーザ。（Userモデルとの関係を定義）
    */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'users_followed', 'user_id', 'follow_id')->withTimestamps();
    }
    
    /**
    * このユーザをフォロー中のユーザ（Userモデルとの関係を定義）
    */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'users_followed', 'user_id', 'user_id')->withTimestamps();
    }
    
    /**
     * $userIdで指定されたユーザをフォローする
     * 
     * @param int $userId
     * @return bool
     */
     public function follow($userId)
     {
         // すでにフォローしているかの確認
         $exist = $this->is_following($userId);
         // 相手が自分自身かどうかの確認
         $its_me = $this->id == $userId;
         
         if ($exist || $its_me) {
             // 既にフォロー済みの場合は何もしない
             return false;
         } else {
             // 見フォローであればフォローする
             $this->followings()->attach($userId);
             return true;
         }
     }
     
     /** 
       * $userIdで指定されたユーザをアンフォローする
       * 
       * @param int $userId
       * @return bool
       */ 
       public function unfollow($userId)
       {
            // すでにフォローしているかの確認
            $exist = $this->is_follwing($userId);
            // 相手が自分自身かどうかの確認
            $its_me = $this->id == $userId;
            
            if ($exist && !$its_me)
            {
                // すでにフォローしていればフォローを解除
                $this->followings()->detach($userId);
                return true;
            } else {
                // 未フォローであれば何もしない
                return false;
            }
       }
       
       /**
        * 指定された$userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中なら true を返す
        * 
        * @param int $userId
        * @return bool
        */
        public function is_following($userId)
        {
            // フォロー中ユーザの中に$userIdのものが存在するか
            return $this->followings()->where('follow_id', $userId)->exists();
        }
        
        /**
         * このユーザに関係するモデルの件数をロードする
         */
         public function loadRelationshipCounts()
         {
             $this->loadCount(['posts', 'followings', 'followers']);
         }
    
}
