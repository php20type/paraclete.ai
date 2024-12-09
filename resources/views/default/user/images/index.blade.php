@extends('layouts.app')
@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

<form id="openai-form" action="" method="post" enctype="multipart/form-data" class="mt-24">		
	@csrf
	<div class="row" id="image-side-space">
		<div class="row no-gutters justify-content-center">
			<div class="col-lg-9 col-md-11 col-sm-12 text-center">
				<h3 class="card-title mt-6 fs-20"><i class="fa-solid fa-wand-magic-sparkles mr-2 text-primary"></i></i>{{ __('AI Image Generator') }}</h3>
				<h6 class="text-muted mb-7">{{ __('Unleash your creativity with our AI image generator that produces stunning visuals in seconds') }}</h6>
				<div class="card-top d-flex text-right justify-content-right right mx-auto">
					<div class="mr-4">
						<p class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} 
							<span class="font-weight-semibold">
								@if (auth()->user()->image_credits == -1) 
									<span id="balance-number">{{ __('Unlimited') }}</span>
								@else 
									<span id="balance-number">{{ number_format(auth()->user()->image_credits + auth()->user()->image_credits_prepaid) }} </span> {{ __(' Image Credits') }}
								@endif
							</span>
						</p>
					</div>
					<div>
						<a href="#" id="main-settings-toggle"><i class="fa-sharp fa-solid fa-sliders text-muted"></i></a>
					</div>
				</div>

				<div class="card mb-4 border-0 image-prompt-wrapper">
					<div class="card-body p-0">					
						<div class="image-prompt d-flex">
							<div class="input-box mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" id="prompt" name="prompt" placeholder="{{ __('Describe what you want to see with phrases, and seperate them with commas...') }}" required>
								</div> 
							</div> 
							<div>
								<button type="submit" name="submit" class="btn btn-primary w-100 pt-2 pb-2" id="image-generate"><i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __('Generate') }}</button>
							</div>
						</div>					
					</div>
				</div>

				<div id="negative-prompt" class="card mb-4 border-0 image-prompt-wrapper sd-feature hide-all">
					<div class="card-body p-0">					
						<div class="image-prompt d-flex">
							<div class="input-box negative mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" name="negative_prompt" id="negative-prompt-input" placeholder="{{ __('Provide negative prompt to tell what you do not want to see in the generated image...') }}">
								</div> 
							</div> 
						</div>					
					</div>
				</div>

				<div id="sd-multi-prompting" class="sd-feature hide-all">
					<div class="mb-4 multi-prompts">				
						<div class="multi-prompt-input d-flex align-items-center">
							<div class="input-box w-100 mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" name="multi_prompt[]" placeholder="{{ __('Describe what you want to see with phrases, and seperate them with commas...') }}">
								</div> 
							</div> 
							<a href="#" class="ml-4 mr-4 delete-prompt-input" data-toggle="remove-input" data-parent=".multi-prompt-input"><i class="fa-solid fa-trash"></i></a>
						</div>				
					</div>
					<div class="text-left mb-2">
						<a href="#" class="btn btn-primary pl-5 pr-5" data-toggle="add-more" data-target=".multi-prompts">{{ __('Add More') }}</a>
					</div>
				</div>

				<div id="sd-image-to-image" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_to_image" id="sd_image_to_image" accept="image/png" onchange="loadFile(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Drop your image here or browse') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image"/>
						</div>
					</div>
				</div>

				<div id="sd-image-upscale" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_upscale" id="sd_image_upscale" accept="image/png" onchange="loadFileScale(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Select your image that you want to upscale') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image-scale"/>
						</div>
					</div>
				</div>

				<div id="sd-image-masking" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_masking" id="sd_image_masking" accept="image/png" onchange="loadFileMask(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Upload your image with transparent target area for inpainting') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image-mask"/>
						</div>
					</div>
				</div>

				<div class="card-bottom p-0">
					<a class="prompts text-muted fs-11 font-weight-semibold" href="#" data-bs-toggle="modal" data-bs-target="#promptModal" data-tippy-content="{{ __('Prompt Library') }}">{{ __('Prompts') }}</a>
				</div>

				<div class="card-bottom p-0 mr-5 sd-feature hide-all">
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" name="enable-negative-prompt" id="negative-prompt-checkbox" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description text-muted">{{ __('Negative Prompt') }}</span>
						</label>
					</div>
				</div>
				<div class="card-bottom p-0 mr-5 sd-feature hide-all">
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" name="sd-enable-multi-prompting" id="sd-multi-prompting-checkbox" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description text-muted">{{ __('Multi Prompting') }}</span>
						</label>
					</div>
				</div>
				<div class="card-bottom p-0 mr-5 sd-feature hide-all">
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" name="sd-enable-image-masking" id="sd-image-masking-checkbox" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description text-muted">{{ __('Image Inpainting') }}</span>
						</label>
					</div>
				</div>
				<div class="card-bottom p-0 mr-5 sd-feature hide-all">
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" name="sd-enable-image-upscale" id="sd-image-upscale-checkbox" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description text-muted">{{ __('Image Upscale') }}</span>
						</label>
					</div>
				</div>
				<div class="card-bottom p-0 mr-5 sd-feature hide-all">
					<div class="form-group">
						<label class="custom-switch">
							<input type="checkbox" name="sd-enable-image-to-image" id="sd-image-to-image-checkbox" class="custom-switch-input">
							<span class="custom-switch-indicator"></span>
							<span class="custom-switch-description text-muted">{{ __('Image to Image') }}</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row mt-8 no-gutters" id="image-containers-wrapper">
			@foreach ($data as $image)
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 image-container">				
					<div class="grid-item">
						<div class="grid-image-wrapper">
							<div class="flex grid-buttons text-center">
								<a href="{{ url($image->image) }}" class="grid-image-view text-center" download><i class="fa-sharp fa-solid fa-arrow-down-to-line" title="{{ __('Download Image') }}"></i></a>
								<a href="#" class="grid-image-view text-center viewImageResult" id="{{ $image->id }}"><i class="fa-sharp fa-solid fa-camera-viewfinder" title="{{ __('View Image') }}"></i></a>
								<a href="#" class="grid-image-view text-center deleteResultButton" id="{{ $image->id }}"><i class="fa-solid fa-trash-xmark" title="{{ __('Delete Image') }}"></i></a>							
							</div>
							<div>
								<span class="grid-image">
									<img class="loaded" src="@if($image->storage == 'local') {{ URL::asset($image->image) }} @else {{ $image->image }} @endif" alt="" >
								</span>
							</div>
							<div class="grid-description">
								<span class="fs-9 text-primary">
									@if ($image->vendor == 'sd') {{ __('Stable Diffusion') }} 
									@elseif ($image->vendor == 'openai') {{ __('Dalle') }} 
									@elseif ($image->vendor == 'falai') {{ __('FLUX') }} 
									@endif
								</span>
								<p class="fs-10 mb-0">{{ substr($image->description, 0, 63) }}...</p>
							</div>
						</div>
					</div>
				</div>
			@endforeach

			<input type="hidden" id="start" name="start" value="12">
			<input type="hidden" id="rowperpage" value="6">
			<input type="hidden" id="totalrecords" value="{{ $records }}">
			
			
		</div>
	</div>

	<aside id="image-settings-wrapper">
		<div class="image-settings p-4">
			<a href="#" id="main-settings-toggle-minimized"><i class="fa-sharp fa-solid fa-sliders text-muted"></i></a>
			<div class="image-vendor mb-3 mt-2">
				<div class="middle">
					<div class="photo-studio-tools mb-5">
						<div class="nav-item dropdown w-100">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
								<h6 class="dropdown-item-title fs-13 font-weight-semibold" id="active-template-name">{{ $model_name }}</h6>	
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">		
								@foreach ($vendors as $vendor)
									@if (trim($vendor) == 'openai')
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="dall-e-3-hd" name="{{ __('OpenAI DALLE 3 HD') }}" icon="<i class='fa-solid fa-aperture'></i>">
											<h6 class="dropdown-item-title fs-12">{{ __('OpenAI DALLE 3 HD') }} <span class="fs-9 text-muted">({{ $credits->openai_dalle_3_hd }} @if ($credits->openai_dalle_3_hd == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>	
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="dall-e-3" name="{{ __('OpenAI DALLE 3') }}" icon="<i class='fa-sharp fa-solid fa-palette'></i>">
											<h6 class="dropdown-item-title fs-12">{{ __('OpenAI DALLE 3') }} <span class="fs-9 text-muted">({{ $credits->openai_dalle_3 }} @if ($credits->openai_dalle_3 == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="dall-e-2" name="{{ __('OpenAI DALLE 2') }}" icon="<i class='fa-solid fa-droplet'></i>">
											<h6 class="dropdown-item-title fs-12">{{ __('OpenAI DALLE 2') }} <span class="fs-9 text-muted">({{ $credits->openai_dalle_2 }} @if ($credits->openai_dalle_2 == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
									@endif
								@endforeach								
								@foreach ($vendors as $vendor)
									@if (trim($vendor) == 'sd')
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="ultra" name="{{ __('Stable Diffusion Ultra') }}" icon="<i class='fa-solid fa-hexagon-image'></i>">									
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion Ultra') }} <span class="fs-9 text-muted">({{ $credits->sd_ultra }} @if ($credits->sd_ultra == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="core" name="{{ __('Stable Diffusion Core') }}" icon="<i class='fa-solid fa-images'></i>">		
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion Core') }} <span class="fs-9 text-muted">({{ $credits->sd_core }} @if ($credits->sd_core == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="sd3-large" name="{{ __('Stable Diffusion 3 Large') }}" icon="<i class='fa-solid fa-eye'></i>">
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion 3 Large') }} <span class="fs-9 text-muted">({{ $credits->sd_3_large }} @if ($credits->sd_3_large == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="sd3-large-turbo" name="{{ __('Stable Diffusion 3 Large Turbo') }}" icon="<i class='fa-solid fa-image-slash'></i>">							
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion 3 Large Turbo') }} <span class="fs-9 text-muted">({{ $credits->sd_3_large_turbo }} @if ($credits->sd_3_large_turbo == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="sd3-medium" name="{{ __('Stable Diffusion 3 Medium') }}" icon="<i class='fa-solid fa-pen-clip'></i>">				
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion 3 Medium') }} <span class="fs-9 text-muted">({{ $credits->sd_3_medium }} @if ($credits->sd_3_medium == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="stable-diffusion-xl-1024-v1-0" name="{{ __('SDXL v1.0') }}" icon="<i class='fa-solid fa-camera-viewfinder'></i>">
											<h6 class="dropdown-item-title fs-12">{{ __('SDXL v1.0') }} <span class="fs-9 text-muted">({{ $credits->sd_xl_v10 }} @if ($credits->sd_xl_v10 == 1) {{ __('credit') }} @else{{ __('credits') }}@endif)</span></h6>										
										</a>
										<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="stable-diffusion-v1-6" name="{{ __('Stable Diffusion v1.6') }}" icon="<i class='fa-sharp fa-solid fa-high-definition'></i>">						
											<h6 class="dropdown-item-title fs-12">{{ __('Stable Diffusion v1.6') }} <span class="fs-9 text-muted">({{ $credits->sd_v16 }} @if ($credits->sd_v16 == 1) {{ __('credit') }} @else{{ __('credits') }}@endif)</span></h6>										
										</a>	
									@endif
								@endforeach	
								@if (App\Services\HelperService::extensionFlux())
									@foreach ($vendors as $vendor)
										@if (trim($vendor) == 'falai')																				
											<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="flux-realism" name="{{ __('FLUX Realism') }}" icon="<i class='fa-sharp fa-solid fa-high-definition'></i>">						
												<h6 class="dropdown-item-title fs-12">{{ __('FLUX Realism') }} <span class="fs-9 text-muted">({{ $credits->flux_realism }} @if ($credits->flux_realism == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
											</a>
											<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="flux-pro/new" name="{{ __('FLUX.1 [pro]') }}" icon="<i class='fa-solid fa-wand-magic-sparkles'></i>">	
												<h6 class="dropdown-item-title fs-12">{{ __('FLUX.1 [pro]') }} <span class="fs-9 text-muted">({{ $credits->flux_pro }} @if ($credits->flux_pro == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
											</a>
											<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="flux/schnell" name="{{ __('FLUX.1 [schnell]') }}" icon="<i class='fa-solid fa-wand-magic-sparkles'></i>">	
												<h6 class="dropdown-item-title fs-12">{{ __('FLUX.1 [schnell]') }} <span class="fs-9 text-muted">({{ $credits->flux_schnell }} @if ($credits->flux_schnell == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
											</a>
											<a class="dropdown-item pt-4 pb-4 d-flex" href="#"  id="flux/dev" name="{{ __('FLUX.1 [dev]') }}" icon="<i class='fa-solid fa-wand-magic-sparkles'></i>">	
												<h6 class="dropdown-item-title fs-12">{{ __('FLUX.1 [dev]') }} <span class="fs-9 text-muted">({{ $credits->flux_dev }} @if ($credits->flux_dev == 1) {{ __('credit') }}@else{{ __('credits') }}@endif)</span></h6>										
											</a>										
										@endif
									@endforeach
								@endif
							</div>
						</div>
					</div>					
				</div>				
			</div>

			<div id="form-group" class="image-numbers text-center mb-5">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Number of Images') }}</h6>
				<div class="quantity mx-auto">
					<a href="#" class="decrease"></a>
					<input type="number" name="max_results" value="1" max="10" min="1">
					<a href="#" class="increase"></a>
				</div>
			</div>

			<div id="form-group" class="mb-5">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Resolution') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('The image resolution of the generated images') }}"></i></h6>
				<select id="resolution" name="resolution" class="form-select">
				</select>	
			</div>

			<div id="form-group" class="mb-4">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Style') }}</h6>

				<button class="btn form-control style-button-img-placeholder" type="button" id="style-button">
					<img src="{{ theme_url('img/frontend/thumbs/none.jpg') }}" class="style-button-img" id="style-button-img" alt=""><span>{{ __('None') }}</span>
					<i class="fa-solid fa-angle-right"></i>
				</button>

				<select id="style" name="style" class="form-select openai-select-feature style-initial-state hide-all">					
					<option value='none' selected>{{ __('None') }}</option>																																																												
					<option value='abstract'>{{ __('Abstract') }}</option>																																																												
					<option value='realistic'>{{ __('Realistic') }}</option>																																																												
					<option value='3d render'>{{ __('3D Render') }}</option>																																																												
					<option value='cartoon'>{{ __('Cartoon') }}</option>																																																												
					<option value='anime'>{{ __('Anime') }}</option>																																																												
					<option value='digital art'>{{ __('Digital Art') }}</option>
					<option value='modern'>{{ __('Modern') }}</option>																																																												
					<option value='art deco'>{{ __('Art Deco') }}</option>																																																												
					<option value='illustration'>{{ __('Illustration') }}</option>																																																												
					<option value='origami'>{{ __('Origami') }}</option>																																																												
					<option value='pixel art'>{{ __('Pixel Art') }}</option>																																																												
					<option value='retro'>{{ __('Retro') }}</option>																																																												
					<option value='photography'>{{ __('Photography') }}</option>																																																												
					<option value='line art'>{{ __('Line Art') }}</option>																																																												
					<option value='pop art'>{{ __('Pop Art') }}</option>																																																																																																																						
					<option value='vaporwave'>{{ __('Vaporwave') }}</option>																																																												
					<option value='pencil drawing'>{{ __('Pencil Drawing') }}</option>																																																												
					<option value='renaissance'>{{ __('Renaissance') }}</option>																																																												
					<option value='minimalism'>{{ __('Minimalism') }}</option>																																																																																																																							
					<option value='sticker'>{{ __('Sticker') }}</option>																																																																																																																							
					<option value='isometric'>{{ __('Isometric') }}</option>																																																																																																																							
					<option value='cyberpunk'>{{ __('Cyberpunk') }}</option>																																																																																																																							
					<option value='ballpoint pen drawing'>{{ __('Ballpoint Pen Drawing') }}</option>																																																																																																																																																																																																																																													
					<option value='steampunk'>{{ __('Steampunk') }}</option>																																																																																																																																																																																																																																													
					<option value='glitchcore'>{{ __('Glitchcore') }}</option>																																																																																																																																																																																																																																													
					<option value='bauhaus'>{{ __('Bauhaus') }}</option>																																																																																																																																																																																																																																													
					<option value='vector'>{{ __('Vector') }}</option>																																																																																																																																																																																																																																													
					<option value='low poly'>{{ __('Low Poly') }}</option>																																																																																																																																																																																																																																													
					<option value='ukiyo-e'>{{ __('Ukiyo-e') }}</option>																																																																																																																																																																																																																																													
					<option value='cubism'>{{ __('Cubism') }}</option>																																																																																																																																																																																																																																													
					<option value='contemporary'>{{ __('Contemporary') }}</option>																																																																																																																																																																																																																																													
					<option value='impressionism'>{{ __('Impressionism') }}</option>																																																																																																																																																																																																																																													
					<option value='pointillism'>{{ __('Pointillism') }}</option>																																																																																																																																																																																																																																																
				</select>
			
				<select id="style" name="style" class="form-select sd-select-feature hide-all">					
					<option value='none' selected>{{ __('None') }}</option>																																																																																																																							
					<option value='3d-model'>{{ __('3D Model') }}</option>																																																																																																																							
					<option value='analog-film'>{{ __('Analog Film') }}</option>																																																																																																																							
					<option value='anime'>{{ __('Anime') }}</option>																																																																																																																							
					<option value='cinematic'>{{ __('Cinematic') }}</option>																																																																																																																																																																																																																																													
					<option value='comic-book'>{{ __('Comic Book') }}</option>																																																																																																																																																																																																																																													
					<option value='digital-art'>{{ __('Digital Art') }}</option>																																																																																																																																																																																																																																													
					<option value='enhance'>{{ __('Enhance') }}</option>																																																																																																																																																																																																																																													
					<option value='fantasy-art'>{{ __('Fantasy Art') }}</option>																																																																																																																																																																																																																																													
					<option value='isometric'>{{ __('Isometric') }}</option>																																																																																																																																																																																																																																													
					<option value='line-art'>{{ __('Line Art') }}</option>																																																																																																																																																																																																																																													
					<option value='low-poly'>{{ __('Low Poly') }}</option>																																																																																																																																																																																																																																													
					<option value='modeling-compound'>{{ __('Modeling Compound') }}</option>																																																																																																																																																																																																																																													
					<option value='neon-punk'>{{ __('Neon Punk') }}</option>																																																																																																																																																																																																																																													
					<option value='origami'>{{ __('Origami') }}</option>	
					<option value='photographic'>{{ __('Photographic') }}</option>	
					<option value='pixel-art'>{{ __('Pixel Art') }}</option>	
					<option value='tile-texture'>{{ __('Tile Texture') }}</option>																																																																																																																																																																																																																																																	
				</select>
			
			</div>

			<hr class="text-center m-auto">

			<div id="form-group" class="mb-5 mt-3">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Lighting Style') }}</h6>
				<select id="lightning" name="lightning" class="form-select">
					<option value='none' selected>{{ __('None') }}</option>																																																												
					<option value="warm">{{ __('Warm') }}</option>
					<option value="cold">{{ __('Cold') }}</option>
					<option value="golden hour">{{ __('Golden Hour') }}</option>
					<option value="blue hour">{{ __('Blue Hour') }}</option>
					<option value="ambient">{{ __('Ambient') }}</option>
					<option value="studio">{{ __('Studio') }}</option>
					<option value="neon">{{ __('Neon') }}</option>
					<option value="dramatic">{{ __('Dramatic') }}</option>
					<option value="cinematic">{{ __('Cinematic') }}</option>
					<option value="natural">{{ __('Natural') }}</option>
					<option value="foggy">{{ __('Foggy') }}</option>
					<option value="backlight">{{ __('Backlight') }}</option>
					<option value="hard">{{ __('Hard') }}</option>																																																																																																																																																																																		
					<option value="soft">{{ __('Soft') }}</option>																																																																																																																																																																																		
					<option value="iridescent">{{ __('Iridescent') }}</option>																																																																																																																																																																																		
					<option value="fluorescent">{{ __('Fluorescent') }}</option>																																																																																																																																																																																		
					<option value="decorative">{{ __('Decorative') }}</option>																																																																																																																																																																																		
					<option value="accent">{{ __('Accent') }}</option>																																																																																																																																																																																		
					<option value="task">{{ __('Task') }}</option>																																																																																																																																																																																		
					<option value="halogen">{{ __('Halogen') }}</option>																																																																																																																																																																																		
					<option value="light emitting diode">{{ __('Light Emitting Diode (LED)') }}</option>																																																																																																																																																																																		
				</select>
			</div>

			<div id="form-group" class="mb-5">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Medium') }}</h6>
				<select id="medium" name="medium" class="form-select">
					<option value='none' selected>{{ __('None') }}</option>																																																												
					<option value='acrylic'>{{ __('Acrylic') }}</option>																																																																																																																																																																																		
					<option value='canvas'>{{ __('Canvas') }}</option>																																																																																																																																																																																		
					<option value='chalk'>{{ __('Chalk') }}</option>																																																																																																																																																																																		
					<option value='charcoal'>{{ __('Charcoal') }}</option>																																																																																																																																																																																		
					<option value='classic oil'>{{ __('Classic Oil') }}</option>																																																																																																																																																																																		
					<option value='crayon'>{{ __('Crayon') }}</option>																																																																																																																																																																																		
					<option value='glass'>{{ __('Glass') }}</option>																																																																																																																																																																																		
					<option value='ink'>{{ __('Ink') }}</option>																																																																																																																																																																																		
					<option value='paster'>{{ __('Pastel') }}</option>																																																																																																																																																																																		
					<option value='pencil'>{{ __('Pencil') }}</option>																																																																																																																																																																																		
					<option value='spray paint'>{{ __('Spray Paint') }}</option>																																																																																																																																																																																		
					<option value='watercolor'>{{ __('Watercolor') }}</option>																																																																																																																																																																																		
					<option value='wood panel'>{{ __('Wood Panel') }}</option>																																																																																																																																																																																		
				</select>
			</div>

			<div id="form-group" class="mb-5">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Mood') }}</h6>
				<select id="mood" name="mood" class="form-select">
					<option value='none' selected>{{ __('None') }}</option>																																																												
					<option value='angry'>{{ __('Angry') }}</option>																																																																																																																																																																																		
					<option value='aggressive'>{{ __('Aggressive') }}</option>																																																																																																																																																																																		
					<option value='boring'>{{ __('Boring') }}</option>																																																																																																																																																																																		
					<option value='bright'>{{ __('Bright') }}</option>																																																																																																																																																																																		
					<option value='calm'>{{ __('Calm') }}</option>																																																																																																																																																																																		
					<option value='cheerful'>{{ __('Cheerful') }}</option>																																																																																																																																																																																		
					<option value='chilling'>{{ __('Chilling') }}</option>																																																																																																																																																																																		
					<option value='colorful'>{{ __('Colorful') }}</option>																																																																																																																																																																																		
					<option value='happy'>{{ __('Happy') }}</option>																																																																																																																																																																																		
					<option value='dark'>{{ __('Dark') }}</option>																																																																																																																																																																																		
					<option value='neutral'>{{ __('Neutral') }}</option>																																																																																																																																																																																		
					<option value='sad'>{{ __('Sad') }}</option>																																																																																																																																																																																		
					<option value='crying'>{{ __('Crying') }}</option>																																																																																																																																																																																		
					<option value='disappointed'>{{ __('Disappointed') }}</option>																																																																																																																																																																																		
					<option value='flirt'>{{ __('Flirt') }}</option>																																																																																																																																																																																		
				</select>
			</div>

			<div id="form-group" class="mb-4">
				<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Artist Name') }}</h6>
				<select id="artist" name="artist" class="form-select">
					<option value='none' selected>{{ __('None') }}</option>																																																												
					<option value="Leonardo da Vinci (Renaissance)">{{ __('Leonardo da Vinci (Renaissance)') }}</option>																																																																																																																																																																																	
					<option value="Vincent van Gogh (Impressionists and Neo-Impressionists)">{{ __('Vincent van Gogh (Impressionists and Neo-Impressionists)') }}</option>																																																																																																																																																																																	
					<option value="Pablo Picasso (Cubism)">{{ __('Pablo Picasso (Cubism)') }}</option>																																																																																																																																																																																	
					<option value="Salvador Dali (Surrealism)">{{ __('Salvador Dali (Surrealism)') }}</option>																																																																																																																																																																																	
					<option value="Banksy (Street Art)">{{ __('Banksy (Street Art)') }}</option>																																																																																																																																																																																	
					<option value="Takashi Murakami (Superflat)">{{ __('Takashi Murakami (Superflat)') }}</option>																																																																																																																																																																																	
					<option value="George Condo (Artificial Realism)">{{ __('George Condo (Artificial Realism)') }}</option>																																																																																																																																																																																	
					<option value="Tim Burton (Expressionism)">{{ __('Tim Burton (Expressionism)') }}</option>																																																																																																																																																																																	
					<option value="Normal Rockwell (exaggerated realism)">{{ __('Normal Rockwell (Exaggerated Realism)') }}</option>																																																																																																																																																																																	
					<option value="Andy Warhol (Pop Art)">{{ __('Andy Warhol (Pop Art)') }}</option>																																																																																																																																																																																	
					<option value="Claude Monet (Impressionism-Nature)">{{ __('Claude Monet (Impressionism-Nature)') }}</option>																																																																																																																																																																																	
					<option value="Robert Wyland (outdoor murals)">{{ __('Robert Wyland (Outdoor Murals)') }}</option>																																																																																																																																																																																	
					<option value="Thomas Kinkade (luminism)">{{ __('Thomas Kinkade (Luminism)') }}</option>																																																																																																																																																																																	
					<option value="Michelangelo (Fresco Art)">{{ __('Michelangelo (Fresco Art)') }}</option>																																																																																																																																																																																	
					<option value="Johannes Vermeer (impressionist)">{{ __('Johannes Vermeer (Impressionist)') }}</option>																																																																																																																																																																																	
					<option value="Gustav Klimt (fresco-secco)">{{ __('Gustav Klimt (Fresco-Secco)') }}</option>																																																																																																																																																																																	
					<option value="Sandro Botticelli (egg tempera)">{{ __('Sandro Botticelli (Egg Tempera)') }}</option>																																																																																																																																																																																	
					<option value="James Abbott (Impressionist)">{{ __('James Abbott (Impressionist)') }}</option>																																																																																																																																																																																	
					<option value="McNeill Whistler (Realism)">{{ __('McNeill Whistler (Realism)') }}</option>																																																																																																																																																																																	
					<option value="Jan van Eyck (Oil Panting)">{{ __('Jan van Eyck (Oil Panting)') }}</option>																																																																																																																																																																																	
					<option value="Hieronymus Bosch (Flemish painting)">{{ __('Hieronymus Bosch (Flemish Painting)') }}</option>																																																																																																																																																																																	
					<option value="Georges Seurat (pointillism)">{{ __('Georges Seurat (Pointillism)') }}</option>																																																																																																																																																																																	
					<option value="Pieter Bruegel (Flemish Renaissance)">{{ __('Pieter Bruegel (Flemish Renaissance)') }}</option>																																																																																																																																																																																	
					<option value="Diego Rodríguez (portraiture and scene painting)">{{ __('Diego Rodríguez (Portraiture and Scene Painting)') }}</option>																																																																																																																																																																																	
					<option value="Silva Velázquez (Baroque)">{{ __('Silva Velázquez (Baroque)') }}</option>																																																																																																																																																																																	
					<option value="John Bramblitt (impressionism Pop Art)">{{ __('John Bramblitt (impressionism Pop Art)') }}</option>																																																																																																																																																																																	
					<option value="Beeple (3d art)">{{ __('Beeple (3D Art)') }}</option>																																																																																																																																																																																	
					<option value="Sam Gilliam (Abstract)">{{ __('Sam Gilliam (Abstract)') }}</option>																																																																																																																																																																																	
					<option value="Hayao Miyazaki (Anime)">{{ __('Hayao Miyazaki (Anime)') }}</option>																																																																																																																																																																																
					<option value="datfootdive (Vaporwave)">{{ __('Datfootdive (Vaporwave)') }}</option>																																																																																																																																																																																
					<option value="Keith Thompson (Steampunk)">{{ __('Keith Thompson (Steampunk)') }}</option>																																																																																																																																																																																
					<option value="Johnny Silverhand (Cyberpunk)">{{ __('Johnny Silverhand (Cyberpunk)') }}</option>																																																																																																																																																																																
				</select>
			</div>

			<div class="sd-feature">

				<hr class="text-center m-auto">

				<div class="mt-1">
					<a class="fs-11 font-weight-semibold" id="advanced-settings-toggle" href="#">{{ __('Advanced Settings') }} <span>+</span></a>	
				</div>

				<div id="advanced-settings-wrapper">
					<div id="form-group" class="mb-5 mt-3">
						<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('image Strength') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('How much influence the uploaded image has on the diffusion process. Values close to 100 will yield images very similar to the uploaded image while values close to 1 will yield images wildly different than the uploaded image') }}"></i></h6>
						<div class="range">
							<div class="range_in">
								<input type="range" min="1" max="100" value="35" name="image_strength">
								<div class="slider" style="width: 35%;"></div>
							</div>
							<div class="value">35</div>
						</div>
					</div>

					<div id="form-group" class="mb-5 mt-3">
						<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Prompt Strength') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('How strictly the diffusion process adheres to the prompt text (higher values keep your image closer to your prompt). Note: Higher value can reduce the output quality, giving less room to the AI for being less creative.') }}"></i></h6>
						<div class="range">
							<div class="range_in">
								<input type="range" min="1" max="35" value="7" name="cfg_scale">
								<div class="slider" style="width: 20%;"></div>
							</div>
							<div class="value">7</div>
						</div>
					</div>

					<div id="form-group" class="mb-5 mt-3">
						<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Generation Steps') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Generation steps is how many times the image is sampled. Higher step value results in higher output quality but will take a longer time to generate results.') }}"></i></h6>
						<div class="range">
							<div class="range_in">
								<input type="range" min="1" max="50" value="30" name="steps">
								<div class="slider" style="width: 60%;"></div>
							</div>
							<div class="value">30</div>
						</div>
					</div>

					<div id="form-group" class="mb-5 mt-3">
						<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Diffusion Samples') }}</h6>
						<select id="diffusion-samples" name="diffusion_samples" class="form-select">
							<option value='none' selected>{{ __('Auto') }}</option>																																																												
							<option value='DDIM'>{{ __('DDIM') }}</option>																																																																																																																																																																																		
							<option value='DDPM'>{{ __('DDPM') }}</option>																																																																																																																																																																																		
							<option value='K_DPMPP_2M'>{{ __('K_DPMPP_2M') }}</option>																																																																																																																																																																																		
							<option value='K_DPMPP_2S_ANCESTRAL'>{{ __('K_DPMPP_2S_ANCESTRAL') }}</option>																																																																																																																																																																																		
							<option value='K_DPM_2'>{{ __('K_DPM_2') }}</option>																																																																																																																																																																																		
							<option value='K_DPM_2_ANCESTRAL'>{{ __('K_DPM_2_ANCESTRAL') }}</option>																																																																																																																																																																																		
							<option value='K_EULER'>{{ __('K_EULER') }}</option>																																																																																																																																																																																		
							<option value='K_EULER_ANCESTRAL'>{{ __('K_EULER_ANCESTRAL') }}</option>																																																																																																																																																																																		
							<option value='K_HEUN'>{{ __('K_HEUN') }}</option>																																																																																																																																																																																		
							<option value='K_LMS'>{{ __('K_LMS') }}</option>																																																																																																																																																																																																																																																																																																																																																																				
						</select>
					</div>
					
					<div id="form-group" class="mb-5">
						<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Clip Guidance Preset') }}</h6>
						<select id="preset" name="preset" class="form-select">
							<option value='NONE' selected>{{ __('None') }}</option>																																																												
							<option value='FAST_BLUE'>{{ __('FAST_BLUE') }}</option>																																																																																																																																																																																		
							<option value='FAST_GREEN'>{{ __('FAST_GREEN') }}</option>																																																																																																																																																																																		
							<option value='SIMPLE'>{{ __('SIMPLE') }}</option>																																																																																																																																																																																		
							<option value='SLOW'>{{ __('SLOW') }}</option>																																																																																																																																																																																		
							<option value='SLOWER'>{{ __('SLOWER') }}</option>																																																																																																																																																																																		
							<option value='SLOWEST'>{{ __('SLOWEST') }}</option>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						
						</select>
					</div>
				</div>

			</div>

		</div>
		
	</aside>

	<div class="custom-modal">
		<div class="modal" id="image-styles-modal" tabindex="-1" aria-hidden="true">			
			  <div class="modal-content">
				<span class="close text-right fs-12 text-muted"><i class="fa-solid fa-close"></i></span>
				<div class="modal-body pl-0 pr-0">
					<div class="row no-gutters image-styles-wrapper">
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-none" name="style" value="none"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/none.jpg') }}" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-none-text">{{ __('No Style') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-abstract" name="style" value="abstract"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/abstract.jpg') }}" id="style-abstract-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-abstract-text">{{ __('Abstract') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-realism" name="style" value="realistic"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/realism.jpg') }}" id="style-realism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-realism-text">{{ __('Realism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-3d" name="style" value="3d-model"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/3d_model.webp') }}" id="style-3d-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-3d-text">{{ __('3D Model') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cartoon" name="style" value="cartoon"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/cartoon.jpg') }}" id="style-cartoon-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cartoon-text">{{ __('Cartoon') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-anime" name="style" value="anime"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/anime.webp') }}"  id="style-anime-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-anime-text">{{ __('Anime') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-digital" name="style" value="digital-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/digitalart.jpg') }}" id="style-digital-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-digital-text">{{ __('Digital Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-artdeco" name="style" value="art deco"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/artdeco.jpg') }}" id="style-artdeco-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-artdeco-text">{{ __('Art Deco') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-pixel" name="style" value="pixel-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/pixelart.jpg') }}" id="style-pixel-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-pixel-text">{{ __('Pixel Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-origami" name="style" value="origami"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/origami.webp') }}" id="style-origami-thumb"  width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-origami-text">{{ __('Origami') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-illustration" name="style" value="illustration"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/illustration.webp') }}" id="style-illustration-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-illustration-text">{{ __('Illustration') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-photography" name="style" value="photographic"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/thumb-72.webp') }}" id="style-photography-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-photography-text">{{ __('Photographic') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-retro" name="style" value="retro"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/retro.webp') }}" id="style-retro-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-retro-text">{{ __('Retro') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-pencil" name="style" value="pencil drawing"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/sketch.webp') }}" id="style-pencil-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-pencil-text">{{ __('Pencil Drawing') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-vaporwave" name="style" value="vaporwave"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/vaporwave.jpg') }}" id="style-vaporwave-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-vaporwave-text">{{ __('Vaporwave') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-popart" name="style" value="pop art"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/popart.jpg') }}" id="style-popart-thumb"  width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-popart-text">{{ __('Pop Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-sticker" name="style" value="sticker"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/sticker.webp') }}" id="style-sticker-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-sticker-text">{{ __('Sticker') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-minimalism" name="style" value="minimalism"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/minimalism.jpg') }}" id="style-minimalism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-minimalism-text">{{ __('Minimalism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-renaissance" name="style" value="renaissance"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/reneissance.webp') }}" id="style-renaissance-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-renaissance-text">{{ __('Renaissance') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-ballpoint" name="style" value="ballpoint pen drawing"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/ink.webp') }}" id="style-ballpoint-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-ballpoint-text">{{ __('Ballpoint Pen') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cyberpunk" name="style" value="cyberpunk"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/cyberpunk.webp') }}" id="style-cyberpunk-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cyberpunk-text">{{ __('Cyberpunk') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-isometric" name="style" value="isometric"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/isometric.jpg') }}" id="style-isometric-thumb"width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-isometric-text">{{ __('Isometric') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-bauhaus" name="style" value="bauhaus"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/bauhaust.webp') }}" id="style-bauhaus-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-bauhaus-text">{{ __('Bauhaus') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-glitchcore" name="style" value="glitchcore"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/glitchcore.jpg') }}" id="style-glitchcore-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-glitchcore-text">{{ __('Glitchcore') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-steampunk" name="style" value="steampunk"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/steampunk.webp') }}" id="style-steampunk-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-steampunk-text">{{ __('Steampunk') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-ukiyo" name="style" value="ukiyo-e"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/ukiyo.webp') }}" id="style-ukiyo-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-ukiyo-text">{{ __('Ukiyo-e') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-lowpoly" name="style" value="low-poly"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/lowpoly.jpg') }}" id="style-lowpoly-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-lowpoly-text">{{ __('Low Poly') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-vector" name="style" value="vector"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/vector.png') }}" id="style-vector-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-vector-text">{{ __('Vector') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-impressionism" name="style" value="impressionism"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/imressionism.jpg') }}" id="style-impressionism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-impressionism-text">{{ __('Impressionism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cubism" name="style" value="cubism"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/cubism.webp') }}" id="style-cubism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cubism-text">{{ __('Cubism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cinematic" name="style" value="cinematic"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/cinematic.jpg') }}" id="style-cinematic-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cinematic-text">{{ __('Cinematic') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-analog" name="style" value="analog-film"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/analog-film.jpg') }}" id="style-analog-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-analog-text">{{ __('Analog Film') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-fantasy" name="style" value="fantasy-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/fantasy-art.jpeg') }}" id="style-fantasy-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-fantasy-text">{{ __('Fantasy Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-line" name="style" value="line-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ theme_url('img/frontend/thumbs/line-art.jpg') }}" id="style-line-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-line-text">{{ __('Line Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			  </div>
			
		  </div>
	</div>

	<div class="image-modal">
		<div class="modal fade" id="image-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h6>{{ __('Image View') }}</h6>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pb-6 pr-5 pl-5">
					
				</div>
			</div>
			</div>
	  	</div>
	</div>

</form>

<div class="modal fade" id="promptModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pl-5 pr-5">
				<h6 class="text-center font-weight-extra-bold fs-16"><i class="fa-solid fa-notebook mr-2"></i> {{ __('Prompt Library') }}</h6>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 p-4">
						<div id="chat-search-panel">
							<div class="search-template">
								<div class="input-box">								
									<div class="form-group prompt-search-bar-dark">							    
										<input type="text" class="form-control" id="search-template" placeholder="{{ __('Search for prompts...') }}">
									</div> 
								</div> 
							</div>
						</div>
					</div>	
				</div>				
				
				<div class="prompts-panel">
		
					<div class="tab-content" id="myTabContent">
		
						<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
							<div class="row" id="templates-panel">			
								@foreach ($prompts as $prompt)
									<div class="col-md-6 col-sm-12">
										<div class="prompt-boxes">
											<div class="card border-0" onclick='applyPrompt("{{ __($prompt->prompt) }}")'>
												<div class="card-body pt-3">
													<div class="template-title">
														<h6 class="mb-2 fs-15 number-font">{{ __($prompt->title) }}</h6>
													</div>
													<div class="template-info">
														<p class="fs-13 text-muted mb-2">{{ __($prompt->prompt) }}</p>
													</div>							
												</div>
											</div>
										</div>	
									</div>														
								@endforeach
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
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
	let task = 'none';
	let active_model = '{{ $model }}';
	let vendor = '{{ $vendor }}';
console.log(vendor)
	$(function () {

		"use strict";

		checkWindowSize();		

		$(".quantity .increase").off().on("click", function(e) {
			e.preventDefault();
			let t = $(this).closest(".quantity").find("input"),
				a = parseInt(t.attr("max"), 10),
				o = parseInt(t.val(), 10);
				o = isNaN(o) ? 0 : o, a !== o && (o++, t.val(o), !1);
		});

		$(".quantity .decrease").off().on("click", function(e) {
			e.preventDefault();
			let t = $(this).closest(".quantity").find("input"),
				a = parseInt(t.val(), 10),
				o = parseInt(t.attr("min"), 10);
				a = isNaN(a) ? 0 : a, o !== a && (a--, t.val(a), !1);
		});

		$('#advanced-settings-toggle').on('click', function (e) {
            e.preventDefault();
            $('#advanced-settings-wrapper').slideToggle();
            let $plus = $(this).find('span');
            if($plus.text() === '+'){
                $plus.text('-')
            } else {
                $plus.text('+')
            }
        });

		$(".range").each(function() {
			let t = $(this),
				a = t.find("input"),
				o = a.val(),
				n = t.find(".value"),
				s = a.attr("min"),
				i = a.attr("max"),
				r = t.find(".slider");
			r.css({
				width: o * (100 * s) / i + "%"
			}), a.on("input", function() {
				o = $(this).val(), n.text(o), r.css({
					width: o * (100 * s) / i + "%"
				})
			})
		});

		// Negative Prompt Checkbox
		$('#negative-prompt-checkbox').on('change', function(e) {

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#sd-multi-prompting-checkbox').is(":checked")) {
				$('#sd-multi-prompting-checkbox').prop('checked', false);
				$('#sd-multi-prompting').slideToggle();
			}

			if(e.target.checked === true) {
				$('#negative-prompt').slideToggle();
				task = 'sd-negative-prompt';				
			}			
			if(e.target.checked === false) {
				$('#negative-prompt').slideToggle();
				task = 'none';
			}
		});

		// Multi Prompting Checkbox
		$('#sd-multi-prompting-checkbox').on('change', function(e) {

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#negative-prompt-checkbox').is(":checked")) {
				$('#negative-prompt-checkbox').prop('checked', false);
				$('#negative-prompt').slideToggle();
			}

			if(e.target.checked === true) {
				$('#sd-multi-prompting').slideToggle();
				task = 'sd-multi-prompting';				
			}			
			if(e.target.checked === false) {
				$('#sd-multi-prompting').slideToggle();
				task = 'none';
			}
		});

		// Image to Image Checkbox
		$('#sd-image-to-image-checkbox').on('change', function(e) {			

			if ($('#negative-prompt-checkbox').is(":checked")) {
				$('#negative-prompt-checkbox').prop('checked', false);
				$('#negative-prompt').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#sd-multi-prompting-checkbox').is(":checked")) {
				$('#sd-multi-prompting-checkbox').prop('checked', false);
				$('#sd-multi-prompting').slideToggle();
			}
			
			if(e.target.checked === true) {
				$('#sd-image-to-image').slideToggle();
				task = 'sd-image-to-image';
			}			
			if(e.target.checked === false) {
				$('#sd-image-to-image').slideToggle();
				task = 'none';
			}
		});

		// Image Masking Checkbox
		$('#sd-image-masking-checkbox').on('change', function(e) {			

			if ($('#negative-prompt-checkbox').is(":checked")) {
				$('#negative-prompt-checkbox').prop('checked', false);
				$('#negative-prompt').slideToggle();
			}

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#sd-multi-prompting-checkbox').is(":checked")) {
				$('#sd-multi-prompting-checkbox').prop('checked', false);
				$('#sd-multi-prompting').slideToggle();
			}

			if(e.target.checked === true) {
				$('#sd-image-masking').slideToggle();
				task = 'sd-image-masking';
			}			
			if(e.target.checked === false) {
				$('#sd-image-masking').slideToggle();
				task = 'none';
			}
		});

		// Image Upscale Checkbox
		$('#sd-image-upscale-checkbox').on('change', function(e) {			

			if ($('#negative-prompt-checkbox').is(":checked")) {
				$('#negative-prompt-checkbox').prop('checked', false);
				$('#negative-prompt').slideToggle();
			}

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-multi-prompting-checkbox').is(":checked")) {
				$('#sd-multi-prompting-checkbox').prop('checked', false);
				$('#sd-multi-prompting').slideToggle();
			}

			if(e.target.checked === true) {
				$('#sd-image-upscale').slideToggle();
				document.getElementById("prompt").required = false;
				task = 'sd-image-upscale';
			}			
			if(e.target.checked === false) {
				$('#sd-image-upscale').slideToggle();
				document.getElementById("prompt").required = true;
				task = 'none';
			}
		});


		$('#main-settings-toggle').on('click', function(e) {
			e.preventDefault();
			$('#image-side-space').toggleClass('expand-main-width');
			$('#image-settings-wrapper').toggleClass('shrink-main-settings');	
		});

		$('#main-settings-toggle-minimized').on('click', function(e) {
			e.preventDefault();
			$('#image-side-space').toggleClass('expand-main-width');
			$('#image-settings-wrapper').toggleClass('shrink-main-settings');	
		});

		$(document).ready(function() {
			setResolution();
		});

		let style_button = document.getElementById("style-button");
		let span = document.getElementsByClassName("close")[0];
		let modal = document.getElementById("image-styles-modal");
		
		style_button.onclick = function() {
			if (modal.style.display === '' || modal.style.display === 'none') {
				modal.style.display = 'block';
				$('#style-button').addClass('rotate-90');
			} else {
				modal.style.display = 'none';
				$('#style-button').removeClass('rotate-90');
			}
			
		}

		span.onclick = function() {
			modal.style.display = "none";
			$('#style-button').removeClass('rotate-90');
		}

		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
				$('#style-button').removeClass('rotate-90');
			}
		}

		document.querySelectorAll('input[name="style"]').forEach((elem) => {
			elem.addEventListener('change', function(event) {
				if (event.target.value != 'none') {
					let image = $('#' + event.target.id + '-thumb').attr('src');
					let text = $('#'+ event.target.id + '-text').text();
					$("#style-button-img").removeClass("style-button-img");
					$("#style-button").removeClass("style-button-img-placeholder");
					$("#style-button i").addClass("extra-line-height");
					$("#style-button span").html(text);
					$("#style-button-img").attr("src", image);
				} else {
					$("#style-button-img").addClass("style-button-img");
					$("#style-button").addClass("style-button-img-placeholder");
					$("#style-button i").removeClass("extra-line-height");
					$("#style-button span").html('None');
				}
				
			})
		});

		$(window).resize(function() {
			if ($(window).width() < 940 ) {
				$('#image-settings-wrapper').addClass('shrink-main-settings');
				$('.openai-select-feature').removeClass('style-initial-state');
			}
		});
		
		$(document).on('click', '.viewImageResult', function(e) {

			"use strict";

			e.preventDefault();

			var id = $(this).attr("id");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'images/view',
				data:{
					id: id,
				},
				success:function(data) {   
				
					if (data['status'] == 'success') {
						$("#image-view-modal .modal-body").html(data['modal']);
						var myModal = new bootstrap.Modal(document.getElementById('image-view-modal'))
						myModal.show();
					} else {
						toastr.error(data['message']);
					}
				
				}
			});
		});


		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			let form = new FormData(this);
			form.append('task', task);
			form.append('model', active_model);
			form.append('vendor', vendor);

			if (task != 'none') {
				if (task == 'sd-image-to-image') {
					if (document.getElementById('sd_image_to_image').files.length === 0) {
						Swal.fire('{{ __('Image to Image Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_to_image').files[0]);	
					}
				} else if (task == 'sd-image-upscale') {
					if (document.getElementById('sd_image_upscale').files.length === 0) {
						Swal.fire('{{ __('Image Upscale Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_upscale').files[0]);
					}
				} else if (task == 'sd-image-masking') {
					if (document.getElementById('sd_image_masking').files.length === 0) {
						Swal.fire('{{ __('Image Masking Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_masking').files[0]);
					}
				}
			} 


			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/app/user/images/process',
				data: form,
				contentType: false,
				processData: false,
				cache: false,
				beforeSend: function() {
					$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles fa-beat-fade mr-2"></i>{{ __("Generating...") }}');
					$('#image-generate').prop('disabled', true);       
				},
				complete: function() {
					$('#image-generate').prop('disabled', false);
					$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __("Generate") }}');            
				},
				success: function (data) {		
						
					if (data['status'] == 'success') {		
						let images = data['images'];
		
						for (let i in images) {
							var checkContainer = document.getElementsByClassName('image-container');
							if (checkContainer.length == 0) {
								$('#image-containers-wrapper').append(images[i]).show().fadeIn("slow");
							} else {
								$(".image-container:first").before(images[i]).show().fadeIn("slow");
							}							
						}
						toastr.success('{{ __('Images were generated successfully') }}');	
						
						if (data['balance'] != 'unlimited') {
							animateValue("balance-number", data['old'], data['current'], 2000);	
						}

						clearFileInput(task);
					} else {						
						Swal.fire('{{ __('Image Generation Error') }}', data['message'], 'warning');
						clearFileInput(task);
					}
				},
				error: function(data) {
					$('#image-generate').prop('disabled', false);
            		$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __("Generate") }}'); 
					clearFileInput(task);
					console.log(data)
				}
			});
		});


		// DELETE IMAGE RESULT
		$(document).on('click', '.deleteResultButton', function(e) {

			e.preventDefault();

			Swal.fire({
				title: '{{ __('Confirm Image Deletion') }}',
				text: '{{ __('It will permanently delete this image') }}',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: '{{ __('Delete') }}',
				reverseButtons: true,
			}).then((result) => {
				if (result.isConfirmed) {
					var formData = new FormData();
					formData.append("id", $(this).attr('id'));
					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						method: 'post',
						url: 'images/delete',
						data: formData,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data['status'] == 'success') {
								toastr.success('{{ __('Selected image has been successfully deleted') }}');	
								location.replace(location.href);								
							} else {
								toastr.error('{{ __('There was an error while deleting this image') }}');
							}      
						},
						error: function(data) {
							Swal.fire('Oops...','{{ __('Something went wrong') }}!', 'error')
						}
					})
				} 
			})
		});


		// FETCH IMAGES FOR MOBILE
		$(document).on('touchmove', onScroll);         
		
		$(window).scroll(function(){
			let position = $(window).scrollTop();
			let bottom = $(document).height() - $(window).height();	
			if( position == bottom ){
				fetchData(); 
			}
		});

		$(document).on("click", '[data-toggle="remove-input"]', function() {
                var $this = $(this);
                var parent = $this.data("parent");
                $this.closest(parent).remove();
            }
        );

		$('[data-toggle="add-more"]').each(function() {
            var $this = $(this);
            var content = '<div class="multi-prompt-input d-flex align-items-center mt-2">' + 
							'<div class="input-box w-100 mb-0">' + 							
								'<div class="form-group">' +							    
									'<input type="text" class="form-control" name="multi_prompt[]" placeholder="{{ __('Describe what you want to see with phrases, and seperate them with commas...') }}">' +
								'</div>' +
							'</div>' +
							'<a href="#" class="ml-4 mr-4 delete-prompt-input" data-toggle="remove-input" data-parent=".multi-prompt-input"><i class="fa-solid fa-trash"></i></a>'+
						'</div>'
            var target = $this.data("target");

            $this.on("click", function(e) {
                e.preventDefault();
                $(target).append(content);
            });
        });
	});

	function onScroll(){
		if($(window).scrollTop() > $(document).height() - $(window).height()-100) {
			fetchData(); 
		}
	}	

	function getFile(uri) {
		//window.open(data,'_blank');
		// window.location.href = data;
		var link = document.createElement("a");
            link.href = uri;
            link.setAttribute("download", "download");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
		return false;
	}

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			obj.innerHTML = current;
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}
 
    // Check if the page has enough content or not. If not then fetch records
    function checkWindowSize(){
        if($(window).height() >= $(document).height()){
            fetchData();
        }
    }
 
    // Fetch records
    function fetchData(){
        var start = Number($('#start').val());
        var allcount = Number($('#totalrecords').val());
        var rowperpage = Number($('#rowperpage').val());
        start = start + rowperpage;
 
        if(start <= allcount){
            $('#start').val(start);
 
            $.ajax({
                url:"{{route('user.images.load')}}",
                data: {start:start},
                dataType: 'json',
                    success: function(response){
                    $(".image-container:last").after(response.html).show().fadeIn("slow");
 
                    // Check if the page has enough content or not. If not then fetch records
                    checkWindowSize();
                }
            });
        }
    }

	$(document).on('click', ".copy-image-prompt", function (e) {	
		var r = document.createRange();
		r.selectNode(document.getElementById('image-prompt-text'));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(r);
		document.execCommand('copy');
		window.getSelection().removeAllRanges();
		toastr.success('{{ __('Image prompt has been copied') }}');
	});

	$(document).on('click', ".copy-image-negative-prompt", function (e) {	
		var r = document.createRange();
		r.selectNode(document.getElementById('image-negative-prompt-text'));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(r);
		document.execCommand('copy');
		window.getSelection().removeAllRanges();
		toastr.success('{{ __('Image prompt has been copied') }}');
	});

	var loadFile = function(event) {
		var output = document.getElementById('source-image');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileScale = function(event) {
		var output = document.getElementById('source-image-scale');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMask = function(event) {
		var output = document.getElementById('source-image-mask');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMaskTarget = function(event) {
		var output = document.getElementById('source-image-mask-target');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMaskOpenai = function(event) {
		var output = document.getElementById('source-image-mask-openai');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileVariations = function(event) {
		var output = document.getElementById('source-image-variations');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	function clearFileInput(task) {
		switch (task) {
			case 'sd-image-to-image':
				document.getElementById('sd_image_to_image').value=null;
				var output = document.getElementById('source-image');
				output.style.display = 'none';
				break;
			case 'sd-image-upscale':
				document.getElementById('sd_image_upscale').value=null;
				var output = document.getElementById('source-image-scale');
				output.style.display = 'none';
				break;
			case 'sd-image-masking':
				document.getElementById('sd_image_masking').value=null;
				var output = document.getElementById('source-image-mask');
				output.style.display = 'none';
				break;
			default:
				break;
		}
	}


	// Apply prompt
	function applyPrompt(prompt) {
		document.querySelector('[name=prompt]').value = prompt;
	}


	// Search prompt
	$(document).on('keyup', '#search-template', function () {
		var searchTerm = $(this).val().toLowerCase();
		$('#templates-panel').find('> div').each(function () {
			if ($(this).filter(function() {
				return (($(this).find('h6').text().toLowerCase().indexOf(searchTerm) > -1) || ($(this).find('p').text().toLowerCase().indexOf(searchTerm) > -1));
			}).length > 0 || searchTerm.length < 1) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});


	$('.photo-studio-tools .dropdown .dropdown-menu .dropdown-item').click(function(e){
		e.preventDefault();

		let task = $(this).attr('id');
		let name = $(this).attr('name');
		let icon = $(this).attr('icon');
		let template_name = document.getElementById('active-template-name');
		active_model = task;
		template_name.innerHTML = name;

		setResolution();
		
	});
		
	
	function setResolution() {
		let resolution = document.getElementById('resolution');
		$("#resolution").empty();

		if (active_model == 'dall-e-2') {	
			$('#resolution').append('<option value="256x256" selected>256 x 256px</option>');
			$('#resolution').append('<option value="512x512">512 x 512px</option>');
			$('#resolution').append('<option value="1024x1024">1024 x 1024px</option>');
			vendor = 'openai';
			openaiReset();
		} else if (active_model == 'dall-e-3' || active_model == 'dall-e-3-hd') {
			$('#resolution').append('<option value="1024x1024" selected>1024 x 1024px</option>');																												
			$('#resolution').append('<option value="1024x1792">1024 x 1792px</option>');																												
			$('#resolution').append('<option value="1792x1024">1792 x 1024px</option>');
			vendor = 'openai';
			openaiReset();
		} else if (active_model == 'stable-diffusion-v1-6') {
			$('#resolution').append('<option value="1024x512">1024 x 512px</option>');
			$('#resolution').append('<option value="896x512">896 x 512px</option>');
			$('#resolution').append('<option value="768x512">768 x 512px</option>');
			$('#resolution').append('<option value="512x512" selected>512 x 512px</option>');
			$('#resolution').append('<option value="512x768">512 x 768px</option>');	
			$('#resolution').append('<option value="512x896">512 x 896px</option>');	
			$('#resolution').append('<option value="512x1024">512 x 1024px</option>');
			vendor = 'sd';
			sdReset();	
		} else if (active_model == 'stable-diffusion-xl-1024-v1-0') {
			$('#resolution').append("<option value='1536x640'>1536 x 640px</option>");
			$('#resolution').append("<option value='1344x768'>1344 x 768px</option>");
			$('#resolution').append("<option value='1216x832'>1216 x 832px</option>");
			$('#resolution').append("<option value='1152x896'>1152 x 896px</option>");
			$('#resolution').append("<option value='1024x1024' selected>1024 x 1024px</option>");
			$('#resolution').append("<option value='896x1152'>896 x 1152px</option>");
			$('#resolution').append("<option value='832x1216'>832 x 1216px</option>");
			$('#resolution').append("<option value='768x1344'>768 x 1344px</option>");
			$('#resolution').append("<option value='640x1536'>640 x 1536px</option>");
			vendor = 'sd';
			sdReset();
		} else if (active_model == 'sd3-medium' || active_model == 'sd3-large' || active_model == 'sd3-large-turbo' || active_model == 'core' || active_model == 'ultra') {
			$('#resolution').append("<option value='1:1'>1:1 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='2:3'>2:3 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='3:2'>3:2 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='4:5'>4:5 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='5:4'>5:4 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='9:16'>9:16 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='16:9'>16:9 ({{ __('Aspect Ratio') }})</option>");
			$('#resolution').append("<option value='9:21'>9:21 ({{ __('Aspect Ratio') }})</option>");
			vendor = 'sd';
			sdReset();
		} else if (active_model == 'flux-realism' || active_model == 'flux-pro/new' || active_model == 'flux/schnell' || active_model == 'flux/dev') {
			$('#resolution').append("<option value='square_hd'>{{ __('Square HD') }}</option>");
			$('#resolution').append("<option value='square'>{{ __('Square') }}</option>");
			$('#resolution').append("<option value='portrait_4_3'>{{ __('Portrait 4:3') }}</option>");
			$('#resolution').append("<option value='portrait_16_9'>{{ __('Portrait 16:9') }}</option>");
			$('#resolution').append("<option value='landscape_4_3'>{{ __('Landscape 4:3') }}</option>");
			$('#resolution').append("<option value='landscape_16_9'>{{ __('Landscape 16:9') }}</option>");
			vendor = 'falai';
			falaiReset();
		}
	}

	function openaiReset() {
		$('.sd-feature').addClass('hide-all');
		$('.openai-feature').addClass('show-all');
		if ($(window).width() > 940 ) {
			$('.openai-select-feature').addClass('style-initial-state');
		} else {
			$('.openai-select-feature').removeClass('style-initial-state').addClass('show-all');
		}	
	}

	function sdReset() {
		$('.sd-feature').removeClass('hide-all');
		$('.openai-feature').removeClass('show-all').addClass('hide-all');
		if ($(window).width() > 940 ) {
			$('.sd-select-feature').addClass('style-initial-state');
		} else {
			$('.sd-select-feature').removeClass('style-initial-state');
		}
	}

	function falaiReset() {
		$('.sd-feature').addClass('hide-all');
		$('.openai-feature').addClass('hide-all');
	}

</script>
@endsection

				

{{-- if (item == 'openai') {
	// Openai is active
	$('.sd-feature').addClass('hide-all');
	$('.openai-feature').addClass('show-all');	
	if ($(window).width() < 940 ) {
		$('.openai-select-feature').addClass('show-all');
	}		
	$('.sd-select-feature').removeClass('show-all').addClass('hide-all');

} else {
	//SD is active
	$('.sd-feature').removeClass('hide-all');
	$('.openai-feature').removeClass('show-all').addClass('hide-all');
	$('.openai-select-feature').removeClass('show-all').addClass('hide-all');
	if ($(window).width() < 940 ) {
		$('.sd-select-feature').addClass('show-all');
	}
}	 --}}