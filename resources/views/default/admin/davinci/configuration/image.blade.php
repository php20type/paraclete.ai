@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('AI Image Model Credits') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-microchip-ai mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.davinci.dashboard') }}"> {{ __('AI Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.davinci.configs') }}"> {{ __('AI Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('AI Image Model Credits') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Set AI Image Model Credits') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('admin.davinci.configs.image.credits.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<h6 class="text-muted text-center">{{ __('OpenAI') }}</h6>

						<div class="row pl-5 pr-5">							
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('OpenAI Dalle 3 HD') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="openai_dalle_3_hd" value="{{ $credits->openai_dalle_3_hd }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('OpenAI Dalle 3') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="openai_dalle_3" value="{{ $credits->openai_dalle_3 }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('OpenAI Dalle 2') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="openai_dalle_2" value="{{ $credits->openai_dalle_2 }}">
									</div> 	
								</div> 						
							</div>
						</div>

						<h6 class="text-muted text-center">{{ __('Stable Diffusion') }}</h6>

						<div class="row pl-5 pr-5">							

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion Ultra') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_ultra" value="{{ $credits->sd_ultra }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion Core') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_core" value="{{ $credits->sd_core }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion 3 Large') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_3_large" value="{{ $credits->sd_3_large }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion 3 Large Turbo') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_3_large_turbo" value="{{ $credits->sd_3_large_turbo }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion 3 Medium') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_3_medium" value="{{ $credits->sd_3_medium }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('SDXL v1.0') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_xl_v10" value="{{ $credits->sd_xl_v10 }}">
									</div> 	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion v1.6') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" min=1 class="form-control" name="sd_v16" value="{{ $credits->sd_v16 }}">
									</div> 	
								</div> 						
							</div>
						</div>

						@if (App\Services\HelperService::extensionFlux())
							<h6 class="text-muted text-center">{{ __('Fal AI') }}</h6>

							<div class="row pl-5 pr-5">							

								<div class="col-lg-12 col-md-12 col-sm-12">							
									<div class="input-box">								
										<h6>{{ __('FLUX Realism') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										<div class="form-group">							    
											<input type="number" min=1 class="form-control" name="flux_realism" value="{{ $credits->flux_realism }}">
										</div> 	
									</div> 						
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">							
									<div class="input-box">								
										<h6>{{ __('FLUX.1 [pro]') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										<div class="form-group">							    
											<input type="number" min=1 class="form-control" name="flux_pro" value="{{ $credits->flux_pro }}">
										</div> 	
									</div> 						
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">							
									<div class="input-box">								
										<h6>{{ __('FLUX.1 [schnell]') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										<div class="form-group">							    
											<input type="number" min=1 class="form-control" name="flux_schnell" value="{{ $credits->flux_schnell }}">
										</div> 	
									</div> 						
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">							
									<div class="input-box">								
										<h6>{{ __('FLUX.1 [dev]') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										<div class="form-group">							    
											<input type="number" min=1 class="form-control" name="flux_dev" value="{{ $credits->flux_dev }}">
										</div> 	
									</div> 						
								</div>
								
							</div>
						@endif

						<!-- ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<button type="submit" class="btn ripple btn-primary pl-9 pr-9 pt-3 pb-3">{{ __('Save') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
@endsection

