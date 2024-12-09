@extends('layouts.app')

@section('css')
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('New Client') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.settings.client') }}"> {{ __('Clients Section') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('New Client') }}</a></li>
			</ol>
		</div>
		
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- FAQ -->
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-8 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Create New Client') }}</h3>								
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('admin.settings.client.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row">							

							<div class="col-sm-12">
								<div class="input-box">
									<h6>{{ __('Client Logo') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="input-group file-browser">									
										<input type="text" class="form-control border-right-0 browse-file" placeholder="{{ __('Image File Name') }}" readonly required>
										<label class="input-group-btn">
											<span class="btn btn-primary special-btn">
												{{ __('Browse') }} <input type="file" name="logo" style="display: none;">
											</span>
										</label>
									</div>
									@error('image')
										<p class="text-danger">{{ $errors->first('image') }}</p>
									@enderror
								</div>
							</div>	
						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<a href="{{ route('admin.settings.client') }}" class="btn btn-cancel mr-2 ripple pl-7 pr-7">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary ripple pl-7 pr-7">{{ __('Create') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	<!-- END -->
@endsection

@section('js')
	<!-- RichText JS -->
	<script src="{{theme_url('js/avatar.js')}}"></script>
@endsection
