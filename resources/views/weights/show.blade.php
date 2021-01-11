@extends('layouts.app')

@section('content')


<div class="display-flex mb-4">
  @if (isset($photo)) 
    <!--<div class="smallest">-->
      <img class="mr-2 rounded img-fluid following smallest-img" src="{{$photo}}" alt="愛犬の写真">
    <!--</div>-->
    
  @endif
  <div class="font-twice-larger">体重の変化</div>
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
  	
  	console.log(weight_logs);
  	console.log(min_label, max_label);
  
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
  		  }
  		}
     });
     
     </script>  
     <!-- グラフを描画ここまで -->

@endif



@endsection