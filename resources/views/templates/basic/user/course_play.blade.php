@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-5">
                    <div class="accordion playlist--accordion playlist-wrapper" id="courseAccordion">
                        @foreach ($course->chapter as $key => $chapter)
                            @if ($chapter->status == 1 && $chapter->lectures()->count() > 0)
                                <div class="accordion-item" style="border:0px solid #000 !important; margin-bottom:10px">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button
                                            style="background: #49BBBD; color:#fff; padding: 20x; font-weight: 400; border-radius: 12px"
                                            class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <img src="/assets/images/frontend/img/book.svg" style="margin-right: 10px" />
                                            {{ $chapter->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $key }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="headingOne" data-bs-parent="#courseAccordion">

                                        <div class="accordion-bohdy">
                                            {{-- <ul id="play-list"> --}}
                                            @foreach ($chapter->lectures as $key => $lecture)
                                                @if ($lecture->status == 1)
                                                    {{-- <li class="" > --}}

                                                    <div
                                                        style="background: <?php echo $key % 2 == 0 ? 'rgba(244, 140, 6, 0.30)' : 'rgba(157, 204, 255, 0.30)'; ?>;border-radius: 12px; padding: 15px;display:flex; margin-bottom:10px; margin-top:10px; justify-content:space-between">
                                                        <button style="background: transparent;font-size:13px"
                                                            type="button" class="list-btn d-flex justify-content-between"
                                                            data-type="{{ $lecture->url ? 1 : 2 }}"
                                                            data-src="{{ $lecture->url ?: asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file) }}">
                                                            <div class="content">
                                                                <p> <img src="/assets/images/frontend/img/bookblack.svg"
                                                                        style="margin-right: 10px" /> {{ $lecture->title }}
                                                                </p>
                                                            </div>
                                                        </button>
                                                        <button style="background: transparent;font-size:13px"
                                                            type="button" class="list-btn"
                                                            data-type="{{ $lecture->url ? 1 : 2 }}"
                                                            data-src="{{ $lecture->url ?: asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file) }}">
                                                            <span
                                                                class="text-muted fs--12px d-flex align-items-center me-2"><i
                                                                    class="las la-play-circle fs--16px"></i>{{ $lecture->duration }}
                                                                @lang('min')</span>
                                                        </button>

                                                        <div
                                                            class="d-flex flex-wrap align-items-center justify-content-between">
                                                            {{-- <span  class="text-muted fs--12px d-flex align-items-center me-2"><i class="las la-play-circle fs--16px"></i>{{$lecture->duration}} @lang('min')</span> --}}
                                                            @if ($lecture->file)
                                                                <div class="dropdown fs--12px">
                                                                    <button
                                                                        class="btn border btn-sm dropdown-toggle py-0 px-2"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        @lang('Resources')
                                                                    </button>
                                                                    <ul class="dropdown-menu p-0">
                                                                        <li class="p-0"><a class="dropdown-item fs--14px"
                                                                                href="{{ route('user.course.lecture.file.download', $lecture->id) }}">@lang('Download')</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- </li> --}}
                                                    {{-- <div class="d-flex flex-wrap align-items-center justify-content-between">
                          <span class="text-muted fs--14px d-flex align-items-center me-2"><i class="las la-play-circle fs--18px"></i>{{$lecture->duration}} @lang('min')</span>
                          @if ($lecture->file)
                          <div class="dropdown fs--12px">
                            <button class="btn border btn-sm dropdown-toggle py-0 px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @lang('Resources')
                            </button>
                            <ul class="dropdown-menu p-0">
                              <li class="p-0"><a class="dropdown-item fs--14px" href="{{route('user.course.lecture.file.download',$lecture->id)}}">@lang('Download')</a></li>                           
                            </ul>
                          </div>
                          @endif
                        </div> --}}
                                                @endif
                                            @endforeach
                                            {{-- </ul><!-- play-list end --> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="col-xl-7 course-playlist-area">
                    <div class="video-play-wrapper">
                        {{-- <div class="course-details-video">
                <img class="w-100" src="{{getImage(imagePath()['course']['path'].'/'.$course->thumbnail,imagePath()['course']['preview_size'])}}" alt="image">
                <a href="#0" class="video-btn"><i class="las la-play"></i></a>
            </div> --}}
                        @php $firstVideoShown = false; @endphp

                        @foreach ($course->chapter as $key => $chapter)
                            @if (!$firstVideoShown && $chapter->status == 1 && $chapter->lectures()->count() > 0)
                                @foreach ($chapter->lectures as $key => $lecture)
                                    @if (!$firstVideoShown && $lecture->status == 1)
                                        @php $firstVideoShown = true; @endphp

                                        @if ($lecture->url)
                                            {{-- {{ $lecture->url }} --}}
                                            <iframe src="{{ $lecture->url }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen id="video-wrapper"></iframe>
                                        @else
                                            {{ asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file) }}
                                            <video class="d-none" width="1250" height="720" controls id="video"
                                                autoplay>
                                                <source
                                                    src="{{ asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file) }}"
                                                    type="video/mp4" id="source">
                                            </video>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        <iframe class="d-none" src="" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                            id="video-wrapper"></iframe>

                        <video class="d-none" width="1250" height="720" controls id="video" autoplay>
                            <source src="" type="video/mp4" id="source">
                        </video>
                    </div>

                    <ul class="nav nav-tabs cumtom--nav-tabs mt-5" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                aria-selected="">@lang('Overview')</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment"
                                type="button" role="tab" aria-controls="comment"
                                aria-selected="true">@lang('Comments')</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button" role="tab" aria-controls="review"
                                aria-selected="false">@lang('All Reviews')</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="givereview-tab" data-bs-toggle="tab"
                                data-bs-target="#givereview" type="button" role="tab" aria-controls="givereview"
                                aria-selected="false">@lang('Give Review')</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="col-xl-8 mt-4">
                                <h6 class="mt-4 mb-3">@lang('Course Details')</h6>
                                <ul class="caption-list mb-5">
                                    <li>
                                        <span class="caption">@lang('Total Lectures')</span>
                                        <span class="value">{{ $course->lectures_count }} @lang('lectures')</span>
                                    </li>
                                    <li>
                                        <span class="caption">@lang('Level')</span>
                                        <span class="value">{{ $course->level->name }}</span>
                                    </li>
                                    <li>
                                        <span class="caption">@lang('Total Duration')</span>
                                        <span class="value">{{ $course->totalDuration() }} @lang('hours on-demand video')</span>
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


                        <div class="tab-pane fade " id="comment" role="tabpanel" aria-labelledby="comment-tab">
                            <div class="comment-area">
                                <h3 class="block-title">{{ $course->comments_count }} @lang('Comments')</h3>

                                <form action="{{ route('user.post.comment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <textarea name="comment" class="form--control" placeholder="@lang('Write your comment')"></textarea>
                                    <div class="mt-2 text-end">
                                        <button type="submit" class="btn btn-md btn--base">@lang('Submit')</button>
                                    </div>
                                </form>

                                <ul class="comment-list mt-3">
                                    @foreach ($course->comments as $k => $comment)
                                        <li>
                                            <div class="single-comment-wrap">
                                                <div class="thumb"> <img
                                                        src="{{ getImage('assets/images/user/profile/' . $comment->user->image, '350x350') }}"
                                                        alt="comment-thumb"> </div>
                                                <div class="content">
                                                    <h6 class="name">{{ $comment->user->fullname }}</h6>
                                                    <span
                                                        class="reply-time">{{ diffForHumans($comment->created_at) }}</span>
                                                    <a class="reply" data-bs-toggle="collapse"
                                                        href="#reply-btn-{{ $k }}" role="button"
                                                        aria-expanded="false" aria-controls="collapseExample"><i
                                                            class="fa fa-reply"></i></a>
                                                    <p>{{ __($comment->comment) }}</p>
                                                </div>
                                            </div>

                                            <ul>
                                                @foreach ($comment->replies as $reply)
                                                    <li>
                                                        <div class="single-comment-wrap">
                                                            <div class="thumb"> <img
                                                                    src="{{ getImage('assets/images/user/profile/' . $reply->user->image, '350x350') }}"
                                                                    alt="comment-thumb"> </div>
                                                            <div class="content">
                                                                <h6 class="name">{{ $reply->user->fullname }}</h6>
                                                                <span
                                                                    class="reply-time">{{ diffForHumans($comment->created_at) }}</span>
                                                                <p>{{ __($reply->comment) }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <form class="reply-form collapse" id="reply-btn-{{ $k }}"
                                                    action="{{ route('user.post.comment') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <textarea name="comment" class="form--control" placeholder="@lang('Write your reply')"></textarea>
                                                    <div class="text-end">
                                                        <button type="submit"
                                                            class="btn btn-sm btn--base">@lang('Submit')</button>
                                                    </div>
                                                </form>
                                            </ul>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="rating-area mt-5">
                                <div class="single-rating-wrapper">
                                    @forelse ($course->reviews as $review)
                                        <div class="single-rating">
                                            <div class="single-rating__thumb">
                                                <img src="{{ getImage('assets/images/user/profile/' . $review->user->image, '350x350') }}"
                                                    alt="image">
                                            </div>
                                            <div class="single-rating__content">
                                                <h5 class="name">{{ $review->user->fullname }}</h5>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div
                                                        class="ratings d-flex align-items-center justify-content-end fs--18px">
                                                        @php
                                                            echo ratings($review->stars);
                                                        @endphp
                                                    </div>
                                                    <span
                                                        class="text-muted ms-2">{{ diffForHumans($review->created_at) }}</span>
                                                </div>
                                                <p class="mt-2">{{ __($review->review) }}</p>
                                            </div>
                                        </div><!-- single-rating end -->
                                    @empty
                                        <div class="single-rating">
                                            <div class="single-rating__content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <h4>@lang('No reviews yet !!')</h4>
                                                </div>
                                            </div>
                                        </div><!-- single-rating end -->
                                    @endforelse

                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="givereview" role="tabpanel" aria-labelledby="givereview-tab">
                            <div class="annoucement-area mt-4">
                                @guest
                                    <label class="text--danger">@lang('Please login first')</label>
                                @endguest
                                <form class="review-form rating mt-4" method="POST"
                                    action="{{ route('user.review') }}">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="author_id" value="{{ $course->author->id }}">
                                    <div class="form-group d-flex flex-wrap">
                                        <label class="review-label text-dark fw-medium mb-0 me-3">@lang('Your Ratings')
                                            :</label>
                                        <div class="rating-form-group">
                                            <label class="star-label">
                                                <input type="radio" name="rating" value="1" />
                                                <span class="icon"><i class="las la-star"></i></span>
                                            </label>
                                            <label class="star-label">
                                                <input type="radio" name="rating" value="2" />
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                            </label>
                                            <label class="star-label">
                                                <input type="radio" name="rating" value="3" />
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                            </label>
                                            <label class="star-label">
                                                <input type="radio" name="rating" value="4" />
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                            </label>
                                            <label class="star-label">
                                                <input type="radio" name="rating" value="5" />
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="icon"><i class="las la-star"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="review" class="form--control" id="review-comments" required placeholder="@lang('Say Something about this course')"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn--base">@lang('Submit Review')</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- row end -->
        </div>
    </section>
@endsection

@push('script')
    <script>
        'use strict';
        (function($) {
            $(".list-btn").each(function() {
                $(this).on('click', function() {
                    var dataSrc = $(this).attr("data-src");
                    var preview = $('.course-details-video')
                    if ($(this).data('type') == 1) {
                        $('#video-wrapper').removeClass('d-none')
                        $('#video').addClass('d-none');
                        preview.addClass('d-none')
                        $('#video-wrapper').attr('src', dataSrc);
                    } else {
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
                    } else {
                        element.addClass("active");
                        element.siblings("li").removeClass("active");
                        element.siblings("li").find("li").removeClass("active");
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
