@extends($activeTemplate . 'layouts.frontend')
@section('style')
    <style>
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        :root {
            --primary-color: #00A884;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'AtypDisplay', 'Inter', sans-serif;
            font-size: medium;
            margin: 0px;
        }

        .navbar {
            padding: 15px 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar nav {
            margin-left: auto;
        }

        .play-button {
            width: 99px;
            height: 99px;
            background: #2C2B31;
            border-radius: 50%;
            opacity: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* .course-tabs {
                    margin-top: 20px;
                    border-bottom: 1px solid #dee2e6;
                    }

                    .course-tabs .nav-link {
                    color: #666;
                    border: none;
                    padding: 10px 20px;
                    margin-right: 20px;
                    position: relative;
                    }

                    .course-tabs .nav-link.active {
                    color: var(--primary-color);
                    background: none;
                    font-weight: 500;
                    }

                    .course-tabs .nav-link.active::after {
                    content: '';
                    position: absolute;
                    bottom: -1px;
                    left: 0;
                    right: 0;
                    height: 2px;
                    background: var(--primary-color);
                    } */

        /* .premium-card {
                    background-color: #2C2B31;
                    color: white;
                    border-radius: 20px;
                    padding: 20px;
                    margin-top: 12000px;
                    } */

        /* .rating-stars {
                    color: #ffd700;
                    font-size: 20px;
                    } */

        /* .instructor-info {
                    display: flex;
                    align-items: center;
                    gap: 15px;

                    } */

        /* .instructor-avatar {
                    width: 46px;
                    height: 46px;
                    border-radius: 50%;
                    object-fit: cover;
                    } */

        .comments-section {
            margin-top: 20px;
        }

        /* .ratecard {
                    background-color: #2C2B31;
                    border-radius: 20px;
                    color: #FFFFFF;
                    } */

        /* a.rsp {
                    color: #3ADBD2 !important;
                    text-decoration: none;
                    } */

        .profile-span {
            width: 64px;
            height: 18px;
            font-size: 13.74px;
            size: 6.39px;
            color: #2C2A31;
            text-wrap: wrap;
        }

        .student-label {
            font-size: 12px;
            color: #666;
        }

        .profile-button {
            background-color: #E6F7F5;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            border: none;
            white-space: nowrap;
        }

        .profile-image {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
        }

        /* a.nav-link {
                    font-size: 15px;
                    } */

        .navbar {
            border-bottom: 0px;
        }

        span.foot-text {
            font-size: 16px;
            font-weight: lighter;
            margin-left: 45px;
        }

        .modal-dark {
            background-color: #2d2d2d;
            color: white;
            border-radius: 16px;
            /* max-width: 500px;
                    margin: 30px auto; */
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .close-button {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 0;
            opacity: 0.7;
        }

        .close-button:hover {
            opacity: 1;
        }

        .post-button {
            background-color: #4ca3ff;
            border: none;
            padding: 6px 16px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #404040;
        }

        .user-name {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-text {
            color: var(--text-gray);
            font-size: 0.85rem;
        }

        .star-rating {
            margin-bottom: 1.5rem;
        }

        .star-rating .star {
            color: #404040;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 0.5rem;
        }

        .star-rating .star:hover {
            color: var(--accent-blue);
        }

        .review-textarea {
            background-color: transparent;
            border: 1px solid #404040;
            border-radius: 8px;
            color: white;
            resize: none;
            width: 100%;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }

        .review-textarea:focus {
            outline: none;
            border-color: var(--accent-blue);
            background-color: transparent;
        }

        .character-count {
            text-align: right;
            color: var(--text-gray);
            font-size: 0.8rem;
        }

        .course-title {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 21.46px;
            font-weight: 600;
            line-height: 35.27px;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            margin-bottom: 17px;
        }

        .course-subtitle {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 12px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            opacity: 40%;
            margin-bottom: 18px;

        }

        .main-container {
            display: flex;
            flex-direction: column;
        }

        .video-container {
            position: relative;
            width: 100%;
            background: #C7CACA;
            border-radius: 20px;
            overflow: hidden;
            height: auto;
        }

        .video-placeholder {
            position: absolute;
            top: 0;
            bottom: 0px;
            right: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            aspect-ratio: 16/9;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.26);
        }

        .course-tabs {
            margin-top: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .course-tabs .nav-link {
            color: #666;
            border: none;
            position: relative;
        }

        a.nav-link.active {
            padding: 8px 0px;
        }

        .course-tabs .nav-link.active {
            position: relative;
            font-family: 'AtypDisplay', sans-serif;
            font-size: 20px;
            font-weight: 400;
            line-height: 28.78px;
            text-align: left;
            color: #2C2B31;
            display: inline-block;
        }

        .course-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #049E96;
            border-radius: 50px;
        }


        .tab-course-description {
            font-family: "Nunito", sans-serif;
            font-size: 18px;
            font-weight: 500;
            line-height: 28px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;

        }


        .premium-card {
            display: flex;
            flex-direction: column;
            align-items: start;
            width: 100%;
            height: 340.41px;
            border-radius: 20px;
            background: #2C2B31;
            padding-left: 37.46px;
            padding-top: 38.56px;
            padding-bottom: 37.41px;
            padding-right: 39px;
        }

        .premium-card-title {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 34.66px;
            font-weight: 400;
            line-height: 49.87px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #FFFFFF;
        }

        .premium-car-para {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 19.83px;
            font-weight: 400;
            line-height: 28.24px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #ffffff;
            padding-bottom: 11.1px;

        }

        .premium-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .premium-features li {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 15.42px;
            font-weight: 400;
            line-height: 21.96px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            column-gap: 10px;
            color: white;
        }

        .premium-btn {
            margin-top: 26.3px;
            background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
            color: #ffffff;
            border: none;
            width: 100%;
            height: 43px;
            padding: 12px;
            border-radius: 14.93px;
            font-weight: 500;
            font-size: 11.2px;
            line-height: 15.95px;
        }

        .rating-card-container {
            margin-top: 8px;
            width: 100%;
            height: 151px;
            border-radius: 20px;
            background-color: #2C2B31;
            padding-top: 24px;
            padding-left: 37px;
            padding-right: 36px;
            padding-bottom: 22.31px;
        }

        .ratecard {
            background-color: #2C2B31;
            border-radius: 20px;
            color: #FFFFFF;
        }

        .rating-card-title {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 19.83px;
            font-weight: 400;
            line-height: 28.24px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #ffffff;

        }

        .rating-card-subtitle {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 8px;
            font-weight: 400;
            line-height: 11.28px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #ffffff;

        }

        .rating-stars {
            /* color: #ffd700;
                    font-size: 20px; */
        }

        .rating-stars img {
            padding-right: 15px;
        }

        .rating-stars img:last-child {
            padding-right: 0px;
        }

        .comment-title {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 20px;
            font-weight: 400;
            line-height: 28.48px;
            text-align: left;
            text-underline-position: "from-font";
            text-decoration-skip-ink: none;
            margin-top: 24px;
            margin-left: 37px;
        }

        .comment-container {
            display: flex;
            align-items: center;
            column-gap: 10px;
            row-gap: 14px;
        }

        .img-container {
            flex-shrink: 0;
        }

        .img-container img {
            width: 48px;
            height: 48px;
            border-radius: 50%;

        }

        .comment-content-container {
            flex-grow: 1;
        }

        .comment-content {
            display: flex;
            column-gap: 5px;
        }

        .comment-content-title {
            font-family: "Nunito", sans-serif;
            font-size: 14px;
            font-weight: 700;
            line-height: 28.68px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
        }

        .comment-content-subtitle-container {
            width: 48px;
            height: 9px;
            /* padding: 2px 3px 3px 3px; */
            border-radius: 6.58px;
            background-color: #DDFFFD;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .comment-content-subtitle {
            font-family: "Nunito", sans-serif;
            font-size: 5.52px;
            font-weight: 400;
            line-height: 28.68px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
        }

        .comment-content-comment {
            font-family: "Nunito", sans-serif;
            font-size: 8px;
            font-weight: 400;
            line-height: 12px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
        }

        .instructor-info {
            display: flex;
            align-items: center;

        }

        .instruction-info-about {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 18px;
            font-weight: 600;
            line-height: 25.9px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
            margin-top: 0.5rem;
            /* margin-bottom: 14px; */
        }

        .instructor-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
        }

        .instructor-info-title {
            font-family: "Nunito", sans-serif;
            font-size: 12.07px;
            font-weight: 700;
            /* line-height: 26px; */
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
            text-wrap: nowrap;

        }

        .instruction-info-right {
            display: flex;
            column-gap: 7.2px;
        }

        .instructor-info-jobtitle {
            font-family: "Nunito", sans-serif;
            font-size: 9.29px;
            font-weight: 600;
            /* line-height: 26px; */
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
            opacity: 40%;

        }

        .star-value {
            display: flex;
            align-items: center;
        }

        .star-value span {
            font-family: "Nunito", sans-serif;
            font-size: 7.83px;
            font-weight: 600;
            /* line-height: 43.83px; */
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #2C2B31;
            margin-left: 5px;
        }

        .instructor-info-detail {
            font-family: "Nunito", sans-serif;
            font-size: 13px;
            font-weight: 600;
            line-height: 20px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            margin-top: 15px;

        }

        .comment-question {
            font-family: 'AtypDisplay', sans-serif;
            font-size: 18px;
            font-weight: 500;
            line-height: 25.9px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;

        }

        .comment-textarea {
            width: 100%;
            height: 119px;
            padding: 13px 312px 97px 16px;
            border-radius: 10px !important;
            border: 0.5px solid #00000033 !important;

        }

        .comment-submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 103px;
            height: 29.14px;
            border-radius: 13.55px;
            background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
            font-family: 'AtypDisplay', sans-serif;
            font-size: 10.16px;
            font-weight: 400;
            line-height: 14.47px;
            text-align: left;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            border: none;
            color: #ffffff;
            margin-top: 15px;

        }



        @media (min-width:576px) {
            .course-title {
                font-size: 31.46px;
                font-weight: 600;
                line-height: 45.27px;
                text-wrap: nowrap;
            }

            .course-subtitle {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 18px;
                font-weight: 400;
                line-height: 12px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                opacity: 40%;
                margin-bottom: 18px;

            }

            .main-container {
                display: flex;
                flex-direction: column;
            }

            .video-container {
                height: 499px;
            }


            .premium-card {
                display: flex;
                flex-direction: column;
                align-items: start;
                width: 401px;
                height: 340.41px;
                border-radius: 20px;
                background: #2C2B31;
                padding-left: 37.46px;
                padding-top: 38.56px;
                padding-bottom: 37.41px;
                padding-right: 39px;
            }

            .premium-card-title {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 34.66px;
                font-weight: 400;
                line-height: 49.87px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                color: #FFFFFF;
            }

            .premium-car-para {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 19.83px;
                font-weight: 400;
                line-height: 28.24px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                color: #ffffff;
                padding-bottom: 11.1px;

            }

            .premium-features {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .premium-features li {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 15.42px;
                font-weight: 400;
                line-height: 21.96px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                column-gap: 10px;
                color: white;
            }

            .premium-btn {
                margin-top: 26.3px;
                background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);
                color: #ffffff;
                border: none;
                width: 100%;
                height: 43px;
                padding: 12px;
                border-radius: 14.93px;
                font-weight: 500;
                font-size: 11.2px;
                line-height: 15.95px;
            }

            .review {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 11.43px;
                font-weight: 400;
                line-height: 16.45px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                color: #3ADBD2;
                margin-top: 8px;
            }

            .rating-card-container {
                width: 401px;
            }

            .rating-stars img {
                padding-right: 15px;
            }

            .rating-stars img:last-child {
                padding-right: 0px;
            }

            .instruction-info-about {
                margin-bottom: 14px;
            }

            .margin-right {
                margin-right: 2rem;
            }

        }

        @media (min-width:768px) {
            .course-title {
                font-size: 31.46px;
                font-weight: 600;
                line-height: 45.27px;
                text-wrap: nowrap;
            }

            .course-subtitle {
                font-family: 'AtypDisplay', sans-serif;
                font-size: 18px;
                font-weight: 400;
                line-height: 12px;
                text-align: left;
                text-underline-position: from-font;
                text-decoration-skip-ink: none;
                opacity: 40%;
                margin-bottom: 18px;
            }

            /* .main-container {
                    flex-direction: row;
                    column-gap:20px;
                    } */

            /* .video-container {
                    width: 899px;
                    } */

            .rating-card-container {
                width: 401px;
            }


        }

        @media (min-width:992px) {}

        @media (min-width:1400px) {
            .main-container {
                flex-direction: row;
                column-gap: 20px;
            }

            .video-container {
                width: 899px;
            }

            .comment-textarea {
                width: 449px;
            }


        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add Lightcase CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightcase@2.5.0/src/css/lightcase.css">

    <!-- Add jQuery and Lightcase JS -->

    <script src="https://cdn.jsdelivr.net/npm/lightcase@2.5.0/src/js/lightcase.js"></script>
@endsection
@section('content')

    <!-- <section class="pt-100 pb-100 text-break">
                    <div class="container">
                    <div class="row">
                      <div class="col-lg-8">

                      <div class="course-details-header mb-5">
                        <h2 class="title">{{ __($course->title) }}</h2>

                        <div class="course-mentor d-flex flex-wrap align-items-center mt-2">
                        <div class="left me-3">
                          <div class="teacher">
                          <div class="thumb"><img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $course->author->image, imagePath()['profile']['user']['size']) }}" alt="image"></div>
                          <p class="name">{{ $course->author->fullname }}</p>
                          </div>
                        </div>
                        {{-- <div class="right me-3">
          <span class="fs--14px">{{number_format_short($course->courseUsers->count())}} @lang('enrolled')</span>
        </div> --}}
                        {{-- <div class="ratings d-flex align-items-center fs--14px mt-1">
          @php
            echo ratings($course->avgRating())
          @endphp
          <span class="ms-2">({{$course->avgRating()}})</span>
      </div> --}}
                      </div>
                    </div>
                    <div class="course-details-video main-course-details-video">
                      <img src="{{ getImage(imagePath()['course']['path'] . '/' . $course->thumbnail, imagePath()['course']['preview_size']) }}" alt="image">
                      <a href="{{ $course->preview == 1 ? asset(imagePath()['course']['preview_video_path'] . '/' . $course->preview_video) : $course->preview_url }}" data-rel="lightcase" class="video-btn"><i class="las la-play"></i></a>
                    </div>
                    <div class="course-details-box mt-5">
                      <h3 class="mb-3">@lang('What Will You Learn?')</h3>
                      @php
                          echo $course->will_learn;
                      @endphp
                    </div>



                    <h3 class="mt-5 mb-3">@lang('Course Content')</h3>
                    <div class="accordion custom--accordion-two" id="courseAccordion">
                      @foreach ($course->chapter as $key => $chapter)
    @if ($chapter->status == 1 && $chapter->lectures()->count() > 0)
    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                        {{ $chapter->title }}
                        </button>
                      </h2>
                      <div id="collapse-{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#courseAccordion">
                        <div class="accordion-body">
                        <ul class="course-video-list">
                          @foreach ($chapter->lectures as $lecture)
    @if ($lecture->status == 1)
    <li>
                          <a href="{{ $lecture->visibility == 0 ? 'javascript:void(0)' : ($lecture->url ?: asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file)) }}" @if ($lecture->visibility == 1) data-rel="lightcase" @endif>
                            <div class="content">
                            <p><span class="me-3"><i class="fas fa-play-circle"></i> {{ $lecture->title }} </span> <span><i class="las la-clock"></i> {{ $lecture->duration }}</span></p>
                            </div>

                            <div class="video-status fs--18px">
                            @if ($lecture->visibility == 1)
    <i class="las la-unlock"></i>
