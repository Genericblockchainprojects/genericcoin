@extends('admin.main')
@section('title', 'Dashboard')
@section('content')
<section class="page-content">
  <div class="page-content-inner">

    <!-- Dashboard -->
    <div class="dashboard-container">

        <div class="flash-message" id="iframeMessage">
                            <div class="admin-alert-msg alert alert-success" style="display:none;z-index: 1000 !important;" id="customSuccessFlash" ><span></span><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                            <div class="admin-alert-msg alert alert-{{ $msg }}  text-center">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                            @endif
                            @endforeach
                        </div>
        <div class="col-lg-12">
          <section class="panel panel-with-borders">
            <div class="panel-heading">
              <h3> Send Token </h3>
            </div>

            <div class="panel-body">
                {{ Form::open(['method' => 'POST','id'=>'validateForm','url'=>'/send-user-token']) }}
                <div class="optionBox">
                <div class="form-group row block">
                  <div class="col-lg-12">
                    <label class="form-control-label" id="msg"></label>
                  </div>

                </div>
                <div class="form-group row block">
                  <div class="col-lg-3">
                    <label class="form-control-label">Address</label>
                  </div>
                  <div class="col-lg-9">
                   <input type="text" name="transferEmail" id="transferEmail" class="form-control" />
                    <span class="text-danger">{{ $errors->first('transferEmail') }}</span>
                  </div>
                </div>



                

                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="form-control-label">Amount </label>
                  </div>
                  <div class="col-lg-9">
                    <input type="text" name="txtAmount" id="txtAmount" class="form-control"/>
                   <span class="text-danger">{{ $errors->first('txtAmount') }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="form-control-label">Fee</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="text" name="txtFee" id="txtFee" class="form-control" />
                    <span class="text-danger">{{ $errors->first('txtFee') }}</span>
                  </div>
                </div>    

                <div class="form-actions" id="btBlock">
                  <button type="submit" name="btnTransfer" id="btnTransfer" class="btn btn-warning"><i class="icmn-paperplane"></i> Send Token  </button>
                </div>
                    </div>
               {{ Form::close() }}
            </div>
          </section>
        </div>





      </div>
    </div>
    <!-- End Dashboard -->

  </div>

  <!-- Page Scripts -->
  <script>
    $(function() {

        ///////////////////////////////////////////////////////////
        // COUNTERS
        $('.counter-init').countTo({
            speed: 1500
        });

        ///////////////////////////////////////////////////////////
        // ADJUSTABLE TEXTAREA
        autosize($('#textarea'));

        ///////////////////////////////////////////////////////////
        // CUSTOM SCROLL
        if (!cleanUI.hasTouch) {
            $('.custom-scroll').each(function() {
                $(this).jScrollPane({
                    autoReinitialise: true,
                    autoReinitialiseDelay: 100
                });
                var api = $(this).data('jsp'),
                        throttleTimeout;
                $(window).bind('resize', function() {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                });
            });
        }

        ///////////////////////////////////////////////////////////
        // CALENDAR
        $('.example-calendar-block').fullCalendar({
            //aspectRatio: 2,
            height: 450,
            header: {
                left: 'prev, next',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
            buttonIcons: {
                prev: 'none fa fa-arrow-left',
                next: 'none fa fa-arrow-right',
                prevYear: 'none fa fa-arrow-left',
                nextYear: 'none fa fa-arrow-right'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            viewRender: function(view, element) {
                if (!cleanUI.hasTouch) {
                    $('.fc-scroller').jScrollPane({
                        autoReinitialise: true,
                        autoReinitialiseDelay: 100
                    });
                }
            },
            defaultDate: '2016-05-12',
            events: [
                {
                    title: 'All Day Event',
                    start: '2016-05-01',
                    className: 'fc-event-success'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-05-09T16:00:00',
                    className: 'fc-event-default'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-05-16T16:00:00',
                    className: 'fc-event-success'
                },
                {
                    title: 'Conference',
                    start: '2016-05-11',
                    end: '2016-05-14',
                    className: 'fc-event-danger'
                }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                if (!$(this).hasClass('event-clicked')) {
                    $('.fc-event').removeClass('event-clicked');
                    $(this).addClass('event-clicked');
                }
            }
        });

        ///////////////////////////////////////////////////////////
        // CAROUSEL WIDGET
        $('.carousel-widget').carousel({
            interval: 4000
        });

        $('.carousel-widget-2').carousel({
            interval: 6000
        });

        ///////////////////////////////////////////////////////////
        // DATATABLES
        $('#example1').DataTable({
            responsive: true,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
        });

        ///////////////////////////////////////////////////////////
        // CHART 1
        new Chartist.Line(".chart-line", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            series: [
                [12, 9, 7, 8, 5],
                [2, 1, 3.5, 7, 3],
                [1, 3, 4, 5, 6]
            ]
        }, {
            fullWidth: !0,
            chartPadding: {
                right: 40
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });

        ///////////////////////////////////////////////////////////
        // CHART 2
        var overlappingData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    series: [
                        [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                        [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                    ]
                },
                overlappingOptions = {
                    seriesBarDistance: 10,
                    plugins: [
                        Chartist.plugins.tooltip()
                    ]
                },
                overlappingResponsiveOptions = [
                    ["", {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function(value) {
                                return value[0]
                            }
                        }
                    }]
                ];

        new Chartist.Bar(".chart-overlapping-bar", overlappingData, overlappingOptions, overlappingResponsiveOptions);


    });
   
   $('form').submit(function () {
        $("#btBlock").html('<button type="button" name="btn-Transfer" id="btn-Transfer" class="btn btn-warning" disabled="true"><i class="fa fa-refresh fa-spin"></i> Send Token  </button>');  
      
  });

    $('#btnCheck').on('click',function(){
        var emailid=$("#email").val();
        var th=$(this);
        $.ajax({
            url: '/check-user-balance',
            data: {
                varEmail: emailid
            },
            type: 'GET',
            dataType: 'JSON',
            async: true,
            beforeSend: function(msg){
                th.find('i').removeClass('icmn-paperplane').addClass('fa fa-refresh fa-spin');
                
            },
            success: function(data){
                if(data.status=="success"){
                   
                    th.find('i').removeClass('fa fa-refresh fa-spin').addClass('icmn-paperplane');
                    $("#divBalance").html(data.availBalance);
                    $("#balanceLoad").html(data.lockedBalance);
                }else{
                    th.find('i').removeClass('fa fa-refresh fa-spin').addClass('icmn-paperplane');
                    $("#checkMsg").html("<span style='color:red; font-weight: bold; font-size: 16px;'>"+data.error_msg+"<span>");
                    //$("#checkMsg").html(data.error_msg);
                    setTimeout(function(){ $("#checkMsg").html('');}, 1000);
                }
            }
        });
    });

    $('#btnTransfer11').on('click',function(){
        var th=$(this);
        var emailid=$("#transferEmail").val();
        var amount=$("#txtAmount").val();
        var fee=$("#txtFee").val();
       /* if(emailid==''){
            $("#transfer-email").html("Email Address is required.");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }

        if(amount==''){
            $("#txt-amount").html("Amount is required.");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }
        
        if(fee==''){
            $("#txt-fee").html("Fee is required.");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }*/
        
        var flg=confirm("Are you sure for transfer balance:"+amount);
        if(flg){
            $.ajax({
            url: '/send-user-token',
            data: {
                "_token": "{{ csrf_token() }}",
                varEmail: emailid,
                varAmount: amount,
                varFee: fee,
            },
            type: 'POST',
            dataType: 'JSON',
            async: true,
            beforeSend: function(msg){
                th.find('i').removeClass('icmn-paperplane').addClass('fa fa-refresh fa-spin');

            },
            success: function (data){alert(data);
               th.find('i').removeClass('fa fa-refresh fa-spin').addClass('icmn-paperplane');
               if(data.status=="success"){
                   $("#msg").html(data.msg);
               }else{
                  $("#msg").html(data.msg);
               }
                setTimeout(function(){ $("#msg").html('');},4000);
            }
            });
        }
        
    });
</script>
  <!-- End Page Scripts -->
</section>
@endsection