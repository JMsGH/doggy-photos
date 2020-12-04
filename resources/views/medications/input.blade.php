@extends('layouts.app')

@section('content')

<h5>投薬開始日と投薬回数の設定</h5>
  <div class="container"></div>
  <form action="users/{id}/medications/{medication}/medications_show" method="post">
  <div class="form-group">
    <label for="start_date">投薬開始日</label>
    <input class="form-control" type="date" name="start_date">
  </div>
  <div class="form-group">
    <label for="number_of_times">投薬回数</label>
    <input type="text" name="number_of_times" class="form-control">   
  </div>
  <button type="submit" class="btn btn-info">設定する</button>
  </form>


@endsection


