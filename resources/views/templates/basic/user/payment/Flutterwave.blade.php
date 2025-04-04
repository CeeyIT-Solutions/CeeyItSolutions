@extends($activeTemplate.'layouts.master')

@section('content')

<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="card custom--card">
                    <div class="card-body px-4 py-3">
                        <h5 class="title mb-2"><span>@lang('Payment Preview')</span></h5>
                        <img src="{{$deposit->gatewayCurrency()->methodImage()}}" class="w-100" alt="@lang('Image')" >
                         <div class="text-center mt-4">
                            <h5>@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h5>
                            <h5 class="my-3">@lang('To Get') {{getAmount($deposit->amount)}}  {{__($general->cur_text)}}</h5>
                            <button type="button" class="btn btn--base w-100" id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                         </div>
                    </div>
                 </div>
             </div>
        </div>
    </div>
</section>


@endsection
@push('script')
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        "use strict"
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{$data->API_publicKey}}";

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{$data->customer_email}}",
                amount: "{{$data->amount }}",
                customer_phone: "{{$data->customer_phone}}",
                currency: "{{$data->currency}}",
                txref: "{{$data->txref}}",
                onclose: function () {
                },
                callback: function (response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    } else {
                        window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                    }
                        // x.close(); // use this to close the modal immediately after payment.
                    }
                });
        }
    </script>
@endpush