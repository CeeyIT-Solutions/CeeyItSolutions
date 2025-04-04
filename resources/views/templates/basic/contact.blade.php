@extends($activeTemplate.'layouts.frontend')

@php
    $contact = @getContent('contact_us.content',true)->data_values;
    $social = getContent('social_icon.element',false,'',1);
@endphp

@section('content')
<section class="pt-100 pb-100 dot--bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-header">
            <div class="section-subtitle border-left text--base">{{__(@$contact->title)}}</div>
            <h2 class="section-title">{{__(@$contact->heading)}}</h2>
          </div>
        </div>
      </div><!-- row end -->
      <div class="contact-area">
        <div class="row gy-5">
          <div class="col-lg-6">
            <div class="map-area">
              <iframe src = "https://maps.google.com/maps?q={{@$contact->latitude}},{{@$contact->longitude}}&hl=es;z=14&amp;output=embed"></iframe>
            </div>
          </div>
          <div class="col-lg-6 ps-lg-4">
            <h3 class="mb-3">@lang('Let\'s talk')</h3>
            <form method="post" action="">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Name')</label>
                    <input name="name" type="text" placeholder="@lang('Your Name')" class="form--control" value="{{ old('name') }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Email')</label>
                    <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form--control" value="{{old('email')}}" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>@lang('Subject')</label>
                    <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>@lang('Your Message')</label>
                    <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form--control">{{old('message')}}</textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
                </div>
              </div>
            </form>
          </div>
        </div><!-- row end -->
      </div><!-- contact-area end -->

      <div class="row gy-4 justify-content-center pt-100">
        <div class="col-lg-4 col-md-6">
          <div class="contact-card">
            <div class="contact-card__header">
              <div class="icon">
                <i class="las la-map-marked-alt"></i>
              </div>
              <h3 class="title">@lang('Location')</h3>
            </div>
            <p>{{@$contact->address}}</p>
          </div><!-- contact-card end -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-card">
            <div class="contact-card__header">
              <div class="icon">
                <i class="las la-address-card"></i>
              </div>
              <h3 class="title">@lang('Email & Phone')</h3>
            </div>
            <p><a href="email:{{@$contact->email_address}}">{{@$contact->email_address}}</a></p>
            <p><a href="tel:{{@$contact->contact_number}}">{{@$contact->contact_number}}</a></p>
          </div><!-- contact-card end -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="contact-card">
            <div class="contact-card__header">
              <div class="icon">
                <i class="las la-map-marked-alt"></i>
              </div>
              <h3 class="title">@lang('Social Contacts')</h3>
            </div>
            <ul class="social-media-list d-flex align-items-center">
              @foreach ($social as $item)
              <li><a target="_blank" href="{{@$item->data_values->url}}" data-toggle="tooltip" title="{{__($item->data_values->title)}}">
                @php
                    echo @$item->data_values->social_icon;
                @endphp  
              </a></li>
              @endforeach
            </ul>
          </div><!-- contact-card end -->
        </div>
      </div><!-- row end -->
    </div>
  </section>

@endsection




