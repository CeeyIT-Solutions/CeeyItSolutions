@extends($activeTemplate.'layouts.master')
@section('content')

@php
    $payment = session('payment') ?? null;
@endphp

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card custom--card">
            <div class="card-header px-4 py-3">
              <h4>@lang('Payment Summery')</h4>
            </div>
            <div class="card-body px-4 py-3">
             
              <ul class="payment-details-list caption-list">
                <li>
                  <span class="caption">@lang('Amount')</span>
                  <span class="value text-end">{{getAmount($data->amount)}} {{__($general->cur_text)}}</span>
                </li>
                <li>
                  <span class="caption">@lang('Charge')</span>
                  <span class="value text--danger text-end">{{getAmount($data->charge)}} {{__($general->cur_text)}}</span>
                </li>
                <li>
                  <span class="caption">@lang('Payable')</span>
                  <span class="value text--success text-end">{{getAmount($data->amount + $data->charge)}} {{__($general->cur_text)}}</span>
                </li>
                <li>
                  <span class="caption">@lang('Conversion Rate')</span>
                  <span class="value text-end">1 {{__($general->cur_text)}} = {{getAmount($data->rate)}}  {{__($data->baseCurrency())}}</span>
                </li>
                <li>
                  <span class="caption">@lang('In') {{$data->baseCurrency()}}</span>
                  <span class="value text--success text-end">{{getAmount($data->final_amo)}}</span>
                </li>
                @if($data->gateway->crypto==1)
                <li>
                    <span class="caption">@lang('Conversion with')</span>
                    <span class="value text--success text-end"> {{ __($data->method_currency) }} @lang('and final value will Show on next step') </span>
                </li>
                @endif
               </ul>
               @if( 1000 >$data->method_code)
               <a href="{{route('user.deposit.confirm')}}" class="btn btn--base w-100 mt-4">@lang('Confirm Payment')</a>
              @else
               <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn--base w-100 mt-4">@lang('Confirm Payment')</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection


