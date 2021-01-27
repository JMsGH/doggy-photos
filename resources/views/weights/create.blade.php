@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card mt-4">
        <div class="card-header bg-info text-white font-weight-bolder inline-display center font-larger" >
          体重記録フォーム 
          @if ($dog->photo) 
            <div class="center mb-2 inline-display">
              <img class="mr-2 rounded img-fluid following smallest-img" src="{{$dog->photo}}" alt="{{ $dog->name }}">
            </div>
          @else
              <div class="font-larger text-center">{{ $dog->dog_name }} </div>
          @endif
        </div>
          <div class="card-body">
            <form action="{{ route('weights.store', ['id' => $dog->user_id, 'dogId' => $dog->id]) }}" method="post">
              @csrf
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">日付</th>
                    <td>
                      <input type="text" name="date_weighed" id="datepicker"/>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">体重（kg）</th>
                    <td>
                      <input type="text" name="weight"/>
                    </td>
                  </tr>
                </tbody>
              </table>
              <input type="hidden" name="dogId" value="{{ $dog->id }}">
              <button class="btn-block-right btn btn-info" type="submit">登録する</button>
            </form>
          </div>
        </div>
      </div>
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

@endsection