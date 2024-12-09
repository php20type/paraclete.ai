@extends('layouts.app')

@section('css')
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('New Use Case') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.settings.case') }}"> {{ __('Use Cases Section') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('New Use Case') }}</a></li>
			</ol>
		</div>
		
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- FAQ -->
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-8 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Create New Use Case') }}</h3>								
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('admin.settings.case.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row">							
							<div class="col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Case Title') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
									</div> 
									@error('title')
										<p class="text-danger">{{ $errors->first('title') }}</p>
									@enderror	
								</div>						
							</div>

							<div class="col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Case Icon') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}">
									</div> 
									@error('icon')
										<p class="text-danger">{{ $errors->first('icon') }}</p>
									@enderror	
								</div>						
							</div>	

							<div class="col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Case Status') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="col-md-12 col-sm-12 mt-2 mb-4 pl-0">
										<div class="form-group">
										  	<label class="custom-switch">
												<input type="checkbox" name="activate" class="custom-switch-input" checked>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">{{ __('Activate Case') }}</span>
										  	</label>
										</div>
									  </div>
								</div>						
							</div>					
						</div>

						<div class="row mt-2">
							<div class="col-lg-12 col-md-12 col-sm-12">	
								<div class="input-box">	
									<h6>{{ __('Case Description') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>							
									<textarea class="form-control" name="description" rows="12" id="richtext" required>{{ old('description') }}</textarea>
									@error('description')
										<p class="text-danger">{{ $errors->first('description') }}</p>
									@enderror	
								</div>											
							</div>
						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<a href="{{ route('admin.settings.faq') }}" class="btn btn-cancel mr-2 ripple pl-7 pr-7">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary ripple pl-7 pr-7">{{ __('Create') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	<!-- END -->
@endsection

