<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog; // 追加
use App\Weight; // 追加

class WeightController extends Controller
{
  // 認証済みユーザ（閲覧者）の愛犬用体重入力ページを表示
  public function create($id, $dogId)
  {
    // dd($dogId);
    $dog = \App\Dog::findOrFail($dogId);
    $userId = $dog->user_id;
    
    // 体重入力ページを表示
    if (\Auth::id() == $userId) {
      return view('weights.create', [
        'dog' => $dog,
        'id' => $userId
      ]);      
    } else {
      return view('/');
    }

  }
  
  public function store(Request $request, $id, $dogId)
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
    
    $weights = Weight::where('dog_id', $dogId)
      ->orderBy('date_weighed', 'asc')->paginate(20);
          // ->get();
      
    // 体重表示ページへ移動
    // return view('weights.show', compact('weights'));
    $dog = \App\Dog::find($dogId);
    $userId = $dog->user_id;
    $photo = $dog->photo;
    
    $weightLogs = [];
    $dateLabels = [];
    $weightIds = [];    
    
    foreach($weights as $weight){
      $weightLog = $weight->weight;
      $dateLabel = $weight->date_weighed;
      $weightId = $weight->id;
      array_push($weightLogs, $weightLog);
      array_push($dateLabels, $dateLabel);
      array_push($weightIds, $weightId);
      
    }
    
    // dd($dateLabels, $weightLogs);
    
    // $targetDays = [$data->date_weighed];
    // dd($targetDays);
    
    
    // viewに体重データを渡す
    return view('weights.show', [
      'dog' => $dog,
      'dog_id' => $dogId,
      'weights' => $weights,
      'weight_logs' => $weightLogs,
      'date_labels' => $dateLabels,
      'weight_ids' => $weightIds,
      'photo' => $photo,
      'id' => $userId
    ]);
  }
  
  public function show($id, $dogId)
  {
    // 保存されている体重データを取り出す
    //dd($dogId);
    
    $dog = \App\Dog::findOrFail($dogId);
    $userId = $dog->user_id;
    $photo = $dog->photo;
    
    // dd(\Auth::id());
    
    if (\Auth::id() == $userId) {
    
      if (Weight::where('dog_id', '=', $dogId)->count() > 0) {
        $weights = Weight::where('dog_id', $dogId)
          ->OrderBy('date_weighed', 'asc')->paginate(20);
          // ->get();
        
        $weightLogs = [];
        $dateLabels = [];
        $weightIds = [];
        
        // dd($data);
        foreach($weights as $weight){
          $weightLog = $weight->weight;
          $dateLabel = $weight->date_weighed;
          //dd($dateLabel);
          $weightId = $weight->id;
          array_push($weightLogs, $weightLog);
          array_push($dateLabels, $dateLabel);
          array_push($weightIds, $weightId);
        }
        
        // viewに体重データを渡す
        return view('weights.show', [
          'dog' => $dog,
          'dog_id' => $dogId,
          'weights' => $weights,
          'weight_logs' => $weightLogs,
          'date_labels' => $dateLabels,
          'weight_ids' => $weightIds,
          'photo' => $photo,
          'id' => $userId
        ]);
        
        
      
      // 体重データがない場合は$data=nullとしてビューを表示
      } else {
        $weights = null;
        return view('weights.show', [
          'weights' => $weights,
          'dogId' => $dogId,
          'photo' => $photo,
          'id' => $userId
        ]);
      }
    } else {
        session()->flash('flash_message', 'ご自分の愛犬の体重記録のみ表示できます');
        return redirect('/');
    }
  }
    

  public function update($weightId) 
  {
    $weight = \App\Weight::find($weightId);
    $dogId = $weight->dog_id;
    $dog = \App\Dog::find($dogId);
    $userId = $dog->user_id;
    
    $weight->date_weighed = strip_tags($_POST['date_weighed']);
    $weight->weight = strip_tags($_POST['weight']);
    $weight->save();
    
    $weights = Weight::where('dog_id', $dogId)
          ->OrderBy('date_weighed', 'asc')
          ->get();
          
    session()->flash('flash_message', '修正したデータに合わせてグラフを再描画しました');
    // return response()->json($weights);
    
    return view('weights.update', [
      'dog' => $dog,
      'dogId' => $dogId,
      'weightId' => $weightId,
      'weight' => $weight,
      'id' => $userId
    ]);

  }  
  
  // 体重データの削除
  public function destroy($weightId)
  {
    // idの値で検索して取得
    $weight = \App\Weight::findOrFail($weightId);
    
    // 認証済みユーザ（閲覧者）がその体重データが所属する犬の所有者である場合体重データを削除
    $dogId = $weight->dog_id;
    $dog = \App\Dog::findOrFail($dogId);
    $userId = $dog->user_id;
    
    //dd($weightId);
    
    if (\Auth::id() === $userId) {
      $weight->delete();
    }
    
    if (Weight::where('dog_id', '=', $dogId)->count() > 0) {
      $weights = Weight::where('dog_id', $dogId)
        ->OrderBy('date_weighed', 'asc')
        ->get();
      
      // 前のURLへリダイレクト 
      session()->flash('flash_message', '体重データを削除しました');
      // return redirect(route('weights.show', [
      //   'dog_id' => $dogId,
      //   'logs' => $weights,
      //   'weight_logs' => $weightLogs,
      //   'date_labels' => $dateLabels,
      //   'weight_ids' => $weightIds,
      //   'photo' => $photo
      // ]));
      
      return view('weights.delete', [
        'dog' => $dog,
        'dogId' => $dogId,
      ]);
    
    // 体重データがない場合は$data=nullとしてビューを表示
    } else {
      $weights = null;
      return view('weights.show', [
        'weights' => $weights,
        'dogId' => $dogId,
        'photo' => $photo
      ]);
    }
    
  }

  
}
