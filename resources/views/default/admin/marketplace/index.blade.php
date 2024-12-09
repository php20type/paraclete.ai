@extends('layouts.app')

@section('content')
	<div class="row justify-content-center mt-24">
		<div class="col-lg-10 col-md-12 col-sm-12">
			<div class="card border-0 p-5 pt-4">
				<div class="card-body">
					<div class="row ">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="border-0 templates-nav-header">
								<div class="card-body">
									<div class="text-center">
										<h3 class="card-title mb-3 ml-2 fs-20 font-weight-bold">{{ __('Marketplace') }}</h3>										
										<h6 class="mb-5 fs-12 text-muted">{{ __('Select and install your preferred extension with one click') }}</h6>
									</div>
				
									<div class="templates-nav-menu mt-7 mb-6 ml-auto mr-auto" id="marketplace-nav" style="max-width: 600px">
										<div class="template-nav-menu-inner">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												<li class="nav-item ml-auto mr-auto" role="presentation">
													<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">{{ __('All') }}</button>
												</li>	
												<li class="nav-item ml-auto mr-auto category-check" role="presentation">
													<button class="nav-link" id="installed-tab" data-bs-toggle="tab" data-bs-target="#installed" type="button" role="tab" aria-controls="installed" aria-selected="false">{{ __('Installed') }}</button>
												</li>	
												<li class="nav-item ml-auto mr-auto category-check" role="presentation">
													<button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" type="button" role="tab" aria-controls="paid" aria-selected="false">{{ __('Paid') }}</button>
												</li>						
												<li class="nav-item ml-auto mr-auto category-check" role="presentation">
													<button class="nav-link" id="free-tab" data-bs-toggle="tab" data-bs-target="#free" type="button" role="tab" aria-controls="free" aria-selected="false">{{ __('Free') }}</button>
												</li>																												
											</ul>
										</div>
									</div>					
								</div>
							</div>
						</div>
				
						<div class="col-lg-12 col-md-12 col-sm-12">

				
									<div class="tab-content extensions" id="myTabContent">
				
										<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
											<div class="row" id="templates-panel">				
													
												@foreach ($extensions as $extension)
													<div class="col-lg-4 col-md-6 col-sm-12">
														<div class="card shadow-0 theme" id="XXXXX-card" onclick="window.location.href='{{ url('app/admin/marketplace/purchase') }}/{{ $extension['slug'] }}'">																
															<div class="card-body">
																<div class="theme-icon mb-3">
																	<div>{!! $extension['banner'] !!} 
																		@foreach ($details as $detail)
																			@if ($detail->slug == $extension['slug'])
																				@if ($detail->installed)
																					<span class="fs-12" style="vertical-align: middle"><i class="fa-solid fa-circle-check ml-2 mr-1"></i> {{__('Installed')}}</span>
																				@endif
																			@endif
																		@endforeach
																	</div>
																</div>
																<div class="theme-name mb-5">
																	<h6 class="fs-18 mb-0 font-weight-bold">{{ $extension['name'] }} <i class="fa-solid fa-star mr-1 ml-2 fs-11 text-yellow" style="vertical-align: middle"></i><span class="text-muted fs-14" style="font-weight: 400">5.0</span></h6>																	
																</div>
																<div class="theme-info mb-5">
																	<p class="fs-13 mb-2">{{ $extension['short_description'] }}</p>
																</div>	
																<div class="theme-tags">
																	@if ($extension['tags'] != "")
																		@foreach(explode(',', $extension['tags']) as $tag) 
																			<span class="fs-12 text-muted mr-2"><i class="fa-solid fa-period mr-1" style="vertical-align: text-top"></i> {{$tag}}</span>
																		@endforeach
																	@endif
																</div>
															</div>
														</div>						
													</div>	
												@endforeach
												
											</div>	
										</div>	
										
										<div class="tab-pane fade" id="installed" role="tabpanel" aria-labelledby="installed-tab">
											<div class="row" id="templates-panel">
												@foreach ($extensions as $extension)
													@foreach ($details as $detail)
														@if ($detail->slug == $extension['slug'])
															@if ($detail->installed)
																<div class="col-lg-4 col-md-6 col-sm-12">
																	<div class="card shadow-0 theme" id="XXXXX-card" onclick="window.location.href='{{ url('app/admin/marketplace/purchase') }}/{{ $extension['slug'] }}'">																
																		<div class="card-body">
																			<div class="theme-icon mb-3">
																				<div>{!! $extension['banner'] !!} 
																					@foreach ($details as $detail)
																						@if ($detail->slug == $extension['slug'])
																							@if ($detail->installed)
																								<span class="fs-12" style="vertical-align: middle"><i class="fa-solid fa-circle-check ml-2 mr-1"></i> {{__('Installed')}}</span>
																							@endif
																						@endif
																					@endforeach
																				</div>
																			</div>
																			<div class="theme-name mb-5">
																				<h6 class="fs-18 mb-0 font-weight-bold">{{ $extension['name'] }} <i class="fa-solid fa-star mr-1 ml-2 fs-11 text-yellow" style="vertical-align: middle"></i><span class="text-muted fs-14" style="font-weight: 400">5.0</span></h6>																	
																			</div>
																			<div class="theme-info mb-5">
																				<p class="fs-13 mb-2">{{ $extension['short_description'] }}</p>
																			</div>	
																			<div class="theme-tags">
																				@if ($extension['tags'] != "")
																					@foreach(explode(',', $extension['tags']) as $tag) 
																						<span class="fs-12 text-muted mr-2"><i class="fa-solid fa-period mr-1" style="vertical-align: text-top"></i> {{$tag}}</span>
																					@endforeach
																				@endif
																			</div>
																		</div>
																	</div>							
																</div>
															@endif															
														@endif																		
													@endforeach	
												@endforeach
											</div>
										</div>

										<div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
											<div class="row" id="templates-panel">
												@foreach ($extensions as $extension)
													@if ($extension['is_free'])
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="card shadow-0 theme" id="XXXXX-card" onclick="window.location.href='{{ url('app/admin/marketplace/purchase') }}/{{ $extension['slug'] }}'">																
																<div class="card-body">
																	<div class="theme-icon mb-3">
																		<div>{!! $extension['banner'] !!} 
																			@foreach ($details as $detail)
																				@if ($detail->slug == $extension['slug'])
																					@if ($detail->installed)
																						<span class="fs-12" style="vertical-align: middle"><i class="fa-solid fa-circle-check ml-2 mr-1"></i> {{__('Installed')}}</span>
																					@endif
																				@endif
																			@endforeach
																		</div>
																	</div>
																	<div class="theme-name mb-5">
																		<h6 class="fs-18 mb-0 font-weight-bold">{{ $extension['name'] }} <i class="fa-solid fa-star mr-1 ml-2 fs-11 text-yellow" style="vertical-align: middle"></i><span class="text-muted fs-14" style="font-weight: 400">5.0</span></h6>																	
																	</div>
																	<div class="theme-info mb-5">
																		<p class="fs-13 mb-2">{{ $extension['short_description'] }}</p>
																	</div>	
																	<div class="theme-tags">
																		@if ($extension['tags'] != "")
																			@foreach(explode(',', $extension['tags']) as $tag) 
																				<span class="fs-12 text-muted mr-2"><i class="fa-solid fa-period mr-1" style="vertical-align: text-top"></i> {{$tag}}</span>
																			@endforeach
																		@endif
																	</div>
																</div>
															</div>						
														</div>	
													@endif
												@endforeach
											</div>
										</div>

										<div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
											<div class="row" id="templates-panel">
												@foreach ($extensions as $extension)
													@if (!$extension['is_free'])
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="card shadow-0 theme" id="XXXXX-card" onclick="window.location.href='{{ url('app/admin/marketplace/purchase') }}/{{ $extension['slug'] }}'">																
																<div class="card-body">
																	<div class="theme-icon mb-3">
																		<div>{!! $extension['banner'] !!} 
																			@foreach ($details as $detail)
																				@if ($detail->slug == $extension['slug'])
																					@if ($detail->installed)
																						<span class="fs-12" style="vertical-align: middle"><i class="fa-solid fa-circle-check ml-2 mr-1"></i> {{__('Installed')}}</span>
																					@endif
																				@endif
																			@endforeach
																		</div>
																	</div>
																	<div class="theme-name mb-5">
																		<h6 class="fs-18 mb-0 font-weight-bold">{{ $extension['name'] }} <i class="fa-solid fa-star mr-1 ml-2 fs-11 text-yellow" style="vertical-align: middle"></i><span class="text-muted fs-14" style="font-weight: 400">5.0</span></h6>																	
																	</div>
																	<div class="theme-info mb-5">
																		<p class="fs-13 mb-2">{{ $extension['short_description'] }}</p>
																	</div>	
																	<div class="theme-tags">
																		@if ($extension['tags'] != "")
																			@foreach(explode(',', $extension['tags']) as $tag) 
																				<span class="fs-12 text-muted mr-2"><i class="fa-solid fa-period mr-1" style="vertical-align: text-top"></i> {{$tag}}</span>
																			@endforeach
																		@endif
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


