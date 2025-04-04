@php
    $latestcourse = getContent('latestcourse.content',true)->data_values;
    $latestCourses = \App\Models\Course::latestCourses();
@endphp

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title">{{__(@$latestcourse->heading)}}</h2>
            <p class="mt-2">{{__(@$latestcourse->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="course-slider">
       @foreach ($latestCourses as $course)
        @if ($course->chapter_count > 0 && $course->lectures_count > 0)
        <div class="single-slide">
          <div class="course-card">
            <div class="course-card__thumb">
              <img src="{{getImage(imagePath()['course']['path'].'/thumb_'.$course->thumbnail,imagePath()['course']['thumb_size'])}}" alt="image">
              <div class="course-type"><i class="las la-file-video"></i></div>
              <span class="course-tag fs--12px">{{__($course->subcategory->name)}}</span>
            </div>
            <div class="course-card__content">
              <h6 class="course-title"><a href="{{route('course.details',[$course->id,$course->slug])}}">{{__($course->title)}}</a></h6>
              <div class="course-mentor mt-3">
                <div class="left">
                  <div class="teacher">
                    <div class="thumb"><img src="{{getImage(imagePath()['profile']['user']['path'].'/'.$course->author->image,'350x350')}}" alt="image"></div>
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
        @endif     
       @endforeach

      </div><!-- row end -->
    </div>
  </section>