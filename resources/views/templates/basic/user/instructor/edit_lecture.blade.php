@extends($activeTemplate.'layouts.master')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-end mb-3">
            <a class="btn btn--base btn-sm mb-2" href="{{route('user.course.lectures',[$course->slug,$chapter->slug])}}"> <i class="las la-backward"></i> @lang('Back')</a>
           
        </div>
      <div class="custom--card p-4">
          <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('user.course.lecture.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
        
                            <input type="hidden" name="chapter_id" value="{{$chapter->id}}">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="lecture_id" value="{{$lecture->id}}">
                            <div class="form-group">
                                <label >@lang('Lecture Title')</label>
                                <input class="form--control" type="text" name="title" placeholder="@lang('Lecture Title')" required value="{{$lecture->title}}">
                            </div>
                            <div class="form-group">
                                <label >@lang('Description')</label>
                                <textarea class="form--control nicEdit" type="text" name="description" placeholder="@lang('Description')">{{$lecture->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>@lang('Select Type')</label>
                                <select id="preview" class="form--control" name="type" required>
                                    <option value="1" {{$lecture->type == 1 ? 'selected':''}}>@lang('Upload Video')</option>
                                    <option value="2" {{$lecture->type == 2 ? 'selected':''}}>@lang('Video Url')</option>
                                </select>
                            </div>
        
                            <div class="preview_video">
                                <div class="form-group">
                                <label>@lang('Uplaod Video') <code>(.mp4,.avi)</code></label>
                                <input name="video_file" type="file"  class="form--control" accept=".mp4,.avi,.mkv"> 
                                </div>
                            </div>
                           
                            <div class="preview_url d-none">
                                <div class="form-group">
                                <label>@lang('Video Url')</label>
                                <input name="url" type="text"  class="form--control" placeholder="@lang('e.g. https://www.youtube.com/embed/XGD0eGfKwlE  or  https://player.vimeo.com/video/551835274?title=0&byline=0&portrait=0')" required disabled value="{{$lecture->url}}">
                                </div>
                            </div>
        
                            <div class="form-group">
                                <label>@lang('Uplaod Document File (optional)') <code>(.docx,.pdf)</code></label>
                                <input name="file" type="file"  class="form-control custom--file-upload"  accept=".docx,.pdf">
                            </div>
        
                            <div class="form-group">
                                <label>@lang('Duration')</label>
                                <input name="duration" type="text"  class="form--control" placeholder="e.g. 10.45" value="{{$lecture->duration}}" required>
                            </div>
        
                            <div class="form-group mt-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Public Visibility:')
                                    <label class="switch">
                                        <input type="checkbox" name="visibility" id="checkbox" {{$lecture->visibility == 1 ? 'checked':''}}>
                                        <div class="slider round"></div>
                                    </label>
                                </li>
                            </div>
                            <div class="form-group mt-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang(' Status:')
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="checkbox" {{$lecture->status == 1  ? 'checked':''}}>
                                        <div class="slider round"></div>
                                    </label>
                                </li>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn--base">@lang('Submit')</button>
                            </div>
                    </form>
                </div>
            </div>
          </div>
      </div>
    </div>
</section>



@stop

@push('script')
     <script>
            'use strict';
            (function ($) {
                 $('#preview').on('change', function () {
                    if($(this).val()==1){
                       $('.preview_video').removeClass('d-none')
                       $('.preview_video').find('input[name=video_file]').removeAttr('disabled')

                       $('.preview_url').addClass('d-none')
                       $('.preview_url').find('input[name=url]').attr('disabled',true)
                    } else if ($(this).val()==2){
                       $('.preview_video').addClass('d-none')
                       $('.preview_video').find('input[name=preview_video]').attr('disabled',true)

                       $('.preview_url').removeClass('d-none')
                       $('.preview_url').find('input[name=url]').removeAttr('disabled')
                    } 
                     else {
                        return false;
                    }
                 }).change();
            })(jQuery);
     </script>
@endpush