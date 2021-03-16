@extends('admin.main')
@section('content')
<section class="page-content">
  <div class="page-content-inner">
    <div class="dashboard-container">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel panel-with-borders">
            <div class="panel-heading">
              <h3>Send  <a type="button" class="btn btn-warning pull-right add btn-xs"><i class="icmn-plus-circle"></i> Add More </a> </h3>
            </div>
            <div class="panel-body">
              <form>
                <div class="optionBox">
                <div class="form-group row block">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Pay To</label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Amount</label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input id="s_amt" type="text" class="form-control" placeholder="" maxlength="16">
                  </div>
                  <div class="col-lg-6">
                    <div class="left-text">= $</div>
                  <div class="value-amount" id="usd_amount">0</div>
                </div>
                </div>

                </div>

                <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">Transaction Fee </label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                  <div class="form-group row">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <label class="form-control-label">USD </label>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="form-actions">
                  <button type="button" class="btn btn-warning"><i class="icmn-paperplane"></i> Send </button>
                </div>
                <div class="form-group row margin-top-20">
                  <div class="col-md-12 margin-bottom-10">
                    <div class="balance-bg-left">Balance :</div>
                    <div class="balance-bg-right"> 0MYC</div>
                  </div>
                  <div class="col-md-12">
                    <div class="transaction-bg-left">Last Transaction : </div>
                    <div class="transaction-bg-right">4be88089d65829bdfdsf152fr5uyrer05e455t41jj4k85dgg87kplf45ss89871</div>
                  </div>
                </div>
              </form>
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
@section('jscript')
<script>
$('.add').click(function() {
    $('.block:last').before('<div class="form-group block margin-bottom-0"><div class="form-group row"><div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"><label class="form-control-label">Pay To</label></div><div class="col-lg-4 col-md-8 col-sm-8 col-xs-12"><input type="text" class="form-control" placeholder=""></div></div><div class="form-group row"><div class="col-lg-2 col-md-4 col-sm-4 col-xs-12"><label class="form-control-label">Amount</label></div><div class="col-lg-4 col-md-8 col-sm-8 col-xs-12"><input id="s_amt" type="text" class="form-control" placeholder="" maxlength="16"></div><div class="col-lg-6"><div class="left-text">= $</div><div class="value-amount" id="usd_amount">0</div></div></div><span class="remove btn btn-danger btn-xs"><i class="icmn-bin"></i> Delete</span></div>');});
$('.optionBox').on('click','.remove',function() {
  $(this).parent().remove();
});
</script>
@endsection
@section('css')
<style type="text/css">
.form-group{position: relative;}
.remove{position: absolute;right: 16px;top: 63px;}
</style>
@endsection