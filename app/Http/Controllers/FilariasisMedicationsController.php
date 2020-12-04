<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FilariasisMedication; // 追加

class FilariasisMedicationsController extends Controller
{
    public function store(Request $request)
    {
      // 認証済みユーザ（閲覧者）の投薬スケジュールとして作成（リクエストされた値をもとに作成）
      $request->user()->filariasis_medications()->create([
        'start_date' => $request->start_date,
        'number_of_times' => $request->number_of_times
      ]);
      
      // 前のURLへリダイレクト
      return back();
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
