@php
    $content = getContent('overview.content',true)->data_values;
    $elements = getContent('overview.element',false,'',1);
@endphp

<section>
    <div class="cta-area pt-100 pb-100 bg--base">
      <div class="el"><img src="{{getImage('assets/images/frontend/overview/'.@$content->background_image,'1600x640')}}" alt="image"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section-header text-center">
              <h2 class="section-title text-white">{{__(@$content->heading)}}</h2>
              <a href="{{url(@$content->button_link)}}" class="btn btn-light mt-4">{{__(@$content->button_text)}}</a>
            </div>
          </div>
        </div><!-- row end -->
      </div>
    </div><!-- cta-area end -->
    <div class="overview-area pb-4">
      <div class="container">
        <div class="overview-wrapper">
          <div class="row gy-4 align-items-center justify-content-center">
            @foreach ($elements as $el)
                
            <div class="col-lg-3 col-6 d-flex justify-content-center">
              <div class="overview-item">
                <div class="overview-item__icon">
                  <img src="{{getImage('assets/images/frontend/overview/'.@$el->data_values->icon,'55x55')}}" alt="image">
                </div>
                <div class="overview-item__content">
                  <h4 class="counter-amount">{{__(@$el->data_values->count)}}</h4>
                  <span>{{__(@$el->data_values->title)}}</span>
                </div>
              </div><!-- overview-item end -->
            </div>
            @endforeach
            
          </div><!-- row end -->
        </div><!-- overview-wrapper end -->
      </div>
    </div><!-- overview-area end -->
  </section>