@extends('admin.main')
@section('title', 'Dashboard')
@section('content')
<section class="page-content">
  <div class="page-content-inner">

    <!-- Dashboard -->
    <div class="dashboard-container">
      <div class="row">
        <div class="col-lg-12">


            <div class="widget widget-four background-transparent">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12col-xs-12">
                    <div class="step-block ">
                        
                        <div class="step-desc pull-center">
                            
                            <p>
                                Welcome Generic Coin
                            </p>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>


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

    $('#btnTransfer').on('click',function(){
        var th=$(this);
        var emailid=$("#transferEmail").val();
        var amount=$("#txtAmount").val();
        var fee=$("#txtFee").val();
        if(emailid==''){
            $("#msg").html("<span style='color: red; font-weight: bold; font-size: 16px;'>Email Address is required.<span>");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }

        if(amount==''){
            $("#msg").html("<span style='color:red; font-weight: bold; font-size: 16px;'>Amount is required.<span>");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }
        
        if(fee==''){
            $("#msg").html("<span style='color:red; font-weight: bold; font-size: 16px;'>Fee is required.<span>");

            setTimeout(function(){ $("#msg").html('');},1000);
            return;
        }
        
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
            success: function (data){
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