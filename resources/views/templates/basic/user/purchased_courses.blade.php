@extends($activeTemplate.'layouts.master')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
    <div class="row justify-content-center gy-4">
        @forelse ($user->userCourses as $course)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="short-course-card">
            <div class="thumb">
                <img src="{{getImage(imagePath()['course']['path'].'/thumb_'.$course->thumbnail,imagePath()['course']['preview_size'])}}" alt="image">
            </div>
            <div class="content">
                <h6 class="title"><a href="{{route('user.course.play',[$course->id,$course->slug])}}">{{$course->title}}</a></h6>
                <a href="#0" class="text-muted fs--14px">{{@$course->author->name}}</a>
                <div class="row mt-2">
                <div class="col-6">
                    <a href="{{route('user.course.play',[$course->id,$course->slug])}}" class="text--base">@lang('Start Course')</a>
                </div>
               
                </div>
            </div>
            </div><!-- short-course-card end -->
        </div>
        @empty
        <div class="col-xl-3 col-lg-4 col-sm-6">
           <h5> @lang('No purchased courses!!')</h5>
        </div>
        @endforelse
    </div>
    </div>
</div>
@stop