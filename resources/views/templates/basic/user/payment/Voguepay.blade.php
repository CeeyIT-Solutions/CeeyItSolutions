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
                                <h5 class="mt-4">@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h5>
                                <h5 class="my-3">@lang('To Get') {{getAmount($deposit->amount)}}  {{__($general->cur_text)}}</h5>
                                <button type="button" class="btn btn--base w-100" id="btn-confirm">@lang('Pay Now')</button>
                             </div>
                        </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>
    
@endsection
@push('script')
    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        "use strict";
        var closedFunction = function() {
        }
        var successFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }
        var failedFunction=function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '60a4ecd9bbc77',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        (function ($) {
            
            $('#btn-confirm').on('click', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        })(jQuery);
    </script>
@endpush
