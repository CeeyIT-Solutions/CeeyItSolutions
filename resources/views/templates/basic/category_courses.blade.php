@extends($activeTemplate.'layouts.frontend')

@section('content')
    
<section class="pt-100 pb-100">
    <div class="container">
     
      <div class="course-slider">
       @forelse ($courses as $course)
      
        <div class="single-slide">
          <div class="course-card">
            <div class="course-card__thumb">
              <img src="{{getImage(imagePath()['course']['path'].'/thumb_'.$course->thumbnail,imagePath()['course']['thumb_size'])}}" alt="image">
              <div class="course-type"><i class="las la-file-video"></i></div>
              <span class="course-tag fs--12px">{{__($course->subcategory->name)}}</span>
            </div>
            <div class="course-card__content">
              <h6 class="course-title mt-2"><a href="{{route('course.details',[$course->id,$course->slug])}}">{{__($course->title)}}</a></h6>
              <div class="course-mentor mt-3">
                <div class="left">
                  <div class="teacher">
                    <div class="thumb"><img src="{{getImage('assets/images/user/'.$course->author->image,'350x350')}}" alt="image"></div>
                    <p class="name">{{$course->author->fullname}}</p>
                  </div>
                </div>
                <div class="right">
                  <span class="fs--14px">{{number_format_short($course->courseUsers->count())}} @lang('enrolled')</span>
                </div>
              </div>
              <div class="course-footer">
                <div class="left">
                  <div class="ratings d-flex align-items-center fs--14px">
                    @php
                        echo ratings($course->avgRating());
                    @endphp
                    <span class="ms-2">({{$course->avgRating()}})</span>
                  </div>
                </div>
                <div class="right">
                  <div class="course-price text--base">{{$course->price ? $general->cur_sym.showAmount($course->price) : 'Free' }}</div>
                </div>
              </div>
            </div>
          </div><!-- course-card end -->
        </div>
        @empty
        <div class="text-center">
            <h6>@lang('No courses found')</h6>
        </div>
       @endforelse
    
      </div><!-- row end -->
      <div class="mt-5 text-end">
        {{paginateLinks($courses,'')}}
     </div>
     
    </div>
  
  </section>
@endsection