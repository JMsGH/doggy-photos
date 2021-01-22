<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 追加
use Collective\Html\Eloquent\FormAccessible;
use Carbon\Carbon;



class Dog extends Model
{
    protected $fillable = [
      'dog_name', 'birthday', 'photo', 'comment',
    ];
    
    protected $dates = [
        'birthday' => 'date:Y/m/d',
        'created_at'=> 'date: Y-m-d H:i:s',
        'updated_at'=> 'date: Y-m-d H:i:s',
    ];
    
   
    
    /**
     * この犬の飼い主であるユーザ（ユーザモデルとの関係を定義）
     */
     public function user ()
     {
       return $this->belongsTo(User::class);
     }
     
     
     use FormAccessible;
     
     /**
      * Get the dog's date of birth.
      * 
      * @param string $value
      * @return string
      
      public function getBirthdayAttribute($value)
      {
          return Carbon::parse($value)->format('Y/m/d');
      }
      */
      /**
     * Get the dog's date of birth for forms.
     *
     * @param  string  $value
     * @return string
     
      public function formBirthdayAttribute($value)
      {
          return Carbon::parse($value)->format('Y/m/d');
      }
    */
      
    /**
     * この犬に属する体重レコード（Weightモデルとの関係を定義）
     */
     public function weights() 
     {
       return $this->hasMany(Weight::class);
     }
}
