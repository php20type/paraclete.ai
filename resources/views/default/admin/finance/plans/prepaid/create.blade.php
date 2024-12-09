@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center"> 
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('New Prepaid Plan') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.prepaid') }}"> {{ __('Prepaid Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('New Prepaid Plan') }}</a></li>
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
						<h6 class="card-title fs-12 text-muted">{{ __('Create New Prepaid Plan') }}</h6>
					</div>
					<div class="card-body pt-0">	
						<hr class="mt-0">									
						<form action="{{ route('admin.finance.prepaid.store') }}" method="POST" enctype="multipart/form-data">
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
													<option value="closed">{{ __('Closed') }}</option>
												</select>
												@error('plan-status')
													<p class="text-danger">{{ $errors->first('plan-status') }}</p>
												@enderror	
											</div>						
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Plan Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> </h6>
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
													<input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
												</div> 
												@error('price')
													<p class="text-danger">{{ $errors->first('price') }}</p>
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
												<h6>{{ __('Featured Plan') }}</h6>
												<select id="featured" name="featured" class="form-select" data-placeholder="{{ __('Select if Plan is Featured') }}:">		
													<option value=1>{{ __('Yes') }}</option>
													<option value=0 selected>{{ __('No') }}</option>
												</select>
											</div> 						
										</div>
									</div>
								</div>
							</div>

							<div class="card mt-7 special-shadow border-0">
								<div class="card-body">
									<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar "><i class="fa-solid fa-box-circle-check text-info fs-14 mr-1 fw-2"></i>{{ __('Included Credits') }}</h6>

									<div class="row">								
										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4 Turbo Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4_turbo" min=0 name="gpt_4_turbo" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4 Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4" min=0 name="gpt_4" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4o Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4o" min=0 name="gpt_4o" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 4o mini Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_4o_mini" min=0 name="gpt_4o_mini" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('o1 preview Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="o1_preview" min=0 name="o1_preview" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('o1 mini Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="o1_mini" min=0 name="o1_mini" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('GPT 3.5 Turbo Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gpt_3_turbo" min=0 name="gpt_3_turbo" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Fine Tuned Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="fine_tune" min=0 name="fine_tune" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3 Opus Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_opus" min=0 name="claude_3_opus" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3.5 Sonnet Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_sonnet" min=0 name="claude_3_sonnet" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Claude 3.5 Haiku Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="claude_3_haiku" min=0 name="claude_3_haiku" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Gemini Pro Model Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="gemini_pro" min=0 name="gemini_pro" value="0">
													<span class="text-muted fs-10">{{ __('For AI Templates and AI Chat features') }}</span>
												</div> 
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Characters') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="characters" name="characters" value="0">
													<span class="text-muted fs-10">{{ __('For AI Voiceover feature') }}</span>
												</div> 
												@error('characters')
													<p class="text-danger">{{ $errors->first('characters') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Minutes') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="minutes" name="minutes" value="0">
													<span class="text-muted fs-10">{{ __('For AI Speech to Text feature') }}</span>
												</div> 
												@error('minutes')
													<p class="text-danger">{{ $errors->first('minutes') }}</p>
												@enderror
											</div> 						
										</div>

										<div class="col-lg-6 col-md-12 col-sm-12">							
											<div class="input-box">								
												<h6>{{ __('Image Credits') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												<div class="form-group">							    
													<input type="number" class="form-control" id="images" name="images" value="0">
													<span class="text-muted fs-10">{{ __('Valid for all images vendors') }}</span>
												</div> 
												@error('images')
													<p class="text-danger">{{ $errors->first('images') }}</p>
												@enderror
											</div> 						
										</div>
									</div>
								</div>
							</div>

							<!-- ACTION BUTTON -->
							<div class="border-0 text-center mb-2 mt-1">
								<a href="{{ route('admin.finance.prepaid') }}" class="btn btn-cancel ripple mr-2 pl-7 pr-7">{{ __('Return') }}</a>
								<button type="submit" class="btn btn-primary ripple pl-7 pr-7">{{ __('Create') }}</button>							
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

		$('#price').on('keyup', function () {
			let cost = $(this).val();
			if (cost > 0) target_price = cost; 
			if (cost == 0) target_price = 0; 
			calculateTotalCost();
		});

		function calculateTotalCost() {
			total_cost = cost_gpt_3t + cost_gpt_4t + cost_gpt_4 + cost_gpt_4o + cost_gpt_4o_mini + cost_o1_mini + cost_o1_preview +  cost_fine_tuned + cost_whisper + cost_opus + cost_sonnet + cost_haiku + cost_gemini + cost_tts;
			document.getElementById('total-cost').innerHTML = total_cost;
			if (target_price > 0) {
				document.getElementById('target-price').innerHTML = target_price;
				net_profit = target_price - total_cost;
				document.getElementById('net-profit').innerHTML = net_profit;
			}
		}
	</script>
@endsection

