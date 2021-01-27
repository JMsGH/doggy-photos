{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="bg-info text-center py-2 my-0 mt-5" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif

<div class="mt-5">
  <h5 class="text-center mb-2">体重データを削除しました</h5>
  <div class="row justify-content-center">
    <div class="col-6">

    </div>
  </div>
</div>

