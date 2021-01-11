<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = [
      'weight',
    ];
    
    protected $dates = [
      'date_weighed' => 'date:Y/m/d',
      'created_at'=> 'date: Y-m-d H:i:s',
      'updated_at'=> 'date: Y-m-d H:i:s',  
    ];
    
  /**
   * この体重レコードが所属する犬（dog modelとの関係を定義）
   */
   public function dog ()
   {
     return $this->belongsTo(Dog::class);
   }
}
