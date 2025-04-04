@php
    $content = @getContent('cta.content',true)->data_values;
    $elements = @getContent('cta.content',false,'',1);
@endphp

<section class="pt-100">
    <div class="container">
      <div class="row gy-5">
        <div class="col-lg-6">
          <div class="single-cta">
            <div class="row align-items-center">
              <div class="col-sm-7 pb-sm-4">
                <h2 class="title">{{__(@$content->heading_one)}}</h2>
                <p class="mt-2">{{__(@$content->sub_heading_one)}}</p>
                <a href="{{url(@$content->button_link_one)}}" class="btn btn--base mt-4">{{__(@$content->button_text_one)}}</a>
              </div>
              <div class="col-sm-5">
                <div class="cta-thumb">
                  <img src="{{getImage('assets/images/frontend/cta/'.@$content->image_one,'768x1270')}}" alt="image">
                </div>
              </div>
            </div>
          </div><!-- single-cta end -->
        </div>
        <div class="col-lg-6">
          <div class="single-cta">
            <div class="row align-items-center">
              <div class="col-sm-7 pb-sm-4">
                <h2 class="title">{{__(@$content->heading_two)}}</h2>
                <p class="mt-2">{{__(@$content->sub_heading_two)}}</p>
                <a href="{{url(@$content->button_link_two)}}" class="btn btn--base mt-4">{{__(@$content->button_text_two)}}</a>
              </div>
              <div class="col-sm-5">
                <div class="cta-thumb">
                  <img src="{{getImage('assets/images/frontend/cta/'.@$content->image_two,'768x1270')}}" alt="image">
                </div>
              </div>
            </div>
          </div><!-- single-cta end -->
        </div>
      </div>
    </div>
  </section>