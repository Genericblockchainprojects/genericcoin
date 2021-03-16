@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

<div class="single-page-block">
    <div class="single-page-block-inner effect-3d-element">
        <div class="blur-placeholder"><!-- --></div>
        <div class="single-page-block-form">

            <header class="page-heading register_back">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Reset Password</h3>

                        </div>
                    </div>
                </div>
            </header>
            <div class="flash-message" id="iframeMessage">
                <div class="admin-alert-msg alert alert-success" style="display:none;z-index: 1000 !important;" id="customSuccessFlash" ><span></span><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <div class="admin-alert-msg alert alert-{{ $msg }}  text-center">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                @endif
                @endforeach
            </div>
         <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
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
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                         <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </span>
                    @endif
                </div>
                
                <div class="form-actions">

                    <input type="submit" class="btn btn-primary view-all" value="Reset Password" class="form-control"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection