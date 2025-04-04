@php
    $content = @getContent('mentors.content',true)->data_values;
    $mentors = \App\Models\User::where('is_instructor',1)->where('status',1)->withCount('courses')->inRandomOrder()->take(4)->get();
@endphp


<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title">{{__(@$content->heading)}}</h2>
            <p class="mt-2">{{__(@$content->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row gy-4 justify-content-center">
        @foreach ($mentors  as $mentor)
        <div class="col-lg-3 col-sm-6">
          <div class="mentor-card">
            <div class="mentor-card__thumb">
              <img src="{{getImage('assets/images/user/profile/'.$mentor->image,'350x350')}}" alt="image">
            </div>
            <div class="mentor-card__content">
              <h4 class="name"><a href="javascript:void(0)">{{$mentor->fullname}}</a></h4>
              <span class="text--base">{{ $mentor->courses_count }} @lang('Courses')</span>
            </div>
          </div><!-- mentor-card end -->
        </div>
        @endforeach
      </div>
    </div>
  </section>