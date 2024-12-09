@extends('layouts.app')

@section('css')
	<link href="{{URL::asset('plugins/tippy/scale-extreme.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/tippy/material.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('SEO Manager') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('SEO Manager') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-8 col-sm-12">
			<div class="card overflow-hidden border-0 p-3">
				<div class="card-body">
				
					<form action="{{ route('admin.settings.seo.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						
						<div class="row">

							<div class="col-sm-12">									
								<div class="card shadow-0 mb-6">							
									<div class="card-body">
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('SEO for Main Landing Page') }}</h6>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Landing Page Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="home_title" value="{{ $metadata->home_title }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Landing Page Author') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="home_author" value="{{ $metadata->home_author }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Landing Page Canonical URL') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="home_url" value="{{ $metadata->home_url }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Landing Page Keywords') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="home_keywords" value="{{ $metadata->home_keywords }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Landing Page Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="home_description" value="{{ $metadata->home_description }}">
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
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('SEO for Login Page') }}</h6>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Login Page Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="login_title" value="{{ $metadata->login_title }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Login Page Author') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="login_author" value="{{ $metadata->login_author }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Login Page Canonical URL') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="login_url" value="{{ $metadata->login_url }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Login Page Keywords') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="login_keywords" value="{{ $metadata->login_keywords }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Login Page Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="login_description" value="{{ $metadata->login_description }}">
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
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('SEO for Registration Page') }}</h6>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Register Page Title') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="register_title" value="{{ $metadata->register_title }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Register Page Author') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="register_author" value="{{ $metadata->register_author }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Register Page Canonical URL') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="register_url" value="{{ $metadata->register_url }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Register Page Keywords') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="register_keywords" value="{{ $metadata->register_keywords }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Register Page Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="register_description" value="{{ $metadata->register_description }}">
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
		
										<h6 class="fs-12 font-weight-bold mb-4 plan-title-bar">{{ __('SEO for Dashboard') }}</h6>
		
										<div class="row">
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Dashboard Author') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="dashboard_author" value="{{ $metadata->dashboard_author }}">
													</div> 
												</div> 
											</div>	
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Dashboard Keywords') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="dashboard_keywords" value="{{ $metadata->dashboard_keywords }}">
													</div> 
												</div> 
											</div>
											<div class="col-md-12 col-sm-12">													
												<div class="input-box">								
													<h6>{{ __('Dashboard Description') }}</h6>
													<div class="form-group">							    
														<input type="text" class="form-control" name="dashboard_description" value="{{ $metadata->dashboard_description }}">
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
							<button type="submit" class="btn btn-primary ripple pl-8 pr-8">{{ __('Save') }}</button>							
						</div>				

					</form>

				</div>
			</div>
		</div>
	</div>	
@endsection


