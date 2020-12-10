<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 // 追加
use App\AdministeredDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable; 
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable; 
use App\Notifications\ReminderMail; 

class FilariasisMedication extends Model
{
    protected $fillable = [
      'start_date',
      'number_of_times',
      'counter',
      'administered'
    ];
    
    protected $dates = [
      'start_date',  
    ];
    
    use Notifiable;
    use SnoozeNotifiable;
    
  
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
    
    
    // 投薬日当日にメールを送信するアクション
    public function setReminder($id)
    {
      $userId = \Auth::id();
      $userEmail = \App\User::findOrFail($userId);
      $userEmail->notifyAt(new ReminderMail, Carbon::parse($id->start_date));
    }
    
}
