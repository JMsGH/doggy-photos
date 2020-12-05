<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\AdministeredDate; // 追加

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
    
    
    // ログイン中のユーザに start_date が存在するか確認。存在する場合は start_date と 残りの予約日を取得
    public function ongoingSchedule($userId)
    {
      $userId = \Auth::id();
      $startDate = $userId->start_date;
      $numberOfTimes = $userId->number_of_times;
      $remainingTimes = $numberOfTimes - ($userId->counter);
      $scheduledDates = [];
      $nextDate;
      
      
      if (isset($startDate)) {
        for ($i = 0; $i <= $remainingTimes; $i++) {
          array_push($scheduledDates, $startDate->addDays(31));
          $nextDate = $scheduledDates[i];
         }
        return $scheduledDates;
         
      } else {
        return false;
      }  
    }
    
}
