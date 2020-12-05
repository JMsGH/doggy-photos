<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FilariasisMedication; // 追加

class FilariasisMedicationsController extends Controller
{
    public function store(Request $request)
    {
            // バリデーション
      $request->validate([
        'start_date' => 'required | after:yesterday',
        'number_of_times' => 'integer | gte:1',
      ]);
      
      $medication = new FilariasisMedication();
      
      // 認証済みユーザ（閲覧者）の投薬スケジュールとして作成（リクエストされた値をもとに作成）
      $medication->user_id = \Auth::id();
      $medication->start_date = $request->start_date;
      $medication->number_of_times = $request->number_of_times;
      
      $medication->save();
      
      
      // 投薬日表示ページへ移動
      return view('medications.medications_show', ['user_id' => \Auth::id()]);
    }
    
    // 認証済みユーザ（閲覧者）の投薬予定・確認ページを表示
    public function show()
    {
      $userId = \Auth::id();
      
      // データがある場合
      if (FilariasisMedication::where('user_id', '=', $userId)->count() > 0) {
         $data = FilariasisMedication::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
      
        // return $data;
        return view('medications.medications_show', ['start_date' => $data->start_date]);
        
        // データがない場合は start_date は null としてビューを表示
      } else {
        return view('medications.medications_show', ['start_date' => null]);
      }
     
    }
    
    // 認証済みユーザ（閲覧者）の投薬開始日･回数設定ページを表示
    public function input()
    {
      return view('medications.input');
    }
    
}
