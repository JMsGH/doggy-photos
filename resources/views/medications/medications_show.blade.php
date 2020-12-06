@extends('layouts.app')
@section('content')

<h2 class="mt-5 mb-4">フィラリア予防投薬予定・記録</h2>

@if (!$data)
  <h5 class="mb-4">
        投薬開始日と投薬回数を設定しますか？<br>
        設定すると設定した回数分、31日間ごとに投薬予定日が表示されます。
  </h5>
  <h5 class="ml-2">
    {!! link_to_route('medications.input', '[設定する]', ['class' => 'font-weight-bold btn-link']) !!}
  </h5>


@elseif ($data->counter == $data->number_of_times)
  <h5 class="mb-4">
    投薬回数分の投薬を終えました。新たに設定しますか？
  </h5>
  <h5 class="ml-2">
    {!! link_to_route('medications.input', '[設定する]', ['class' => 'font-weight-bold btn-link']) !!}
  </h5>


@else  
<div class="row">
  <div class="col-sm-6">
      <ul class="list-group">
        <li class="list-group-item med-date">
          {{ $data->start_date->format('Y/m/d') }}
          
            {!! link_to_route('medications.toUpdate', '投薬日変更', ['id' => $data->user_id, 'id2' => $data->id], ['class' => 'btn-link']) !!}
            
            {{-- {!! Form::open(['route' => 'medications.administered']) !!}
          {!! Form::submit('投薬完了', ['id' => $data->id, 'user_id' => $data->user_id], ['class'=>'btn btn-sm-success', ]) !!}
          {!! Form::close() !!} --}}
          
        </li>
    
        <div style="display: none;">
          {{ $i = 0 }}
        </div>
        @while($i < ($data->number_of_times-1))
        <li class="list-group-item med-date">
          <div style="display: none;">
            {{ $data->start_date = ($data->start_date->addDay(31)) }}
          </div>
          {{ $data->start_date->format('Y/m/d') }}
          <div style="display: none;">
          {{ $i++ }}
          </div>

        </li>
        @endwhile
      </ul>
  </div>
</div>



  
@endif

@endsection