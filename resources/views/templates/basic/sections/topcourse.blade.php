@php
    $topCourse = getContent('topcourse.content',true)->data_values;
    $topCourses = \App\Models\Course::topCourses();
@endphp

<section class="pt-100 pb-100 section--bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title">{{__(@$topCourse->heading)}}</h2>
            <p class="mt-2">{{__(@$topCourse->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row gy-4 justify-content-center">
        @foreach ($topCourses as $course)
        @if ($course->chapter_count > 0 && $course->lectures_count > 0)
        <div class="col-xl-3 col-lg-4 col-sm-6">
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
                  <div class="course-price text--base">
                    @if ($course->value == 1 && $course->discount)
                    <span class="course-price me-2 text-whit"> {{$general->cur_sym}}{{getAmount($course->discountPrice())}}</span>
                    <del class="me-2 del">{{$general->cur_sym}}{{getAmount($course->price)}}</del>
                    @else
                    {{$course->value == 1 ? $general->cur_sym.showAmount($course->price) : 'Free' }}
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div><!-- course-card end -->
        </div>
        @endif     
        @endforeach
      </div><!-- row end -->
      <div class="row mt-5">
        <div class="col-lg-12 text-center">
          <a href="{{route('courses')}}" class="btn btn-outline--base">@lang('View All Courses')</a>
        </div>
      </div>
    </div>
  </section>