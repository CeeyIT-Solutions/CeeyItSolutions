<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
    data-background="{{getImage('assets/admin/images/sidebar/2.jpg', '400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] . '/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('admin.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] . '/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.users*', 3)}}">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Users')</span>

                        @if(
                            $banned_users_count > 0 || $email_unverified_users_count > 0 || $sms_unverified_users_count
                            > 0
                        )
                                                    <span class="menu-badge pill bg--primary ml-auto">
                                                        <i class="fa fa-exclamation"></i>
                                                    </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.users*', 2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.users.all')}} ">
                                <a href="{{route('admin.users.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Users')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.users.active')}} ">
                                <a href="{{route('admin.users.active')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Users')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.users.banned')}} ">
                                <a href="{{route('admin.users.banned')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned Users')</span>
                                    @if($banned_users_count)
                                        <span class="menu-badge pill bg--primary ml-auto">{{$banned_users_count}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item  {{menuActive('admin.users.email.unverified')}}">
                                <a href="{{route('admin.users.email.unverified')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Unverified')</span>

                                    @if($email_unverified_users_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{$email_unverified_users_count}}</span>
                                    @endif
                                </a>
                            </li>

                            {{-- <li class="sidebar-menu-item {{menuActive('admin.users.sms.unverified')}}">
                            <a href="{{route('admin.users.sms.unverified')}}" class="nav-link">
                                <i class="menu-icon las la-dot-circle"></i>
                                <span class="menu-title">@lang('SMS Unverified')</span>
                                @if($sms_unverified_users_count)
                                <span class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_users_count}}</span>
                                @endif
                            </a>
                </li> --}}

                <li class="sidebar-menu-item {{menuActive('admin.users.with.balance')}}">
                    <a href="{{route('admin.users.with.balance')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('With Balance')</span>
                        @if($sms_unverified_users_count)
                            <span class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_users_count}}</span>
                        @endif
                    </a>
                </li>


                <li class="sidebar-menu-item {{menuActive('admin.users.email.all')}}">
                    <a href="{{route('admin.users.email.all')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Email to All')</span>
                    </a>
                </li>

            </ul>
        </div>
        </li>
        <li class="sidebar-menu-item sidebar-dropdown">
            <a href="javascript:void(0)" class="{{menuActive('admin.instructor*', 3)}}">
                <i class="menu-icon las la-users"></i>
                <span class="menu-title">@lang('Manage Instructor')</span>

                @if(
                    $banned_instructor_count > 0 || $email_unverified_instructor_count > 0 ||
                    $email_unverified_instructor_count > 0
                )
                                    <span class="menu-badge pill bg--primary ml-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                @endif
            </a>
            <div class="sidebar-submenu {{menuActive('admin.instructor*', 2)}} ">
                <ul>
                    <li class="sidebar-menu-item {{menuActive('admin.instructor.all')}} ">
                        <a href="{{route('admin.instructor.all')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('All Instructor')</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item {{menuActive('admin.instructor.active')}} ">
                        <a href="{{route('admin.instructor.active')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Active Instructor')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{menuActive('admin.instructor.pending')}} ">
                        <a href="{{route('admin.instructor.pending')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Pending Instructor')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{menuActive('admin.instructor.banned')}} ">
                        <a href="{{route('admin.instructor.banned')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Banned Users')</span>
                            @if($banned_instructor_count)
                                <span class="menu-badge pill bg--primary ml-auto">{{$banned_instructor_count}}</span>
                            @endif
                        </a>
                    </li>

                    <li class="sidebar-menu-item  {{menuActive('admin.instructor.email.unverified')}}">
                        <a href="{{route('admin.instructor.email.unverified')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Email Unverified')</span>

                            @if($email_unverified_instructor_count)
                                <span
                                    class="menu-badge pill bg--primary ml-auto">{{$email_unverified_instructor_count}}</span>
                            @endif
                        </a>
                    </li>

                    {{-- <li class="sidebar-menu-item {{menuActive('admin.instructor.sms.unverified')}}">
                    <a href="{{route('admin.instructor.sms.unverified')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('SMS Unverified')</span>
                        @if($sms_unverified_instructor_count)
                        <span class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_instructor_count}}</span>
                        @endif
                    </a>
        </li> --}}

        <li class="sidebar-menu-item {{menuActive('admin.instructor.with.balance')}}">
            <a href="{{route('admin.instructor.with.balance')}}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">@lang('With Balance')</span>

            </a>
        </li>


        <li class="sidebar-menu-item {{menuActive('admin.instructor.email.all')}}">
            <a href="{{route('admin.instructor.email.all')}}" class="nav-link">
                <i class="menu-icon las la-dot-circle"></i>
                <span class="menu-title">@lang('Email to All')</span>
            </a>
        </li>

        </ul>
    </div>
    </li>

    <li class="sidebar-menu-item sidebar-dropdown">
        <a href="javascript:void(0)" class="{{menuActive('admin.categories*', 3)}}">
            <i class="menu-icon las la-th-list"></i>
            <span class="menu-title">@lang('Course Category')</span>

        </a>
        <div class="sidebar-submenu {{menuActive('admin.categories*', 2)}} ">
            <ul>

                <li class="sidebar-menu-item {{menuActive('admin.categories')}} ">
                    <a href="{{route('admin.categories')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Categories')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.subcategories')}} ">
                    <a href="{{route('admin.subcategories')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Sub Categories')</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="sidebar-menu-item sidebar-dropdown">
        <a href="javascript:void(0)" class="{{menuActive('admin.course*', 3)}}">
            <i class="menu-icon las la-film"></i>
            <span class="menu-title">@lang('Manage Course')</span>

        </a>
        <div class="sidebar-submenu {{menuActive('admin.course*', 2)}} ">
            <ul>

                <li class="sidebar-menu-item {{menuActive('admin.course.active')}} ">
                    <a href="{{route('admin.course.active')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Active Courses')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.course.user')}} ">
                    <a href="{{url('admin/courses/users')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('User Courses')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.course.pending')}} ">
                    <a href="{{route('admin.course.pending')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Pending Courses')</span>
                        @if($pending_course > 0)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.course.banned')}} ">
                    <a href="{{route('admin.course.banned')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Banned Courses')</span>
                    </a>
                </li>

            </ul>
        </div>
    </li>

    <!-- APPLY SCHOLARSHIP -->
    <li class="sidebar-menu-item sidebar-dropdown">
        <a href="javascript:void(0)" class="{{menuActive('admin.course*', 3)}}">
            <i class="menu-icon las la-user-graduate"></i>
            <span class="menu-title">@lang('Scholarship')</span>

        </a>
        <div class="sidebar-submenu {{menuActive('admin.course*', 2)}} ">
            <ul>
                <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
                    <a href="{{url('/admin/scholarship/list')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Applications Older')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
                    <a href="{{url('/admin/scholarship/list/2025')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Applications 2025')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
                    <a href="{{url('/admin/laptops/list')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Laptop Apply Older')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
                    <a href="{{url('/admin/laptops/list/2025')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Laptop Apply 2025')</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>


    {{-- <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
    <a href="{{url('/admin/scholarship/list')}}" class="nav-link">
        <i class="menu-icon las la-dot-circle"></i>
        <span class="menu-title">@lang('Application Info')</span>
    </a>
    </li> --}}

    <li class="sidebar-menu-item {{menuActive('admin.levels')}} ">
        <a href="{{route('admin.levels')}}" class="nav-link">
            <i class="menu-icon las la-level-up-alt"></i>
            <span class="menu-title">@lang('Course Levels')</span>
        </a>
    </li>

    <li class="sidebar-menu-item {{menuActive('admin.application')}} ">
        <a href="{{route('admin.applications.list')}}" class="nav-link">
            <i class="menu-icon las la-level-up-alt"></i>
            <span class="menu-title">Applications</span>
        </a>
    </li>

    <li class="sidebar-menu-item  {{menuActive('admin.coupon*')}}">
        <a href="{{route('admin.coupon.all')}}" class="nav-link">
            <i class="menu-icon las la-percentage"></i>
            <span class="menu-title">@lang('Manage Coupons')</span>
        </a>
    </li>
    <li class="sidebar-menu-item  {{menuActive('admin.donations*')}}">
        <a href="{{route('admin.donations.all')}}" class="nav-link">
            <i class="menu-icon las la-hand-holding-heart"></i>
            <span class="menu-title">@lang('Donations')</span>
        </a>
    </li>

    {{-- <li class="sidebar-menu-item  {{menuActive('admin.advertisements*')}}">
    <a href="{{route('admin.advertisements')}}" class="nav-link">
        <i class="lab la-adversal menu-icon"></i>
        <span class="menu-title">@lang('Manage Advertise')</span>
    </a>
    </li> --}}

    <li class="sidebar-menu-item sidebar-dropdown">
        <a href="javascript:void(0)" class="{{menuActive('admin.gateway*', 3)}}">
            <i class="menu-icon las la-credit-card"></i>
            <span class="menu-title">@lang('Payment Gateways')</span>

        </a>
        <div class="sidebar-submenu {{menuActive('admin.gateway*', 2)}} ">
            <ul>

                <li class="sidebar-menu-item {{menuActive('admin.gateway.automatic.index')}} ">
                    <a href="{{route('admin.gateway.automatic.index')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Automatic Gateways')</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item {{menuActive('admin.gateway.manual.index')}} ">
                <a href="{{route('admin.gateway.manual.index')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Manual Gateways')</span>
                </a>
    </li> --}}
    </ul>
