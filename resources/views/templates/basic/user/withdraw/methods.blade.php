@extends($activeTemplate.'layouts.master')

@section('content')

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row gy-4 justify-content-center">
        @foreach($withdrawMethod as $data)

        <div class="col-lg-3">
          <div class="payment-card">
            <div class="payment-card__thumb">
              <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image,imagePath()['withdraw']['method']['size'])}}" alt="image">
            </div>
            <div class="payment-card__content">
              <h6 class="title">{{__($data->name)}}</h6>
            </div>
            <ul class="list-group text-center mt-3">
                <li class="list-group-item">@lang('Limit')
                    : {{getAmount($data->min_limit)}}
                    - {{getAmount($data->max_limit)}} {{__($general->cur_text)}}</li>

                <li class="list-group-item"> @lang('Charge')
                    - {{getAmount($data->fixed_charge)}} {{__($general->cur_text)}}
                    + {{getAmount($data->percent_charge)}}%
                </li>
                <li class="list-group-item">@lang('Processing Time')
                    - {{$data->delay}}</li>
            </ul>
            <a href="javascript:void(0)" class="btn btn-md btn--base w-100 mt-3 withdraw" data-bs-toggle="modal" data-bs-target="#payment-modal"
                data-id="{{$data->id}}"
                data-resource="{{$data}}"
                data-min_amount="{{getAmount($data->min_limit)}}"
                data-max_amount="{{getAmount($data->max_limit)}}"
                data-fix_charge="{{getAmount($data->fixed_charge)}}"
                data-percent_charge="{{getAmount($data->percent_charge)}}"
                data-base_symbol="{{__($general->cur_text)}}"
            >@lang('Withdraw Now')</a>
          </div><!-- payment-card end -->
        </div>
        @endforeach
       
      </div>
    </div>
  </section>

    <div class="modal fade" id="payment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{route('user.withdraw.money')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title method-name">@lang('Withdraw')</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger withdrawLimit"></p>
                    <p class="text-danger withdrawCharge"></p>
                    <div class="form-group">
                        <input type="hidden" name="currency"  class="edit-currency form-control">
                        <input type="hidden" name="method_code" class="edit-method-code  form-control">
                    </div>
                    <div class="form-group">
                        <label>@lang('Enter Amount'):</label>
                        <div class="input-group">
                            <input id="amount" type="text" class="form--control" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="{{old('amount')}}">
                            <span class="input-group-text addon-bg currency-addon">{{__($general->cur_text)}}</span>
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
            $('.withdraw').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var withdrawLimit = `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{__($general->cur_text)}}`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge = `@lang('Charge'): ${fixCharge} {{__($general->cur_text)}} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>

@endpush

