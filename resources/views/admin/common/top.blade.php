<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> @yield('title')</title>
<link href="{{ asset('assets/img/favicon.144x144.png') }}" rel="apple-touch-icon" type="image/png" sizes="144x144">
<link href="{{ asset('assets/img/favicon.114x114.png') }}" rel="apple-touch-icon" type="image/png" sizes="114x114">
<link href="{{ asset('assets/img/favicon.72x72.png') }}" rel="apple-touch-icon" type="image/png" sizes="72x72">
<link href="{{ asset('assets/img/favicon.57x57.png') }}" rel="apple-touch-icon" type="image/png">
<link href="{{ asset('assets/img/favicon.png') }}" rel="icon" type="image/png">
<link href="{{ asset('assets/img/favicon.ico') }}" rel="shortcut icon">

<!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Vendors Styles -->
<!-- v1.0.0 -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Clean UI Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/common/css/source/main.css') }}">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
<!-- Vendors Scripts -->
<!-- v1.0.0 -->
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-mousewheel/jquery.mousewheel.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jscrollpane/script/jquery.jscrollpane.min.js') }}"></script>
<script src="{{ asset('assets/vendors/spin.js/spin.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-countTo/jquery.countTo.js') }}"></script>
<!-- Clean UI Scripts -->
<script src="{{ asset('assets/common/js/common.js') }}"></script>
<script src="{{ asset('assets/common/js/demo.temp.js') }}"></script>

<script type="text/javascript">
$( "#s_amt" ).keyup(function() {
var data = document.getElementById('s_amt').value * 0.10
document.getElementById('usd_amount').innerHTML = "<b>= $<b>"+ parseFloat(data.toFixed(3))

})
</script>
</head>
