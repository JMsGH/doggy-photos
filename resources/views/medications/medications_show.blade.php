@extends('layouts.app')
@section('content')

<h2>フィラリア予防投薬予定・記録</h2>

@if ($start_date)
  <ul class="list-group">
    <li class="list-group-item">
      {{ $start_date }}
    </li>
    {{-- @foreach($dates as $date)
    <li class="list-group-item">
      
    </li> --}}
  </ul>

@else
  <p>
    投薬開始日と投薬回数を設定しますか？　設定すると投薬予定日が設定した回数だけ31日間ごとに表示されます。
  </p>
  <p>
    {!! link_to_route('medications.input', '設定する', ['class' => 'btn btn-sm btn-info']) !!}
  </p>
  
@endif

@endsection