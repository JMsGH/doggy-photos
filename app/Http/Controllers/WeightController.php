<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog; // 追加
use App\Weight; // 追加

class WeightController extends Controller
{
  // 認証済みユーザ（閲覧者）の愛犬用体重入力ページを表示
  public function create($dogId)
  {
    // dd($dogId);
    $dog = \App\Dog::findOrFail($dogId);
    
    // 体重入力ページを表示
    return view('weights.create', [
      'dog' => $dog
    ]);
  }
  
  public function store(Request $request, $dogId)
  {
    // バリデーション
    $request->validate([
      'date_weighed' => 'required', 
      'weight' => 'required | numeric | gte:0',
    ]);
    
    $weight = new Weight();
    
    // その$dogIdを持つ犬の体重記録として作成（リクエストされた値をもとに作成）
    $weight->dog_id = $dogId;
    $weight->date_weighed = $request->date_weighed;
    $weight->weight = $request->weight;
    
    $weight->save();
    
    $logs = Weight::where('dog_id', $dogId)
      ->orderBy('date_weighed', 'asc')
      ->get();
      
    // 体重表示ページへ移動
    // return view('weights.show', compact('logs'));
    $dog = \App\Dog::find($dogId);
    $photo = $dog->photo;
    
    $weightLogs = [];
    $dateLabels = [];
    
    // dd($data);
    foreach($logs as $log){
      $weight = $log->weight;
      $dateLabel = $log->date_weighed;
      array_push($weightLogs, $weight);
      array_push($dateLabels, $dateLabel);
    }
    
    // dd($dateLabels, $weightLogs);
    
    // $targetDays = [$data->date_weighed];
    // dd($targetDays);
    
    
    // viewに体重データを渡す
    return view('weights.show', [
      'dog_id' => $dogId,
      'logs' => $logs,
      'weight_logs' => $weightLogs,
      'date_labels' => $dateLabels,
      'photo' => $photo
    ]);
  }
  
  public function show($dogId)
  {
    // 保存されている体重データを取り出す
    //dd($dogId);
    
    $dog = \App\Dog::find($dogId);
    $photo = $dog->photo;
    
    if (Weight::where('dog_id', '=', $dogId)->count() > 0) {
      $logs = Weight::where('dog_id', $dogId)
        ->OrderBy('date_weighed', 'asc')
        ->get();
      
      $weightLogs = [];
      $dateLabels = [];
      
      // dd($data);
      foreach($logs as $log){
        $weight = $log->weight;
        $dateLabel = $log->date_weighed;
        array_push($weightLogs, $weight);
        array_push($dateLabels, $dateLabel);
      }
      
      // dd($dateLabels, $weightLogs);
      
      // $targetDays = [$data->date_weighed];
      // dd($targetDays);
      
      
      // viewに体重データを渡す
      return view('weights.show', [
        'dog_id' => $dogId,
        'logs' => $logs,
        'weight_logs' => $weightLogs,
        'date_labels' => $dateLabels,
        'photo' => $photo
      ]);
    
    // 体重データがない場合は$data=nullとしてビューを表示
    } else {
      $logs = null;
      return view('weights.show', [
        'logs' => $logs,
        'dogId' => $dogId,
        'photo' => $photo
      ]);
    }
  }
    
  // public function getWeightData($dogId) {
  //   $logs = Weight::where('dog_id', $dogId)
  //     ->OrderBy('date_weighed', 'asc')
  //     ->get();
    
  //   foreach($logs as $log){
  //     $weight = $log->weight;
  //     $dateKey = $log->date_weighed;
  //   }
    
  //   return [
  //     $weight,
  //     $dateKey
  //   ];
  // }
  
}
