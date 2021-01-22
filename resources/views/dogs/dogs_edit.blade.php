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
                <td>{!! Form::text('birthday', null, ['class' => 'form-control', 'id' => 'dog-bd-datepicker']) !!}
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

// <script src="{{ asset('/js/bsdatepicker.js') }}"></script>
{{-- Bootstrap Datepickerのjsコード --}}
<script type="text/javascript">
  $('#dog-bd-datepicker').datepicker({
    format: "yyyy/mm/dd",
    language: "ja"
});
</script>

@endsection