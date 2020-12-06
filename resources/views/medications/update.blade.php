@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5 mt-4 mb-5">
     <h5>投薬日の変更</h5>
      <form action ="{{ route('medications.update', ['id2' => $id]) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <input class="form-control" type="date" name="start_date"></input>
        </div>
        <button type="submit" class="btn btn-info">変更する</button>
        </table>
        
      </form>
    </div>
  </div>
</div>
        

@endsection
