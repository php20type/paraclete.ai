@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('Monthly Report') }}</h4>
			<ol class="breadcrumb mb-2">
				<ol class="breadcrumb mb-2">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page"><a href=""> {{ __('Monthly Report') }}</a></li>
				</ol>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row justify-content-center">
		@if ($type == 'Regular License' && $status)
			<div class="row text-center justify-content-center">
				<p class="fs-14" style="background:#FFE2E5; color:#ff0000; padding:1rem 2rem; border-radius: 0.5rem; max-width: 1200px;">{{ __('Extended License is required in order to have access to these features') }}</p>
			</div>	
		@else
			<div class="col-lg-6 col-md-8 col-xm-12">
				<div class="card border-0">
					<div class="card-header text-center">
						<h3 class="card-title text-muted text-center">{{ __('Current Month Report') }} </h3>
					</div>
					<div class="card-body pt-5">
						<div class="row">
							<div class="col-lg-5 col-md-6 col-12">
								<h6 class="fs-12 font-weight-bold text-center mb-4 mt-2">{{ __('Finance') }}</h6>
								<h6 class="text-muted fs-12">{{ __('Total Revenue') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['revenue'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Total Services Cost') }}: <span class="fs-12 font-weight-semibold" style="float:right">${{ $monthly_report['cost'] }}</span></h6>								
								<h6 class="text-muted fs-12">{{ __('Total New Subscribers') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['subscribers'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Top Plan Sold') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['plan'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Total Referral Earnings') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['referrals'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Total Requested Referral Payouts') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['payouts'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Top Payment Gateway Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gateway'] }}</span></h6>
								
								<h6 class="fs-12 font-weight-bold text-center mb-4 mt-4">{{ __('Users') }}</h6>
								<h6 class="text-muted fs-12">{{ __('Total New Registrations') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['users'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Total Account Terminations') }}: <span class="fs-12 font-weight-semibold" style="float:right">0</span></h6>
								<h6 class="text-muted fs-12">{{ __('Top Registration Country') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['country'] }}</span></h6>

								<h6 class="fs-12 font-weight-bold text-center mb-4 mt-4">{{ __('AI Credits') }}</h6>
								<h6 class="text-muted fs-12">{{ __('GPT 4o Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gpt_4o'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('GPT 4o mini Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gpt_4o_mini'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('GPT 4 Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gpt_4'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('GPT 4 Turbo Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gpt_4t'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('GPT 3.5 Turbo Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gpt_3t'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Claude 3 Opus Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['opus'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Claude 3.5 Sonnet Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['sonnet'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Claude 3 Haiku Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['haiku'] }}</span></h6>
								<h6 class="text-muted fs-12">{{ __('Gemini Pro Credits Used') }}: <span class="fs-12 font-weight-semibold" style="float:right">{{ $monthly_report['gemini'] }}</span></h6>
							</div>	
							<div class="col-lg-2"></div>
							<div class="col-lg-5 col-md-6 col-12">
								<h6 class="fs-12 font-weight-bold text-center mb-4 mt-2">{{ __('Email Reporting') }}</h6>
								<div class="form-group mb-3">
									<label class="custom-switch">
										<input type="checkbox" name="weekly" class="custom-switch-input" id="weekly" onchange="toggleWeekly()" @if ( $settings->weekly_reports) checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Send Weekly Summary via Email') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Make sure to properly configure your SMTP and CRON settings first. Email is sent to system email address defined in the SMTP settings page.') }}"></i>																</span>
									</label>
								</div>
								<div class="form-group mb-3">
									<label class="custom-switch">
										<input type="checkbox" name="monthly" class="custom-switch-input" id="monthly" onchange="toggleMonthly()" @if ( $settings->monthly_reports) checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Send Monthly Summary via Email') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Make sure to properly configure your SMTP and CRON settings first. Email is sent to system email address defined in the SMTP settings page.') }}"></i></span>
									</label>
								</div>
							</div>
						</div>

	

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-center mb-4 mt-4">
							<a href="{{ route('admin.finance.dashboard') }}" class="btn btn-cancel mr-2 pl-7 pr-7 ripple">{{ __('Return') }}</a>						
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection

@section('js')

	<script type="text/javascript">

		function toggleWeekly() {

			var formData = new FormData();
			formData.append("status", $('#weekly').is(':checked') );
			formData.append("type", "weekly");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: '/app/admin/finance/report/notification',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if (data['status'] == 200) {
						toastr.success('{{ __('Email reporting status notification updated successfully') }}');								
					} else {
						toastr.error('There was an issue with your email notification setup');
					}      
				},
				error: function(data) {
					toastr.error('There was an issue with your email notification setup');
				}
			})
		}

		function toggleMonthly() {

			var formData = new FormData();
			formData.append("status", $('#weekly').is(':checked') );
			formData.append("type", "monthly");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: '/app/admin/finance/report/notification',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if (data['status'] == 200) {
						toastr.success('{{ __('Email reporting status notification updated successfully') }}');								
					} else {
						toastr.error('There was an issue with your email notification setup');
					}      
				},
				error: function(data) {
					toastr.error('There was an issue with your email notification setup');
				}
			})
		}
	</script>
@endsection
