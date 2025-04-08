@php
  $footer = optional(getContent('footer.content', true))->data_values;
  $social = getContent('social_icon.element', false, '', 1);
  $policies = getContent('policies.element', false, '', 1);
@endphp
<style>
  .footer-bg {
    background-color: #222126;
    color: #ffffff;
  }

  .footer-links {
    margin: 0;
    padding: 0;
  }

  .footer-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 19.18px;
    width: 46.36px
  }

  .footer-links li {
    padding: 12px;
    border: 0.61px solid #FFFFFF80;
    border-radius: 6.1px;
    list-style: none;
  }

  .footer-links li a {}

  .privacy-policy {
    font-family: 'AtypDisplay', sans-serif;
    font-weight: 400;
    font-size: 1rem;
    line-height: 26.64px;
    text-align: center;
    color: #ffffff;
    text-decoration: none;
    /* padding-right: 60px; */
  }
</style>
{{-- style="background-image:
url('{{getImage('assets/images/frontend/footer/'.@$footer->background_image,'1920x1280')}}');"
--}}
<!-- <footer class="footer bg_img">
  <div class="footer__top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <a href="{{url('/')}}" class="footer-logo"><img src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="image"></a>
          {{-- <ul class="footer-menu d-flex flex-wrap justify-content-center mt-4">
              @foreach($pages as $k => $data)
               <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
          @endforeach
          <li><a href="{{route('courses')}}">@lang('Courses')</a></li>
          <li><a href="{{route("blog")}}">@lang('Blog')</a></li>
          <li><a href="{{route('faq')}}">@lang('Faq')</a></li>
          @auth
          <li><a href="{{route('ticket')}}">@lang('Support')</a></li>
          @endauth
          @guest
          <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
          @endguest
          </ul> --}}
          <ul class="social-links d-flex flex-wrap align-items-center mt-4 justify-content-center">
            @foreach ($social as $item)
            <li><a target="_blank" href="{{@$item->data_values->url}}" data-toggle="tooltip" title="{{__($item->data_values->title)}}">
                @php
                echo @$item->data_values->social_icon;
                @endphp
              </a></li>

            @endforeach

          </ul>

          <div class="col-lg-6 mx-auto mt-3">
            {{-- <p class="text-white">{{__(@$footer->short_details)}}</p> --}}
            <ul class="footer-menu d-flex flex-wrap justify-content-center">
              @foreach ($policies as $links)
              <li><a href="{{route('links',[slug(@$links->data_values->title),$links->id])}}">{{__(@$links->data_values->title)}}</a></li>
              @endforeach

            </ul>
          </div>

          <div style="margin-bottom:-20px;margin-top:10px" class="text-md-start text-center mt-3">
            <p class="text-white text-center">{{date('Y')}} © {{$general->sitename}} . @lang('All Right Reserved')</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="footer__bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-md-start text-center">
          <p class="text-white">{{date('Y')}} © {{$general->sitename}} . @lang('All Right Reserved')</p>
  </div>
  <div class="col-md-6">

  </div>
  </div>
  </div>
  </div> --}}
</footer> -->

<!-- Footer -->
<footer>
  <div class="container-fluid footer-bg  text-white py-5">
    <div class="container mx-auto">
      <div class="row justify-content-center">
        <div class="col-auto mb-4">
          <img src="{{asset('assets/images/ceeyit_footer_logo.svg')}}" alt="Footer logo Image">
        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-auto">
          <ul class="footer-links">
            <li>
              <a href="https://www.linkedin.com/company/ceeyit-solutions/?viewAsMember=true" target="_blank"
                class="text-white">
                <i class="fa-brands fa-linkedin">
                </i></a>
            </li>
            <li>
              <a href="https://x.com/ceeyitsolutions" target="_blank" class="text-white">
                <i class="fa-brands fa-twitter">
                </i></a>
            </li>
            <li>
              <a href="https://www.instagram.com/ceeyit_solutions/" target="_blank" class="text-white">
                <i class="fa-brands fa-instagram">
                </i> </a>
            </li>
            <li>
              <a href="mailto:ceeyitsolutions@gmail.com" target="_blank" class="text-white">
                <i class="fa-solid fa-envelope">
                </i></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-5 text-center">
        <div class="">
          <p class="mb-3 d-flex justify-content-evenly" style="text-wrap: nowrap;">
            @foreach ($policies as $links)
        <a class="privacy-policy"
          href="{{route('links', [slug(@$links->data_values->title), $links->id])}}">{{__(@$links->data_values->title)}}</a>
      @endforeach
          </p>
        </div>
      </div>
      <div class="mt-4 text-center">
        <div class="">
          <p class="mb-3 d-flex justify-content-evenly" style="text-wrap: nowrap;">
            <a class="privacy-policy">{{date('Y')}} © {{$general->sitename}}</a>
            <a class="privacy-policy"> @lang('All Right Reserved')</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>