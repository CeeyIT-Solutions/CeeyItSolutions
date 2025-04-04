@php
$content = optional(getContent('breadcrumb.content',true))->data_values;
@endphp
{{-- style="background-image: url('{{getImage('assets/images/frontend/breadcrumb/'. @$content->background_image,'1920x1080')}}');"
--}}
<section class="inner-hero bg_img">
    <div class="container">
        {{-- <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2 class="page-title text-white">{{__($pageTitle)}}</h2>
        <ul class="page-breadcrumb justify-content-center">
            <li><a href="{{route('home')}}">@lang('Home')</a></li>
            <li>{{__($pageTitle)}}</li>
        </ul>
    </div>
    </div> --}}
    </div>
</section>