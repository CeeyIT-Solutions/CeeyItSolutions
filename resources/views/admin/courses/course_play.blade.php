@extends('admin.layouts.app')

@section('panel')

<section class="pb-100">
  <div class="row gy-4">
    <div class="col-xl-7">
      <div class="video-play-wrapper">
        <div class="course-details-video">
            <img class="w-100" src="{{getImage(imagePath()['course']['path'].'/'.$course->thumbnail,imagePath()['course']['preview_size'])}}" alt="image">
            <a href="#0" class="video-btn"><i class="las la-play"></i></a>
        </div><!-- course-details-video end -->
        <iframe class="d-none" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="video-wrapper"></iframe>

        <video class="d-none" width="100%" height="500" controls id="video" autoplay>
          <source src="" type="video/mp4" id="source">
        </video>
      </div>
    </div>
    <div class="col-xl-5 mt-lg-0 mt-3">
        
      <div class="accordion custom--accordion-two playlist-wrapper" id="courseAccordion">
        @foreach ($course->chapter as $key => $chapter)
        @if ($chapter->status == 1 && $chapter->lectures()->count() > 0)
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapseOne">
            {{$chapter->title}}
          </button>
        </h2>
        <div id="collapse-{{$key}}" class="accordion-collapse collapse {{$loop->first ? 'show' : ''}}" aria-labelledby="headingOne" data-bs-parent="#courseAccordion">
            <div class="accordion-body">
                <ul id="play-list">
                  @foreach ($chapter->lectures as $lecture)
              
                  @if ($lecture->status == 1)
                    <li class="">
                    <button type="button" class="list-btn" data-type="{{$lecture->url ? 1 : 2}}" data-src="{{$lecture->url ? : asset(imagePath()['lecture']['path'].'/'.$lecture->video_file)}}">
                      
                        <div class="content pl-0">
                        <p><i class="las la-film"></i> {{$lecture->title}}</p>
                        </div>
                        
                    </button>
                    <div class="d-flex flex-wrap align-items-center">
                      <span class="text-muted fs--14px d-flex align-items-center me-2"><i class="las la-play-circle fs--18px"></i>{{$lecture->duration}} @lang('min')</span>
                      @if ($lecture->file)
                      <div class="dropdown ml-3">
                        <button class="btn border btn-sm dropdown-toggle py-0 px-2 fs--12px" type="button" data-toggle="dropdown" aria-expanded="false">
                          @lang('Resources')
                        </button>
                        <ul class="dropdown-menu p-0">
                          <li class="p-0"><a class="dropdown-item fs--12px" href="{{route('admin.course.lecture.file.download',$lecture->id)}}">@lang('Download')</a></li>                           
                        </ul>
                      </div>
                      @endif
                    </div>
                  </li>
                @endif
                @endforeach
              </ul><!-- play-list end -->
            </div>
          </div>
      </div>
        @endif
        @endforeach 
        
      </div>
    </div>
  </div><!-- row end -->
  <div class="row">
    <div class="col-lg-7 mt-lg-0 mt-4">
      <div class="video-description mt-4">
          <h6 class="mt-4 mb-3">@lang('Course Details')</h6>
          <ul class="caption-list mb-5">
            <li>
              <span class="caption">@lang('Total Lectures')</span>
              <span class="value">{{$course->lectures_count}} @lang('lectures')</span>
            </li>
            <li>
              <span class="caption">@lang('Level')</span>
              <span class="value">{{$course->level->name}}</span>
            </li>
            <li>
              <span class="caption">@lang('Cerficate')</span>
              <span class="value">@lang('Yes')</span>
            </li>
          </ul>


          <h4 class="mb-2">@lang('About this course')</h4>
          <p>
              @php
                echo $course->description;
              @endphp
          </p>
          
          <h6 class="mt-4 mb-3">@lang('What will you learn?')</h6>
          <ul class="disc-list">
            @php
                echo $course->will_learn;
            @endphp
          </ul>
        </div>
    </div>
  </div>
</section>

  
{{-- reject modal --}}
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-exclamation-circle text-danger display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to reject this course ? Please tell some reasons to author.')</h6>

                    <textarea name="reasons"placeholder="Write your reasons" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--danger del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- approve modal --}}
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-check-circle  text--success display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to approve this course ?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--success del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
     <script>
            'use strict';
            (function ($) {
                $( ".list-btn" ).each(function() {
                    $(this).on('click', function(){
                    var dataSrc = $(this).attr("data-src");
                    var preview  = $('.course-details-video')
                    if($(this).data('type') == 1){
                      $('#video-wrapper').removeClass('d-none')
                      $('#video').addClass('d-none');
                      preview.addClass('d-none')
                      $('#video-wrapper').attr('src', dataSrc);
                    }else{
                      $('#video').removeClass('d-none');
                      $('#video-wrapper').addClass('d-none')
                      preview.addClass('d-none')
                      $('#source').attr('src', dataSrc);
                      document.getElementById('video').load()
                    }

                    // add active class with "list-btn"
                    var element = $(this).parent("li");
                    if (element.hasClass("active")) {
                        element.find("li").removeClass("active");
                    }
                    else {
                        element.addClass("active");
                        element.siblings("li").removeClass("active");
                        element.siblings("li").find("li").removeClass("active");
                    }
                    });
                });

                $('.reject').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#rejectModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.approve').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#approveModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
            })(jQuery);
     </script>
@endpush

@push('breadcrumb-plugins')
@if ($course->status != 2)
 @if ($course->status == 1)
    <a href="javascript:void(0)" data-route="{{route('admin.course.action',$course->id)}}" class="btn btn--dark reject" data-toggle="tooltip" title="@lang('Reject')">
        <i class="las la-thumbs-down"></i> @lang('Reject')
    </a>
 @elseif($course->status == 0)
    <a href="javascript:void(0)" data-route="{{route('admin.course.action',$course->id)}}" class="btn btn--success  approve" data-toggle="tooltip" title="@lang('Approve')">
        <i class="las la-check-double"></i> @lang('Approve')
    </a>
 @endif
@endif
@endpush

@push('style')
    <style>
      .fs--12px {
        font-size: 12px !important;
      }
      
      .playlist-wrapper {
          max-height: 770px;
          overflow-y: auto;
          scrollbar-width: thin;
          scrollbar-color: darkgrey #e7e7e7;
      }
      @media (max-width: 1399px) {
          .playlist-wrapper {
              max-height: 550px;
          }
      }

      @media (max-width: 767px) {
          .playlist-wrapper {
              max-height: 450px;
          }
      }

      @media (max-width: 575px) {
          .playlist-wrapper {
              max-height: 350px;
          }
      }

      .playlist-wrapper::-webkit-scrollbar {
          width: 7px;
      }
      .playlist-wrapper::-webkit-scrollbar-track {
          box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      }
      .playlist-wrapper::-webkit-scrollbar-thumb {
          background-color: darkgrey;
          border-radius: 999px;
          -webkit-border-radius: 999px;
          -moz-border-radius: 999px;
          -ms-border-radius: 999px;
          -o-border-radius: 999px;
      }
    </style>
@endpush