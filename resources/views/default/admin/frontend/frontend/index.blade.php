@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('Frontend Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-7 col-md-10 col-sm-12">
			<div class="card overflow-hidden border-0 p-3">
				<div class="card-body">
				
					<form id="frontend-settings" action="{{ route('admin.settings.frontend.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Maintenance Mode') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="maintenance" class="custom-switch-input" @if ( config('frontend.maintenance')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable') }}</span>
									</label>
								</div> 
							</div>
							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Frontend Page') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="frontend" class="custom-switch-input" @if ( config('frontend.frontend_page')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>
						</div>


						<div class="card shadow-0 mb-6">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Custom Landing Page URL') }}</h6>

								<div class="form-group mb-3">
									<label class="custom-switch">
										<input type="checkbox" name="enable-redirection" class="custom-switch-input" @if ( config('frontend.custom_url.status')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-md-12 col-sm-12">													
										<div class="input-box mb-3">								
											<h6>{{ __('Landing Page URL') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Set custom index url for all frontend pages. Ex: https://aws.amazon.com (Note: https:// - is required)"></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('url') is-danger @enderror" id="url" name="url" value="{{ config('frontend.custom_url.link') }}" autocomplete="off">
												@error('url')
													<p class="text-danger">{{ $errors->first('url') }}</p>
												@enderror
											</div> 
										</div> 
									</div>							
								</div>	
							</div>
						</div>

						<div class="card shadow-0 mb-6">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Advanced Settings') }}</h6>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">													
										<div class="input-box mb-3">								
											<h6>{{ __('Custom CSS File Path URL') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Provide full URL of the CSS file (With: https:// or http:// included)"></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('css') is-danger @enderror" id="css" name="css" value="@if ($frontend_settings) {{ $frontend_settings->custom_css_url }} @endif" autocomplete="off">
												@error('css')
													<p class="text-danger">{{ $errors->first('css') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Custom JS File Path URL') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Provide full URL of the JS file (With: https:// or http:// included)"></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('js') is-danger @enderror" id="js" name="js" value="@if ($frontend_settings) {{ $frontend_settings->custom_js_url }} @endif" autocomplete="off">
												@error('js')
													<p class="text-danger">{{ $errors->first('js') }}</p>
												@enderror
											</div> 
										</div> 						
									</div>	
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Custom JS Code to Header') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Only JS code is allowed with proper <script> </script> tags"></i></h6>
											<div class="form-group">							    
												<textarea class="form-control" id="header_code" name="header_code">@if ($frontend_settings) {{ $frontend_settings->custom_header_code }} @endif</textarea>
											</div> 
										</div> 						
									</div>	
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Custom JS Code to Body') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Only JS code is allowed with proper <script> </script> tags"></i></h6>
											<div class="form-group">							    
												<textarea class="form-control" id="body_code" name="body_code">@if ($frontend_settings) {{ $frontend_settings->custom_body_code }} @endif</textarea>
											</div> 
										</div> 						
									</div>							
								</div>
	
							</div>
						</div>
						
						<div class="card shadow-0">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Footer Social Media Information') }}</h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-twitter mr-2"></i>{{ __('Twitter') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('twitter') is-danger @enderror" id="twitter" name="twitter" value="{{ config('frontend.social_twitter') }}" autocomplete="off">
												@error('twitter')
													<p class="text-danger">{{ $errors->first('twitter') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-facebook-f mr-2"></i>{{ __('Facebook') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('facebook') is-danger @enderror" id="facebook" name="facebook" value="{{ config('frontend.social_facebook') }}" autocomplete="off">
												@error('facebook')
													<p class="text-danger">{{ $errors->first('facebook') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-linkedin-in mr-2"></i>{{ __('LinkedIn') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('linkedin') is-danger @enderror" id="linkedin" name="linkedin" value="{{ config('frontend.social_linkedin') }}" autocomplete="off">
												@error('linkedin')
													<p class="text-danger">{{ $errors->first('linkedin') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-instagram mr-2"></i>{{ __('Instagram') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('instagram') is-danger @enderror" id="instagram" name="instagram" value="{{ config('frontend.social_instagram') }}" autocomplete="off">
												@error('instagram')
													<p class="text-danger">{{ $errors->first('instagram') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-youtube mr-2"></i>{{ __('Youtube') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('youtube') is-danger @enderror" id="youtube" name="youtube" value="{{ config('frontend.social_youtube') }}" autocomplete="off">
												@error('youtube')
													<p class="text-danger">{{ $errors->first('youtube') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
								</div>
	
							</div>
						</div>
						
						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-center mt-1">
							<button type="button" class="btn btn-primary ripple pl-7 pr-7" id="save">{{ __('Save') }}</button>							
						</div>				

					</form>

				</div>
			</div>
		</div>
	</div>	
@endsection

@section('js')
	<script src="{{URL::asset('plugins/ace/src-min-noconflict/ace.js')}}"></script>
	<script>
		$(function () {
			let header_code = ace.edit("header_code");
			header_code.session.setMode("ace/mode/javascript");

			let body_code = ace.edit("body_code");
			body_code.session.setMode("ace/mode/javascript");

			$('#save').on('click',function(e) {

				const form = document.getElementById("frontend-settings");
				let formData = new FormData(form);

				if (header_code) {
					formData.append('header_code', header_code.getValue());
				}
				if (body_code) {
					formData.append('body_code', body_code.getValue());
				}

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: "POST",
					url: $('#frontend-settings').attr('action'),
					data: formData,
					processData: false,
					contentType: false,
					success: function(data) {

						if (data['status'] == 200) {
							toastr.success('{{ __('Settings were successfully saved') }}');
						}

					},
					error: function(data) {
						toastr.error('{{ __('There was an issue with saving the settings') }}');
					}
				}).done(function(data) {})
			});
		});
   </script>
@endsection

