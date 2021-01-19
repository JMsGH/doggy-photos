@extends('layouts.app')

@section('content')

<div class="mt-5">
  <div class="row justify-content-center">
    <div class="col-6">
      
      {{-- フラッシュメッセージ --}}
      @if (session('flash_message'))
          <div class="flash_message bg-info text-center py-2 my-0">
              {{ session('flash_message') }}
          </div>
      @endif
      
      <table class="table table-striped">
      <tbody>
        <tr>
          <th scope="row">日付</th>
          <td>{{ $weight->date_weighed }}</td>
        </tr>
        <tr>
          <th scope="row">体重（kg）</th>
          <td>{{ $weight->weight }}</td>
        </tr>
      </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

