
<div class="cwt__footer visible-footer">
    <div class="cwt__footer__bottom">
        <div class="row">
            <div class="col-md-12 margin-bottom-20">
                <div class="cwt__footer__company text-center">
                    <span>
                        © 2018 All rights reserved
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-backdrop"><!-- --></div>

@section('jscript')
<script type="text/javascript">
$( "#s_amt" ).keyup(function() {
var data = document.getElementById('s_amt').value * 0.10
document.getElementById('usd_amount').innerHTML = ""+ parseFloat(data.toFixed(3))

})
</script>
@endsection
