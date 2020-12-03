<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministeredDate extends Model
{
    protected $fillable = [
      'administered_date'
    ];
    
    /**
     * この投薬スケジュールを所有するユーザ（Userモデルとの関係を定義）
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    
    /**
     * この投薬スケジュールが属する投薬スケジュールFilariasisMedicationモデルとの関係を定義）
     */
    public function user()
    {
      return $this->belongsTo(FilariasisMedication::class);
    }
    
    /**
     * 投薬確定日をテーブルに保存
     * 
     * @param 
     * @return
     */
     public function storeDate()
     {
       // 
     }
}
