@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER-->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('Finance Dashboard') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Finance Dashboard') }}</a></li>
			</ol>
		</div>
	</div>
	<!--END PAGE HEADER -->
@endsection

@section('content')						
	@if ($type == 'Regular License' || $type == '')
		<div class="row text-center justify-content-center">
			<p class="fs-14" style="background:#FFE2E5; color:#ff0000; padding:1rem 2rem; border-radius: 0.5rem; max-width: 1200px;">{{ __('Extended License is required in order to have access to these features') }}</p>
		</div>			
	@else
		<div class="row">	
			<div class="col-lg col-md-6 col-sm-12 mt-auto mb-auto">                        
				<div class="title text-center dashboard-title">
					<h6 class="text-muted fs-14 mb-3 font-weight-bold">{{ __('Total Revenue') }}</h6>
					<h3 class="fs-24 mb-3 super-strong">{!! config('payment.default_system_currency_symbol') !!} {{ number_format((float)$total['total_income'][0]['data'],2) }}</h3>  
					<h6 class="text-muted fs-10">{{ __('Lifetime') }} <span class="font-weight-bold">{{ __('earnings') }}</span></h6>    
				</div>                                               
			</div>
			<div class="col-lg col-md-6 col-sm-12 mt-auto mb-auto">                        
				<div class="title text-center dashboard-title">
					<h6 class="text-muted fs-14 mb-3 font-weight-bold">{{ __('Total Spending') }}</h6>
					<h3 class="fs-24 mb-3 super-strong">${{ number_format((float)$total['total_spending'], 3) }}</h3>     
					<h6 class="text-muted fs-10">{{ __('Estimated') }} <span class="font-weight-bold">{{ __('AI service costs') }}</span></h6> 
				</div>                                               
			</div>
			<div class="col-lg col-md-2 col-sm-12">
				<div class="card overflow-hidden border-0">
					<div class="card-body">
						<div class="d-flex align-items-end justify-content-between">
							<div>
								<p class=" mb-2 fs-12 font-weight-semibold text-muted"><i class="fa-solid fa-user-visor mr-2 text-muted"></i> {{ __('Total Active Subscribers') }}</p>
								<h2 class="mb-0"><span class="number-font fs-20">{{ number_format($total['total_subscribers']) }}</span></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg col-md-2 col-sm-12">
				<div class="card overflow-hidden border-0">
					<div class="card-body">
						<div class="d-flex align-items-end justify-content-between">
							<div>
								<p class=" mb-2 fs-12 font-weight-semibold text-muted"><i class="fa-solid fa-face-tongue-money mr-2 text-muted"></i>{{ __('Total Referral Earnings') }}</p>
								<h2 class="mb-0"><span class="number-font fs-20">{{ number_format((float)$total['referral_earnings'][0]['data'], 2) }}</span></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg col-md-2 col-sm-12">
				<div class="card overflow-hidden border-0">
					<div class="card-body">
						<div class="d-flex align-items-end justify-content-between">
							<div>
								<p class=" mb-2 fs-12 font-weight-semibold text-muted"><i class="fa-sharp fa-solid fa-badge-percent mr-2 text-muted"></i>{{ __('Total Referral Payouts') }}</p>
								<h2 class="mb-0"><span class="number-font fs-20">{{ number_format((float)$total['referral_payouts'][0]['data'], 2) }}</span></h2>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 mt-3">
				<div class="card border-0" id="admin-dashboard-panels">
					<div class="card-body p-7">
	
						<div class="row">
							
							<div class="col-lg-2 col-md-2 col-sm-12">
								<div class="mb-6">
									<h2 class="mb-1"><span class="number-font fs-20">{!! config('payment.default_system_currency_symbol') !!}{{ number_format((float)$total_monthly['income_current_month'][0]['data'], 2) }}</span> <span id="revenue_difference"></span><h2>
									<p class="text-muted fs-11 mb-2"> {{ __('Current Month Earnings') }}</p>
								</div>
								<div class="mb-7">
									<h2 class="mb-1"><span class="number-font fs-20">${{ number_format((float)$total_monthly['spending_current_month'], 3) }}</span> <span id="spending_difference"></span><h2>
									<p class="text-muted fs-11 mb-2"> {{ __('Current Month Spendings') }}</p>
								</div>
								<a href="{{ route('admin.finance.report.monthly') }}" class="btn btn-primary mb-5" style="text-transform: none; width: 175px">{{ __('Current Month Report') }}</a>
								<a href="{{ route('admin.finance.report.yearly') }}" class="btn btn-primary mb-4" style="text-transform: none; width: 175px; background: #1e1e2d; border-color: #1e1e2d;">{{ __('Current Year Report') }}</a>
							</div>
	
							<div class="col-lg-10 col-md-10 col-sm-12">
								<div>
									<span class="fs-10 text-muted" style="position: absolute; right: 1.5rem; top: -10px; background: #f5f9fc; padding: 0.5rem 1rem; border-radius: 10px;">{{ __('Current Year') }}</span>
									<canvas id="financeEarningsChart" style="height: 300px"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	

			<div class="col-md-4 col-sm-12 mt-3">
				<div class="card overflow-hidden border-0 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-box-dollar mr-2 text-muted"></i>{{ __('Revenue Source') }}</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div style="position: relative">
									<div class="mt-4">
										<canvas id="revenuePlan" class="h-330"></canvas>
									</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-12 mt-3">
				<div class="card overflow-hidden border-0 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-microchip-ai mr-2 text-muted"></i>{{ __('AI Cost Breakdown') }} (USD)</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div style="position: relative">
									<div class="mt-4">
										<canvas id="costService" class="h-330"></canvas>
									</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-12 mt-3">
				<div class="card overflow-hidden border-0 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-users-viewfinder mr-2 text-muted"></i>{{ __('Users vs Subscribers') }}</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div style="position: relative">
									<div class="mt-4">
										<canvas id="userDoughnut" class="h-330"></canvas>
									</div>
									<h6 class="text-center dashboard-center-text-finance"><span class="text-muted fs-12">{{ __('Total Subscribers') }}</span><br><span class="fs-14 font-weight-semibold">{{ number_format($total['total_subscribers'] ) }}</span></h6>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12 col-sm-12 mt-3">
				<div class="card border-0 pb-5 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-credit-card-front mr-2 text-muted"></i>{{ __('Latest Transactions') }}</h3>
							<div class="btn-group dashboard-menu-button">
								<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="export" data-bs-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis  table-action-buttons table-action-buttons-big edit-action-button"></i></button>
								<div class="dropdown-menu" aria-labelledby="export" data-popper-placement="bottom-start">								
									<a class="dropdown-item" href="{{ route('admin.finance.transactions') }}">{{ __('View All') }}</a>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 pl-6 pr-6">
						<div class="dashboard-5-column">
							<div class="font-weight-semibold text-muted fs-12">{{ __('Plan') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Price') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Gateway') }}</div>
							<div class="text-right mr-4 font-weight-semibold text-muted fs-12">{{ __('Status') }}</div>
							<div class="text-right mr-5 font-weight-semibold text-muted fs-12">{{ __('Date') }}</div>
						</div>
					</div>
					<div class="card-body pt-2 height-400">
	
						<div class="row">
							
							@foreach ($latest_transactions as $data)
								<div class="col-sm-12">					
									<div class="card" onclick="window.location.href='{{ theme_url('app/admin/finance/transaction/'.$data->id.'/show') }}'">
										<div class="card-body pt-2 pb-2 pl-4 pr-4 dashboard-5-column">
											<div class="template-icon">
												<div class="fs-12">
													<p class="font-weight-semibold fs-12 mb-0">{{ $data->plan_name }}</p>
													<p class="text-muted fs-10 mb-0">{{ ucfirst($data->frequency) }} {{ __('Plan') }}</p>
												</div>								
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{!! config('payment.default_system_currency_symbol') !!}{{ number_format($data->price) }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ $data->gateway }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ __(ucfirst($data->status)) }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-10 mb-0 text-muted">{{ date_format($data->created_at, 'd M Y') }}<br><span>{{ date_format($data->created_at, 'H:i A') }}</span></p>
											</div>
										</div>
									</div>													
								</div>
							@endforeach
	
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12 col-sm-12 mt-3">
				<div class="card border-0 pb-5 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-credit-card-front mr-2 text-muted"></i>{{ __('Cost per AI Model') }} (USD)</h3>
						</div>
					</div>
					<div class="card-body pt-2 height-400">
	
						<div class="row">
							<div id="chartdiv" style="width: 100%; height: 350px;"></div>
	
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12 col-sm-12 mt-3">
				<div class="card border-0 pb-5 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-badge-percent mr-2 text-muted"></i>{{ __('Revenue per Plan') }}</h3>
							<div class="btn-group dashboard-menu-button">
								<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="export" data-bs-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis  table-action-buttons table-action-buttons-big edit-action-button"></i></button>
								<div class="dropdown-menu" aria-labelledby="export" data-popper-placement="bottom-start">								
									<a class="dropdown-item" href="{{ route('admin.finance.plans') }}">{{ __('View All') }}</a>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 pl-6 pr-6">
						<div class="dashboard-4-column">
							<div class="font-weight-semibold text-muted fs-12">{{ __('Plan') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Plan Price') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12"># {{ __('of Purchases') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Total Revenue') }}</div>
						</div>
					</div>
					<div class="card-body pt-2 height-400">
	
						<div class="row">
							
							@foreach ($transactions as $data)
								<div class="col-sm-12">					
									<div class="card" onclick="window.location.href='{{ theme_url('app/admin/finance/transactions') }}'">
										<div class="card-body pt-2 pb-2 pl-4 pr-4 dashboard-4-column">
											<div>
												<div class="fs-12">
													<p class="font-weight-semibold fs-12 mb-0">{{ $data->plan_name }}</p>
													<p class="text-muted fs-10 mb-0">{{ ucfirst($data->frequency) }} {{ __('Plan') }}</p>
												</div>								
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">
													@if ($data->frequency == 'prepaid')
														@foreach ($prepaid as $plan)
															@if ($plan->plan_name == $data->plan_name)
																{!! config('payment.default_system_currency_symbol') !!} {{ $plan->price }}
															@endif
														@endforeach
													@else	
														@foreach ($subscription as $plan)
															@if ($plan->plan_name == $data->plan_name)
																{!! config('payment.default_system_currency_symbol') !!} {{ $plan->price }}
															@endif
														@endforeach
													@endif
													
												</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ $data->quantity }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{!! config('payment.default_system_currency_symbol') !!}{{ number_format($data->price) }}</p>
											</div>
										</div>
									</div>													
								</div>
							@endforeach
	
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12 col-sm-12 mt-3">
				<div class="card border-0 pb-5 dashboard-fixed-457" id="admin-dashboard-panels">
					<div class="card-header pt-4 pb-4 border-0">
						<div class="mt-3">
							<h3 class="card-title mb-2"><i class="fa-solid fa-credit-card-front mr-2 text-muted"></i>{{ __('Pending Approvals') }}</h3>
							<div class="btn-group dashboard-menu-button">
								<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="export" data-bs-display="static" aria-expanded="false"><i class="fa-solid fa-ellipsis  table-action-buttons table-action-buttons-big edit-action-button"></i></button>
								<div class="dropdown-menu" aria-labelledby="export" data-popper-placement="bottom-start">								
									<a class="dropdown-item" href="{{ route('admin.finance.transactions') }}">{{ __('View All') }}</a>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 pl-6 pr-6">
						<div class="dashboard-5-column">
							<div class="font-weight-semibold text-muted fs-12">{{ __('Plan') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('User') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Price') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Gateway') }}</div>
							<div class="text-right font-weight-semibold text-muted fs-12">{{ __('Status') }}</div>
						</div>
					</div>
					<div class="card-body pt-2 height-400">
	
						<div class="row">
							
							@foreach ($approvals as $data)
								<div class="col-sm-12">					
									<div class="card" onclick="window.location.href='{{ theme_url('app/admin/finance/transaction/'.$data->id.'/show') }}'">
										<div class="card-body pt-2 pb-2 pl-4 pr-4 dashboard-5-column">
											<div>
												<div class="fs-12">
													<p class="font-weight-semibold fs-12 mb-0">{{ $data->plan_name }}</p>
													<p class="text-muted fs-10 mb-0">{{ ucfirst($data->frequency) }} {{ __('Plan') }}</p>
												</div>								
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ $data->name }}</p>
												<p class="text-muted fs-10 mb-0">{{ ucfirst($data->email) }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{!! config('payment.default_system_currency_symbol') !!}{{ number_format($data->price) }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ $data->gateway }}</p>
											</div>
											<div class="text-right mb-auto mt-auto">
												<p class="fs-12 mb-0 text-muted">{{ __(ucfirst($data->status)) }}</p>
											</div>
										</div>
									</div>													
								</div>
							@endforeach
	
						</div>
					</div>
				</div>
			</div>

		</div>

	@endif
