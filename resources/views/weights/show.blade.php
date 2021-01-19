@extends('layouts.app')

@section('content')

{{-- フラッシュメッセージ --}}
@if (session('flash_message'))
    <div class="bg-info text-center py-2 my-0 mb-5" id="flash_message">
        {{ session('flash_message') }}
    </div>
@endif


<div class="display-flex mb-4">
  @if (isset($photo)) 
    <!--<div class="smallest">-->
      <img class="mr-2 rounded img-fluid following smallest-img" src="{{$photo}}" alt="愛犬の写真">
    <!--</div>-->
    
  @endif
  <div class="font-twice-larger">Weight Change</div>
</div>

@if (!$logs)
  <h5 class="mt-4 mb-4 line-spacing-wider text-center">
    体重の記録がありません。体重を入力しますか？
  </h5>
  {{-- 体重入力ページへのリンク --}}
  <h5 class="ml-2 text-center">
    {!! link_to_route('weights.create', '体重入力ページへ',  ['dogId' => $dogId], ['class' => 'btn-edit']) !!}
  </h5>
  
@else
  <canvas id="myChart"></canvas>
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
  	
  	// console.log(weight_ids);
  	// console.log(labels);
  	// console.log(weight_logs);
  	// console.log(min_label, max_label);
  
  	//グラフを描画
     var ctx = document.getElementById("myChart");
     var myChart = new Chart(ctx, {
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
                      <input type="hidden" name="weight_id" id="weightId" />
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
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#weightModal">閉じる</button>
          <button class="btn-block-right btn btn-info" type="submit" id="revise-button">修正する</button>
        </form>
        </div>
      </div>
    </div>
  </div>

@endif

<script>
  $(document).ready(function(){
    $('#weightRevisionForm').submit(function(event){
      submitForm();
      return false;
    });
  });
  
  function submitForm() {
    let weightId = $('#weightId').val(); // weight_idを取得
    
    $.ajax({
      beforeSend: function(xhr) {
        return xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
      },
      type: 'POST',
      url: '/weights/' + weightId,
      cache: false,
      data: $('form#weightRevisionForm').serialize(),
      success: function(response){
        $('#weightUpdate').html(response)
        $('#weightModal').modal('hide');
      },
      error: function() {
        alert('エラー');
      }
    });
  }
  
  const reviseButton = document.getElementById('revise-button');
  
  // [修正する]ボタンをクリックするとイベントリスナーが実行される
  // ★★★ ここから
  reviseButton.addEventListner('click', { 
    logs = @json($logs);
    
  });
  
</script>

@endsection