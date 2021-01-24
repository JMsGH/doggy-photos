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
        return $this->belongsToMany(User::class, 'users_followed', 'follow_id', 'user_id')->withTimestamps();
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
        $exist = $this->is_following($userId);
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
         $this->loadCount(['posts', 'followings', 'followers', 'favorites', 'dogs']);
     }
         
     /**
      * このユーザのお気に入り投稿（Postモデルとの関係を定義）
      */
      public function favorites()
      {
          return $this->belongsToMany(Post::class, 'user_favorites', 'user_id', 'fav_post_id')->withTimestamps();
      }
      
      /**
       * $postIdで指定された投稿をお気に入りにする
       * 
       * @param int $postID
       * @return bool
       */
    public function favorite($postId)
    {
       // 既にお気に入りにしているかの確認
       $exist = $this->is_favorite($postId);
    
        if ($exist) {
            // すでにお気に入りとしている場合は何もしない
            return false;
        } else {
            // まだお気に入りとしていなければお気に入りとする
            $this->favorites()->attach($postId);
            return true;
        }
    }
                
    /**
    * $postIdで指定された投稿をお気に入りから外す
    * @param int $postId
    * @return bool
    */
    public function unfavorite($postId)
    {
    // 既にお気に入りにしているかの確認
    $exist = $this->is_favorite($postId);
    
    if ($exist) {
        // すでにお気に入りとしている場合はお気に入りから外す
        $this->favorites()->detach($postId);
        return true;
    } else {
        // まだお気に入りとしていなければ何もしない
        return false;
    }
    }
     
    /**
    * 指定された$postIdをこのユーザがお気に入りとしているか調べる。していれば true を返す
    * 
    * @param int $postId
    * @return bool
    */
    public function is_favorite($postId)
    {
      // お気に入りとしている投稿の中にこの $postIdが存在するか
      return $this->favorites()->where('fav_post_id', $postId)->exists();
    }
    
    /**
     * idから1件のデータを取得する
     */
    public function selectUserFindById($id)
    {
        $id = \Auth::id();
        // 「SELECT id, name, email, about_me_and_dog WHERE id = ?」を発行する
        $query = $this->select([
            'id',
            'name',
            'email',
            'about_me_and_dog'
        ])->where([
            'id' => $id
        ]);
        
        // first()で1件のみ取得
        return $query->first();
    }
    
    /**
     * IDで指定したユーザを更新する
     */
    public function updateUserFindById($user)
    {
        $user = \Auth::user();
        
        return $this->where([
            'id' => $user['id']
        ])->update([
            'name' => $user['name'],
            'email' => $user['email'],
            'about_me_and_dog' => $user['about_me_and_dog']
        ]);
    }
    
    /**
     * このユーザが所有する投薬スケジュール（FilariasisMedicationとの関係を定義）
     */
    public function medications()
    {
        return $this->hasMany(FilariasisMedication::class);
    }
           
    /**
     * このユーザが所有する投薬確定日（Administereとの関係を定義）
     */
    public function administeredDates()
    {
        return $this->hasMany(AdministeredDate::class);
    }      
        
    
         // フィラリア投薬当日のリマインダーメールを送信するアクション
    public function sendReminder()
    {
      //
    }  
    
    /**
    * このユーザに所属する犬（Dogモデルとの関係を定義）
    */
    public function dogs()
    {
        return $this->hasMany(Dog::class);
    }
    
    
          
}
