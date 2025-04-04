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
                                <form action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" class="text-center">
                                    @csrf
                                    <h5>@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</h5>
                                    <h5 class="my-3">@lang('To Get') {{getAmount($deposit->amount)}}  {{__($general->cur_text)}}</h5>
                                    <button type="button" class="btn  btn--base w-100" id="btn-confirm">@lang('Pay Now')</button>
                                    <script
                                        src="//js.paystack.co/v1/inline.js"
                                        data-key="{{ $data->key }}"
                                        data-email="{{ $data->email }}"
                                        data-amount="{{$data->amount}}"
                                        data-currency="{{$data->currency}}"
                                        data-ref="{{ $data->ref }}"
                                        data-custom-button="btn-confirm"
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
