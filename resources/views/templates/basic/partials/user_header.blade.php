<header class="header">
  <div class="header__bottom">
    <div class="container">
      <nav class="navbar navbar-expand-xl p-0 align-items-center">
        <a class="site-logo site-title" href="{{url('/')}}"><img src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="menu-toggle"></span>
        </button>
        <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
          <ul class="navbar-nav main-menu m-auto">
            <li><a href="{{url('/')}}">@lang('Home')</a></li>
            @if (auth()->user()->is_instructor == 1)
            <li class="menu_has_children"><a href="javascript:void(0)">@lang('Instructor')</a>
              <ul class="sub-menu">
                <li><a href="{{route('user.create.course')}}"> <i class="las la-plus"></i> @lang('Create Course')</a></li>
                <li><a href="{{route('user.courses')}}"> <i class="las la-book"></i> @lang('My Courses')</a></li>

              </ul>
            </li>
            @else
            <li><a href="{{route('courses')}}"> @lang('Courses')</a></li>
            @endif

            <li><a href="{{route('user.transactions')}}"> @lang('Transactions')</a></li>

            {{-- <li><a href="{{route('user.deposit.history')}}">@lang('Deposits')</a></li> --}}
            @if (auth()->user()->is_instructor == 1)
            <li><a href="{{route('user.withdraw.history')}}">@lang('Withdrawals')</a></li>
            @endif


            <li class="menu_has_children"><a href="javascript:void(0)">@lang('More')</a>
              <ul class="sub-menu">
                <li><a href="{{route('user.application.form')}}">Apply For Courses</a></li>
                <li><a href="{{route('user.become.instructor')}}">@lang('Become an Instructor')</a></li>
                <li><a href="{{route('user.profile.setting')}}">@lang('Profile Setting')</a></li>
                <li><a href="{{route('user.change.password')}}">@lang('Change Password')</a></li>
                <li><a href="{{route('user.twofactor')}}">@lang('2FA Security')</a></li>
                {{-- <li><a href="{{route('ticket')}}">@lang('Support')</a>
            </li> --}}
          </ul>
          </li>


          </ul>
          <div class="nav-right align-items-center">
            {{-- <select class="language-select me-3 langSel mt-sm-0 mt-2">
                @foreach($language as $item)
                    <option value="{{$item->code}}" @if(session('lang') == $item->code) selected @endif>{{ __($item->name)}}</option>
            @endforeach
            </select> --}}

            <a href="{{route('user.home')}}" class="btn btn-sm btn-outline--base d-flex align-items-center me-2 mt-sm-0 mt-2"><i class="las la-home fs--18px me-2"></i>@lang('Dashboard')</a>

            <a href="{{route('user.logout')}}" class="btn btn-sm btn--base d-flex align-items-center mt-sm-0 mt-2"><i class="las la-sign-out-alt fs--18px me-2"></i>@lang('Logout')</a>

          </div>
        </div>
      </nav>
    </div>
  </div><!-- header__bottom end -->
</header>