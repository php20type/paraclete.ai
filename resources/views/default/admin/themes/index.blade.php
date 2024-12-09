@extends('layouts.app')

@section('content')
	<div class="row justify-content-center mt-24">
		<div class="col-sm-12">
			<div class="card border-0 p-5 pt-4">
				<div class="card-body">
					<div class="row ">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="border-0 templates-nav-header">
								<div class="card-body">
									<div class="text-center">
										<h3 class="card-title mb-3 ml-2 fs-20 font-weight-bold">{{ __('Available Themes') }}</h3>										
										<h6 class="mb-5 fs-12 text-muted">{{ __('Get your dashboard UI to the next levels') }}</h6>
									</div>
				
									<div class="templates-nav-menu mt-7 mb-6 ml-auto mr-auto" style="max-width: 500px">
										<div class="template-nav-menu-inner">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												<li class="nav-item ml-auto mr-auto" role="presentation">
													<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">{{ __('All') }}</button>
												</li>							
												<li class="nav-item ml-auto mr-auto category-check" role="presentation">
													<button class="nav-link" id="frontend-tab" data-bs-toggle="tab" data-bs-target="#frontend" type="button" role="tab" aria-controls="frontend" aria-selected="false">{{ __('Frontend') }}</button>
												</li>	
												<li class="nav-item ml-auto mr-auto category-check" role="presentation">
													<button class="nav-link" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">{{ __('Dashboard') }}</button>
												</li>																
											</ul>
										</div>
									</div>					
								</div>
							</div>
						</div>
				
						<div class="col-lg-12 col-md-12 col-sm-12">
				
							<div class="tab-content" id="myTabContent">
		
								<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
									<div class="row" id="templates-panel">				
											
										@foreach ($themes as $theme)
											<div class="col-lg-4 col-md-6 col-sm-12">
												<div class="card shadow-0 theme" id="XXXXX-card">
													<div class="theme-banner">
														<figure>
															<img src="{{ $theme['banner'] }}" alt="">
															<figcaption>
																<a href="{{ $theme['demo_url'] }}" class="fs-14 text-white font-weight-bold" target="_blank">{{ __('Live Preview') }}</a>							
															</figcaption>
														</figure>
													</div>
														
													<div class="card-body pt-5">
														<div class="theme-group">
															@if ($theme['slug'] != 'default')
																<h6 class="mb-4 fs-13 text-muted"><i class="fa-solid fa-objects-column mr-1 text-primary"></i> {{ __('Premium') }} {{ ucfirst($theme['type']) }} {{ __('Theme') }}</h6>
															@else
																<h6 class="mb-4 fs-13 text-muted"><i class="fa-solid fa-objects-column mr-1 text-primary"></i> {{ __('Free Theme') }}</h6>
															@endif																	
														</div>
														<div class="theme-name">
															<h6 class="mb-4 fs-15 super-strong">{{ $theme['name'] }}  {{ __('Theme') }} <span class="text-muted ml-2 fs-12">v{{ $theme['version'] }}</span></h6>
														</div>
														<div class="theme-info">
															<p class="fs-13 text-muted mb-2">{{ $theme['short_description'] }}</p>
														</div>	
														<div class="theme-action text-center mt-4 mb-4">	
															@foreach ($extensions as $extension)
																@if ($extension->slug == $theme['slug'])
																	@if ($extension->purchased && !$extension->installed)
																		<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Install Theme') }}</a>	
																	@else
																		@if (($extension->slug != 'default') && ($extension->slug == $settings->dashboard_theme || $extension->slug == $settings->frontend_theme))
																			@if ((float)$extension->version < (float)$theme['version'])
																				<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																			@else
																				<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>
																			@endif																						
																		@else
																			@if ($extension->purchased && ($theme['slug'] != 'default'))
																				@if ((float)$extension->version < (float)$theme['version'])
																					<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																				@else
																					<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																				@endif
																			@else 
																				@if ($theme['slug'] == 'default')
																					@if ($settings->dashboard_theme == 'default' && $settings->frontend_theme == 'default')
																						<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>	
																					@else
																						@if ((float)$extension->version < (float)$theme['version'])
																							<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																						@else
																							<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																						@endif
																					@endif
																				@else
																					<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Buy Now') }}</a>	
																				@endif																				
																			@endif
																		@endif
																	@endif
																	
																@endif																		
															@endforeach																
															
														</div>	
													</div>
												</div>						
											</div>	
										@endforeach
										
									</div>	
								</div>				

								<div class="tab-pane fade" id="frontend" role="tabpanel" aria-labelledby="frontend-tab">
									<div class="row" id="templates-panel">
										@foreach ($themes as $theme)
											@if ($theme['type'] == 'frontend' || $theme['type'] == 'both')
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="card shadow-0 theme" id="XXXXX-card">
														<div class="theme-banner">
															<figure>
																<img src="{{ $theme['banner'] }}" alt="">
																<figcaption>
																	<a href="{{ $theme['demo_url'] }}" class="fs-14 text-white font-weight-bold" target="_blank">{{ __('Live Preview') }}</a>							
																</figcaption>
															</figure>
														</div>
															
														<div class="card-body pt-5">
															<div class="theme-group">
																@if ($theme['slug'] != 'default')
																	<h6 class="mb-4 fs-13 text-muted"><i class="fa-solid fa-objects-column mr-1 text-primary"></i> {{ __('Premium') }} {{ ucfirst($theme['type']) }} {{ __('Theme') }}</h6>
																@else
																	<h6 class="mb-4 fs-13 text-muted"><i class="fa-solid fa-objects-column mr-1 text-primary"></i> {{ __('Free Theme') }}</h6>
																@endif
															</div>
															<div class="theme-name">
																<h6 class="mb-4 fs-15 number-font">{{ $theme['name'] }}  {{ __('Theme') }} <span class="text-muted ml-2 fs-12">v{{ $theme['version'] }}</span></h6>
															</div>
															<div class="theme-info">
																<p class="fs-13 text-muted mb-2">{{ $theme['short_description'] }}</p>
															</div>	
															<div class="theme-action text-center mt-4 mb-4">
																@foreach ($extensions as $extension)
																	@if ($extension->slug == $theme['slug'])
																		@if ($extension->purchased && !$extension->installed)
																			<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Install Theme') }}</a>	
																		@else
																			@if (($extension->slug != 'default') && ($extension->slug == $settings->dashboard_theme || $extension->slug == $settings->frontend_theme))
																				@if ((float)$extension->version < (float)$theme['version'])
																					<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																				@else
																					<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>
																				@endif																						
																			@else
																				@if ($extension->purchased && ($theme['slug'] != 'default'))
																					@if ((float)$extension->version < (float)$theme['version'])
																						<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																					@else
																						<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																					@endif
																				@else 
																					@if ($theme['slug'] == 'default')
																						@if ($settings->dashboard_theme == 'default' && $settings->frontend_theme == 'default')
																							<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>	
																						@else
																							@if ((float)$extension->version < (float)$theme['version'])
																								<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																							@else
																								<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																							@endif
																						@endif
																					@else
																						<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Buy Now') }}</a>	
																					@endif																				
																				@endif
																			@endif
																		@endif
																		
																	@endif																		
																@endforeach	
															</div>	
														</div>
													</div>						
												</div>	
											@endif													
										@endforeach
									</div>
								</div>

								<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
									<div class="row" id="templates-panel">
										@foreach ($themes as $theme)
											@if ($theme['type'] == 'dashboard' || $theme['type'] == 'both')
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="card shadow-0 theme" id="XXXXX-card">
														<div class="theme-banner">
															<figure>
																<img src="{{ $theme['banner'] }}" alt="">
																<figcaption>
																	<a href="{{ $theme['demo_url'] }}" class="fs-14 text-white font-weight-bold" target="_blank">{{ __('Live Preview') }}</a>							
																</figcaption>
															</figure>
														</div>
															
														<div class="card-body pt-5">
															<div class="theme-group">
																<h6 class="mb-4 fs-13 text-muted"><i class="fa-solid fa-objects-column mr-1 text-primary"></i> {{ __('Premium') }} {{ ucfirst($theme['type']) }} {{ __('Theme') }}</h6>
															</div>
															<div class="theme-name">
																<h6 class="mb-4 fs-15 number-font">{{ $theme['name'] }}  {{ __('Theme') }} <span class="text-muted ml-2 fs-12">v{{ $theme['version'] }}</span></h6>
															</div>
															<div class="theme-info">
																<p class="fs-13 text-muted mb-2">{{ $theme['short_description'] }}</p>
															</div>	
															<div class="theme-action text-center mt-4 mb-4">
																@foreach ($extensions as $extension)
																	@if ($extension->slug == $theme['slug'])
																		@if ($extension->purchased && !$extension->installed)
																			<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Install Theme') }}</a>	
																		@else
																			@if (($extension->slug != 'default') && ($extension->slug == $settings->dashboard_theme || $extension->slug == $settings->frontend_theme))
																				@if ((float)$extension->version < (float)$theme['version'])
																					<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																				@else
																					<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>
																				@endif																						
																			@else
																				@if ($extension->purchased && ($theme['slug'] != 'default'))
																					@if ((float)$extension->version < (float)$theme['version'])
																						<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																					@else
																						<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																					@endif
																				@else 
																					@if ($theme['slug'] == 'default')
																						@if ($settings->dashboard_theme == 'default' && $settings->frontend_theme == 'default')
																							<a href="#" class="btn btn-primary ripple disabled" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activated') }}</a>	
																						@else
																							@if ((float)$extension->version < (float)$theme['version'])
																								<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Update Theme') }}</a>	
																							@else
																								<a href="{{ route('admin.theme.activate', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Activate Theme') }}</a>	
																							@endif
																						@endif
																					@else
																						<a href="{{ route('admin.theme.purchase', $theme['slug']) }}" class="btn btn-primary ripple" style="width: 250px; text-transform: none; font-size: 12px; padding-top: 1rem; padding-bottom: 1rem;">{{ __('Buy Now') }}</a>	
																					@endif																				
																				@endif
																			@endif
																		@endif
																		
																	@endif																		
																@endforeach	
															</div>	
														</div>
													</div>						
												</div>	
											@endif													
										@endforeach 
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




