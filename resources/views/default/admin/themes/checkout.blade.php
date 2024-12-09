@extends('layouts.app')

@section('content')
	<div class="row mt-24">
		<div class="col-sm-12">
			<div class="card border-0 p-5 pt-4">
				<div class="card-body">
					<div class="row">	
						<h3 class="card-title mb-3 fs-20 font-weight-bold">{{ $theme['name'] }} {{ __('Theme') }}</h3>										
						<a href="{{ route('admin.themes') }}" class="mb-5 fs-12 text-muted"><i class="fa-solid fa-objects-column mr-2 text-muted"></i>{{ __('View All Themes') }}</a>		

						<div class="col-lg-8 col-md-7 col-sm-12">
							<div class="card shadow-0 theme">
								<div class="pl-5 pr-5 pt-5 pb-4">
									<img src="{{ $theme['banner'] }}" style="border-radius: 8px">
								</div>
																	
								<div class="card-body">
									<div class="row">
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="card shadow-0 text-center" style="height: 70px;">
												<h6 class="mt-auto mb-auto fs-13 font-weight-semibold"><i class="fa-solid fa-objects-column mr-2 text-primary"></i>{{ ucfirst($theme['type']) }} {{ __('Theme') }}</h6>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="card shadow-0 text-center" style="height: 70px;">
												<h6 class="mt-auto mb-auto fs-13 font-weight-semibold"><i class="fa-solid fa-badge-check mr-2 text-primary"></i>{{ __('Tested with DaVinci AI') }}</h6>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="card shadow-0 text-center" style="height: 70px;">
												<h6 class="mt-auto mb-auto fs-13 font-weight-semibold"><i class="fa-solid fa-star mr-1 fs-11" style="vertical-align: top"></i>5.0</h6>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="card shadow-0 text-center" style="height: 70px;">
												<h6 class="mt-auto mb-auto fs-13 font-weight-semibold"><i class="fa-solid fa-timer mr-2"></i>{{ __('Recently Updated') }}</h6>
											</div>
										</div>
									</div>
									<div class="theme-name">
										<h6 class="mb-5 mt-3 fs-15 number-font">{{ __('About') }} {{ $theme['name'] }} {{ __('Theme') }}</h6>
									</div>
									<div class="theme-info">
										<p class="fs-13 text-muted mb-2">{{ $theme['main_description'] }}</p>
									</div>	
									<div class="theme-info mt-7 mb-7">
										@foreach ($tags as $tag)
											<p class="fs-14 font-weight-semibold mb-5"><i class="fa-solid fa-circle-check fs-20 text-primary mr-2" style="vertical-align: middle"></i> {{ trim($tag) }}</p>
										@endforeach
									</div>	
									<div class="theme-faq">
										<h6 class="mb-5 mt-6 fs-15 font-weight-bold">{{ __('Got Questions?') }}</h6>
										<div id="faqs" class="pb-6">
											<div id="accordion">
												<div class="card">
													<div class="card-header" id="heading1">
														<h5 class="mb-0">
														<span class="btn btn-link faq-button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
															<i class="fa-solid fa-messages-question fs-14 text-muted mr-2"></i> {{ __('How to install the theme?') }}
														</span>
														</h5>
														<i class="fa-solid fa-plus fs-10"></i>
													</div>
												
													<div id="collapse-1" class="collapse" aria-labelledby="heading1" data-bs-parent="#accordion">
														<div class="card-body">
															{{ __('After successfully purchasing your target theme, you can click on the install button that will appear after the purchase process is completed. It will start the download process of your new theme and it will be ready for activation and usage within seconds.') }}
														</div>
													</div>
												</div>
											</div>
											<div id="accordion">
												<div class="card">
													<div class="card-header" id="heading2">
														<h5 class="mb-0">
														<span class="btn btn-link faq-button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
															<i class="fa-solid fa-messages-question fs-14 text-muted mr-2"></i> {{ __('How to switch a theme?') }}
														</span>
														</h5>
														<i class="fa-solid fa-plus fs-10"></i>
													</div>
												
													<div id="collapse-2" class="collapse" aria-labelledby="heading2" data-bs-parent="#accordion">
														<div class="card-body">
															{{ __('In case if you purchased multiple themes, you can click on the activate button, it will automatically set it as your default system theme either for frontend or dashboard depending on which theme you purchased and activated.') }}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>						
							
						</div>

						<div class="col-lg-4 col-md-5 col-sm-12">
							<form id="payment-form" action="{{ route('admin.theme.purchase', $theme['slug']) }}" install="{{ route('admin.theme.install', $theme['slug']) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="card shadow-0 theme">								
									<div class="card-body text-center">
										<div class="theme-name mt-5">
											<h6 class="mb-4 fs-13 text-muted">{{ __('For a limited time only') }}</h6>
										</div>
										<div class="theme-info">
											<h6 class="mb-4 fs-40 number-font" style="opacity: 0.8">${{ $theme['price'] }}</h6>
										</div>	
										<div class="theme-name mt-3">
											<h6 class="mb-4 fs-13 text-muted">{{ __('Price is in US dollar. Tax included.') }}</h6>
										</div>
										<input type="hidden" name="value" id="hidden_value" value="{{ $theme['price'] }}">
										<input type="hidden" name="type" value="theme">
										<div class="theme-action text-center mt-4 mb-4">
											@if ($extension->purchased && $extension->installed)
												@if ((float)$extension->version < (float)$theme['version'])
													<a href="#" id="update-button" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 11px; padding-top: 10px; padding-bottom: 10px;">{{ __('Update Theme') }}</a>	
												@else
													<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 11px; padding-top: 10px; padding-bottom: 10px;">{{ __('Activate Theme') }}</a>	
												@endif
											@else
												@if ($extension->purchased && !$extension->installed)
													<a href="#" id="install-button" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 11px; padding-top: 10px; padding-bottom: 10px;">{{ __('Install Theme') }}</a>	
												@else
													<button type="submit" id="payment-button" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 11px; padding-top: 10px; padding-bottom: 10px;">{{ __('Buy Theme') }}</button>
												@endif	
											@endif										
										</div>	
									</div>
								</div>	
							</form>
							
							<div class="card shadow-0 theme">
								<div class="card-body p-6">
									<p class="card-title mb-4 font-weigth-semibold pb-3" style="border-bottom: 1px solid #dbe2eb">{{ __('Details') }}</p>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Released Date') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ $theme['released_date'] }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Updated Date') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ $theme['updated_date'] }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Version') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ $theme['version'] }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Installation') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ __('One Click') }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('License Required') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ __('Regular or Extended') }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Free Updates') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ __('Lifetime') }}</h6>
											</div>
										</div>
									</div>
								</div>
							</div>	
							
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- END USER PROFILE PAGE -->
@endsection


