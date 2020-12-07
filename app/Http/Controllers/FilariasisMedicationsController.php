<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FilariasisMedication; // 追加
use App\AdministeredDate; // 追加

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
          return view('medications.medications_show')->with(['data' => $data]);
        
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
    public function toUpdate()
    {
      $userId = \Auth::id();
      $data = FilariasisMedication::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
      
      $medId = $data->id;
      
       // 'update.blade'は投薬日変更用ビュー
      return view('medications.update', [
        'user_id' => $userId,
        'id' => $medId,
      ]);
    }
    
    // 投稿日を変更するアクション
    public function update(Request $request)
    {
      $userId = \Auth::id();
      $medId = $request->id;
      
      $data = FilariasisMedication::where('id', '=', $medId)->get();
      
      $med = FilariasisMedication::find($request->id);
      $med->start_date = $request->start_date;
      $med->save();
      
      // 投薬予定日ページにリダイレクト
      return redirect()->route('medications.show', ['id' => $userId, 'id2' => $medId]);
      
    }
    
    // 投薬完了を確定させるアクション
    public function administered(Request $request)
    {
      $userId = \Auth::id();
      $medId = $request->id;
      $administeredDate = $request->adminDate;
      
      $adminDate = new AdministeredDate();
      
      // 認証済みユーザ（閲覧者）の投薬完了として作成（リクエストされた値をもとに作成）
      $adminDate->user_id = $userId;
      $adminDate->medication_id = $medId;
      $adminDate->administered_date = $administeredDate;
      
      $adminDate->save();
      
      $med = FilariasisMedication::find($medId);
      $currentDate = $med->start_date;
      $med->start_date = $currentDate->addDay(31);
      
      $currentCounter = $med->counter;
      $med->counter = $currentCounter + 1;
      
      $med->save();
      
      $data = \App\FilariasisMedication::where('id', $medId)->get();

      
      // 投薬予定日ページにリダイレクト
      return redirect()->route('medications.show', ['id' => $userId, 'id2' => $medId]);
      
    }
    
}
