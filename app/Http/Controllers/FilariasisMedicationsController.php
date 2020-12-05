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
      
      $post_data = $request::all();
      
      // 投薬日表示ページへ移動
      return view('medications.medications_show', compact('post_data'));
    }
    
    // 認証済みユーザ（閲覧者）の投薬予定・確認ページを表示
    public function show()
    {
      return view('medications.medications_show');
    }
    
    // 認証済みユーザ（閲覧者）の投薬開始日･回数設定ページを表示
    public function input()
    {
      return view('medications.input');
    }
    
}
