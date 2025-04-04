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
                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <h5 class="text-center">@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h5>
                                    <h5 class="my-3 text-center">@lang('To Get') {{getAmount($deposit->amount)}}  {{__($general->cur_text)}}</h5>
                                    <script
                                        src="{{$data->src}}"
                                        class="stripe-button"
                                        @foreach($data->val as $key=> $value)
                                        data-{{$key}}="{{$value}}"
                                        @endforeach
                                    >
                                    </script>
                                </form>
                             </div>
                        </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>
    
@endsection
@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        (function ($) {
            "use strict";
            $('button[type="submit"]').addClass("btn btn--base w-100");
        })(jQuery);
    </script>
@endpush
