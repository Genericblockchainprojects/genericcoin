@extends('admin.main')
@section('title', 'Change Email')
@section('content')
<section class="page-content">
  <div class="page-content-inner">
    <div class="dashboard-container">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel panel-with-borders">
            <div class="panel-heading">
              <h3>Change Email</h3>
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
            {{ Form::open(['method' => 'POST','class'=>'form-horizontal','id'=>'validatePasswordForm','autocomplete'=>'off', 'url'=> route('update_email'), 'enctype' => 'multipart/form-data']) }}
            {{ Form::hidden('id', @Auth::id()) }}
            {{ csrf_field() }}
                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Email</label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="text" name="email" value="{{@$data->email}}" class="form-control" placeholder="Email">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  </div>
                </div>

                <div class="form-actions">
                    <input type="submit"  class="btn btn-primary view-all" value="Update Email" class="form-control"/>

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