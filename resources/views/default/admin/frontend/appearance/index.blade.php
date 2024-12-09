@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('Logos Manager') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Logos') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body">
				
					<form action="{{ route('admin.settings.appearance.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar mt-3">{{ __('Frontend Logos') }}</h6>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Frontend Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_frontend) }}" alt="Frontend Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_frontend" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_frontend')
												<p class="text-danger">{{ $errors->first('logo_frontend') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Frontend Footer Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_frontend_footer) }}" alt="Frontend Footer Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_frontend_footer" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_frontend_footer')
												<p class="text-danger">{{ $errors->first('logo_frontend_footer') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Frontend Collapsed') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_frontend_collapsed) }}" alt="Frontend Collapsed Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_frontend_collapsed" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_frontend_collapsed')
												<p class="text-danger">{{ $errors->first('logo_frontend_collapsed') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Favicon') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box">
											<img src="{{ URL::asset('uploads/logo/favicon.ico') }}" class="border w-20 mt-3" alt="Favicon Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Favicon') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="32px by 32px ICO Format" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="favicon_logo" style="display: none;">
													</span>
												</label>
											</div>
											@error('favicon_logo')
												<p class="text-danger">{{ $errors->first('favicon_logo') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<h6 class="fs-12 font-weight-bold mb-5 plan-title-bar mt-6">{{ __('Dashboard Logos') }}</h6>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Dashboard Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_dashboard) }}" alt="Dashboard Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_dashboard" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_dashboard')
												<p class="text-danger">{{ $errors->first('logo_dashboard') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Dashboard Dark Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_dashboard_dark) }}" alt="Dashboard Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_dashboard_dark" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_dashboard_dark')
												<p class="text-danger">{{ $errors->first('logo_dashboard_dark') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Dashboard Collapsed') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_dashboard_collapsed) }}" alt="Dashboard Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_dashboard_collapsed" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_dashboard_collapsed')
												<p class="text-danger">{{ $errors->first('logo_dashboard_collapsed') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card shadow-0">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Dashboard Collapsed Dark') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-5">
										<div class="input-box border">
											<img src="{{ URL::asset($settings->logo_dashboard_collapsed_dark) }}" alt="Dashboard Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-7">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="logo_dashboard_collapsed_dark" style="display: none;">
													</span>
												</label>
											</div>
											@error('logo_dashboard_collapsed_dark')
												<p class="text-danger">{{ $errors->first('logo_dashboard_collapsed_dark') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<button type="submit" class="btn btn-primary pl-8 pr-8 ripple">{{ __('Save') }}</button>							
						</div>				

					</form>

				</div>
			</div>
		</div>
	</div>	
@endsection

@section('js')
	<!-- File Uploader -->
	<script src="{{theme_url('js/avatar.js')}}"></script>
@endsection
