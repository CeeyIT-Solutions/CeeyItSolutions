@extends($activeTemplate.'layouts.master')


@section('content')

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row gy-4">
        @foreach($gatewayCurrency as $data)
        <div class="col-lx-3 col-lg-4 col-sm-6">
          <div class="payment-card has--link">
            <a href="javascript:void(0)" class="item--link deposit" data-bs-toggle="modal" data-bs-target="#payment-modal"
            data-id="{{$data->id}}"
            data-name="{{$data->name}}"
            data-currency="{{$data->currency}}"
            data-method_code="{{$data->method_code}}"
            data-min_amount="{{getAmount($data->min_amount)}}"
            data-max_amount="{{getAmount($data->max_amount)}}"
            data-base_symbol="{{$data->baseSymbol()}}"
            data-fix_charge="{{getAmount($data->fixed_charge)}}"
            data-percent_charge="{{getAmount($data->percent_charge)}}"
            
            ></a>
            <div class="payment-card__thumb">
              <img src="{{$data->methodImage()}}" alt="image">
            </div>
            <div class="payment-card__content">
              <h4 class="title">{{__($data->name)}}</h4>
            </div>
          </div><!-- payment-card end -->
        </div>
        @endforeach
       
      </div>
    </div>
  </section>
  <!-- payment section end -->


  <!-- Modal -->
  <div class="modal fade" id="payment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{route('user.deposit.insert')}}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title method-name"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger depositLimit"></p>
                <p class="text-danger depositCharge"></p>
                <div class="form-group">
                    <input type="hidden" name="currency" class="edit-currency">
                    <input type="hidden" name="method_code" class="edit-method-code">
                </div>
                <div class="form-group">
                    <label>@lang('Enter Amount'):</label>
                    <div class="input-group">
                        <input id="amount" type="text" class="form--control" name="amount" placeholder="@lang('Amount')" required  value="{{old('amount')}}">
                        <span class="input-group-text">{{__($general->cur_text)}}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('Close')</button>
              <button type="submit" class="btn btn--base">@lang('Submit')</button>
            </div>
          </div>
      </form>
    </div>
  </div>





@endsection



@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.deposit').on('click', function () {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{$general->cur_text}}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });
        })(jQuery);
    </script>
@endpush
