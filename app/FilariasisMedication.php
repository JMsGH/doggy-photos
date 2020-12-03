<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilariasisMedication extends Model
{
    protected $fillable = [
      'start_date',
      'number_of_times',
      'counter',
      'administered'
    ];
  
    /**
     * この投薬スケジュールを所有するユーザ（Userモデルとの関係を定義）
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
}
