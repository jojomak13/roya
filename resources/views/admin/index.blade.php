@extends('layouts.admin.master')

@section('title', __('dashboard.title'))

@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')
		<div class="row">
			
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
			  <span class="info-box-icon bg-info elevation-1"><i class="fa fa-money"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">@lang('dashboard.home.profit')</span>
				<span class="info-box-number">
					@money($totalProfit->profit)
				  <small>@lang('dashboard.currency')</small>
				</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>

		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-shopping-cart"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">@lang('dashboard.home.uncompleted_orders')</span>
				<span class="info-box-number">{{ $uncompletedOrders->count() }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>

		  <!-- fix for small devices only -->
		  <div class="clearfix hidden-md-up"></div>

		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-tags"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">@lang('dashboard.home.productsCount')</span>
				<span class="info-box-number">{{ $productsCount }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>

		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">@lang('dashboard.home.usersCount')</span>
				<span class="info-box-number">{{ $usersCount }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>

		</div>

		<div class="row">
		  <div class="col-md-12">
			<div class="card">
			  <div class="card-header">
				<h5 class="card-title">@lang('dashboard.home.profit')</h5>
			  </div>
			  <div class="card-body">
				<div class="chart">
					<div id="mainChart" ></div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">@lang('dashboard.home.uncompleted_orders')</h5>
					</div>
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>@lang('dashboard.home.status')</th>
									<th>@lang('dashboard.home.total_price')</th>
									<th>@lang('dashboard.home.created_at')</th>
									<th>@lang('dashboard.control')</th>
								</tr>
							</thead>
							<tbody>
								@foreach($uncompletedOrders as $index => $order)
								<tr>
									<td>{{ $index + 1 }}</td>
									<td>{{ $order->order_status }}</td>
									<td>@money($order->total_price)</td>
									<td>{{ $order->created_at->diffForHumans() }}</td>
									<td>
										<a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">@lang('dashboard.home.casher_orders')</h5>
					</div>
					<div class="card-body" style="direction: ltr">
					<div class="chart">
						<div id="cashierProfit"></div>
					</div>
					</div>
				</div>
			</div>
		</div>
		
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
	//  Start Main Profit
	new Morris.Line({
		element: "mainChart",
		resize: true,
        data: [
			@foreach($profit as $profit)
			{ ym: "{{ $profit->year }}-{{ $profit->month }}", value: {{ $profit->total_price }} },
			@endforeach
        ],
        xkey: "ym",
        ykeys: ["value"],
		labels: ["Profit"],
		lineColors: ["#17a2b8"],
		pointFillColors: ['#28a745'],
		formatter: function(x) { return x.tolocaleString() }
	});
	//  End Main Profit

	// Start Cashier Profit
	Morris.Donut({
		element: 'cashierProfit',
		resize: true,
		data: [
			@foreach($casher_profit as $profit)
			{value: {{ $profit->orders }}, label: '{{ $profit->first_name }} {{ $profit->last_name }}', totalPrice: {{ $profit->total_price }} },
			@endforeach
		],
		backgroundColor: '#ccc',
		labelColor: '#060',
		colors: [
			'#0BA462',
			'#39B580',
			'#67C69D',
			'#95D7BB'
		],
		formatter: function (x, data) { 
			return `${x}`
		}
	});
	// End Cashier Profit
</script>
@endsection