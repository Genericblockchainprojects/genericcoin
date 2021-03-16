@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')

 <div class="single-page-block">
      <div class="single-page-block-inner effect-3d-element">
        <div class="blur-placeholder"><!-- --></div>
        <div class="flash-message" id="iframeMessage">
    <div class="admin-alert-msg alert alert-success" style="display:none;z-index: 1000 !important;" id="customSuccessFlash" ><span></span><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="admin-alert-msg alert alert-{{ $msg }}  text-center">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    @endif
    @endforeach
</div>
        <div class="single-page-block-form">
          <h3 class="text-center"> <i class="icmn-user margin-right-10"></i> Forgot Password </h3>
         
          <form class="form-validationl" method="POST" action="{{ route('password.email') }}">
              {{ csrf_field() }}
           
            <div class="form-group">
                   <input  type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email ID">
		
                   <span class="text-danger">{{ $errors->first('email') }}</span>
		</div>
	
           <div class="form-group"> <a class="btn btn-link pull-right margin-top-35" href="{{ url('login') }}">Back To Login</a> </div>
            <div class="form-actions">
             <input type="submit" class="btn btn-primary view-all" value="Send Password Reset Link" class="form-control"/>
            </div>
          </form>
          
        </div>
      </div>
@endsection