@else
    <i class="las la-lock"></i>
    @endif
                            </div>
                          </a>
                          </li>
    @endif
    @endforeach
                        </ul>
                        </div>
                      </div>
                      </div>
    @endif
    @endforeach
                    </div>

                    <div class="show-img mt-3 rounded-3 overflow-hidden d-lg-block d-none">
                      @php
                          echo advertisements('728x90');
                      @endphp
                    </div>

                    <div class="course-details-box mt-5">
                      <h3 class="mb-3">@lang('About This Course')</h3>
                      @php
                          echo $course->description;
                      @endphp
                    </div>

                    <h3 class="mt-5 mb-3">@lang('Instructor')</h3>
                    <div class="instructor-card">
                      <div class="thumb">
                      <img src="{{ getImage('/assets/images/user/profile/' . $course->author->image, '350x350') }}" alt="image">
                      </div>
                      <div class="content">
                      <h4 class="name">{{ $course->author->fullname }}</h4>
                      <span class="mt-1">{{ @$course->author->instructor_info->occupation }}</span>

                      <ul class="instructor-info-list d-flex flex-wrap align-items-center">
                        <li>
                        <i class="las la-layer-group"></i>
                        <span>{{ $course->author->courses()->count() }} @lang('Courses')</span>
                        </li>

                        <li>
                        <i class="las la-user-friends"></i>
                        <span>{{ $course->author->courseUsers()->count() }} @lang('Students')</span>
                        </li>
                        <li>
                        <i class="far fa-star star"></i>
                        <span>{{ $course->author->totalReview()->count() }} @lang('Reviews')</span>
                        </li>
                      </ul>
                      </div>
                      <p class="w-100 mt-2">{{ @$course->author->instructor_info->detail }}</p>
                    </div>

                    <div class="show-img mt-3 rounded-3 overflow-hidden d-lg-block d-none">
                      @php
                          echo advertisements('728x90');
                      @endphp
                    </div>

                    <ul class="nav nav-tabs cumtom--nav-tabs mt-5" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button" role="tab" aria-controls="comment" aria-selected="true">@lang('Comments')</button>
                      </li>
                      <li class="nav-item" role="presentation">
                      <button class="nav-link" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="false">@lang('All Reviews')</button>
                      </li>

                      <li class="nav-item" role="presentation">
                      <button class="nav-link" id="annoucement-tab" data-bs-toggle="tab" data-bs-target="#annoucement" type="button" role="tab" aria-controls="annoucement" aria-selected="false">@lang('Give Review')</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="comment" role="tabpanel" aria-labelledby="comment-tab">
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
                          <div class="thumb"> <img src="{{ getImage('/assets/images/user/profile/' . $comment->user->image, '350x350') }}" alt="comment-thumb"> </div>
                          <div class="content">
                            <h6 class="name">{{ $comment->user->fullname }}</h6>
                            <span class="reply-time">{{ diffForHumans($comment->created_at) }}</span> <a class="reply" data-bs-toggle="collapse" href="#reply-btn-{{ $k }}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-reply"></i></a>
                            <p>{{ __($comment->comment) }}</p>
                          </div>
                          </div>

                          <ul>
                          @foreach ($comment->replies as $reply)
    <li>
                            <div class="single-comment-wrap">
                            <div class="thumb"> <img src="{{ getImage('/assets/images/user/profile/' . $reply->user->image, '350x350') }}" alt="comment-thumb"> </div>
                            <div class="content">
                              <h6 class="name">{{ $reply->user->fullname }}</h6>
                              <span class="reply-time">{{ diffForHumans($comment->created_at) }}</span>
                              <p>{{ __($reply->comment) }}</p>
                            </div>
                            </div>
                          </li>
    @endforeach
                          <form class="reply-form collapse" id="reply-btn-{{ $k }}" action="{{ route('user.post.comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="comment" class="form--control" placeholder="@lang('Write your reply')"></textarea>
                            <div class="text-end">
                            <button type="submit" class="btn btn-sm btn--base">@lang('Submit')</button>
                            </div>
                          </form>
                          </ul>
                        </li>
    @endforeach

                        </ul>
                      </div>
                      </div>


                      <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="rating-area mt-5">
                        <div class="single-rating-wrapper">
                        @forelse ($course->reviews as $review)
    <div class="single-rating">
                          <div class="single-rating__thumb">
                          <img src="{{ getImage('/assets/images/user/profile/' . $review->user->image, '350x350') }}" alt="image">
                          </div>
                          <div class="single-rating__content">
                          <h5 class="name">{{ $review->user->fullname }}</h5>
                          <div class="d-flex align-items-center mt-1">
                            <div class="ratings d-flex align-items-center justify-content-end fs--18px">
                            @php
                                echo ratings($review->stars);
                            @endphp
                            </div>
                            <span class="text-muted ms-2">{{ diffForHumans($review->created_at) }}</span>
                          </div>
                          <p class="mt-2">{{ __($review->review) }}</p>
                          </div>
                        </div>
        @empty
                        <div class="single-rating">
                          <div class="single-rating__content">
                          <div class="d-flex align-items-center mt-1">
                            <h4>@lang('No reviews yet !!')</h4>
                          </div>
                          </div>
                        </div>
    @endforelse

                        </div>
                      </div>
                      </div>

                      <div class="tab-pane fade" id="annoucement" role="tabpanel" aria-labelledby="annoucement-tab">
                      <div class="annoucement-area mt-4">
                        @guest
                                        <h3 class="block-title text--danger text-center">@lang('Please login first')</h3>
                        @endguest
                        @auth
                                        <form class="review-form rating mt-4" method="POST" action="{{ route('user.review') }}">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="hidden" name="author_id" value="{{ $course->author->id }}">
                                        <div class="form-group d-flex flex-wrap">
                                          <label class="review-label text-dark fw-medium mb-0 me-3">@lang('Your Ratings') :</label>
                                          <div class="rating-form-group">
                                          <label class="star-label">
                                            <input type="radio" name="rating" value="1" />
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                          </label>
                                          <label class="star-label">
                                            <input type="radio" name="rating" value="2" />
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                          </label>
                                          <label class="star-label">
                                            <input type="radio" name="rating" value="3" />
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                          </label>
                                          <label class="star-label">
                                            <input type="radio" name="rating" value="4" />
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                          </label>
                                          <label class="star-label">
                                            <input type="radio" name="rating" value="5" />
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                            <span class="icon"><i class="far fa-star star"></i></span>
                                          </label>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <textarea name="review" class="form--control" id="review-comments" required placeholder="@lang('Say Something about this course')"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn--base">@lang('Submit Review')</button>
                                        </form>
                        @endauth
                      </div>
                      </div>
                    </div>

                    </div>
                    <div class="col-lg-4 ps-lg-5 mt-lg-0 mt-5">
                    <div class="course-details-sidebar">
                      <div class="course-details-widget bg--base text-white">
                      <div class="d-flex align-items-center">
                        @if ($course->value == 1 && $course->discount)
    <h2 class="course-price me-2 text-white newPrice"> {{ $general->cur_sym }}{{ getAmount($course->discountPrice()) }}</h2>
                        <del class="me-2 del">{{ $general->cur_sym }}{{ getAmount($course->price) }}</del>
                        <span>{{ $course->discount . '%' }} @lang('off')</span>
