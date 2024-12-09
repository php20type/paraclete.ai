@extends('layouts.app')

@section('css')
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7 justify-content-center">
		<div class="page-leftheader text-center">
			<h4 class="page-title mb-0"> {{ __('Edit Page') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.settings.page')}}"> {{ __('Pages') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Edit Page') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row justify-content-center">
		<div class="col-lg-10 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Edit Page') }}</h3>
				</div>
				<div class="card-body">
				
					<form action="{{ route('admin.settings.page.update', $id) }}" method="POST" enctype="multipart/form-data">
						@method('PUT')
						@csrf
						
						<div class="row mt-2">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Activate Page') }}</h6>
									<div class="form-group">
										<label class="custom-switch">
											<input type="checkbox" name="status" class="custom-switch-input" @if($id->status) checked @endif>
											<span class="custom-switch-indicator"></span>
										</label>
									</div>
								</div>
							</div>	
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Show on Top Menu') }}</h6>
									<div class="form-group">
										<label class="custom-switch">
											<input type="checkbox" name="top" class="custom-switch-input" @if($id->show_main_nav) checked @endif>
											<span class="custom-switch-indicator"></span>
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Show on Footer Menu') }}</h6>
									<div class="form-group">
										<label class="custom-switch">
											<input type="checkbox" name="footer" class="custom-switch-input" @if($id->show_footer_nav) checked @endif>
											<span class="custom-switch-indicator"></span>
										</label>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-lg-6 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('SEO Title') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ $id->seo_title }}">
									</div> 
								</div>						
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('SEO Canonical URL') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="seo_url" name="seo_url" value="{{ $id->seo_url }}">
									</div> 
								</div>						
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('SEO Description') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="seo_description" name="seo_description" value="{{ $id->seo_description }}">
									</div> 
								</div>						
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('SEO Keywords') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="{{ $id->seo_keywords }}">
									</div> 
								</div>						
							</div>
							<hr>
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Page Title') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="title" name="title" value="{{ $id->title }}" placeholder="{{ __('ex: Terms and Condition') }}" required>
									</div> 
								</div>						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Slug') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="slug" name="slug" value="{{ $id->slug }}" placeholder="terms-and-conditions" required>
									</div> 
								</div>						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">	
								<div class="input-box">	
									<h6 class="fs-12 font-weight-bold mb-4">{{ __('Content') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-control" name="content" rows="30" id="tinymce-editor">{!! $id->content !!}</div>							
								</div>											
							</div>
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-center mb-2 mt-1">
							<button type="submit" class="btn btn-primary pl-9 pr-9 ripple">{{ __('Update') }}</button>							
						</div>				

					</form>

				</div>
			</div>
		</div>
	</div>	
@endsection

@section('js')
<script src="{{URL::asset('plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{theme_url('js/export.js')}}"></script>
<script type="text/javascript">
	let loading = `<span class="loading">
					<span style="background-color: #fff;"></span>
					<span style="background-color: #fff;"></span>
					<span style="background-color: #fff;"></span>
					</span>`;
	let loading_dark = `<span class="loading">
						<span style="background-color: #1e1e2d;"></span>
						<span style="background-color: #1e1e2d;"></span>
						<span style="background-color: #1e1e2d;"></span>
						</span>`;
		$(function () {

			const tinymceOptions = {
				selector: '#tinymce-editor',
				statusbar: false,
				toolbar_sticky: true,
				draggable_modal: true,
				plugins: [
					'advlist', 'autolink', 'lists', 'charmap', 'preview', 'anchor', 'wordcount', 'autosave', 'link', 'image', 'code',
				],
				toolbar: 'AIMain AIOptions | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | forecolor backcolor emoticons | blockquote | undo redo | image link code',


		};

		if (getCookie('theme') == 'dark') {
			tinymceOptions.skin = 'oxide-dark';
			tinymceOptions.content_css = 'dark';
		}

		tinyMCE.init( tinymceOptions );

		function getCookie(cName) {
			const name = cName + "=";
			const cDecoded = decodeURIComponent(document.cookie); //to be careful
			const cArr = cDecoded.split('; ');
			let res;
			cArr.forEach(val => {
				if (val.indexOf(name) === 0) res = val.substring(name.length);
			})
			return res
		}

		});
	</script>
@endsection