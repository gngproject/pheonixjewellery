@extends('main-layout.template')

@section('content')
<section class="container">
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <!--@foreach ($transaction as $item)-->
                        <div>
                            
                            <input type="hidden" id="transactionid" name="transactionid" value="{{$transaction->code}}">
                        </div>
                        <!--@endforeach-->
                        <div style="margin-top: 1.125rem; margin-left:5rem; padding: 10% auto" class="embed-responsive embed-responsive-16by9 payment-method">
                            <iframe class="embed-responsive-item" id="sgoplus-iframe" src="" scrolling="yes" frameborder="0" height="200" width="500"></iframe>
                        </div>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
<script type="text/javascript" src="https://sandbox-kit.espay.id/public/signature/js"></script>

<script type="text/javascript">
window.onload = function() {
    var pos         = $("#sgopayment input[type='radio']:checked").val();
    // var posLength   = pos.length;
    // var n           = pos.indexOf(":");
    // var bankCode    = "014,"
    // var productCode = "BCAATM";
    // document.getElementById('transactionid').value;
    // console.log("data"+$('#transactionid').val());
    var data = {
        key         : "bd1e4ce8945808f8e6ef9c50c834d0c2",
        backUrl     : "{{ route('payment.done') }}",
        display     : "option",
        // paymentId   : document.getElementById('transactionid').value,
        paymentId: $('#transactionid').val(),
        bankCode    : $("#sgopayment input[type='radio']:checked").val(),
    };

        sgoPlusIframe = document.getElementById("sgoplus-iframe");
        sgoPlusIframe.src = SGOSignature.getIframeURL(data);
        SGOSignature.receiveForm();
};

</script>

@endsection