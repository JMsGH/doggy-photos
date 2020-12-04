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
    public function date_user()
    {
      return $this->belongsTo(User::class);
    }
    
    /**
     * この投薬スケジュールが属する投薬スケジュールFilariasisMedicationモデルとの関係を定義）
     */
    public function filariasis_medication()
    {
      return $this->belongsTo(FilariasisMedication::class);
    }
    

}