@else
    <h2 class="course-price me-2 text-white newPrice"> @if ($course->value == 1)
    {{ $general->cur_sym }} {{ getAmount($course->price) }}
@else
    @lang('Free')
    @endif
                </h2>
    @endif
                      </div>
                      <h6 class="mt-4 mb-3 text-white">@lang('This course includes'):</h6>
                      <ul class="course-widget-feature">
                        <li><i class="fas fa-play-circle"></i> {{ $course->totalDuration() }} @lang('hours on-demand video')</li>
                        <li><i class="far fa-file"></i> {{ $course->lectures_count }} @lang('Lectures')</li>
                        <li><i class="fas fa-infinity"></i>@lang('Full lifetime access')</li>

                      </ul>
                      @auth
                                      @if (auth()->user()->is_instructor != 1)
        @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'success')->first())
        <a href="{{ route('user.course.play', [$course->id, $course->slug]) }}" class="btn btn--light mt-5 w-100">@lang('Goto Course')</a>
    @else
        @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'pending')->first())
        <a href="javascript:void(0)" class="btn btn--light mt-5 w-100 purchase disabled">@lang('Pending Approval')</a>
    @elseif(\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'rejected')->first())
        <a href="javascript:void(0)" class="btn btn--light mt-5 w-100 purchase disabled">@lang('Approval Rejected')</a>
    @else
        <a href="javascript:void(0)" class="btn btn--light mt-5 w-100 purchase" data-payment_route="{{ route('user.payment', $course->code) }}">@lang('Purchase')</a>
        @endif

                                      @if ($course->value != 0)
        <a href="javascript:void(0)" class="coupon-open d-block text-center text-white mt-2">@lang('Apply Coupon Code')</a>
                                      <form class="coupon-form mt-4">
                                        <div class="input-group coupon-div">
                                        <input type="hidden" name="course_id" value="{{ $course->id }}" id="courseid">
                                        <input type="text" name="coupon" class="form--control" autocomplete="off" placeholder="@lang('Coupon code')" id="coupon">
                                        <button type="button" class="btn btn--secondary" id="apply-coupon">@lang('Apply')</button>
                                        </div>
                                      </form>
        @endif
        @endif
    @else
        @if ($course->author_id != auth()->id())
        @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->first())
        <a href="{{ route('user.course.play', [$course->id, $course->slug]) }}" class="btn btn--light mt-5 w-100 ">@lang('Goto Course')</a>
    @else
        <a href="javascript:void(0)" class="btn btn--light mt-5 w-100 purchase" data-payment_route="{{ route('user.payment', $course->code) }}">@lang('Purchase')</a>
        @endif
        @endif
        @endif
    @else
        <a href="{{ route('user.login') }}" class="btn btn--light mt-5 w-100">@lang('Purchase')</a>
                      @endauth


                      </div>
                      <div class="course-details-review mt-3">
                      <div class="rating-area d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div class="rating">{{ $course->avgRating() }}</div>
                        <div class="content">
                        <div class="ratings d-flex align-items-center justify-content-end fs--18px">
                          @php
                              echo ratings($course->avgRating());
                          @endphp
                        </div>
                        <span class="mt-1 text-muted fs--14px">@lang('Based on') {{ $course->reviews->count() }} @lang('ratings')</span>
                        </div>
                      </div>

                      @for ($i = 5; $i > 0; $i--)
    <div class="single-review">
                        <p class="star"><i class="las la-star text--base"></i> {{ $i }}</p>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $course->starCount($i) }}%" aria-valuenow="{{ $course->starCount($i) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="percentage">{{ $course->starCount($i) }}%</span>
                      </div>
    @endfor

                      </div>
                      <div class="course-details-review mt-3">
                      <h5 class="mb-3">@lang('Course Tags')</h5>
                      <div class="tags">
                        @if (!empty($course->tags))
    @foreach ($course->tags as $tag)
    <a href="{{ route('courses', ['search' => $tag]) }}">{{ __($tag) }}</a>
    @endforeach
@else
    <p>@lang('No tags found')</p>
    @endif
                      </div>
                      </div>
                    </div>
                    </div>
                    </div>
                    </div>
                  </section> -->


    <div class="modal" tabindex="-1" id="purchaseModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <form action="{{ route('user.purchase') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between p-2">
                        <h6>@lang('Click to proceed')</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-bodytext-center">
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        @if ($course->value == 0)
                            <button type="submit" class="btn premium-btn btn-md w-100 balace">@lang('Enroll')</button>
                        @else
                            {{-- <button type="submit" class="btn btn--dark btn-md w-100 balace">{{$general->sitename}}
    @lang('Balance')</button> --}}
                            <a href="" class="btn premium-btn btn-md w-100 gateway">Buy Now</a>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ///modal for review/// -->
    <div class="modal " tabindex="-1" id="reviewModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-dark p-3">

                <div class="modal-header d-flex justify-content-between align-items-center">
                    <button class="close-button" data-bs-dismiss="modal" aria-label="Close" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                    <form action="{{ route('user.review') }}" method="POST">
                        @csrf
                        @auth
                            <button type="submit" class="btn post-button text-white">Post</button>
                        @endauth
                </div>
                <div class="modal-body">
                    @guest
                        <h3 class="block-title text-danger text-center">@lang('Please login first')</h3>
                    @endguest
                    @auth
                        <div class="user-info">
                            <div class="user-avatar"></div>
                            <div>
                                <div class="user-name">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</div>
                                <div class="info-text">Reviews are public and include your account and device info</div>
                            </div>
                        </div>

                        <div class="star-rating">
                            <i class="far fa-star stars"></i>
                            <i class="far fa-star stars"></i>
                            <i class="far fa-star stars"></i>
                            <i class="far fa-star stars"></i>
                            <i class="far fa-star stars"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="1" />
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="author_id" value="{{ $course->author->id }}">
                        <textarea class="review-textarea" name="review" rows="4" required
                            placeholder="Describe your experience (optional)" maxlength="500"></textarea>
                        <div class="character-count">0/500</div>
                    @endauth
                </div>


                </form>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <div class="container my-4 py-4 my-md-5 py-md-5">
        <h1 class="course-title">{{ __($course->title) }}</h1>
        <div>
            <p class="">
                {!! $course->will_learn !!}
            </p>
        </div>
        <div class="main-container">
            <!-- Left Column - Video and Course Content -->
            <div class="">
                <!-- Video Player -->
                <div class="video-container"
                    style="background-image: url('{{ getImage(imagePath()['course']['path'] . '/' . $course->thumbnail, imagePath()['course']['preview_size']) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <div class="video-placeholder">
                        <div class="">
                            <img src="{{ getImage(imagePath()['course']['path'] . '/' . $course->thumbnail, imagePath()['course']['preview_size']) }}"
                                alt="image">
                            <a href="{{ $course->preview == 1 ? asset(imagePath()['course']['preview_video_path'] . '/' . $course->preview_video) : $course->preview_url }}"
                                data-rel="lightcase" class="video-btn">
                                <div class="play-button">
                                    <img src="/assets/images/play_button_vector.svg" alt="">
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Course Tabs -->
            <ul class="nav course-tabs" id="courseTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#about">About</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#content">Course Content</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#comments">Comments</a>
                    </li>
                @endauth
            </ul>

            <!-- about Tab Content -->
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="about">
                    <!-- <h3>DW Completed</h3> -->
                    <!-- Content for "DW Completed" section -->
                    <div class="row mt-1">
                        <div class="col-lg-8">
                            <p class="tab-course-description">
                                {!! $course->description !!}
                            </p>
                        </div>

                        <div class="col-lg-4">
                            <div class="instructor-info">
                                <div>
                                    <h5 class="instruction-info-about">About Instructor</h5>
                                    <div class="instruction-info-right">
                                        <div class=""> <img src="/assets/images/instructor_picture_placeholder.png"
                                                alt="" class="instructor-avatar"></div>
                                        <div class="d-flex flex-column justify-content-center align-items-start">
                                            <p class="instructor-info-title mb-0">{{ $course->author->fullname }}</p>
                                            <p class="instructor-info-jobtitle mb-0">
                                                {{ @$course->author->instructor_info->occupation }}</p>
                                            <div class="star-value"><img src="/assets/images/yellow_star_vector.svg"
                                                    alt="" class="mb-0"><span>4.6</span></div>
                                        </div>
                                    </div>
                                    <p class="instructor-info-detail">{{ @$course->author->instructor_info->detail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- course Tab Content -->
            <div class="tab-content mt-4">
                <div class="tab-pane fade show" id="content">
                    <!-- <h3>DW Completed</h3> -->
                    <!-- Content for "DW Completed" section -->
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="accordion custom--accordion-two" id="courseAccordion">
                                @foreach ($course->chapter as $key => $chapter)
                                    @if ($chapter->status == 1 && $chapter->lectures()->count() > 0)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $key }}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    {{ $chapter->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $key }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="headingOne" data-bs-parent="#courseAccordion">
                                                <div class="accordion-body">
                                                    <ul style="margin-right: 0px !important;">
                                                        @foreach ($chapter->lectures as $lecture)
                                                            @if ($lecture->status == 1)
                                                                <li style="list-style-type: none;">
                                                                    <a style="text-decoration:none;color:black;"
                                                                        href="{{ $lecture->visibility == 0 ? 'javascript:void(0)' : ($lecture->url ?: asset(imagePath()['lecture']['path'] . '/' . $lecture->video_file)) }}"
                                                                        @if ($lecture->visibility == 1) data-rel="lightcase" @endif>
                                                                        <div class="content">
                                                                            <p><span class="me-3"><img
                                                                                        src="/assets/images/small_play_button.png"
                                                                                        alt="" class="mx-2">
                                                                                    {{ $lecture->title }} </span>
                                                                                <span><img
                                                                                        src="/assets/images/small-time-vector.png"
                                                                                        alt="">
                                                                                    {{ $lecture->duration }}</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="video-status fs--18px">
                                                                            @if ($lecture->visibility == 1)
                                                                                <i class="las la-unlock"></i>
                                                                            @else
                                                                                <i class="las la-lock"></i>
                                                                            @endif
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="instructor-info">
                                <div>
                                    <h5 class="instruction-info-about">About Instructor</h5>
                                    <div class="instruction-info-right">
                                        <div class=""> <img src="/assets/images/instructor_picture_placeholder.png"
                                                alt="" class="instructor-avatar"></div>
                                        <div class="d-flex flex-column justify-content-center align-items-start">
                                            <p class="instructor-info-title mb-0">{{ $course->author->fullname }}</p>
                                            <p class="instructor-info-jobtitle mb-0">
                                                {{ @$course->author->instructor_info->occupation }}</p>
                                            <div class="star-value"><img src="/assets/images/yellow_star_vector.svg"
                                                    alt="" class="mb-0"><span>4.6</span></div>
                                        </div>
                                    </div>
                                    <p class="instructor-info-detail">{{ @$course->author->instructor_info->detail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- content Tab Content -->
            <div class="container tab-content mt-2">
                <div class="row tab-pane fade show" id="comments">
                    <!-- <h3>What's on your mind?</h3> -->
                    <div class="row">
                        <div class="col-lg-7">
                            <form action="{{ route('user.post.comment') }}" method="POST">
                                @csrf
                                <div class="d-flex flex-column">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <h5 for="message" class="form-label comment-question">
                                        What's on your mind?</h5>
                                    <textarea name="comment" class="form-control comment-textarea" id="message" rows="5"
                                        placeholder="Write your comment"></textarea>
                                    <div class="d-flex justify-content-end margin-right">
                                        <button class="btn comment-submit-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- </section> -->
                        <div class="col-lg-5">
                            <div class="instructor-info">
                                <div>
                                    <h5 class="instruction-info-about">About Instructor</h5>
                                    <div class="instruction-info-right">
                                        <div class=""> <img src="/assets/images/instructor_picture_placeholder.png"
                                                alt="" class="instructor-avatar"></div>
                                        <div class="d-flex flex-column justify-content-center align-items-start">
                                            <p class="instructor-info-title mb-0">{{ $course->author->fullname }}</p>
                                            <p class="instructor-info-jobtitle mb-0">
                                                {{ @$course->author->instructor_info->occupation }}</p>
                                            <div class="star-value"><img src="/assets/images/yellow_star_vector.svg"
                                                    alt="" class="mb-0"><span>4.6</span></div>
                                        </div>
                                    </div>
                                    <p class="instructor-info-detail">{{ @$course->author->instructor_info->detail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- Right Column - Premium Card -->
        <div class="">
            <div class="premium-card">
                <h4 class="premium-card-title">
                    @if ($course->value == 1)
                        {{ $general->cur_sym }} {{ getAmount($course->price) }}
                    @else
                        @lang('Free')
                    @endif
                </h4>
                <p class="premium-car-para">@lang('This course includes'):</p>
                <ul class="premium-features">
                    <li><img src="/assets/images/clock_vector.svg" alt=""> {{ $course->totalDuration() }}
                        @lang('hours
                                                                                                    on-demand video') </li>
                    <li><img src="/assets/images/lectures_vector.svg" alt=""> {{ $course->lectures_count }}
                        lectures</li>
                    <li><img src="/assets/images/access_vector.svg" alt=""> @lang('Full lifetime access')</li>
                </ul>

                @auth
                    @if (auth()->user()->is_instructor != 1)
                        @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'success')->first())
                            <a href="{{ route('user.course.play', [$course->id, $course->slug]) }}"
                                class="btn w-100 premium-btn">@lang('Goto Course')</a>
                        @else
                            @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'pending')->first())
                                <a href="javascript:void(0)"
                                    class="btn premium-btn  w-100 purchase disabled">@lang('Pending Approval')</a>
                            @elseif(\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->where('status', 'rejected')->first())
                                <a href="javascript:void(0)"
                                    class="btn premium-btn  w-100 purchase disabled">@lang('Approval Rejected')</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn--light  w-100 purchase premium-btn"
                                    data-payment_route="{{ route('user.payment', $course->code) }}">@lang('Purchase')</a>
                            @endif

                            @if ($course->value != 0)
                                <a href="javascript:void(0)"
                                    class="coupon-open d-block text-center text-white mt-2 premium-btn">@lang('Apply Coupon Code')</a>
                                <form class="coupon-form mt-4">
                                    <div class="input-group coupon-div">
                                        <input type="hidden" name="course_id" value="{{ $course->id }}" id="courseid">
                                        <input type="text" name="coupon" class="form--control" autocomplete="off"
                                            placeholder="@lang('Coupon code')" id="coupon">
                                        <button type="button" class="btn premium-btn"
                                            id="apply-coupon">@lang('Apply')</button>
                                    </div>
                                </form>
                            @endif
                        @endif
                    @else
                        @if ($course->author_id != auth()->id())
                            @if (\App\Models\UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->first())
                                <a href="{{ route('user.course.play', [$course->id, $course->slug]) }}"
                                    class="btn premium-btn  w-100 ">@lang('Goto Course')</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn--light  w-100 purchase premium-btn"
                                    data-payment_route="{{ route('user.payment', $course->code) }}">@lang('Purchase')</a>
                            @endif
                        @endif
                    @endif
                @else
                    <a href="{{ route('user.login') }}" class="btn  w-100 premium-btn">@lang('Purchase')</a>
                @endauth
            </div>

            <!-- Rating Section -->
            <div class="rating-card-container">
                <div class="rate-card-body">
                    <h5 class="rating-card-title">Rate this course</h5>
                    <p class="rating-card-subtitle">Tell others what you think</p>
                    <div class="rating-stars">
                        <img src="/assets/images/course_star.svg" alt="" class="">
                        <img src="/assets/images/course_star.svg" alt="" class="">
                        <img src="/assets/images/course_star.svg" alt="" class="">
                        <img src="/assets/images/course_star.svg" alt="" class="">
                        <img src="/assets/images/course_star.svg" alt="" class="">
                    </div>
                    @guest
                        <h5 class="review">@lang('Please login first')</h5>
                    @else
                        <a href="javascript:void(0)" class="review">write a review</a>
                    @endguest

                </div>
            </div>

            <div>
                <h3 class="comment-title">All Comments ({{ $course->comments_count }})</h3>
            </div>

            <div class="container">
                @foreach ($course->comments as $k => $comment)
                    <div class="comment-container">
                        <!-- Profile Image -->
                        <div class="img-container">
                            <img src="{{ getImage('/assets/images/user/profile/' . $comment->user->image, '350x350') }}"
                                alt="Profile" class="rounded-circle">

                        </div>

                        <!-- Content -->
                        <div class="comment-content-container">
                            <div class="comment-content">
                                <h6 class="mb-0 comment-content-title">{{ $comment->user->fullname }}</h6>
                                <div class="comment-content-subtitle-container">
                                    <span
                                        class="comment-content-subtitle">{{ diffForHumans($comment->created_at) }}</span>
                                </div>
                                <a class="reply" data-bs-toggle="collapse" href="#reply-btn-{{ $k }}"
                                    role="button" aria-expanded="false" aria-controls="collapseExample"><i
                                        class="fa fa-reply"></i>Reply</a>
                            </div>
                            <p class="mb-0 comment-content-comment">
                                {{ __($comment->comment) }}
                            </p>
                            <ul>
                                @foreach ($comment->replies as $reply)
                                    <li>
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ getImage('/assets/images/user/profile/' . $reply->user->image, '350x350') }}"
                                                    alt="comment-thumb" alt="Profile" class="rounded-circle"
                                                    style="width: 48px; height: 48px; background-color: #f0f0f0;">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">

                                                    <h6 class="mb-0 fw-bold">{{ $reply->user->fullname }}</h6>

                                                    <span class="text-primary"
                                                        style="font-size: 14px; background-color: #DDFFFD !important; color: #2C2B31 !important;">{{ diffForHumans($reply->created_at) }}</span>
                                                </div>
                                                <p class="mb-0 text-muted text-left" style="font-size: 10px;">
                                                    {{ __($reply->comment) }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <form class="reply-form collapse" id="reply-btn-{{ $k }}"
                                    action="{{ route('user.post.comment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="comment" class="form-control" placeholder="@lang('Write your reply')"></textarea>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-sm btn--base">@lang('Submit')</button>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    </div>

    </div>
    </div>
    </div>

@endsection

@push('script')
    <script>
        // Character counter
        const textarea = document.querySelector('.review-textarea');
        const charCount = document.querySelector('.character-count');

        textarea.addEventListener('input', function() {
            charCount.textContent = `${this.value.length}/500`;
        });

        // Star rating
        const stars = document.querySelectorAll('.stars');
        const ratingInput = document.getElementById('rating');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                    }
                });

                // Update hidden input with the rating value
                ratingInput.value = index + 1;
            });
        });
    </script>

    <script>
        'use strict';
        (function($) {
            $('.coupon-open').on('click', function() {
                $('.coupon-form').slideToggle();
            });

            $('.purchase').on('click', function() {
                $('#purchaseModal').find('.gateway').attr('href', $(this).data('payment_route'))
                $('#purchaseModal').modal('show')
            });

            $('.review').on('click', function() {

                $('#reviewModal').modal('show')
            });
            // lightcase plugin init
            $('a[data-rel^=lightcase]').lightcase();


            $('#apply-coupon').on('click', function() {


                var coupon = $(this).parents('.coupon-div').find('#coupon').val();
                var courseid = $(this).parents('.coupon-div').find('#courseid').val();
                var route = "{{ route('user.apply.coupon') }}"
                var data = {
                    coupon: coupon,
                    course_id: courseid,
                    _token: '{{ csrf_token() }}'
                }
                $.post(route, data)
                    .then(function(response) {

                        if (response.coupon) {
                            $.each(response.coupon, function(i, val) {
                                notify('error', val);
                            });

                        } else {
                            notify('success', response.yes);

                            $('.newPrice').text('{{ $general->cur_sym }}' + ' ' + response.newPrice)
                            $('.del').addClass('d-none')
                        }
                    })
            })

            function btnDisable(btn) {
                $(btn).addClass('d-none');
            }

            $('.advert').on('click', function() {
                var ad_id = $(this).data('advertid')
                var data = {
                    ad_id: ad_id,
                    _token: '{{ csrf_token() }}'
                }
                var route = "{{ route('ad.click') }}"
                $.post(route, data).then(function(res) {})
            })

        })(jQuery);
    </script>
@endpush
