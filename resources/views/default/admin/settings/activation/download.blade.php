@extends('layouts.auth')

@section('content')
    <div class="container vertical-center">
        <div class="row justify-content-md-center">

                    <div class="col-md-6 col-sm-12 mt-8">   

                        <div class="card overflow-hidden border-0 special-shadow">	
                                                    
                            <div class="card-body" id="manual-activation">                                                  

                                <h3 class="text-center font-weight-bold fs-16 mb-4 mt-3">{{ __('Download v6.1 Update') }}</h3>

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-login alert-success"> 
                                        <strong><i class="fa fa-check-circle"></i> {{ $message }}</strong>
                                    </div>
                                    @endif

                                    @if ($message = Session::get('error'))
                                    <div class="alert alert-login alert-danger">
                                        <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
                                    </div>
                                @endif                            
                                
                                <form action="{{ route('download.update.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div id="install-wrapper">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">								
                                                <div class="input-box">								
                                                    <h6>{{ __('License Code') }}</h6>
                                                    <div class="form-group">							    
                                                        <input type="text" class="form-control @error('license') is-danger @enderror" id="license" name="license" value="{{ old('license') }}" placeholder="Enter Your License Code" autocomplete="off" required>
                                                        @error('license')
                                                            <p class="text-danger">{{ $errors->first('license') }}</p>
                                                        @enderror
                                                    </div> 
                                                </div>
                                            </div>                                
                                        </div>
                                    </div>

                        </div>                    

                    </div>  
                    <div class="form-group mb-0 text-center">                        
                        <button type="submit"  class="btn btn-primary pr-7 pl-7">{{ __('Download') }}</button>                                               
                    </div>
                </form>    
            </div>
            
        </div>
    </div>
@endsection

