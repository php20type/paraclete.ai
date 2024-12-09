@extends('layouts.app')
@section('css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center"> 
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('New Subscription Plan') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.plans') }}"> {{ __('Subscription Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('New Subscription Plan') }}</a></li>
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
			<div class="@if ($type == 'Regular License') col-md-10 @else col-lg-8 col-md-8 @endif col-sm-12">
				<div class="card border-0">
					<div class="card-header border-0 pb-0">
						<h6 class="card-title fs-12 text-muted">{{ __('Create New Subscription Plan') }}</h6>
					</div>
					<div class="card-body pt-0">
						<hr class="mt-0">									
						<form action="{{ route('admin.finance.plan.store') }}" method="POST" enctype="multipart/form-data">
							@csrf

							<div class="card mt-4 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-money-check-dollar-pen text-info fs-14 mr-1 fw-2"></i>{{ __('General Settings') }}</h6>

									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">						
											<div class="input-box">	
												<h6>{{ __('Plan Status') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="plan-status" name="plan-status" class="form-select" data-placeholder="{{ __('Select Plan Status') }}:">			
													<option value="active" selected>{{ __('Active') }}</option>
													<option value="hidden">{{ __('Hidden') }}</option>
													<option value="closed">{{ __('Closed') }}</option>
												</select>
												@error('plan-status')
													<p class="text-danger">{{ $errors->first('plan-status') }}</p>
												@enderror	
											</div>						
										</div>							
										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Plan Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="plan-name" name="plan-name" value="{{ old('plan-name') }}" required>
												</div> 
												@error('plan-name')
													<p class="text-danger">{{ $errors->first('plan-name') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Price') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required>
												</div> 
												@error('cost')
													<p class="text-danger">{{ $errors->first('cost') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Currency') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="currency" name="currency" class="form-select" data-placeholder="{{ __('Select Currency') }}:">			
													@foreach(config('currencies.all') as $key => $value)
														<option value="{{ $key }}" @if(config('payment.default_system_currency') == $key) selected @endif>{{ $value['name'] }} - {{ $key }} ({!! $value['symbol'] !!})</option>
													@endforeach
												</select>
												@error('currency')
													<p class="text-danger">{{ $errors->first('currency') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Payment Frequence') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="frequency" name="frequency" class="form-select" data-placeholder="{{ __('Select Payment Frequency') }}:" data-callback="duration_select">		
													<option value="monthly" selected>{{ __('Monthly') }}</option>
													<option value="yearly">{{ __('Yearly') }}</option>
													<option value="lifetime">{{ __('Lifetime') }}</option>
												</select>
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Featured Plan') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="featured" name="featured" class="form-select" data-placeholder="{{ __('Select if Plan is Featured') }}:">		
													<option value=1>{{ __('Yes') }}</option>
													<option value=0 selected>{{ __('No') }}</option>
												</select>
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Free Plan') }}</h6>
												<div class="form-group">							    
													<select id="free-plan" name="free-plan" class="form-select" data-placeholder="{{ __('Make this plan a Free Plan?') }}:">			
														<option value=1>{{ ('Yes') }}</option>
														<option value=0 selected>{{ ('No') }}</option>
													</select>
												</div> 
												@error('free-plan')
													<p class="text-danger">{{ $errors->first('free-plan') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Free Plan Days') }}</h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="days" name="days" min=0 value="{{ old('days') }}">
												</div> 
												@error('days')
													<p class="text-danger">{{ $errors->first('days') }}</p>
												@enderror
											</div> 						
										</div>
									</div>
								</div>
							</div>

							<div class="card mt-7 shadow-0" id="payment-gateways">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa fa-bank text-info fs-14 mr-1 fw-2"></i>{{ __('Payment Gateways Plan IDs') }}</h6>

									<div class="row">								
										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('PayPal Plan ID') }} <span class="text-danger">({{ __('Required for Paypal') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Paypal Plan ID in your Paypal account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="paypal_gateway_plan_id" name="paypal_gateway_plan_id" value="{{ old('paypal_gateway_plan_id') }}">
												</div> 
												@error('paypal_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('paypal_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Stripe Product ID') }} <span class="text-danger">({{ __('Required for Stripe') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Stripe Product ID in your Stripe account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="stripe_gateway_plan_id" name="stripe_gateway_plan_id" value="{{ old('stripe_gateway_plan_id') }}">
												</div> 
												@error('stripe_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('stripe_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Paystack Plan Code') }} <span class="text-danger">({{ __('Required for Paystack') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Paystack Plan ID in your Paystack account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="paystack_gateway_plan_id" name="paystack_gateway_plan_id" value="{{ old('paystack_gateway_plan_id') }}">
												</div> 
												@error('paystack_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('paystack_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Razorpay Plan ID') }} <span class="text-danger">({{ __('Required for Razorpay') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Razorpay Plan ID in your Razorpay account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="razorpay_gateway_plan_id" name="razorpay_gateway_plan_id" value="{{ old('razorpay_gateway_plan_id') }}">
												</div> 
												@error('razorpay_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('razorpay_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Flutterwave Plan ID') }} <span class="text-danger">({{ __('Required for Flutterwave') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Flutterwave Plan ID in your Flutterwave account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="flutterwave_gateway_plan_id" name="flutterwave_gateway_plan_id" value="{{ old('flutterwave_gateway_plan_id') }}">
												</div> 
												@error('flutterwave_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('flutterwave_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Paddle Plan ID') }} <span class="text-danger">({{ __('Required for Paddle') }}) <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('You have to get Paddle Plan ID in your Paddle account. Refer to the documentation if you need help with creating one') }}."></i></span></h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="paddle_gateway_plan_id" name="paddle_gateway_plan_id" value="{{ old('paddle_gateway_plan_id') }}">
												</div> 
												@error('paddle_gateway_plan_id')
													<p class="text-danger">{{ $errors->first('paddle_gateway_plan_id') }}</p>
												@enderror
											</div> 						
										</div>
									</div>
								</div>						
							</div>

							<div class="card mt-7 mb-7 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-box-circle-check text-info fs-14 mr-1 fw-2"></i>{{ __('Included AI Credits') }}</h6>

									<div class="row">
										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 3 Turbo Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_3_turbo" name="gpt_3_turbo" value="0" required placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4 Turbo Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4_turbo" name="gpt_4_turbo" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4o Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4o" name="gpt_4o" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4o mini Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4o_mini" name="gpt_4o_mini" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4 Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4" name="gpt_4" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('o1 preview Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="o1_preview" name="o1_preview" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('o1 mini Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="o1_mini" name="o1_mini" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Fine Tuned Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="fine_tune"  name="fine_tune" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3 Opus Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_opus" name="claude_3_opus" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3.5 Sonnet Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_sonnet" name="claude_3_sonnet" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3.5 Haiku Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_haiku" name="claude_3_haiku" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Gemini Pro Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gemini_pro" name="gemini_pro" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Each text generation task counts output words created') }}. {{ __('Set as -1 for unlimited words') }}. ({{ __('1 credit = 1 word') }}).</span>
												</div> 
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Characters Included') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="characters" name="characters" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('For AI Voiceover feature') }}. {{ __('Set as -1 for unlimited characters') }}.</span>
												</div> 
												@error('characters')
													<p class="text-danger">{{ $errors->first('characters') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Minutes Included') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="minutes" name="minutes" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('For AI Speech to Text feature') }}. {{ __('Set as -1 for unlimited minutes') }}.</span>
												</div> 
												@error('minutes')
													<p class="text-danger">{{ $errors->first('minutes') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Image Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-muted ml-3">({{ __('Renewed Monthly') }})</span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="image-credits" name="image-credits" value="0" placeholder="0">
													<span class="text-muted fs-10">{{ __('Valid for all image vendors') }}. {{ __('Set as -1 for unlimited images') }}.</span>
												</div> 
												@error('image-credits')
													<p class="text-danger">{{ $errors->first('image-credits') }}</p>
												@enderror
											</div> 						
										</div>

									</div>
								</div>
							</div>

							<div class="card mt-7 mb-7 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-box-circle-check text-info fs-14 mr-1 fw-2"></i>{{ __('Included Features') }}</h6>

									<div class="row">	
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Writer Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="writer-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Article Wizard Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="wizard-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Smart Editor Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="smart-editor-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Rewriter Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="rewriter-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Image Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="image-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Voiceover Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="voiceover-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Speech to Text Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="whisper-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Chat Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="chat-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Code Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="code-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal OpenAI API Usage Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-openai-api" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal Claude API Usage Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-claude-api" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal Gemini API Usage Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-gemini-api" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>
			
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal Stable Diffusion API Usage Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-sd-api" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Vision Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="vision-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Chat Image Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="chat-image-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI File Chat Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="file-chat-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Internet Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="internet-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Web Chat Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="chat-web-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>																			

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal Custom AI Chat Bot Creation Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-chat-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Personal Custom Template Creation Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="personal-template-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Brand Voice Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="brand-voice-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>					

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Youtube Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="youtube-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI RSS Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group mt-3">
													<label class="custom-switch">
														<input type="checkbox" name="rss-feature" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card mt-7 mb-7 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-box-circle-check text-info fs-14 mr-1 fw-2"></i>{{ __('Included Service Limits') }}</h6>

									<div class="row">							
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Available Models for All Templates') }} <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Subscribers will only have access to the selected models for all AI features related to generating text') }}."></i></h6>
												<select class="form-select" id="templates-models-list" name="templates_models_list[]" data-placeholder="{{ __('Choose Models for Templates') }}" multiple>									
													<option value='gpt-3.5-turbo-0125'>{{ __('GPT 3.5 Turbo') }}</option>																																																																																												
													<option value='gpt-4'>{{ __('GPT 4') }}</option>																																																																																																																																																																																																																																																							
													<option value='gpt-4o'>{{ __('GPT 4o') }}</option>																																																																																																																																																																																																																																																					
													<option value='gpt-4o-mini'>{{ __('GPT 4o mini') }}</option>																																																																																																																																																																																																																																																					
													<option value='gpt-4-0125-preview'>{{ __('GPT 4 Turbo') }}</option>																																																																																																																											
													<option value='gpt-4-turbo-2024-04-09'>{{ __('GPT 4 Turbo with Vision') }}</option>																																																																																																																																																																																																																																																						
													<option value='o1-preview'>{{ __('o1 preview') }}</option>																																																																																																																																																																																																																																																						
													<option value='o1-mini'>{{ __('o1 mini') }}</option>																																																																																																																																																																																																																																																						
													<option value='claude-3-opus-20240229'>{{ __('Claude 3 Opus') }}</option>																																																																																																																											
													<option value='claude-3-5-sonnet-20241022'>{{ __('Claude 3.5 Sonnet') }}</option>																																																																																																																											
													<option value='	claude-3-5-haiku-20241022'>{{ __('Claude 3.5 Haiku') }}</option>																																																																																																																											
													<option value='gemini_pro'>{{ __('Gemini Pro') }}</option>																																																																																																																											
													@foreach ($models as $model)
														<option value="{{ $model->model }}"> {{ $model->description }} ({{ __('Fine Tune Model')}})</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Available Models for All Chat Bots') }} <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Subscribers will only have access to the selected models for all AI features related to chat bots') }}."></i></h6>
												<select class="form-select" id="chats-models-list" name="chats_models_list[]" data-placeholder="{{ __('Choose Models for Chat Bots') }}" multiple>
													<option value='gpt-3.5-turbo-0125'>{{ __('GPT 3.5 Turbo') }}</option>																																																																																												
													<option value='gpt-4'>{{ __('GPT 4') }}</option>																																																																																																																																																																																																																																																							
													<option value='gpt-4o'>{{ __('GPT 4o') }}</option>																																																																																																																																																																																																																																																							
													<option value='gpt-4o-mini'>{{ __('GPT 4o mini') }}</option>																																																																																																																																																																																																																																																							
													<option value='gpt-4-0125-preview'>{{ __('GPT 4 Turbo') }}</option>																																																																																																																											
													<option value='gpt-4-turbo-2024-04-09'>{{ __('GPT 4 Turbo with Vision') }}</option>
													<option value='o1-preview'>{{ __('o1 preview') }}</option>																																																																																																																																																																																																																																																						
													<option value='o1-mini'>{{ __('o1 mini') }}</option>	
													<option value='claude-3-opus-20240229'>{{ __('Claude 3 Opus') }}</option>																																																																																																																											
													<option value='claude-3-5-sonnet-20241022'>{{ __('Claude 3.5 Sonnet') }}</option>																																																																																																																											
													<option value='	claude-3-5-haiku-20241022'>{{ __('Claude 3.5 Haiku') }}</option>																																																																																																																											
													<option value='gemini_pro'>{{ __('Gemini Pro') }}</option>																																																																																																																											
													@foreach ($models as $model)
														<option value="{{ $model->model }}"> {{ $model->description }} ({{ __('Fine Tune Model')}})</option>
													@endforeach
												</select>
											</div>
										</div>									

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Template Categories Access') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="templates" name="templates" class="form-select" data-placeholder="{{ __('Set Templates Access') }}">
													<option value="all" selected>{{ __('All Templates') }}</option>																																										
													<option value="free">{{ __('Only Free Templates') }}</option>																																										
													<option value="standard"> {{ __('Up to Standard Templates') }}</option>		
													<option value="professional"> {{ __('Up to Professional Templates') }}</option>																																																												
													<option value="premium"> {{ __('Up to Premium Templates') }} ({{ __('All') }})</option>																																																												
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('AI Chat Categories Access') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<select id="chats" name="chats" class="form-select" data-placeholder="{{ __('Set AI Chat Type Access') }}">
													<option value="all">{{ __('All Chat Types') }}</option>
													<option value="free">{{ __('Only Free Chat Types') }}</option>																																											
													<option value="standard"> {{ __('Up to Standard Chat Types') }}</option>
													<option value="professional"> {{ __('Up to Professional Chat Types') }}</option>
													<option value="premium"> {{ __('Upto Premium Chat Types') }} ({{ __('All') }})</option>																																																														
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="input-box">
												<h6>{{ __('Included AI Voiceover Vendors') }} <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Only listed TTS voices of the listed vendors will be available for the subscriber. Make sure to include respective vendor API keys in the AI Settings page.') }}."></i></h6>
												<select class="form-select" id="voiceover-vendors" name="voiceover_vendors[]" data-placeholder="{{ __('Choose Voiceover vendors') }}" multiple>
													<option value='aws'>{{ __('AWS') }}</option>																															
													<option value='azure'> {{ __('Azure') }}</option>																															
													<option value='gcp'> {{ __('GCP') }}</option>																															
													<option value='openai'> {{ __('OpenAI') }}</option>																															
													<option value='elevenlabs'> {{ __('ElevenLabs') }}</option>																																																														
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Number of Team Members') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Define how many team members a user is allowed to create under this subscription plan') }}."></i></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="team-members" name="team-members" min=0 value="0" required>
												</div> 
												@error('team-members')
													<p class="text-danger">{{ $errors->first('team-members') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="row">

											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Included AI Image Vendors') }} <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Only listed AI Image vendors models will be available for the subscriber. Make sure to include respective vendor API keys in the AI Settings page.') }}."></i></h6>
													<select class="form-select" id="image-vendors" name="image_vendors[]" data-placeholder="{{ __('Choose AI Image vendors') }}" multiple>
														<option value='openai'>{{ __('OpenAI') }}</option>																															
														<option value='sd'> {{ __('Stable Diffusion') }}</option>	
														@if (App\Services\HelperService::extensionFlux())																														
															<option value='falai'> {{ __('Fal AI') }}</option>
														@endif																																																																																													
													</select>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Maximum Allowed CSV File Size') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Set the maximum CSV file size limit that subscriber is allowed to process') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0.1" step="0.1" id="chat-csv-file-size" name="chat-csv-file-size" value="1.0">
														<span class="text-muted fs-10">{{ __('Maximum Size limit is in Megabytes (MB)') }}.</span>
													</div> 
													@error('chat-csv-file-size')
														<p class="text-danger">{{ $errors->first('chat-csv-file-size') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Maximum Allowed PDF File Size') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Set the maximum PDF file size limit that subscriber is allowed to process') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0.1" step="0.1" id="chat-pdf-file-size" name="chat-pdf-file-size" value="1.0">
														<span class="text-muted fs-10">{{ __('Maximum Size limit is in Megabytes (MB)') }}.</span>
													</div> 
													@error('chat-pdf-file-size')
														<p class="text-danger">{{ $errors->first('chat-pdf-file-size') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Maximum Allowed Word File Size') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Set the maximum Word file size limit that subscriber is allowed to process') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0.1" step="0.1" id="chat-word-file-size" name="chat-word-file-size" value="1.0">
														<span class="text-muted fs-10">{{ __('Maximum Size limit is in Megabytes (MB)') }}.</span>
													</div> 
													@error('chat-word-file-size')
														<p class="text-danger">{{ $errors->first('chat-word-file-size') }}</p>
													@enderror
												</div> 						
											</div>																					

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Image/Video/Voiceover Results Storage Period') }} <span class="text-muted">({{ __('In Days') }})</span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('After set days file results will be deleted via CRON task') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" id="file-result-duration" name="file-result-duration" value="-1">
														<span class="text-muted fs-10">{{ __('Set as -1 for unlimited storage duration') }}.</span>
													</div> 
													@error('file-result-duration')
														<p class="text-danger">{{ $errors->first('file-result-duration') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Generated Text Content Results Storage Period') }} <span class="text-muted">({{ __('In Days') }})</span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('After set days results will be deleted from database via CRON task') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" id="document-result-duration" name="document-result-duration" value="-1">
														<span class="text-muted fs-10">{{ __('Set as -1 for unlimited storage duration') }}.</span>
													</div> 
													@error('document-result-duration')
														<p class="text-danger">{{ $errors->first('document-result-duration') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Max Allowed Words Limit for All Text Results') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('OpenAI will treat this limit as a stop marker. i.e. If you set it to 500, openai will try to stop as it will create a text with 500 tokens, but it can also ignore it on some cases') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" id="tokens" name="tokens" value="4000" required>
													</div> 
													@error('tokens')
														<p class="text-danger">{{ $errors->first('tokens') }}</p>
													@enderror
												</div> 						
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="card mt-7 mb-7 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-box-circle-check text-info fs-14 mr-1 fw-2"></i>{{ __('Included Extension Features') }}</h6>

									<div class="row">	
										
										@if (App\Services\HelperService::extensionVoiceClone())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Voice Clone Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="voice-clone-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Maximum Allowed Created Voice Clones') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Set the number of voice clones that user can create') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0" id="voice_clone_number" name="voice_clone_number" value="0">
													</div> 
													@error('voice_clone_number')
														<p class="text-danger">{{ $errors->first('voice_clone_number') }}</p>
													@enderror
												</div> 						
											</div>	
										@endif

										@if (App\Services\HelperService::extensionSoundStudio())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Sound Studio Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="sound-studio-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>
										@endif
										
										@if (App\Services\HelperService::extensionPlagiarism())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Plagiarism Checker Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="plagiarism-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('AI Content Detector Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="detector-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Total Scan tasks for AI Plagiarism Checker') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0" id="plagiarism-pages" name="plagiarism-pages" value="0">
													</div> 
													@error('plagiarism-pages')
														<p class="text-danger">{{ $errors->first('plagiarism-pages') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Total Scan tasks for AI Content Decoder') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0" id="detector-pages" name="detector-pages" value="0">
													</div> 
													@error('detector-pages')
														<p class="text-danger">{{ $errors->first('detector-pages') }}</p>
													@enderror
												</div> 						
											</div>
										@endif

										@if (App\Services\HelperService::checkIntegrationFeature())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Integration Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="integration-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>
										@endif
										
										@if (App\Services\HelperService::extensionPhotoStudio())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('AI Photo Studio Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="photo-studio-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>
										@endif

										@if (App\Services\HelperService::extensionVideoImage())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('AI Image to Video Feature') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="video-image-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>	
										@endif

										@if (App\Services\HelperService::extensionPebblely())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('AI Product Photo') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="product-photo-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>	
										@endif

										@if (App\Services\HelperService::extensionWordpressIntegration())
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="input-box">
													<h6>{{ __('Wordpress Integration') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group mt-3">
														<label class="custom-switch">
															<input type="checkbox" name="wordpress-feature" class="custom-switch-input">
															<span class="custom-switch-indicator"></span>
														</label>
													</div>
												</div>
											</div>	

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Total Allowed Wordpress Websites') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Number of Wordpress Websites use will be able to connect') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0" id="wordpress-website-number" name="wordpress-website-number" value="0">
													</div> 
													@error('wordpress-website-number')
														<p class="text-danger">{{ $errors->first('wordpress-website-number') }}</p>
													@enderror
												</div> 						
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">							
												<div class="input-box">								
													<h6>{{ __('Total Allowed Wordpress Posts Scheduled') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Number of active posts in the schedule queue') }}."></i></h6>
													<div class="form-group">							    
														<input type="number" class="form-control" min="0" id="wordpress-post-number" name="wordpress-post-number" value="0">
													</div> 
													@error('wordpress-post-number')
														<p class="text-danger">{{ $errors->first('wordpress-post-number') }}</p>
													@enderror
												</div> 						
											</div>
										@endif
									</div>
								</div>
							</div>

							<div class="card mt-7 shadow-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar"><i class="fa-solid fa-filter-list text-info fs-14 mr-1 fw-2"></i>{{ __('Extra') }} <span class="text-muted">({{ __('Optional') }})</span></h6>

									<div class="row mt-6">
										<div class="col-12">
											<div class="input-box">	
												<h6>{{ __('Primary Heading') }} </h6>
												<div class="form-group">							    
													<input type="text" class="form-control" id="primary-heading" name="primary-heading" value="{{ old('primary-heading') }}">
												</div>
											</div>
										</div>
									</div>

									<div class="row mt-6">
										<div class="col-lg-12 col-md-12 col-sm-12">	
											<div class="input-box">	
												<h6>{{ __('Plan Features') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <span class="text-danger ml-3">({{ __('Comma Seperated') }})</span></h6>							
												<textarea class="form-control" name="features" rows="10">{{ old('features') }}</textarea>
												@error('features')
													<p class="text-danger">{{ $errors->first('features') }}</p>
												@enderror	
											</div>											
										</div>
									</div>
								</div>
							</div>
							

							<!-- ACTION BUTTON -->
							<div class="border-0 text-center mb-2 mt-1">
								<a href="{{ route('admin.finance.plans') }}" class="btn btn-cancel mr-2 pl-7 pr-7">{{ __('Return') }}</a>
								<button type="submit" class="btn btn-primary pl-7 pr-7">{{ __('Create') }}</button>							
							</div>				

						</form>					
					</div>
				</div>
			</div>

			@if ($type != 'Regular License')
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="card border-0 cost-sticky">
						<div class="card-header border-0 pb-0">
							<h6 class="card-title fs-12 text-muted">{{ __('Calculate Cost and Margin') }} (USD)</h6>
						</div>						
						<div class="card-body pt-0">		
							<hr class="mt-0">							
							<h6 class="fs-12 font-weight-semibold">{{ __('OpenAI Cost') }}:</h6>
							<ul>
								<ol class="fs-11 mb-1 text-muted">{{ __('GPT 3.5 Turbo Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gpt-3t">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('GPT 4 Turbo Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gpt-4t">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('GPT 4 Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gpt-4">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('GPT 4o Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gpt-4o">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('GPT 4o mini Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gpt-4o-mini">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('o1 mini Model') }}: <span class="text-warning cost-right-side">$<span id="cost-o1-mini">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('o1 preview Model') }}: <span class="text-warning cost-right-side">$<span id="cost-o1-preview">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('Fine Tuned Model') }}: <span class="text-warning cost-right-side">$<span id="cost-fine-tuned">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('Whisper') }} (STT): <span class="text-warning cost-right-side">$<span id="cost-whisper">0</span></span></ol>
							</ul>
							<h6 class="fs-12 mt-3 font-weight-semibold">{{ __('Anthropic Cost') }}:</h6>
							<ul>
								<ol class="fs-11 mb-1 text-muted">{{ __('Claude 3 Opus Model') }}: <span class="text-warning cost-right-side">$<span id="cost-opus">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('Claude 3.5 Sonnet Model') }}: <span class="text-warning cost-right-side">$<span id="cost-sonnet">0</span></span></ol>
								<ol class="fs-11 mb-1 text-muted">{{ __('Claude 3.5 Haiku Model') }}: <span class="text-warning cost-right-side">$<span id="cost-haiku">0</span></span></ol>
							</ul>
							<h6 class="fs-12 mt-3 font-weight-semibold">{{ __('Gemini Cost') }}:</h6>
							<ul>
								<ol class="fs-11 mb-1 text-muted">{{ __('Gemini Pro Model') }}: <span class="text-warning cost-right-side">$<span id="cost-gemini">0</span></span></ol>
							</ul>
							<h6 class="fs-12 mt-3 font-weight-semibold">{{ __('Voiceover Cost') }}:</h6>
							<ul>
								<ol class="fs-11 mb-1 text-muted">{{ __('Characters') }} (TTS): <span class="text-warning cost-right-side">$<span id="cost-tts">0</span></span></ol>
							</ul>
							<hr>
							<h6 class="fs-12 mt-3 font-weight-semibold text-muted">{{ __('Target Price') }}: <span class="text-warning cost-right-side">$<span id="target-price">0</span></span></h6>
							<h6 class="fs-12 mt-3 font-weight-semibold text-muted">{{ __('Total Cost') }}: <span class="text-warning cost-right-side">$<span id="total-cost">0</span></span></h6>
							<h6 class="fs-12 mt-3 font-weight-semibold text-muted">{{ __('Net Profit') }}: <span class="text-warning cost-right-side">$<span id="net-profit">0</span></span></h6>
						</div>
					</div>
				</div>
			@endif
		@endif
	</div>
@endsection

@section('js')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
	<script>
		let total_cost = 0;
		let target_price = 0;
		let net_profit = 0;
		let cost_gpt_3t = 0;
		let cost_gpt_4t = 0;
		let cost_gpt_4 = 0;
		let cost_gpt_4o = 0;
		let cost_gpt_4o_mini = 0;
		let cost_o1_mini = 0;
		let cost_o1_preview = 0;
		let cost_fine_tuned = 0;
		let cost_whisper = 0;
		let cost_opus = 0;
		let cost_sonnet = 0;
		let cost_haiku = 0;
		let cost_gemini = 0;
		let cost_tts = 0;

		$("#voiceover-vendors").select2({
			theme: "bootstrap-5",
			containerCssClass: "select2--small",
			dropdownCssClass: "select2--small",
		});

		$("#templates-models-list").select2({
			theme: "bootstrap-5",
			containerCssClass: "select2--small",
			dropdownCssClass: "select2--small",
		});

		$("#chats-models-list").select2({
			theme: "bootstrap-5",
			containerCssClass: "select2--small",
			dropdownCssClass: "select2--small",
		});

		$("#image-vendors").select2({
			theme: "bootstrap-5",
			containerCssClass: "select2--small",
			dropdownCssClass: "select2--small",
		});

		$('#gpt_3_turbo').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gpt_3t }}';
			if (credits > 0) cost_gpt_3t = (credits/1000) * price; 
			if (credits == 0) cost_gpt_3t = 0; 
			let view = document.getElementById('cost-gpt-3t').innerHTML = cost_gpt_3t;
			calculateTotalCost();
		});

		$('#gpt_4_turbo').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gpt_4t }}';
			if (credits > 0) cost_gpt_4t = (credits/1000) * price; 
			if (credits == 0) cost_gpt_4t = 0; 
			let view = document.getElementById('cost-gpt-4t').innerHTML = cost_gpt_4t;
			calculateTotalCost();
		});

		$('#gpt_4').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gpt_4 }}';
			if (credits > 0) cost_gpt_4 = (credits/1000) * price; 
			if (credits == 0) cost_gpt_4 = 0; 
			let view = document.getElementById('cost-gpt-4').innerHTML = cost_gpt_4;
			calculateTotalCost();
		});

		$('#gpt_4o').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gpt_4o }}';
			if (credits > 0) cost_gpt_4o = (credits/1000) * price; 
			if (credits == 0) cost_gpt_4o = 0; 
			let view = document.getElementById('cost-gpt-4o').innerHTML = cost_gpt_4o;
			calculateTotalCost();
		});

		$('#gpt_4o_mini').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gpt_4o_mini }}';
			if (credits > 0) cost_gpt_4o_mini = (credits/1000) * price; 
			if (credits == 0) cost_gpt_4o_mini = 0; 
			let view = document.getElementById('cost-gpt-4o-mini').innerHTML = cost_gpt_4o_mini;
			calculateTotalCost();
		});

		$('#o1_mini').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->o1_mini }}';
			if (credits > 0) cost_o1_mini = (credits/1000) * price; 
			if (credits == 0) cost_o1_mini = 0; 
			let view = document.getElementById('cost-o1-mini').innerHTML = cost_o1_mini;
			calculateTotalCost();
		});

		$('#o1_preview').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->o1_preview }}';
			if (credits > 0) cost_o1_preview = (credits/1000) * price; 
			if (credits == 0) cost_o1_preview = 0; 
			let view = document.getElementById('cost-o1-preview').innerHTML = cost_o1_preview;
			calculateTotalCost();
		});

		$('#fine_tune').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->fine_tuned }}';
			if (credits > 0) cost_fine_tuned = (credits/1000) * price; 
			if (credits == 0) cost_fine_tuned = 0; 
			let view = document.getElementById('cost-fine-tuned').innerHTML = cost_fine_tuned;
			calculateTotalCost();
		});

		$('#claude_3_opus').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->claude_3_opus }}';
			if (credits > 0) cost_opus = (credits/1000) * price; 
			if (credits == 0) cost_opus = 0; 
			let view = document.getElementById('cost-opus').innerHTML = cost_opus;
			calculateTotalCost();
		});

		$('#claude_3_sonnet').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->claude_3_sonnet }}';
			if (credits > 0) cost_sonnet = (credits/1000) * price; 
			if (credits == 0) cost_sonnet = 0; 
			let view = document.getElementById('cost-sonnet').innerHTML = cost_sonnet;
			calculateTotalCost();
		});

		$('#claude_3_haiku').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->claude_3_haiku }}';
			if (credits > 0) cost_haiku = (credits/1000) * price; 
			if (credits == 0) cost_haiku = 0; 
			let view = document.getElementById('cost-haiku').innerHTML = cost_haiku;
			calculateTotalCost();
		});

		$('#gemini_pro').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->gemini_pro }}';
			if (credits > 0) cost_gemini = (credits/1000) * price; 
			if (credits == 0) cost_gemini = 0; 
			let view = document.getElementById('cost-gemini').innerHTML = cost_gemini;
			calculateTotalCost();
		});

		$('#minutes').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->whisper }}';
			if (credits > 0) cost_whisper = credits * price; 
			if (credits == 0) cost_whisper = 0; 
			let view = document.getElementById('cost-whisper').innerHTML = cost_whisper;
			calculateTotalCost();
		});

		$('#characters').on('keyup', function () {
			let credits = $(this).val();
			let price = '{{ $prices->aws_tts }}';
			if (credits > 0) cost_tts = (credits/1000000) * price; 
			if (credits == 0) cost_tts = 0; 
			let view = document.getElementById('cost-tts').innerHTML = cost_tts;
			calculateTotalCost();
		});

		$('#cost').on('keyup', function () {
			let cost = $(this).val();
			if (cost > 0) target_price = cost; 
			if (cost == 0) target_price = 0; 
			calculateTotalCost();
		});

		function duration_select(value) {
			if (value == 'lifetime') {
				$('#payment-gateways').css('display', 'none');
			} else {
				$('#payment-gateways').css('display', 'block');
			}
		} 

		function calculateTotalCost() {
			total_cost = cost_gpt_3t + cost_gpt_4t + cost_gpt_4 + cost_gpt_4o + cost_gpt_4o_mini + cost_o1_mini + cost_o1_preview + cost_fine_tuned + cost_whisper + cost_opus + cost_sonnet + cost_haiku + cost_gemini + cost_tts;
			document.getElementById('total-cost').innerHTML = total_cost;
			if (target_price > 0) {
				document.getElementById('target-price').innerHTML = target_price;
				net_profit = target_price - total_cost;
				document.getElementById('net-profit').innerHTML = net_profit;
			}
		}
	</script>
@endsection

