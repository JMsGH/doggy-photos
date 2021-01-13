@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-info text-white font-weight-bolder" >体重記録フォーム</div>
          <div class="card-body">
            <form action="{{ route('weights.store', ['dogId' => $dog->id]) }}" method="post">
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
              <button class="text-right btn btn-primary" type="submit">登録する</button>
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