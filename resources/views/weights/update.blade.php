
<div class="mt-5">
  <h6 class="text-center mb-2">体重データを以下のように修正しました</h6>
  <div class="row justify-content-center">
    <div class="col-6">
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

