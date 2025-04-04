@php
    $content = getContent('testimonial.content',true)->data_values;
    $elements = getContent('testimonial.element',false,'',1);
@endphp
{{-- style="background-image: url('{{getImage('assets/images/frontend/testimonial/'.@$content->background_image)}}');" --}}
<section class="pt-100 pb-100 bg_img " style="background-color: #97979730" >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section-header">
            <h2 class="section-title" style="font-size:20px;text-align:left">{{__(@$content->heading)}}</h2>
            {{-- <p class="mt-3 text-white">{{__(@$content->sub_heading)}}</p> --}}
          </div>
        </div>
      </div>
      <div class="testimonial-slider">
          @foreach ($elements as $el)
          <div class="single-slide">
            <div class="testimonial-card">
              <div class="row">
                <div class="col-md-5 col-sm-12">
                   <div class="thumb">
                    <img src="{{getImage("assets/images/frontend/testimonial/".@$el->data_values->author_image)}}" alt="image">
                  </div>
                </div>
                <div class="col-md-5 col-sm-12">
                  <br>
                   <h6 class="name text--base mt-3" style="text-align: left;font-size:26px">{{@$el->data_values->author_name}}</h6>
              <p class="details  mt-3"  style="text-align: left;font-size:16px">{{__(@$el->data_values->quote)}}</p>
             <br>
              <p  style="text-align: left;font-size:14px;">{{@$el->data_values->designation}}</p>  
                </div>
                <div class="col-md-2 col-sm-12"></div>
              </div>
             
            </div>
          </div>
          @endforeach
      </div>
    </div>
  </section>