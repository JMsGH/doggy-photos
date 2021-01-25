@extends('layouts.app')

@section('content')

<div class="display-flex mb-4">
  @if (isset($photo)) 
    <!--<div class="smallest">-->
      <img class="mr-2 rounded img-fluid following ex-smallest-img" src="{{$photo}}" alt="愛犬の写真">
    <!--</div>-->
    
  @endif
  <div class="font-larger ml-4 mb-2">体重の変化</div>
  
</div>

@if (!$weights)
  <h5 class="mt-4 mb-4 line-spacing-wider text-center">
    体重の記録がありません。体重を入力しますか？
  </h5>
  {{-- 体重入力ページへのリンク --}}
  <h5 class="ml-2 text-center">
    {!! link_to_route('weights.create', '体重入力ページへ',  ['id' => $id, 'dogId' => $dogId], ['class' => 'btn-edit']) !!}
  </h5>
  
@else

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="bg-info text-center py-2 my-0 mt-5" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif

  {{-- グラフ描画エリア --}}
  <div style="width:100%">
    <canvas id="myChart"></canvas>
  </div>

<div class="container">
  
  
</div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

	{{-- グラフを描画--}}
  <script>
	//ラベル
	const labels = @json($date_labels);
	
	// id
	const weight_ids = @json($weight_ids);
	
	//体重ログ
	const weight_logs = @json($weight_logs);
	
	const aryMax = function(a, b) {
	 return Math.max(a, b);
	};
	
	const aryMin = function(a, b) {
	  return Math.min(a, b);
	};
	
	let min_label = Math.floor((weight_logs).reduce(aryMin) - 0.5);
	let max_label = Math.ceil((weight_logs).reduce(aryMax) + 0.5);
	
	// ページ読み込み時にグラフを描画
	drawChart();

	//グラフ描画処理
	function drawChart() {
     var ctx = document.getElementById("myChart");
     window.myChart = new Chart(ctx, {            // グローバル変数として作成
  		type: 'line',
  		data : {
  			labels: labels,       // x軸ラベル
  			datasets: [
  				{
  					label: '体重',    
  					data: weight_logs,
  					tension: 0,
  					borderColor: "rgba(37,78,255,1)",
           	backgroundColor: "rgba(0,0,0,0)",
           	pointRadius: 3
  				}
  			]
  		},
  		options: {
  			title: {
  				display: false,
  				text: ''
  			},
  			legend: {
  			  display: false,
  			},
  			plugins: {
  			  tooltip: {
  			    
  			  }
  			},
  			scales: {
  			  yAxes: [
  			    {
  			      ticks: {
  			        min: min_label, // ラベル最小値
  			        max: max_label, // ラベル最大値
  			      },
  			      scaleLabel: {        
  			      display: true,
  			      fontSize: 16,
  			      labelString: '体重 (kg)'
  			      }
  			    }
  			 ],
  		  },
  		  hover: {
  		    mode: 'point'
  		  },
  		  onClick: function clickHandler(evt, activeElements) {
  		    if (activeElements.length) {
  		      var element = this.getElementAtEvent(evt);
  		      var index = element[0]._index;
  		      var _datasetIndex = element[0]._datasetIndex;
  		      var weightId = weight_ids[index];
  		      var weightLog = weight_logs[index];
  		      var weightDate = labels[index];
  		      
  		      // console.log(index);
  		      console.log(weightId);
  		      console.log(weightDate);
  		      console.log(weightLog);
              
            if (index > -1) {
              
              $('#weightModal').on('show.bs.modal', function ()
              {
                $(this).find('#datepicker').val(weightDate);
                $(this).find('#weight_log').val(weightLog);
                $(this).find('#weightId').val(weightId);
              });
              
              $('#weightModal').modal('show');
            }
          }
        }
  		}
     });
    }
  // 更新ボタンをクリックしたらグラフを再描画
  // document.getElementById('update-btn').onclick = function() {
	  // すでにグラフが生成されている場合はグラフを破棄する
	  // console.log('Clicked');
	  // if (myChart) {
    //  myChart.destroy();
    // }
	  
	  // drawChart(); // グラフを再描画
	// }
  </script>  
  <!-- グラフを描画ここまで -->
  
  <!-- 体重データ更新後に表示 -->
  <div id="weightUpdate"></div>
  <!-- Modal -->
  <div class="modal fade" id="weightModal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">体重データの修正・削除</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
           <form id="weightRevisionForm" name="weightRevision" role="form">
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">weight_id</th>
                    <td>
                      <input type="text" name="weight_id" id="weightId" />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">日付</th>
                    <td>
                      <input type="text" name="date_weighed" id="datepicker" />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">体重（kg）</th>
                    <td>
                      <input type="text" name="weight" id="weight_log"/>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="submit_btn btn-block-right btn btn-danger" type="button" id="delete" value="delete">削除</button>
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#weightModal">閉じる</button>
          <button class="submit_btn btn-block-right btn btn-info" type="button" id="update" value="update">修正</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  
      <div class="row">
        <div class="col-5"></div>
        <div class="col-7">
          <div class="d-flex justify-content-end mt-2">
            <div class="p-2">
              {{ $weights->links() }}
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <div class="p-2">{!! link_to_route('dogs.index', '愛犬ページ', ['id' => \Auth::id()], ['class' => 'btn-detail ml-2']) !!}
            </div>
          {{-- 体重入力ページへのリンク --}}
            <div class="p-2">
              {!! link_to_route('weights.create', '体重を入力',  ['id' => $dog->user_id, 'dogId' => $dog->id], ['class' => 'btn-edit ml-2']) !!}
            </div>
            {{-- グラフ更新ボタン --}}
            <div class="p-2">
              {!! link_to_route('weights.show', 'グラフを更新',  ['id' => $dog->user_id, 'dogId' => $dog->id], ['class' => 'btn-weight ml-2 mb-2']) !!}
            </div>
          </div>
        </div>
      </div>
      
  <ul class="font-smaller text-secondary mt-4">
    <li class="mb-2">
      グラフの点にカーソルを合わせると体重データ（日付、体重）が表示されます。
    </li>
    <li class="mb-2">
      グラフの点をクリックして体重データの修正と削除ができます。修正、削除後は [グラフを更新] ボタンをクリックしてグラフを更新してください。
    </li>
    <li>
      グラフにはデータが20件ずつ表示されます。前後のデータを表示するにはグラフの下にある [<] [>]または数字をクリックしてください。
    </li>
  </ul>

