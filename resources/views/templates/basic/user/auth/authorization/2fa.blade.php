@extends($activeTemplate .'layouts.auth')

@php
    $content = getContent('login.content',true)->data_values;
@endphp

@section('content')
    <section class="account-section">
        <div class="left">
          <div class="top-el">
            <img src="{{getImage('assets/images/frontend/login/'.@$content->texture_image_up,'1595x645')}}" alt="image">
          </div>
          <div class="bottom-el">
            <img src="{{getImage('assets/images/frontend/login/'.@$content->texture_image_down,'1595x645')}}" alt="image">
          </div>
          <div class="account-form-area">
            <div class="text-center">
              <a href="{{url('/')}}" class="account-logo"><img src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="image"></a>
            </div>
            <form class="account-form mt-5" method="POST" action="{{route('user.go2fa.verify')}}">
                @csrf
                <div class="form-group">
                    <p class="text-center">@lang('Current Time'): {{\Carbon\Carbon::now()}}</p>
                </div>

                <div class="form-group">
                    <label>@lang('Verification Code')</label>
                    <input type="text" name="code" class="form--control" id="code">
                </div>

              <div class="form-group mt-4">
                <button type="submit" class="btn btn--base w-100">@lang('Verify')</button>
              </div>
              
            </form>
          </div>
        </div>
        <div class="right bg_img" style="background-image: url('{{getImage('assets/images/frontend/login/'.@$content->background_image,'1920x1280')}}');">
          <div class="content text-center">
            <h2 class="title text-white">@lang('2FA Verification')</h2>
          
          </div>
        </div>
    </section> 
@endsection




@push('script')
<script>
    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          
              $(this).val(function (index, value) {
                 value = value.substr(0,7);
                  return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
              });
          
      });
    })(jQuery)
</script>
@endpush