@endsection

@section('js')
	<!-- Chart JS -->
	<script src="{{URL::asset('plugins/chart/chart.min.js')}}"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script type="text/javascript">
		$(function() {
	
			'use strict';

			// FINANCE REVENUE TABLE
			let chartColor = "#FFFFFF";
			var earningData = JSON.parse(`<?php echo $chart_data['monthly_earnings']; ?>`);
			var costData = JSON.parse(`<?php echo $chart_data['monthly_spendings']; ?>`);
			var earningDataset = Object.values(earningData);
			var costDataset = Object.values(costData);

			let usersOptionsConfiguration = {
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false,
					},
					tooltip: {
						titleAlign: 'center',
						bodySpacing: 4,
						mode: "nearest",
						intersect: 0,
						position: "nearest",
						xPadding: 20,
						yPadding: 20,
						caretPadding: 20
					},
				},			
				responsive: true,
				scales: {
					y: {
						display: 1,
						grid: 0,
						ticks: {
							display: true,
							padding: 10,
							beginAtZero: true,
							stepSize: 500,
							color: '#b7bdc9',
							font: {
                        		size: 10
                    		},
						},
						grid: {
							zeroLineColor: "transparent",
							drawTicks: false,
							display: false,
							drawBorder: false,
						}
					},
					x: {
						display: 1,
						grid: 0,
						ticks: {
							display: true,
							padding: 10,
							beginAtZero: true,
							color: '#b7bdc9',
							font: {
                        		size: 10
                    		},
						},
						grid: {
							zeroLineColor: "transparent",
							drawTicks: false,
							display: false,
							drawBorder: false,
						}
					}
				},
				layout: {
					padding: {
						left: 0,
						right: 0,
						top: 0,
						bottom: 0	
					}
				},
				elements: {
					line: {
						tension : 0.4
					},
				},
			};

			let ctx3 = document.getElementById('financeEarningsChart').getContext("2d");
			let gradientStroke3 = ctx3.createLinearGradient(500, 0, 100, 0);
			gradientStroke3.addColorStop(0, '#007bff');
			gradientStroke3.addColorStop(1, chartColor);
			let gradientFill3 = ctx3.createLinearGradient(0, 250, 0, 150);
			gradientFill3.addColorStop(0, "rgba(128, 182, 244, 0)");
			gradientFill3.addColorStop(1, "rgba(0, 123, 255, 0.4)");
			let gradientFill4 = ctx3.createLinearGradient(0, 250, 0, 150);
			gradientFill4.addColorStop(0, "rgba(128, 182, 244, 0)");
			gradientFill4.addColorStop(1, "rgba(255, 191, 0, 0.4)");
			let myChart3 = new Chart(ctx3, {
				type: 'line',
				data: {
					labels: ['{{ __('Jan') }}', '{{ __('Feb') }}', '{{ __('Mar') }}', '{{ __('Apr') }}', '{{ __('May') }}', '{{ __('Jun') }}', '{{ __('Jul') }}', '{{ __('Aug') }}', '{{ __('Sep') }}', '{{ __('Oct') }}', '{{ __('Nov') }}', '{{ __('Dec') }}'],
					datasets: [{
						label: "{{ __('Earnings') }}",
						borderColor: "#007bff",
						pointBorderColor: "#FFF",
						pointBackgroundColor: "#007bff",
						pointBorderWidth: 1,
						pointHoverRadius: 4,
						pointHoverBorderWidth: 1,
						pointRadius: 2,
						fill: true,
						backgroundColor: gradientFill3,
						borderWidth: 2,
						data: earningDataset
					},
					{
						label: "{{ __('Spendings') }}",
						borderColor: "#ffab00",
						pointBorderColor: "#FFF",
						pointBackgroundColor: "#ffab00",
						pointBorderWidth: 1,
						pointHoverRadius: 4,
						pointHoverBorderWidth: 1,
						pointRadius: 2,
						fill: true,
						backgroundColor: gradientFill4,
						borderWidth: 2,
						data: costDataset
					}]
				},
				options: usersOptionsConfiguration
			});


			// USER DONUGHNUT CHART
			let userDoughnut = document.getElementById('userDoughnut');
			let delayed3;
			new Chart(userDoughnut, {
				type: 'doughnut',
				data: {
					labels: [
						'{{ __('Non-Subscribers') }}',
						'{{ __('Subscribers') }}',
					],
					datasets: [{
						data: ['{{ $total['total_nonsubscribers'] }}', '{{ $total['total_subscribers'] }}'],
						backgroundColor: [
							'#1e1e2d',
							'#007bff',
						],
						hoverOffset: 20,
						weight: 0.001,
						borderWidth: 0
					}]
				},
				options: {
					cutout: 90,
					maintainAspectRatio: false,
					legend: {
						display: false,
						labels: {
							display: false
						}
					},
					responsive: true,
					animation: {
						onComplete: () => {
							delayed3 = true;
						},
						delay: (context) => {
							let delay = 0;
							if (context.type === 'data' && context.mode === 'default' && !delayed3) {
								delay = context.dataIndex * 50 + context.datasetIndex * 5;
							}
							return delay;
						},
					},
					plugins: {
						tooltip: {
							cornerRadius: 2,
							xPadding: 10,
							yPadding: 10,
							backgroundColor: '#000000',
							titleColor: '#FF9D00',
							yAlign: 'bottom',
							xAlign: 'center',
						},
						legend: {
							position: 'bottom',
							labels: {
								boxWidth: 10,
								font: {
									size: 12
								},
								padding: 30
							}
						}
					}
				}
			});


			// COST DONUGHNUT CHART
			let spendingData = JSON.parse(`<?php echo $chart_data['cost_data']; ?>`);
			let costLabelDataset = Object.keys(spendingData);
			let costDataDataset = Object.values(spendingData);
			let costDoughnut = document.getElementById('costService');
			let delayed2;
			new Chart(costDoughnut, {
				type: 'doughnut',
				data: {
					labels: costLabelDataset,
					datasets: [{
						data: costDataDataset,
						backgroundColor: [
							'#67b7dc',
							'#6494dc',
							'#6771dc',
							'#8067dc',
							'#a367dc',
							'#c767dc',
							'#dc67ce',
							'#dc67ab',
							'#dc6788',
							'#dc6867',
						],
						hoverOffset: 20,
						weight: 0.001,
						borderWidth: 0
					}]
				},
				options: {
					cutout: 20,
					maintainAspectRatio: false,
					legend: {
						display: false,
						labels: {
							display: false
						}
					},
					responsive: true,
					animation: {
						onComplete: () => {
							delayed2 = true;
						},
						delay: (context) => {
							let delay = 0;
							if (context.type === 'data' && context.mode === 'default' && !delayed2) {
								delay = context.dataIndex * 50 + context.datasetIndex * 5;
							}
							return delay;
						},
					},
					plugins: {
						tooltip: {
							cornerRadius: 2,
							xPadding: 10,
							yPadding: 10,
							backgroundColor: '#000000',
							titleColor: '#FF9D00',
							yAlign: 'bottom',
							xAlign: 'center',
						},
						legend: {
							position: 'bottom',
							labels: {
								boxWidth: 10,
								font: {
									size: 12
								},
								padding: 30
							}
						}
					}
				}
			});


			// REVENUE DONUGHNUT CHART
			let sourceData = JSON.parse(`<?php echo $chart_data['source_data']; ?>`);
			let sourceLabelDataset = Object.keys(sourceData);
			let sourceDataDataset = Object.values(sourceData);
			let revenueDoughnut = document.getElementById('revenuePlan');
			let delayed4;
			new Chart(revenueDoughnut, {
				type: 'doughnut',
				data: {
					labels: sourceLabelDataset,
					datasets: [{
						data: sourceDataDataset,
						backgroundColor: [
							'#67b7dc',
							'#6494dc',
							'#6771dc',
							'#8067dc',
							'#a367dc',
							'#c767dc',
							'#dc67ce',
							'#dc67ab',
							'#dc6788',
							'#dc6867',
						],
						hoverOffset: 20,
						weight: 0.001,
						borderWidth: 0
					}]
				},
				options: {
					cutout: 20,
					maintainAspectRatio: false,
					legend: {
						display: false,
						labels: {
							display: false
						}
					},
					responsive: true,
					animation: {
						onComplete: () => {
							delayed4 = true;
						},
						delay: (context) => {
							let delay = 0;
							if (context.type === 'data' && context.mode === 'default' && !delayed4) {
								delay = context.dataIndex * 50 + context.datasetIndex * 5;
							}
							return delay;
						},
					},
					plugins: {
						tooltip: {
							cornerRadius: 2,
							xPadding: 10,
							yPadding: 10,
							backgroundColor: '#000000',
							titleColor: '#FF9D00',
							yAlign: 'bottom',
							xAlign: 'center',
						},
						legend: {
							position: 'bottom',
							labels: {
								boxWidth: 10,
								font: {
									size: 10
								},
								padding: 30
							}
						}
					}
				}
			});


			am5.ready(function() {

				var root = am5.Root.new("chartdiv");

				// Set themes
				// https://www.amcharts.com/docs/v5/concepts/themes/
				root.setThemes([
				am5themes_Animated.new(root)
				]);

				// Create chart
				// https://www.amcharts.com/docs/v5/charts/xy-chart/
				var chart = root.container.children.push(am5xy.XYChart.new(root, {
				panX: true,
				panY: true,
				wheelX: "panX",
				wheelY: "zoomX",
				pinchZoomX: true,
				paddingLeft:0,
				paddingRight:1,
				fontSize: 10,
				}));

				// Add cursor
				// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
				var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
				cursor.lineY.set("visible", false);


				// Create axes
				// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
				var xRenderer = am5xy.AxisRendererX.new(root, { 
				minGridDistance: 0, 
				minorGridEnabled: false
				});

				xRenderer.labels.template.setAll({
				rotation: -90,
				centerY: am5.p50,
				centerX: am5.p100,
				paddingRight: 15,
				fontSize: 10,
				});

				xRenderer.grid.template.setAll({
				location: 1
				})

				var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
				maxDeviation: 0.3,
				categoryField: "model",
				renderer: xRenderer,
				tooltip: am5.Tooltip.new(root, {}),
				}));

				var yRenderer = am5xy.AxisRendererY.new(root, {
				strokeOpacity: 0,
				});

				yRenderer.labels.template.setAll({
				fontSize: 10,
				});

				var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
				maxDeviation: 0.3,
				renderer: yRenderer
				}));

				yRenderer.grid.template.setAll({
					stroke: am5.color(0xdbe2eb),
					strokeWidth: 1
				});
				
				xRenderer.grid.template.setAll({
					stroke: am5.color(0xdbe2eb),
				});

				// Create series
				// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
				var series = chart.series.push(am5xy.ColumnSeries.new(root, {
				name: "Model",
				xAxis: xAxis,
				yAxis: yAxis,
				valueYField: "value",
				sequencedInterpolation: true,
				categoryXField: "model",
				tooltip: am5.Tooltip.new(root, {
					labelText: "{valueY}",
					fontSize: 10,
				})
				}));

				series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
				series.columns.template.adapters.add("fill", function (fill, target) {
				return chart.get("colors").getIndex(series.columns.indexOf(target));
				});

				series.columns.template.adapters.add("stroke", function (stroke, target) {
				return chart.get("colors").getIndex(series.columns.indexOf(target));
				});

				let services = JSON.parse(`<?php echo $chart_data['services']; ?>`);

				// Set data
				var data = [
					{
						model: "GPT 4o",
						value: services.gpt_4o,
					},
					{
						model: "GPT 4o mini",
						value: services.gpt_4o_mini,
					},
					{
						model: "GPT 4",
						value: services.gpt_4,
					},
					{
						model: "GPT 4 Turbo",
						value: services.gpt_4t,
					},
					{
						model: "GPT 3.5 Turbo",
						value: services.gpt_3t,
					},
					{
						model: "Claude 3 Opus",
						value: services.opus,
					},
					{
						model: "Claude 3 Sonnet",
						value: services.sonnet,
					},
					{
						model: "Claude 3 Haiku",
						value: services.haiku,
					},
					{
						model: "Gemini Pro",
						value: services.gemini,
					},
				];

				xAxis.data.setAll(data);
				series.data.setAll(data);


				// Make stuff animate on load
				// https://www.amcharts.com/docs/v5/concepts/animations/
				series.appear(1000);
				chart.appear(1000, 100);

				}); // end am5.ready()


			// Percentage Difference				
			var income_current_month = JSON.parse(`<?php echo $percentage['income_current']; ?>`);			
			var income_past_month = JSON.parse(`<?php echo $percentage['income_past']; ?>`);
			var spending_current_month = JSON.parse(`<?php echo $percentage['spending_current']; ?>`);	
			var spending_past_month = JSON.parse(`<?php echo $percentage['spending_past']; ?>`);

			(income_current_month[0]['data'] == null) ? income_current_month = 0 : income_current_month = income_current_month[0]['data'];
			(income_past_month[0]['data'] == null) ? income_past_month = 0 : income_past_month = income_past_month[0]['data'];

			var income_current_total = parseInt(income_current_month);	
			var income_past_total = parseInt(income_past_month);
			var spending_current_total = parseInt(spending_current_month);
			var spending_past_total = parseInt(spending_past_month);

			var income_change = mainPercentageDifference(income_past_total, income_current_total);
			var spending_change = mainPercentageDifference(spending_past_month, spending_current_month);

			document.getElementById('revenue_difference').innerHTML = income_change;
			document.getElementById('spending_difference').innerHTML = spending_change;

			function mainPercentageDifference(past, current) {
				if (past == 0) {
					var change = (current == 0) ? '<span class="text-muted fs-12" style="vertical-align: middle"> 0%</span>' : '<span class="text-success fs-12" style="vertical-align: middle"><i class="fa fa-caret-up"></i> 100%</span>';   					
					return change;
				} else if(current == 0) {
					var change = (past == 0) ? '<span class="text-muted fs-12" style="vertical-align: middle"> 0%</span>' : '<span class="text-danger" style="vertical-align: middle"><i class="fa fa-caret-down"></i> 100%</span>';
					return change;
				} else if(past == current) {
					var change = '<span class="text-muted fs-12" style="vertical-align: middle"> 0%</span>';
					return change; 
				}

				var difference = current - past;
    			var difference_value, result;

				var totalDifference = Math.abs(difference);
				var change = (totalDifference/past) * 100;				

				if (difference > 0) { result = '<span class="text-success fs-12" style="vertical-align: middle;"><i class="fa fa-caret-up"></i> ' + change.toFixed(1) + '%</span>'; }
				else if(difference < 0) {result = '<span class="text-danger" style="vertical-align: middle;"><i class="fa fa-caret-down"></i> ' + change.toFixed(1) + '%</span>'; }
				else { difference_value = '<span class="text-muted fs-12" style="vertical-align: middle;"> ' + change.toFixed(1) + '%</span>'; }				

				return result;
			}
		});		
	</script>
@endsection