@extends('layouts.app')

@section('content')
	<div class="row mt-24">
		<div class="col-sm-12">
			<div class="card border-0 p-5 pt-4">
				<div class="card-body">
					<div class="row justify-content-center">	
						<div class="col-lg-4 col-md-5 col-sm-12">
							<h3 class="mb-3 fs-20 super-strong text-center">{{ __('Thank you for your purchase!') }}</h3>
							<p class="fs-12 text-muted text-center mb-5">{{ __('Payment for') }} {{ $theme['name'] }} {{ __('Theme') }} {{ __('was successful, please proceed with installation') }}</p>
							<form id="payment-form" action="{{ route('admin.theme.install', $theme['slug']) }}" method="POST" enctype="multipart/form-data">
								<div class="card shadow-0 theme">								
									<div class="card-body text-center">
										<div class="theme-info">
											<h6 class="mb-4 fs-20 font-weight-bold" style="opacity: 0.8">{{ $theme['name'] }} {{ __('Theme') }}</h6>
										</div>	
										<div class="theme-name mt-3">
											<h6 class="mb-4 fs-12 text-muted">{{ __('Click on Install button') }}</h6>
										</div>

										<div class="theme-action text-center mt-4 mb-4">
											<button type="button" id="install-button" class="btn btn-primary ripple" style="min-width: 250px; text-transform: none; font-size: 11px; padding-top: 10px; padding-bottom: 10px;">{{ __('Install') }}</button>
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
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Theme Type') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ ucfirst($theme['type']) }} Theme</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Theme Name') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ $theme['name'] }}</h6>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="card shadow-0 p-4" style="height: 75px;">
												<h6 class="mb-4 fs-10 text-muted" style="text-transform: uppercase; letter-spacing: 1px">{{ __('Purchase Date') }}</h6>
												<h6 class="fs-13 font-weight-semibold">{{ date('M d, Y') }}</h6>
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
				url: $('#payment-form').attr('action'),
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
					}

				},
				error: function(data) {
					toastr.error(data['message']);
					$('#install-button').prop('disabled', false);
					let btn = document.getElementById('install-button');					
					btn.innerHTML = '{{ __('Install') }}';
					toastr.warning(data['message']);
					document.querySelector('#loader-line')?.classList?.add('hidden');
				}
			}).done(function(data) {})
		});

	</script>
@endsection