</div>
</li>

{{-- <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.deposit*',3)}}">
<i class="menu-icon las la-credit-card"></i>
<span class="menu-title">@lang('Deposits')</span>
@if(0 < $pending_deposits_count) <span class="menu-badge pill bg--primary ml-auto">
    <i class="fa fa-exclamation"></i>
    </span>
    @endif
    </a>
    <div class="sidebar-submenu {{menuActive('admin.deposit*',2)}} ">
        <ul>

            <li class="sidebar-menu-item {{menuActive('admin.deposit.pending')}} ">
                <a href="{{route('admin.deposit.pending')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Pending Deposits')</span>
                    @if($pending_deposits_count)
                    <span class="menu-badge pill bg--primary ml-auto">{{$pending_deposits_count}}</span>
                    @endif
                </a>
            </li>

            <li class="sidebar-menu-item {{menuActive('admin.deposit.approved')}} ">
                <a href="{{route('admin.deposit.approved')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Approved Deposits')</span>
                </a>
            </li>

            <li class="sidebar-menu-item {{menuActive('admin.deposit.successful')}} ">
                <a href="{{route('admin.deposit.successful')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Successful Deposits')</span>
                </a>
            </li>


            <li class="sidebar-menu-item {{menuActive('admin.deposit.rejected')}} ">
                <a href="{{route('admin.deposit.rejected')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('Rejected Deposits')</span>
                </a>
            </li>

            <li class="sidebar-menu-item {{menuActive('admin.deposit.list')}} ">
                <a href="{{route('admin.deposit.list')}}" class="nav-link">
                    <i class="menu-icon las la-dot-circle"></i>
                    <span class="menu-title">@lang('All Deposits')</span>
                </a>
            </li>
        </ul>
    </div>
    </li> --}}

    <li class="sidebar-menu-item sidebar-dropdown">
        <a href="javascript:void(0)" class="{{menuActive('admin.withdraw*', 3)}}">
            <i class="menu-icon la la-bank"></i>
            <span class="menu-title">@lang('Withdrawals') </span>
            @if(0 < $pending_withdraw_count) <span class="menu-badge pill bg--primary ml-auto">
                <i class="fa fa-exclamation"></i>
                </span>
            @endif
        </a>
        <div class="sidebar-submenu {{menuActive('admin.withdraw*', 2)}} ">
            <ul>

                <li class="sidebar-menu-item {{menuActive('admin.withdraw.method.index')}}">
                    <a href="{{route('admin.withdraw.method.index')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Withdrawal Methods')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.withdraw.pending')}} ">
                    <a href="{{route('admin.withdraw.pending')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Pending Log')</span>

                        @if($pending_withdraw_count)
                            <span class="menu-badge pill bg--primary ml-auto">{{$pending_withdraw_count}}</span>
                        @endif
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.withdraw.approved')}} ">
                    <a href="{{route('admin.withdraw.approved')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Approved Log')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.withdraw.rejected')}} ">
                    <a href="{{route('admin.withdraw.rejected')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Rejected Log')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.withdraw.log')}} ">
                    <a href="{{route('admin.withdraw.log')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Withdrawals Log')</span>
                    </a>
                </li>


            </ul>
        </div>
    </li>

    {{-- <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.ticket*',3)}}">
    <i class="menu-icon la la-ticket"></i>
    <span class="menu-title">@lang('Support Ticket') </span>
    @if(0 < $pending_ticket_count) <span class="menu-badge pill bg--primary ml-auto">
        <i class="fa fa-exclamation"></i>
        </span>
        @endif
        </a>
        <div class="sidebar-submenu {{menuActive('admin.ticket*',2)}} ">
            <ul>

                <li class="sidebar-menu-item {{menuActive('admin.ticket')}} ">
                    <a href="{{route('admin.ticket')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('All Ticket')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.ticket.pending')}} ">
                    <a href="{{route('admin.ticket.pending')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Pending Ticket')</span>
                        @if($pending_ticket_count)
                        <span class="menu-badge pill bg--primary ml-auto">{{$pending_ticket_count}}</span>
                        @endif
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.ticket.closed')}} ">
                    <a href="{{route('admin.ticket.closed')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Closed Ticket')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.ticket.answered')}} ">
                    <a href="{{route('admin.ticket.answered')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Answered Ticket')</span>
                    </a>
                </li>
            </ul>
        </div>
        </li> --}}


        <li class="sidebar-menu-item sidebar-dropdown">
            <a href="javascript:void(0)" class="{{menuActive('admin.report*', 3)}}">
                <i class="menu-icon la la-list"></i>
                <span class="menu-title">@lang('Report') </span>
            </a>
            <div class="sidebar-submenu {{menuActive('admin.report*', 2)}} ">
                <ul>
                    <li
                        class="sidebar-menu-item {{menuActive(['admin.report.transaction', 'admin.report.transaction.search'])}}">
                        <a href="{{route('admin.report.transaction')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Transaction Log')</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-menu-item {{menuActive(['admin.report.login.history', 'admin.report.login.ipHistory'])}}">
                        <a href="{{route('admin.report.login.history')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Login History')</span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>


        {{-- <li class="sidebar-menu-item  {{menuActive('admin.subscriber.index')}}">
        <a href="{{route('admin.subscriber.index')}}" class="nav-link"
            data-default-url="{{ route('admin.subscriber.index') }}">
            <i class="menu-icon las la-thumbs-up"></i>
            <span class="menu-title">@lang('Subscribers') </span>
        </a>
        </li> --}}


        {{-- <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.index')}}">
        <a href="{{route('admin.setting.index')}}" class="nav-link">
            <i class="menu-icon las la-life-ring"></i>
            <span class="menu-title">@lang('General Setting')</span>
        </a>
        </li>

        <li class="sidebar-menu-item {{menuActive('admin.setting.logo.icon')}}">
            <a href="{{route('admin.setting.logo.icon')}}" class="nav-link">
                <i class="menu-icon las la-images"></i>
                <span class="menu-title">@lang('Logo & Favicon')</span>
            </a>
        </li> --}}



        {{-- <li class="sidebar-menu-item {{menuActive('admin.extensions.index')}}">
        <a href="{{route('admin.extensions.index')}}" class="nav-link">
            <i class="menu-icon las la-cogs"></i>
            <span class="menu-title">@lang('Extensions')</span>
        </a>
        </li> --}}

        {{-- <li class="sidebar-menu-item  {{menuActive(['admin.language.manage','admin.language.key'])}}">
        <a href="{{route('admin.language.manage')}}" class="nav-link"
            data-default-url="{{ route('admin.language.manage') }}">
            <i class="menu-icon las la-language"></i>
            <span class="menu-title">@lang('Language') </span>
        </a>
        </li> --}}

        {{-- <li class="sidebar-menu-item {{menuActive('admin.seo')}}">
        <a href="{{route('admin.seo')}}" class="nav-link">
            <i class="menu-icon las la-globe"></i>
            <span class="menu-title">@lang('SEO Manager')</span>
        </a>
        </li> --}}

        <li class="sidebar-menu-item sidebar-dropdown">
            <a href="javascript:void(0)" class="{{menuActive('admin.email.template*', 3)}}">
                <i class="menu-icon la la-envelope-o"></i>
                <span class="menu-title">@lang('Email Manager')</span>
            </a>
            <div class="sidebar-submenu {{menuActive('admin.email.template*', 2)}} ">
                <ul>

                    <li class="sidebar-menu-item {{menuActive('admin.email.template.global')}} ">
                        <a href="{{route('admin.email.template.global')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Global Template')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-menu-item {{menuActive(['admin.email.template.index', 'admin.email.template.edit'])}} ">
                        <a href="{{ route('admin.email.template.index') }}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Email Templates')</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item {{menuActive('admin.email.template.setting')}} ">
                        <a href="{{route('admin.email.template.setting')}}" class="nav-link">
                            <i class="menu-icon las la-dot-circle"></i>
                            <span class="menu-title">@lang('Email Configure')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.sms.template*',3)}}">
        <i class="menu-icon la la-mobile"></i>
        <span class="menu-title">@lang('SMS Manager')</span>
        </a>
        <div class="sidebar-submenu {{menuActive('admin.sms.template*',2)}} ">
            <ul>
                <li class="sidebar-menu-item {{menuActive('admin.sms.template.global')}} ">
                    <a href="{{route('admin.sms.template.global')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('Global Setting')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.sms.templates.setting')}} ">
                    <a href="{{route('admin.sms.templates.setting')}}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('SMS Gateways')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive(['admin.sms.template.index','admin.sms.template.edit'])}} ">
                    <a href="{{ route('admin.sms.template.index') }}" class="nav-link">
                        <i class="menu-icon las la-dot-circle"></i>
                        <span class="menu-title">@lang('SMS Templates')</span>
                    </a>
                </li>
            </ul>
        </div>
        </li> --}}

        {{-- <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.templates')}}">
        <a href="{{route('admin.frontend.templates')}}" class="nav-link ">
            <i class="menu-icon la la-html5"></i>
            <span class="menu-title">@lang('Manage Templates')</span>
        </a>
        </li> --}}

        {{-- <li class="sidebar-menu-item {{menuActive('admin.frontend.manage.pages')}}">
        <a href="{{route('admin.frontend.manage.pages')}}" class="nav-link ">
            <i class="menu-icon la la-list"></i>
            <span class="menu-title">@lang('Manage Pages')</span>
        </a>
        </li> --}}

        <li class="sidebar-menu-item sidebar-dropdown">
            <a href="javascript:void(0)" class="{{menuActive('admin.frontend.sections*', 3)}}">
                <i class="menu-icon la la-html5"></i>
                <span class="menu-title">@lang('Manage Section')</span>
            </a>
            <div class="sidebar-submenu {{menuActive('admin.frontend.sections*', 2)}} ">
                <ul>
                    @php
                        $lastSegment = collect(request()->segments())->last();
                    @endphp
                    @foreach(getPageSections(true) as $k => $secs)
                        @if($secs['builder'])
                            @if($k == 'testimonial')
                                <li class="sidebar-menu-item  @if($lastSegment == $k) active @endif ">
                                    <a href="{{ route('admin.frontend.sections', $k) }}" class="nav-link">
                                        <i class="menu-icon las la-dot-circle"></i>
                                        <span class="menu-title">{{__($secs['name'])}}</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>

        {{-- <li class="sidebar__menu-header">@lang('Extra')</li>

                <li class="sidebar-menu-item  {{menuActive('admin.system.info')}}">
        <a href="{{route('admin.system.info')}}" class="nav-link" data-default-url="{{ route('admin.system.info') }}">
            <i class="menu-icon las la-server"></i>
            <span class="menu-title">@lang('System Information') </span>
        </a>
        </li>

        <li class="sidebar-menu-item {{menuActive('admin.setting.custom.css')}}">
            <a href="{{route('admin.setting.custom.css')}}" class="nav-link">
                <i class="menu-icon lab la-css3-alt"></i>
                <span class="menu-title">@lang('Custom CSS')</span>
            </a>
        </li>

        <li class="sidebar-menu-item {{menuActive('admin.setting.optimize')}}">
            <a href="{{route('admin.setting.optimize')}}" class="nav-link">
                <i class="menu-icon las la-broom"></i>
                <span class="menu-title">@lang('Clear Cache')</span>
            </a>
        </li>
        <li class="sidebar-menu-item  {{menuActive('admin.request.report')}}">
            <a href="{{route('admin.request.report')}}" class="nav-link"
                data-default-url="{{ route('admin.request.report') }}">
                <i class="menu-icon las la-bug"></i>
                <span class="menu-title">@lang('Report & Request') </span>
            </a>
        </li> --}}

        </ul>
        <div class="text-center mb-3 text-uppercase">
            <span class="text--white">Developed by </span>
            <br>
            <span class="text--white"><a href="https://alphadevelopers.co.uk/">ALPHA DEVELOPERS</a></span>
        </div>
        </div>
        </div>
        </div>
        <!-- sidebar end -->