@extends('layouts.app')
@section('content')

<div class="text-center">
<h2 class="mt-5 mb-4">フィラリア予防薬 投薬予定・記録</h2>

@if (!$data)
  <h5 class="mb-4 line-spacing-wider">
        投薬開始日と投薬回数を設定しますか？<br>
        設定すると設定した回数分、31日間ごとに投薬予定日が表示されます。
  </h5>
  <h5 class="ml-2">
    {!! link_to_route('medications.input', '[設定する]', ['class' => 'font-weight-bold btn-link']) !!}
  </h5>
</div>


@elseif ($data->counter == $data->number_of_times)
  <h5 class="mb-4">
    投薬回数分の投薬を終えました。新たに設定しますか？
  </h5>
  <h5 class="ml-2">
    {!! link_to_route('medications.input', '[設定する]', ['class' => 'font-weight-bold btn-link']) !!}
  </h5>


@else
<div class="row justify-content-md-center">
  <div class="col-sm-8">
    
    <h5 class="mb-4 text-primary">
      @if ($data->counter > 0)
        {{ $data->counter }}回投薬済みです。残り{{ $data->number_of_times - $data->counter }}回です。
      @endif
    </h5>
    
    @if ((count($adminDates) == 0))
    <div></div>
    @else
      <ul class="list-group">
        @foreach($adminDates as $date)
          <li class="list-group-item med-date">
            <div class="row justify-content-md-left">
              <div class="col-sm-3 text-left date-administered">  
                  {{ $date->administered_date }}
              </div>
              <div class="col-sm-3 text-left date-administered">
                  投薬完了
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    @endif
  
    
      <ul class="list-group">
        <li class="list-group-item med-date">
          <div class="row justify-content-md-left">
          <div class="col-sm-3 text-left">
          {{-- {{ $data->start_date->format('Y/m/d')) . '　' }} --}}
          {{ date('Y-m-d', strtotime($data->start_date)) }}
          </div>
          
          @if (date("Y-m-d H:i:s") > ($data->start_date))
            <div class="col-sm-3">
            {!! Form::open(['route' => ['medications.administered', $data->id]]) !!}
              {!! Form::hidden('id', $data->id) !!}
              {!! Form::hidden('adminDate', $data->start_date) !!}
              {!! Form::submit('投薬完了', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}
            </div>
            
            {{-- <div class="col-sm-3">
            {!! Form::open(['route' => ['medications.reminder', $data->id]]) !!}
              {!! Form::hidden('id', $data->id) !!}
              {!! Form::submit('リマインダー', ['class'=>'btn btn-info']) !!}
            {!! Form::close() !!}
            </div>  --}}
            
          @endif
            <div class="col-sm-3">
            {!! link_to_route('medications.edit', '投薬日変更', ['medId' => $data->id], ['class' => 'btn-link']) !!}
            </div>
          </div>
          
        </li>
    
        <div style="display: none;">
          {{ $i = 0 }}
        </div>
        
        @while($i < (($data->number_of_times)-1-($data->counter)))
        <li class="list-group-item med-date text-left">
          <div style="display: none;">
          {{-- {{ $data->start_date = ($data->start_date->addDay(31)) }} --}}
          {{ $data->start_date = date('Y-m-d', strtotime($data->start_date . '+31 days')) }}
          </div>
          {{-- {{ $data->start_date->format('Y-m-d') }} --}}
          {{ date('Y-m-d', strtotime($data->start_date)) }}
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