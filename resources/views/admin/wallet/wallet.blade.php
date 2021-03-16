@extends('admin.main')
@section('content')
<section class="page-content">
  <div class="page-content-inner">
    <div class="dashboard-container">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel panel-with-borders">
            <div class="panel-heading">
              <h3>Wallet Dashboard</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <h4> Balance </h4>
                </div>
                <div class="col-lg-12">
                  <div class="background-color">
                    <div class="col-md-4 col-sm-12 col-xs-12"> <strong>Available :</strong> Read 0 MYC </div>
                    <div class="col-md-4 col-sm-12 col-xs-12"> <strong>Pending  :</strong> Read 0 MYC </div>
                    <div class="col-md-4 col-sm-12 col-xs-12"> <strong>Total :</strong> Read 0 MYC </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4>Latest Transactions </h4>
                  <div class="table-responsive">
                    <table class="sheru-cp-section table">
                      <thead class="table__head">
                      <tr class="table__row">
                          <th class="table__cell table__cell--head" scope="col"><strong>User List</strong></th>
                          <th class="table__cell table__cell--head" scope="col"><strong> Date </strong></th>
                          <th class="table__cell table__cell--head" scope="col"><strong> Amount</strong></th>
                          <th class="table__cell table__cell--head" scope="col"><strong> USD</strong></th>
                        </tr>
                      </thead>
                      <tbody class="table__body">
                        <tr class="table__row">
                          <th class="table__cell table__cell--head" scope="row" data-title="Name">Kavin Laxes</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Date">17/10/2017</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Amount">0.00000000  MYC</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="USD">$ 10</td>
                        </tr>
                        <tr class="table__row">
                          <th class="table__cell table__cell--head" scope="row" data-title="Name">David Max</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Date">17/10/2017</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Amount">0.00000000  MYC</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="USD">$ 8</td>
                        </tr>
                        <tr class="table__row">
                          <th class="table__cell table__cell--head" scope="row" data-title="Name">Kavin Laxes</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Date">17/10/2017</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Amount">0.00000000  MYC</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="USD">$ 9</td>
                        </tr>
                        <tr class="table__row">
                          <th class="table__cell table__cell--head" scope="row" data-title="Name">David Max</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Date">17/10/2017</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="Amount">0.00000000  MYC</td>
                          <th class="table__cell table__cell--head" scope="row" data-title="USD">$ 1</td>
                        </tr>


                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-center">
                  <nav>
                    <ul class="pagination" style="margin-bottom: -10px;">
                      <li class="page-item"> <a class="page-link" href="javascript: void(0);" aria-label="Previous"> <span aria-hidden="true"> <i class="fa fa-arrow-left"></i> </span> <span class="sr-only">Previous</span> </a> </li>
                      <li class="page-item"><a class="page-link disabled" href="javascript: void(0);">1</a></li>
                      <li class="page-item"><a class="page-link disabled" href="javascript: void(0);">2</a></li>
                      <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                      <li class="page-item"><a class="page-link" href="javascript: void(0);">...</a></li>
                      <li class="page-item"><a class="page-link" href="javascript: void(0);">91</a></li>
                      <li class="page-item"> <a class="page-link" href="javascript: void(0);" aria-label="Next"> <span aria-hidden="true"> <i class="fa fa-arrow-right"></i> </span> <span class="sr-only">Next</span> </a> </li>
                    </ul>
                  </nav>
                </div>
              </div>
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