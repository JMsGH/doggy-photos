@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5 mt-4 mb-5">
     <h5 class="text-center mb-4">投薬日の変更</h5>
      <form action ="{{ route('medications.update', ['medication' => $id]) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <input type="hidden" name="id" value="{{ $id }}">
          <input class="form-control" type="text" name="start_date"  id="datepicker"></input>
        </div>
        <button type="submit" class="btn btn-info btn-block-right">変更する</button>
        </table>
        
      </form>
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
