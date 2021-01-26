<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FilariasisMedication; // 追加
use App\AdministeredDate; // 追加
use App\User; // 追加
// use Illuminate\Notifications\Notifiable; // 追加

class FilariasisMedicationsController extends Controller
{
    // use Notifiable;

    // 認証済みユーザ（閲覧者）の投薬開始日･回数設定ページを表示
    public function input()
    {
      return view('medications.input');
    }
    
    
    public function store(Request $request)
    {
            // バリデーション
      $request->validate([
        'start_date' => 'required',  // 過去に遡って設定する可能性があるので、条件 after: yesterday を削除
        'number_of_times' => 'integer | gte:1',
      ]);
      
      $medication = new FilariasisMedication();
      
      // 認証済みユーザ（閲覧者）の投薬スケジュールとして作成（リクエストされた値をもとに作成）
      $medication->user_id = \Auth::id();
      // dd($request->start_date);
      $medication->start_date = $request->start_date;
      $medication->number_of_times = $request->number_of_times;
      
      $medication->save();
      
      $userId = \Auth::id();
      
      $data = FilariasisMedication::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
            
      $adminDates = [];
      
      if ($data->user_id == \Auth::id()){
      
      // 投薬日表示ページへ移動
      return view('medications.medications_show', with([
          'data' => $data,
          'adminDates' => $adminDates
      ]));
      
      } else {
          session()->flash('flash_message', '表示できるのは本人が登録した投薬情報のみです。');
          return redirect('/');
      }
    }
    
    // 認証済みユーザ（閲覧者）の投薬予定・確認ページを表示
    public function show($id)
    {
      $userId = \Auth::id();
      
      //dd($id, $userId);
      
      if ($userId == $id) {
      
        // データがある場合
        if (FilariasisMedication::where('user_id', '=', $userId)->count() > 0) {
           $data = FilariasisMedication::where('user_id', $userId)
              ->orderBy('created_at', 'desc')
              ->first();
        
        $medId = $data->id;
              
        $adminDates = \App\AdministeredDate::where('medication_id', $medId)->orderBy('administered_date', 'desc')->get();
        
            // 取得した $data を viewに渡す
            return view('medications.medications_show')->with([
              'data' => $data,
              'medication' => $medId,
              'adminDates' => $adminDates
            ]);
          
          // データがない場合は start_date は null としてビューを表示
        } else {
          $data = null;
          return view('medications.medications_show', ['data' => $data]);
        }
      
      } else {
          session()->flash('flash_message', '表示できるのは本人が登録した投薬情報のみです。');
          return redirect('/');
      }
     
    }
    
    
    // 投薬日を変更するためのビューへ移動
    public function edit($id, $medId)
    {
     
      $data = FilariasisMedication::where('id', $medId)->first();
      
       //dd($data, $data->user_id);
    
      //dd($id, \Auth::id());
      
      if ($id == \Auth::id()) {
        
              // ->orderBy('created_at', 'desc')
              // ->first();
        
        // $medId = $data->id;
        
         // 'update.blade'は投薬日変更用ビュー
        return view('medications.edit', [
          'id' => $id,
          'medId' => $medId,
        ]);

      } else {
          session()->flash('flash_message', '修正できるのは本人が登録した投薬情報のみです。');
          return redirect('/');
      }
    }
    
    
    // 投稿日を変更するアクション
    public function update(Request $request, $id, $medId)
    {
      $userId = \Auth::id();
      $medId = $request->id;
      
      $data = FilariasisMedication::where('id', '=', $medId)->first();
      
      //dd($data);
      
      if ($userId === $data->user_id) {
        $med = FilariasisMedication::find($request->id);
        $med->start_date = $request->start_date;
        $med->save();
        
        $adminDates = \App\AdministeredDate::where('medication_id', $medId)->orderBy('administered_date', 'desc')->get();
        
        // 投薬予定日ページにリダイレクト
        return redirect()->route('medications.show', [
          'id' => $userId, 
          'medication' => $medId,
          'adminiDates' => $adminDates,
        ]);
        
      } else {
          session()->flash('flash_message', '修正できるのは本人が登録した投薬情報のみです。');
          return redirect('/');
      }

    }
    
    // 投薬完了を確定させるアクション
    public function administered(Request $request)
    {
      //dd();
      $userId = \Auth::id();
      $medId = $request->id;
      $administeredDate = $request->adminDate;
      
      $adminDate = new AdministeredDate();
      
      // 認証済みユーザ（閲覧者）の投薬完了として作成（リクエストされた値をもとに作成）
      $adminDate->user_id = $userId;
      $adminDate->medication_id = $medId;
      $adminDate->administered_date = $administeredDate;
      
      $adminDate->save();
      
      $adminDates = \App\AdministeredDate::where('medication_id', $medId)->orderBy('administered_date', 'desc')->get();
      
      //dd($adminDates);
      
      $med = FilariasisMedication::find($medId);
      $currentDate = $med->start_date;
      // $med->start_date = $currentDate->addDay(31);
      $med->start_date = date('Y-m-d', strtotime($currentDate . '+31 days'));
      
      $currentCounter = $med->counter;
      $med->counter = $currentCounter + 1;
      
      $med->save();
      
      // $data = \App\FilariasisMedication::where('id', $medId)->get();

      
      // 投薬予定日ページにリダイレクト
      return redirect()->route('medications.show', [
        'id' => $userId, 
        'medication' => $medId,
        'adminiDates' => $adminDates
      ]);
      
    }
    
    // GETアクセスされたときにトップページにリダイレクト
    public function forceRedirect() {
      
        session()->flash('flash_message', '表示できないページへアクセスされたのでトップページへリダイレクトします。');
        return redirect('/');      
      
    }
    
}
