<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 // 追加
use App\AdministeredDate;
use App\User;
// use Illuminate\Notifications\Notifiable; 
// use App\Notifications\ReminderMail; 

class FilariasisMedication extends Model
{
    protected $fillable = [
      'start_date',
      'number_of_times',
      'counter',
    ];
    
    protected $dates = [
      'start_date' => 'date:Y-m-d', 
    ];
    
    // use Notifiable;

  
    /**
     * この投薬スケジュールを所有するユーザ（Userモデルとの関係を定義）
     */
    public function medication_user()
    {
      return $this->belongsTo(User::class);
    }
    
    /**
     * この投薬スケジュールに属する投薬確定日（AdministeredDateモデルとの関係を定義）
     */
    public function administered_date()
    {
      return $this->hasMany(AdministeredDate::class);
    }
    
}