@endif

<script>
  $(document).ready(function(){
    //$('#weightRevisionForm').submit(function(event){
    //  submitForm();
    //  return false;
    //});
    $('.submit_btn').click(function(e){
      console.log(e);
      submitForm(e.target.id);
    });
  });
  
  var actionValue;
  
  $('.submit_btn').click(function(){
      actionValue = $(this).attr('value');
  });
    
  function submitForm(id) {
    let weightId = $('#weightId').val(); // weight_idを取得

    // ボタンのvalueを取得？？
    
    console.log(actionValue);
    console.log(id);

    $.ajax({
      beforeSend: function(xhr) {
        return xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
      },
      type: 'POST',
      url: '/weights/'+ id + '/' + weightId,
      cache: false,
      data: $('form#weightRevisionForm').serialize(),
      // dataType: 'json',
      success: function(response){
        // TODO ここでresposeの中から取り出す。
        // console.log(response.weight);
        
        // TODO drawChart()再度呼び出す。

        $('#weightUpdate').html(response);
        $('#weightModal').modal('hide');
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log("ajax通信に失敗しました");
        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        console.log("textStatus     : " + textStatus);
        console.log("errorThrown    : " + errorThrown.message);
        alert('エラー');
      }
    });
  }
  

  // [修正する]ボタンをクリックするとイベントリスナーが実行される
  // ★★★ ここから
  {{-- reviseButton.addEventListner('click', { 
    logs = @json($weights);
    
  }); --}}
  
</script>

@endsection