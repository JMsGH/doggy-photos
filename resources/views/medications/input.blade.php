@extends('layouts.app')

@section('content')

<h4 class="mt-5 mb-4 text-center">投薬開始日と投薬回数の設定</h4>
  <div class="row justify-content-center">
  <div class="col-sm-6">
    <form action="{{ route('medications.store', ['id' => \Auth::id()]) }}" method="post">
      @csrf
    <div class="form-group">
      <label for="start_date">投薬開始日</label>
      <input class="form-control" type="text" name="start_date" id="datepicker">
    </div>
    <div class="form-group">
      <label for="number_of_times">投薬回数</label>
      <input type="text" name="number_of_times" class="form-control">   
    </div>
    <button type="submit" class="btn btn-info btn-block-right mt-4">設定する</button>
    </form>
  </div>
  </div>
  

{{-- Bootstrap Datepickerのjsコード --}}
<script type="text/javascript">
  $('#datepicker').datepicker({
    format: "yyyy/mm/dd",
    todayBtn: "linked",
    clearBtn: true,
    todayHighlight: true,
    language: 'ja'
    });
</script>

  {{-- <h5>投薬開始日と投薬回数の設定</h5>
    <div class="container">
      <div class="col-sm-6">
        {!! Form::open(['route' => 'medications.store']) !!}
        <div class="form-group">
          {!! Form::label('start_date', '投薬開始日', ['class' => 'font-weight-bold']) !!}
          {!! Form::date('start_date', ['class' => 'date form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('number_of_times', '投薬回数', ['class' => 'font-weight-bold']) !!}
          {!! Form::text('number_of_times',  ['class' => 'form-control']) !!}
        </div>
          {!! Form::submit('設定する', ['class'=>'btn btn-info']) !!}
        {!! Form::close() !!}
      </div>
    </div> --}}
@endsection


