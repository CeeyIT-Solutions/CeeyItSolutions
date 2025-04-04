@extends($activeTemplate.'layouts.frontend')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

  /* courses */
  .container-top {
    min-height: 100vh;
    padding: 4rem 1rem; 
    margin-bottom: 14rem; 
  }
  .custom-input {
    display: flex;
    justify-content:center;
    margin:auto;
    border-radius: 50px;
    border: 1px solid #C0D4D3;
    padding-top: 1.3rem;
    padding-bottom:1.3rem;
    padding-left: 66px !important;
  }
  .form-control::placeholder{
    font-family:"Atyp Text",sans-serif;
    font-weight: 400;
    font-size:18px;
    line-height: 25.38px;
    color:#2C2A31;
    opacity: 30%;
    height:100%;
  }
  .input-container {
    position: relative;
    width: 100%;
  }

  .search-icon {
    position: absolute;
    top: 35px;
    left: 25px;
  }

   /* SELECT DROPDOWN */
   .custom-select {
    position: relative;
    width: fit-content;
    background-color: #DDFFFD;
    border-radius: 50px;
    color: #059B93;
    padding-top: 17px;
    padding-bottom: 17px;
    padding-left:40px;
    font-family:"Atyp Text",sans-serif;
    font-weight:500;
    font-size: 18px;
    line-height: 25.54px;
    
   }

   .failed {
    color: #9b98ad !important;
    font-size: 12px;
    margin-bottom: 1rem;
  }

   .custom-select .option {
    color:#059B93;
    padding-left:14px;
   }

   .select-course-icon {
    position:absolute;
    top:25px;
    left:20px;
    z-index: 1;
   }
   /* SELECT DROPDOWN */

   /* CARD */
   .card-container {
    /* width: 294px; */
    height: 400px;
    border: none;
    box-shadow: 0px 2px 12px 0px #50CAE92E;
    border-radius: 20px !important;
  }

  .card-top-image {
    display: flex;
    align-items: center;
    justify-content: center;
     border-top-right-radius: 20px;
     border-top-left-radius: 20px;
     width:100%;
     /* height: 100%; */

   }

   .card-container h5 {
    font-family: 'AtypDisplay',sans-serif;
    font-size: 21.77px;
    font-weight: 500;
    line-height: 31.33px;
    text-decoration-skip-ink: none;
    color: #302F35;
    text-wrap: nowrap;

   }

   .time-icon {
    width:9.22px !important;
    height: 9.22px !important;
   }

   .course-icon {
    width:9.22px !important;
    height: 9.22px !important;
   }

   .course-card-subtitle {
     font-family: 'AtypDisplay',sans-serif;
     font-weight: 400;
     font-size: 10px;
     line-height: 17.28px;
     color:#302F35;
     margin-left: 3px;
   }

   .course-ratings {
    display:flex;
    /* align-items: center; */
    color: #FCC318;
    font-size: 12px;
    width: 14.6px;
    height: 14.6px;
    margin-top: 9px;
   }

   .course-rating-score {
    font-family: 'AtypDisplay',sans-serif;
    font-weight: 400;
    font-size: 9px;
    line-height: 17.28px;
    color: #302F35;
    margin-left: 5px;

   }

   .view-courses-btn {
    font-family: 'AtypDisplay',sans-serif;
    font-weight: 400;
    font-size: 10.16px;
    line-height: 14.47px;
    color:#ffffff;
    width: 103px;
    border: none;
    border-radius: 13.55px;
    margin-top: 5px;
    background: linear-gradient(180deg, #00E8DB -31.4%, #095450 126.74%);

   }
   
   .gap-y-45 {
    row-gap: 45px; 
   }
   /* CARD */

  @media (min-width:576px) {
    .input-container {
      display: flex;
      justify-content:center;
   
    }
      .custom-input {
      border-radius: 50px;
      border: 1px solid #C0D4D3;
      padding: 1.3rem 3.2rem;

    }

    .search-icon {
      position: absolute;
      top: 35px;
      left: 25px;
    }

    .card-container {
    height: 321px;
    }
   
  }

  @media (min-width:768px) {
    .input-container {
      
    }

    .card-container {
    height: 321px;
    }

    .gap-y-45 {
    row-gap: 73px; 
   }
  }
    @media (min-width:992px) {
      .input-container {
      width: 820px;
    }

	}
    @media (min-width:1200px) {
      
    }
    @media (min-width:1400px) {
      
    }
  
  /* courses */
</style>
@endsection
@section('content')
<!-- <section>
  <div class="container-fluid" style="padding-top:80px;padding-bottom: 50px;background: #00000080; background-image: url('{{getImage('assets/images/frontend/banner/bg.svg','1920x640')}}')">
    <div class="container" style="padding-left:7%; padding-right:7%">
      <div class="row">
        <div class="col-md-12 mb-4">
          <form class="hero-search-form category-search-form mb-0" action="" method="GET">
            <i class="las la-search"></i>
            <input type="text" name="search" autocomplete="on" class="form--control" placeholder="@lang('title, tags eg. web design, art, skill development')...">
            <button type="submit" class="hero-search-form__btn">@lang('Search')</button>
          </form>
        </div>
      </div>
      <div class="row" style="margin-top:-30px; margin-bottom: 30px">
        <div class="col-md-3 col-sm-6">
          <div class="action-widget__body">
            <select class="select select-md" onChange="window.location.href=this.value">
              <option value="{{queryBuild('type','')}}" {{request('type') == '' ? 'selected':''}}>@lang('Select type')</option>
              <option value="{{queryBuild('type',1)}}" {{request('type') == 1 ? 'selected':''}}>@lang('Top Courses')</option>
              <option value="{{queryBuild('type',2)}}" {{request('type') == 2 ? 'selected':''}}>@lang('Latest Courses')</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="action-widget__body">
            <select class="select select-md" onChange="window.location.href=this.value">
              <option value="{{queryBuild('value','')}}" {{request('value') == '' ? 'selected':''}}>@lang('All')</option>
              <option value="{{queryBuild('value','free')}}" {{request('value') == 'free' ? 'selected':''}}>@lang('Free')</option>
              <option value="{{queryBuild('value','premium')}}" {{request('value') == 'premium' ? 'selected':''}}>@lang('Premium')</option>
            </select>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="action-widget__body">
            <select class="select select-md cat" onChange="window.location.href=this.value">
              <option value="{{queryBuild('category','')}}" {{request('category') == '' ? 'selected':''}}>@lang('All')</option>
              @foreach ($categories as $category)
              <option value="{{queryBuild('category',$category->slug)}}" {{request('category') == $category->slug ? 'selected':''}}>{{$category->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="action-widget__body">
            <select class="select select-md" onChange="window.location.href=this.value">
              <option value="{{queryBuild('level','')}}" {{request('level') == '' ? 'selected':''}}>@lang('All')</option>
              @foreach ($levels as $level)
              <option value="{{queryBuild('level',$level->slug)}}" {{request('level') == $level->slug ? 'selected':''}}>{{$level->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        {{-- <div class="col-lg-3 pe-4">
          <button class="action-sidebar-open mb-4"><i class="las la-sliders-h"></i> @lang('Filter')</button>
          <div class="action-sidebar">
            <button class="action-sidebar-close"><i class="las la-times"></i></button>
            <div class="action-widget pt-0">
              <h4 class="action-widget__title">@lang('Course filter by')</h4>
            
        </div>
            <div class="action-widget">
              <h4 class="action-widget__title">@lang('Filter by price')</h4>
              <div class="action-widget__body">
               
             
              </div>
            </div>
            <div class="action-widget">
                <h6 class="action-widget__title">@lang('Category')</h6>
                <div class="action-widget__body">
                 
               
                </div>
              </div>

            <div class="action-widget">
              <h6 class="action-widget__title">@lang('Level')</h6>
              <div class="action-widget__body">
               
             
              </div>
            </div>
          </div> --}}
        {{-- <div class="show-img mt-3 rounded-3 overflow-hidden d-lg-block d-none">
            @php
              echo advertisements('300x250');
            @endphp
          </div>
          <div class="show-img mt-3 rounded-3 overflow-hidden d-lg-block d-none">
            @php
               echo advertisements('300x250');
            @endphp
          </div>
          <div class="show-img mt-3 rounded-3 overflow-hidden d-lg-block d-none">
            @php
              echo advertisements('300x600');
             @endphp
          </div> --}}
      </div>
    </div>
  </div>

  <div class="container pt-100">
    <div class="row ">

      @forelse ($courses as $course)
      <div class="col-md-3 col-sm-6">
        <div class="course-card mb-5" style="height: 510px">
          <div class="course-card__thumb">
            <img src="{{getImage(imagePath()['course']['path'].'/thumb_'.$course->thumbnail,imagePath()['course']['preview_size'])}}" alt="image">
            <div class="course-type"><i class="las la-file-video"></i></div>
          </div>
          <div class="course-card__content">
            <div class="mb-3">
              <span class="course-tag fs--12px">{{@$course->subcategory->name}}</span>
              <div style="float: right">
                <span style="float: right" class="badge bg--primary font-weight-normal mt-2">{{$course->level->name}}</span>

              </div>
            </div>
            <a style="margin-top:-15px" href="{{route('course.details',[$course->id,$course->slug])}}">
              <h6 class="course-title mt-0"><a href="{{route('course.details',[$course->id,$course->slug])}}">{{$course->title}}</a></h6>
            </a>
            <div style="margin-top:10px" class="mb-3">
              <p class="mt-3" style="font-size: 14px">{{Str::limit(strip_tags(@$course->description,120))}}</p>

              {{-- <p style="font-size:13px">Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod tempor</p> --}}
              {{-- <p> {!!substr($course->description,0,200)!!}</p> --}}
              {{-- {!!strlen($course->description) > 200 ? substr($course->description,0,200) : $course->description!!} --}}
              {{-- @php
                echo  Illuminate\Support\Str::words($course->description, 20, '');
                    
                      // echo ratings($course->avgRating());
                  @endphp --}}
              {{-- <span class="ms-2">({{$course->avgRating()}})</span> --}}
            </div>
            <div class="course-mentor mt-2">
              <div class="left">
                <div class="teacher">
                  <div class="thumb"><img src="{{getImage(imagePath()['profile']['user']['path'].'/'.$course->author->image,'350x350')}}" alt="image"></div>
                  <p style="font-size: 12px" class="name">{{$course->author->fullname}}</p>
                </div>
              </div>
              <div class="right">
                @if ($course->discount)
                <del style="font-size: 12px" class="text-muted fs--10px">{{$general->cur_sym}}{{getAmount($course->price)}}</del>
                <div style="font-size: 14px" class="course-price">{{$general->cur_sym}}{{getAmount($course->discountPrice())}}</div>
                @else
                <div style="font-size: 14px" class="course-price">@if(getAmount($course->price)) {{$general->cur_sym}}{{getAmount($course->price)}} @else @lang('Free') @endif</div>
                @endif
                {{-- <span class="fs--14px">{{number_format_short($course->courseUsers->count())}} @lang('enrolled')</span> --}}
              </div>
            </div>
          </div>
          {{-- <div class="course-footer">
                      <div class="w-100 text-center">
                      
                        <a href="{{route('course.details',[$course->id,$course->slug])}}" class="btn btn-sm btn--base w-100 mt-4">@lang('View Details')</a>
        </div>
      </div> --}}
    </div>
  </div>


  @empty
  <div class="course-card list-view">
    <div class="course-card__thumb text-md-start text-center not__found">
      <img src="{{getImage('assets/images/not_found.jpg')}}" width="60%" alt="image">
    </div>
    <div class="course-card__content d-flex align-items-center justify-content-center">
      <h5>@lang('No courses found !')</h5>
    </div>
  </div>
  @endforelse
  <div class="text-end mt-4 pagination-md">
    <ul class="pagination d-inline-flex">
      {{paginateLinks($courses,'')}}
      </li>
    </ul>
  </div>
  </div>
  </div>

  </div>


</section> -->

<!-- //// NEW IMPLEMENTATION /// -->
  <div class="container container-top mx-auto " style="min-height: screen;">
    <div>
    
      <form  action="" method="GET">
        <div class="input-container mb-3 mx-auto">
          <!-- <span class="border-none bg-transparent" id="basic-addon1"> -->
            <svg class="search-icon" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.6" d="M26.6209 24.7238L21.6154 19.755C23.5583 17.3305 24.4993 14.2532 24.2447 11.1558C23.9901 8.0584 22.5594 5.17633 20.2466 3.1022C17.9339 1.02807 14.915 -0.080459 11.8106 0.00455155C8.70629 0.0895621 5.75247 1.36165 3.55654 3.55924C1.36062 5.75684 0.0894941 8.71291 0.0045481 11.8196C-0.080398 14.9263 1.02729 17.9475 3.09984 20.262C5.1724 22.5765 8.05229 24.0083 11.1473 24.2631C14.2424 24.5179 17.3174 23.5762 19.74 21.6318L24.705 26.6006C24.8305 26.7272 24.9797 26.8276 25.1441 26.8962C25.3085 26.9647 25.4848 27 25.663 27C25.8411 27 26.0174 26.9647 26.1818 26.8962C26.3462 26.8276 26.4955 26.7272 26.6209 26.6006C26.8641 26.3488 27 26.0124 27 25.6622C27 25.312 26.8641 24.9756 26.6209 24.7238ZM12.171 21.6318C10.3031 21.6318 8.47708 21.0775 6.92396 20.0389C5.37084 19.0004 4.16033 17.5242 3.44551 15.7972C2.73068 14.0701 2.54365 12.1697 2.90807 10.3363C3.27248 8.5029 4.17197 6.81879 5.49279 5.49696C6.81361 4.17514 8.49644 3.27497 10.3285 2.91027C12.1605 2.54558 14.0595 2.73276 15.7852 3.44812C17.5109 4.16349 18.9859 5.37492 20.0237 6.92922C21.0615 8.48352 21.6154 10.3109 21.6154 12.1802C21.6154 14.6869 20.6203 17.091 18.8492 18.8635C17.078 20.636 14.6758 21.6318 12.171 21.6318Z" fill="black"/>
            </svg>
          <!-- </span> -->
          <input type="text" class="form-control custom-input mx-auto" placeholder="Browse courses, tags, titles." aria-label="Browse courses, tags, titles." aria-describedby="basic-addon1">
          
        </div>
     </form>
    </div>
    
   <div class="d-flex mx-auto position-relative" style="max-width:900px;">
     <img class="select-course-icon" src="{{asset('assets/images/course_icon.svg')}}" alt="">
     <div>
      <select class="form-select custom-select"  onChange="window.location.href=this.value" aria-label="Default select example">
        <option selected value="{{queryBuild('category','')}}">All Category</option>
        @foreach ($categories as $category)
          <option value="{{queryBuild('category',$category->slug)}}" {{request('category') == $category->slug ? 'selected':''}}>{{$category->name}}</option>
        @endforeach
      </select>
     </div>

   </div>

   <div class="container">
      <div class="row my-5">
        @forelse ($courses as $course)
          <div class="col col-sm-6 col-md-4 col-lg-3 my-4">
            <div class="card shadow border-0" style="border-radius: 20px !important; box-shadow: 0px 2px 12px 0px #50CAE92E;">
              <img src="{{getImage(imagePath()['course']['path'].'/thumb_'.$course->thumbnail,imagePath()['course']['preview_size'])}}" class="card-img-top" alt="..." >
              <div class="card-body" >
                <h5 class="card-title" style="over">{{$course->title}}</h5>
                <div class="card-text">
                  <div class="d-flex gap-2">
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/images/time_icon.svg')}}" class="time-icon" alt="...">
                      <p class="card-text course-card-subtitle">{{$course->totalDuration()}} hours</p>
                    </div>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('assets/images/course_icon_small.svg')}}" class="course-icon" alt="...">
                      <p class="card-text course-card-subtitle">{{$course->lectures()->count()}} modules</p>
                    </div>
                  </div>
                </div>

                @php
                  $rating = intval(abs($course->avgRating())); // Get the rating
                  $fullStars = floor($rating); // Number of full stars
                  $halfStar = ($rating - $fullStars) >= 0.5; // Check if there's a half star
                  $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Remaining empty stars
                @endphp
                
                <div class="course-ratings">
                  @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star"></i>
                  @endfor

                  <!-- Display half star if necessary -->
                  @if ($halfStar)
                    <i class="fas fa-star-half"></i>
                  @endif

                  <!-- Display empty stars -->
                  @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="fas fa-star failed"></i>
                  @endfor

                  @if($rating>0)
                  <p class="course-rating-score">4.5</p>
                  @endif
                </div>
                <div class="d-flex justify-content-end">
                  <a href="{{route('course.details',[$course->id,$course->slug])}}" class="btn view-courses-btn">View course</a>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="{{getImage('assets/images/not_found.jpg')}}" class="img-fluid" alt="image">
              </div>
              <div class="col-md-8">
                <div class="card-body d-flex align-items-center justify-content-center">
                  <h5 class="card-title">@lang('No courses found !')</h5>
                </div>
              </div>
            </div>
          </div>
        @endforelse
        <div class="text-end mt-4 pagination-md">
          <ul class="pagination d-inline-flex">
            {{paginateLinks($courses,'')}}
            </li>
          </ul>
        </div>
      </div>
   </div>
  </div>

  @endsection

  @push('script')
  <script>
    'use strict';
    (function($) {
      $('.advert').on('click', function() {
        var ad_id = $(this).data('advertid')
        var data = {
          ad_id: ad_id,
          _token: '{{csrf_token()}}'
        }
        var route = "{{route('ad.click')}}"
        $.post(route, data).then(function(res) {})
      })

    })(jQuery);
  </script>
  @endpush