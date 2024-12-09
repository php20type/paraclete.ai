@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0">{{ __('AI Vendor Service Costs') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Payment Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row justify-content-center">
		<div class="col-lg-6 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header border-0 pb-0">
					<h6 class="card-title fs-12 text-muted">{{ __('Update AI Vendor Service Costs') }}</h6>
				</div>
				<div class="card-body pt-0">			
					<hr class="mt-0">						
					<form id="" action="{{ route('admin.finance.settings.costs.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row mt-2 pl-5 pr-5">

							<h6 class="card-title fs-12 mb-4 text-muted">{{ __('OpenAI Costs') }}:</h6>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GPT 4o Mini Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="gpt_4o_mini" value="{{ $prices->gpt_4o_mini }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GPT 4o Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="gpt_4o" value="{{ $prices->gpt_4o }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GPT 4 Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="gpt_4" value="{{ $prices->gpt_4 }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GPT 4 Turbo Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="gpt_4t" value="{{ $prices->gpt_4t }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GPT 3.5 Turbo Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="gpt_3t" value="{{ $prices->gpt_3t }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('o1 Mini Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="o1_mini" value="{{ $prices->o1_mini }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('o1 Preview Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="o1_preview" value="{{ $prices->o1_preview }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Fine Tuned Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="fine_tuned" value="{{ $prices->fine_tuned }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Whisper') }} (STT) <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per minute') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="whisper" value="{{ $prices->whisper }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Dalle 3 HD') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per image') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="dalle_3_hd" value="{{ $prices->dalle_3_hd }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Dalle 3') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per image') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="dalle_3" value="{{ $prices->dalle_3 }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Dalle 2') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per image') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="dalle_2" value="{{ $prices->dalle_2 }}">
									</div> 	
								</div> 						
							</div>

							<h6 class="card-title fs-12 mb-4 mt-4 text-muted">{{ __('Anthropic Costs') }}:</h6>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Claude 3 Opus Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="opus" value="{{ $prices->claude_3_opus }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Claude 3.5 Sonnet Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.0001" step="0.0001" class="form-control" name="sonnet" value="{{ $prices->claude_3_sonnet }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Claude 3 Haiku Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.00001" step="0.00001" class="form-control" name="haiku" value="{{ $prices->claude_3_haiku }}">
									</div> 	
								</div> 						
							</div>

							<h6 class="card-title fs-12 mb-4 mt-4 text-muted">{{ __('Google Gemini Costs') }}:</h6>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Gemini Pro Model') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 tokens/words') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" min="0.00001" step="0.00001" class="form-control" name="gemini" value="{{ $prices->gemini_pro }}">
									</div> 	
								</div> 						
							</div>

							<h6 class="card-title fs-12 mb-4 mt-4 text-muted">{{ __('Stable Diffusion Costs') }}:</h6>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Stable Diffusion') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1000 credits') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="sd" value="{{ $prices->sd }}">
									</div> 	
								</div> 						
							</div>

							<h6 class="card-title fs-12 mb-4 mt-4 text-muted">{{ __('Voiceover Costs') }}:</h6>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('AWS TTS') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1M characters') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="aws" value="{{ $prices->aws_tts }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Azure TTS') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1M characters') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="azure" value="{{ $prices->azure_tts }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('GCP TTS') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1M characters') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="gcp" value="{{ $prices->gcp_tts }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Elevenlabs TTS') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1M characters') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="elevenlabs" value="{{ $prices->elevenlabs_tts }}">
									</div> 	
								</div> 						
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('OpenAI TTS') }} <i class="ml-1 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Per 1M characters') }}"></i></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" name="openai" value="{{ $prices->openai_tts }}">
									</div> 	
								</div> 						
							</div>

						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<a href="{{ route('admin.davinci.configs') }}" class="btn ripple btn-cancel mr-2">{{ __('Return') }}</a>
							<button type="submit" class="btn ripple btn-primary">{{ __('Apply') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
@endsection

