@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        
        <div class="card-header">愛犬情報の編集</div>
        
        @if (Auth::id() == $dog->user_id)
          {!! Form::model($dog, ['method' => 'PATCH', 'action' =>['DogsController@update', $dog->id]]) !!}
          {{ csrf_field()}}
          <table class="table">
            <tbody>
              <input type="hidden" name="id" value="{{ $dog->id }}">
              <tr>
                <th scope="row">名前</th>
                <td>{!! Form::text('dog_name', null, ['class' => 'form-control']) !!}
                </td>
                </td>
              </tr>
              <tr>
                <th scope="row">誕生日</th>
                <td>{!! Form::text('birthday', null, ['class' => 'datepicker form-control', 'id' => 'datepicker']) !!}
                </td>
              </tr>
              <tr>
                <th scope="row">コメント</th>
                <td>{!! Form::textarea('comment', null, ['class' => 'form-control'], ['rows' => '2']) !!}
                </td>
              </tr>
            </tbody>
          </table>
          <div class="text-right mr-2 mb-2">
            {!! Form::submit('修正', ['class'=>'btn btn-info']) !!}
            {!! Form::close() !!}
          </div>

        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#datepicker').datepicker({
    format: "yyyy/mm/dd",
    maxViewMode: 3,
    todayBtn: true,
    clearBtn: true,
    language: "ja",
    beforeShowDay: function(date){
          if (date.getMonth() == (new Date()).getMonth())
            switch (date.getDate()){
              case 4:
                return {
                  tooltip: 'Example tooltip',
                  classes: 'active'
                };
              case 8:
                return false;
              case 12:
                return "green";
          }
        },
    beforeShowMonth: function(date){
          if (date.getMonth() == 8) {
            return false;
          }
        },
    beforeShowYear: function(date){
          if (date.getFullYear() == 2007) {
            return false;
          }
        }
    });
</script>

@endsection