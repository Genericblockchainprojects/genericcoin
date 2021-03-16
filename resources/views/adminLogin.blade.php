@extends('layouts.app')
@section('title', 'Login')
@section('content')
 
 <div class="single-page-block">
      <div class="single-page-block-inner effect-3d-element">
        <div class="blur-placeholder"><!-- --></div>
        <div class="single-page-block-form">
            
          <h3 class="text-center"> <i class="icmn-enter margin-right-10"></i> Login Form </h3>
          <br />
          <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.auth') }}">
               {!! csrf_field() !!}
            <div class="form-group">
              <input  type="text" name="email" class="form-control" placeholder="Email ID">
                @if ($errors->has('email'))
                <span class="help-block">
                     <span class="text-danger">{{ $errors->first('email') }}</span>
                </span>
                @endif
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    </span>
                @endif
            </div>
 <div class="form-group"> <a class="btn btn-link pull-right margin-top-35" href="{{ route('password.request') }}">Forgot Your Password?</a> </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary width-150">Log In </button>
              
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