@section('js')
	<script type="text/javascript">
		let loading = `<span class="loading">
					<span style="background-color: #fff;"></span>
					<span style="background-color: #fff;"></span>
					<span style="background-color: #fff;"></span>
					</span>`;

		$('#install-button').on('click',function(e) {

			const form = document.getElementById("payment-form");
			let data = new FormData(form);

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "POST",
				url: $('#payment-form').attr('install'),
				data: data,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('#install-button').prop('disabled', true);
					let btn = document.getElementById('install-button');					
					btn.innerHTML = loading;  
					document.querySelector('#loader-line')?.classList?.remove('hidden');         
				},	

				success: function(data) {

					if (data['status']) {
						let btn = document.getElementById('install-button');					
						btn.innerHTML = '{{ __('Installed') }}';
						toastr.success(data['message']);
						document.querySelector('#loader-line')?.classList?.add('hidden');
					} else {
						$('#install-button').prop('disabled', false);
						let btn = document.getElementById('install-button');					
						btn.innerHTML = '{{ __('Install Theme') }}';
						toastr.error(data['message']);
						document.querySelector('#loader-line')?.classList?.add('hidden');
					}

				},
				error: function(data) {
					$('#install-button').prop('disabled', false);
					let btn = document.getElementById('install-button');					
					btn.innerHTML = '{{ __('Install Theme') }}';
					toastr.error(data['message']);
					document.querySelector('#loader-line')?.classList?.add('hidden');
				}
			}).done(function(data) {})
		});


		$('#update-button').on('click',function(e) {

			const form = document.getElementById("payment-form");
			let data = new FormData(form);

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "POST",
				url: $('#payment-form').attr('install'),
				data: data,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('#update-button').prop('disabled', true);
					let btn = document.getElementById('update-button');					
					btn.innerHTML = loading;  
					document.querySelector('#loader-line')?.classList?.remove('hidden');         
				},	

				success: function(data) {

					if (data['status']) {
						let btn = document.getElementById('update-button');					
						btn.innerHTML = '{{ __('Updated') }}';
						toastr.success(data['message']);
						document.querySelector('#loader-line')?.classList?.add('hidden');
					} else {
						$('#update-button').prop('disabled', false);
						let btn = document.getElementById('update-button');					
						btn.innerHTML = '{{ __('Update Theme') }}';
						toastr.error(data['message']);
						document.querySelector('#loader-line')?.classList?.add('hidden');
					}

				},
				error: function(data) {
					$('#update-button').prop('disabled', false);
					let btn = document.getElementById('update-button');					
					btn.innerHTML = '{{ __('Update Theme') }}';
					toastr.error(data['message']);
					document.querySelector('#loader-line')?.classList?.add('hidden');
				}
			}).done(function(data) {})
		});

	</script>
@endsection


