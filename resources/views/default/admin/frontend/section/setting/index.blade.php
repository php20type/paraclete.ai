@extends('layouts.app')

@section('css')
	<link href="{{URL::asset('plugins/tippy/scale-extreme.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/tippy/material.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('Frontend Section Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Section Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-8 col-sm-12">
			<div class="card overflow-hidden border-0 p-3">
				<div class="card-body">
				
					<form action="{{ route('admin.settings.section.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						
						<div class="row">

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Main Banner Section') }}</h6>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Main Banner Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="main_banner_pretitle" value="{{ $frontend_sections->main_banner_pretitle }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Main Banner Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="main_banner_title" value="{{ $frontend_sections->main_banner_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Main Banner Carousel Text') }} <i class="ml-2 fa fa-info info-notification" data-tippy-content="{{ __('Use comma seperated list like: Chatbots,Vision,Voiceovers') }}"></i></h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="main_banner_carousel" value="{{ $frontend_sections->main_banner_carousel }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Main Banner Sub Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="main_banner_subtitle" value="{{ $frontend_sections->main_banner_subtitle }}">
													</div> 
												</div> 
											</div>						
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('How it Works Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="how_it_works" class="custom-switch-input" @if ($frontend_sections->how_it_works_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('How it Works Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="how_it_works_subtitle" value="{{ $frontend_sections->how_it_works_subtitle }}" autocomplete="off">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('How it Works Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="how_it_works_title" value="{{ $frontend_sections->how_it_works_title }}" autocomplete="off">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('How it Works Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="how_it_works_description" value="{{ $frontend_sections->how_it_works_description }}" autocomplete="off">
													</div> 
												</div> 
											</div>	
																
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('AI Tools Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="tools" class="custom-switch-input" @if ($frontend_sections->tools_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('AI Tools Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="tools_subtitle" value="{{ $frontend_sections->tools_subtitle }}" autocomplete="off">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('AI Tools Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="tools_title" value="{{ $frontend_sections->tools_title }}" autocomplete="off">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('AI Tools Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="tools_description" value="{{ $frontend_sections->tools_description }}" autocomplete="off">
													</div> 
												</div> 
											</div>						
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Templates Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="templates" class="custom-switch-input" @if ($frontend_sections->templates_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Templates Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="templates_subtitle" value="{{ $frontend_sections->templates_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Templates Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="templates_title" value="{{ $frontend_sections->templates_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Templates Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="templates_description" value="{{ $frontend_sections->templates_description }}">
													</div> 
												</div> 
											</div>				
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Features Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="features" class="custom-switch-input" @if ($frontend_sections->features_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Features Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="features_subtitle" value="{{ $frontend_sections->features_subtitle }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Features Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="features_title" value="{{ $frontend_sections->features_title }}">
													</div> 
												</div> 
											</div>												
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Features Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="features_description" value="{{ $frontend_sections->features_description }}">
													</div> 
												</div> 
											</div>					
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Pricing Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="pricing" class="custom-switch-input" @if ($frontend_sections->pricing_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Pricing Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="pricing_subtitle" value="{{ $frontend_sections->pricing_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Pricing Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="pricing_title" value="{{ $frontend_sections->pricing_title }}">
													</div> 
												</div> 
											</div>		
													
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Pricing Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="pricing_description" value="{{ $frontend_sections->pricing_description }}">
													</div> 
												</div> 
											</div>			
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Reviews Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="reviews" class="custom-switch-input" @if ($frontend_sections->reviews_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Reviews Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="reviews_subtitle" value="{{ $frontend_sections->reviews_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Reviews Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="reviews_title" value="{{ $frontend_sections->reviews_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Reviews Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="reviews_description" value="{{ $frontend_sections->reviews_description }}">
													</div> 
												</div> 
											</div>				
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('FAQs Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="faq" class="custom-switch-input" @if ($frontend_sections->faq_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('FAQs Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="faq_subtitle" value="{{ $frontend_sections->faq_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('FAQs Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="faq_title" value="{{ $frontend_sections->faq_title }}">
													</div> 
												</div> 
											</div>														
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('FAQs Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="faq_description" value="{{ $frontend_sections->faq_description }}">
													</div> 
												</div> 
											</div>					
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Blogs Section') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="blog" class="custom-switch-input" @if ($frontend_sections->blogs_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Blogs Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="blog_subtitle" value="{{ $frontend_sections->blogs_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Blogs Main Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="blog_title" value="{{ $frontend_sections->blogs_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Blogs Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="blog_description" value="{{ $frontend_sections->blogs_description }}">
													</div> 
												</div> 
											</div>			
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Info Banner') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="info" class="custom-switch-input" @if ($frontend_sections->info_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Info Banner Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="info_title" value="{{ $frontend_sections->info_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Info Banner Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="info_description" value="{{ $frontend_sections->info_description }}">
													</div> 
												</div> 
											</div>					
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Images Banner') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="images" class="custom-switch-input" @if ($frontend_sections->images_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Images Banner Pre Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="images_subtitle" value="{{ $frontend_sections->images_subtitle }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Images Banner Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="images_title" value="{{ $frontend_sections->images_title }}">
													</div> 
												</div> 
											</div>		
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Images Banner Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="images_description" value="{{ $frontend_sections->images_description }}">
													</div> 
												</div> 
											</div>				
										</div>	
									</div>
								</div>
							</div>

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Clients Banner') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="clients" class="custom-switch-input" @if ($frontend_sections->clients_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Main Light Text') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="clients_title" value="{{ $frontend_sections->clients_title }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Secondary Dark Text') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="clients_title_dark" value="{{ $frontend_sections->clients_title_dark }}">
													</div> 
												</div> 
											</div>						
										</div>	
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('Contact Us Page') }}</h6>
		
										<div class="form-group">
											<label class="custom-switch mb-4">
												<input type="checkbox" name="contact" class="custom-switch-input" @if ($frontend_sections->contact_status) checked @endif>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Enable') }}</span>
											</label>
										</div>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Office Location Address') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="contact_location" value="{{ $frontend_sections->contact_location }}">
													</div> 
												</div> 
											</div>							
										</div>	
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Email Address') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="contact_email" value="{{ $frontend_sections->contact_email }}">
													</div> 
												</div> 
											</div>							
										</div>
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box mb-3">								
													<h6>{{ __('Phone Address') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="contact_phone" value="{{ $frontend_sections->contact_phone }}">
													</div> 
												</div> 
											</div>							
										</div>
									</div>
								</div>
							</div>

						</div>

						
						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<button type="submit" class="btn btn-primary ripple pl-7 pr-7">{{ __('Save') }}</button>							
						</div>				

					</form>

				</div>
			</div>
		</div>
	</div>	
@endsection


