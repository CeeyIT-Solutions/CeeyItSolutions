<style>
  .btn-signup {
    width: 129px;
    background: linear-gradient(6.43deg, #00E8DB -18.08%, #095450 121.1%);
    box-shadow: 0px 4px 55px 0px #0000001F;
    border-radius: 20px;

  }

  .btn-signup:hover {
    color: white;
  }

  .nav-link {
    font-family: 'AtypDisplay', sans-serif;
    font-weight: 400;
    font-size: 15px;
    line-height: 22px;
    opacity: 70%;
  }

  .nav-link .active {
    font-weight: 600;
    color: #2B2A31;
  }

  @media (min-width: 768px) {
    .nav-item-list {
      padding-right: 54px;
    }
  }
</style>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a href="{{redirect(route('home'))}}"> <img src="{{asset('assets/images/ceeyit_logo.svg')}}" alt="Logo Image"
        style=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon" style=""></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item nav-item-list">
          <a class="nav-link active" href="{{url('/')}}">@lang('Home')</a>
        </li>
        <li class="nav-item nav-item-list">
          <a class="nav-link" href="{{ route('courses') }}">@lang('Courses')</a>
        </li>
        @auth
      <li class="nav-item nav-item-list">
        <a class="nav-link" href="{{route('ticket')}}">@lang('Support')</a>
      </li>
    @endauth

        <li class="nav-item nav-item-list">
          <a class="nav-link" href="{{route('foundation')}}">@lang("Foundation")</a>
        </li>
        <!-- SCHOLARHSHIP -->
        {{-- <li class="nav-item nav-item-list">
          <a class="nav-link" href="{{route(" scholarships")}}">@lang("Scholarships")</a>
        </li> --}}

        @foreach($pages as $k => $data)
      <li class="nav-item  mx-3">
        <a class="nav-link" href="{{route('pages', [$data->slug])}}">{{__($data->name)}}</a>
      </li>
    @endforeach

        @guest
      <li class="nav-item ms-lg-3">
        <a href="{{route('user.register')}}"><button class="btn btn-signup">Sign up</button></a>
      </li>
    @endguest

        @auth
      <li class="nav-item ms-lg-3">
        <a href="{{route('user.home')}}" class="profile-button">
        <img src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, '350x350') }}" width="20"
          height="20" alt="Profile" class="profile-image">
        <strong>
          <span class="profile-span ml-5">{{auth()->user()->firstname . ' ' . auth()->user()->lastname}}</span>
        </strong>
        </a>
      </li>
    @endauth
      </ul>
    </div>
  </div>
</nav>