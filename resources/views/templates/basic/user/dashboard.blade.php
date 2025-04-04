@extends($activeTemplate.'layouts.master')
@section('content')
<br/> <br>
<section class="pt-100 pb-100" >
    <div class="container">
      <div class="row gy-4 justify-content-center">
        <div class="col-xl-6 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="las la-school"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$user->userCourses->count()}}</h3>
              <p class="caption mt-1">@lang('Purchased Courses')</p>
            </div>
            <div class="widget__btn">
              <a href="{{route('user.course.purchased')}}" class="view-all">@lang('View')</a>
            </div>
          </div><!-- widget end -->
        </div>
        <div class="col-xl-6 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="lar la-bookmark"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$user->transactions->count()}}</h3>
              <p class="caption mt-1">@lang('Total Transactions')</p>
            </div>
            <div class="widget__btn">
              <a href="{{route('user.transactions')}}" class="view-all">@lang('View')</a>
            </div>
          </div><!-- widget end -->
        </div>
        {{-- <div class="col-xl-4 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="las la-wallet"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$general->cur_sym}}{{getAmount($user->deposits->sum('amount'))}}</h3>
              <p class="caption mt-1">@lang('Total Deposit')</p>
            </div>
            <div class="widget__btn">
              <a href="{{route('user.deposit.history')}}" class="view-all">@lang('View All')</a>
            </div>
          </div><!-- widget end -->
        </div> --}}
       @if ($user->is_instructor == 1)
        <div class="col-xl-4 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="las la-clipboard-check"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$general->cur_sym}}{{getAmount($user->Withdrawals->sum('amount'))}}</h3>
              <p class="caption mt-1">@lang('Total Withdraw')</p>
            </div>
            <div class="widget__btn">
              <a href="{{route('user.withdraw.history')}}" class="view-all">@lang('View All')</a>
            </div>
          </div><!-- widget end -->
        </div>
        <div class="col-xl-4 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="las la-users"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$user->totalEnrolled()->count()}}</h3>
              <p class="caption mt-1">@lang('Total Student')</p>
            </div>
         
          </div><!-- widget end -->
        </div>
        <div class="col-xl-4 col-md-6 widget-item">
          <div class="widget d-flex flex-wrap align-items-center rounded-3">
            <div class="widget__icon text-white d-inline-flex justify-content-center align-items-center rounded-2">
              <i class="las la-film"></i>
            </div>
            <div class="widget__content">
              <h3 class="widget__number">{{$user->courses()->count()}}</h3>
              <p class="caption mt-1">@lang('Total Approved Course')</p>
            </div>
            <div class="widget__btn">
              <a href="{{route('user.courses')}}" class="view-all">@lang('View All')</a>
            </div>
          </div><!-- widget end -->
        </div>
       @endif
      </div><!-- row end -->

    </div>
</section>
@endsection