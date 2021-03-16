@extends('admin.main')
@section('title', 'Change Password')
@section('content')
<section class="page-content">
  <div class="page-content-inner">
    <div class="dashboard-container">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel panel-with-borders">
            <div class="panel-heading">
              <h3>Change Password</h3>
            </div>
             <div class="flash-message" id="iframeMessage">
                        <div class="admin-alert-msg alert alert-success" style="display:none;z-index: 1000 !important;" id="customSuccessFlash" ><span></span><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <div class="admin-alert-msg alert alert-{{ $msg }}  text-center">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                        @endif
                        @endforeach
                    </div>
            <div class="panel-body">
            {{ Form::open(['method' => 'POST','class'=>'form-horizontal','id'=>'validatePasswordForm','autocomplete'=>'off', 'url'=> route('update_password'), 'enctype' => 'multipart/form-data']) }}
            {{ Form::hidden('id', @Auth::id()) }}
            {{ csrf_field() }}
                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Current Password</label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label"> New Password</label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="password" name="new_password" class="form-control" placeholder="New Password">
                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Confirm Password </label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                  </div>
                </div>
                <div class="form-actions">
                    <input type="submit"  class="btn btn-primary view-all" value="Update Password" class="form-control"/>

                </div>

             {{Form::close()}}
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <!-- Page Scripts -->
  <!-- End Page Scripts -->
</section>
@endsection
