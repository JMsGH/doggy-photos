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
      
      $userId = \Auth::id();
      
      $data = FilariasisMedication::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
      
      
      // 投薬日表示ページへ移動
      return view('medications.medications_show', compact('data'));
    }
    
    // 認証済みユーザ（閲覧者）の投薬予定・確認ページを表示
    public function show()
    {
      $userId = \Auth::id();
      
      // データがある場合
      if (FilariasisMedication::where('user_id', '=', $userId)->count() > 0) {
         $data = FilariasisMedication::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
      
          // 取得した $data を viewに渡す
          return view('medications.medications_show',compact('data'));
        
        // データがない場合は start_date は null としてビューを表示
      } else {
        $data = null;
        return view('medications.medications_show', ['data' => $data]);
      }
     
    }
    
    // 認証済みユーザ（閲覧者）の投薬開始日･回数設定ページを表示
    public function input()
    {
      return view('medications.input');
    }
    
    
    // 投薬日を変更するためのビューへ移動
    public function toUpdate($medId)
    {
      $userId = \Auth::id();
      $medId = 'id2';
      
       // 'update.blade'は投薬日変更用ビュー
      return view('medications.update', [
        'user_id' => $userId,
        'id' => $medId,
      ]);
    }
    
    // 投稿日を変更するアクション
    public function update(Request $request)
    {
      $medId = $request->id;
      
      $data = FilariasisMedication::where('id', '=', $medId)->get();
      
      dd($data);
      
      // $med = FilariasisMedication::find($request->id);
      // $med->start_date = $request->start_date;
      // $med->save();
      
      // // 投薬予定日ページはリダイレクト
      // return redirect()->reoute('medications.show', ['id' => $userId, 'id2' => $medId]);
      
    }
    
}
