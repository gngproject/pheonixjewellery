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
                        @foreach ($transaction as $item)
                        <div>
                            <input type="hidden" id="transactionid" name="transactionid" value="{{$item->code}}">
                        </div>
                        @endforeach
                        <div style="margin-top: 50px; margin-bottom: 50px; margin-left:300px;" class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" id="sgoplus-iframe" src="" scrolling="no" frameborder="0" height="100" width="500"></iframe>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://sandbox-kit.espay.id/public/signature/js"></script>

<script type="text/javascript">
window.onload = function() {
    var pos         = $("#sgopayment input[type='radio']:checked").val();
    // var posLength   = pos.length;
    // var n           = pos.indexOf(":");
    // var bankCode    = "014,"
    // var productCode = "BCAATM";

    var data = {
        key         : "bd1e4ce8945808f8e6ef9c50c834d0c2",
        backUrl     : "{{ route('payment.done') }}",
        display     : "option",
        paymentId   : document.getElementById("transactionid").value,
        bankCode    : $("#sgopayment input[type='radio']:checked").val(),
        // bankProduct : productCode
    },

        sgoPlusIframe = document.getElementById("sgoplus-iframe");
        sgoPlusIframe.src = SGOSignature.getIframeURL(data);
        SGOSignature.receiveForm();
};

</script>
@endsection