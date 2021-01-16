@extends('layouts.app')

@section('content')


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
                $(this).find('#weight_id').val(weightId);
              });
              
              $('#weightModal').modal('show');
            }
          }
        }
  		  
  		  
  		}
     });
    </script>  
     <!-- グラフを描画ここまで -->
  <!-- Modal -->
  <div class="modal fade" id="weightModal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">体重データの修正・削除</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            {{-- <form action="{{ route('weights.update', ['weightId' => $weighId]) }}" method="patch">
              @csrf --}}
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">日付</th>
                    <td>
                      <input type="text" name="date_weighed" id="datepicker" {{-- value="" --}} />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">体重（kg）</th>
                    <td>
                      <input type="text" name="weight" id="weight_log" {{-- value="{{ $weightLog }}" --}}/>
                      <input type="text" name="weight_id" id="weight_id" />
                    </td>
                  </tr>
                </tbody>
              </table>

            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <button class="btn-block-right btn btn-info" type="submit">修正する</button>
        </div>
      </div>
    </div>
  </div>

@endif



@endsection