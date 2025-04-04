@extends('admin.layouts.app')

@section('panel')

<div class="row">

    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>User</th>
                                <th>More Info</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $k=> $application)
                            <tr>

                                <td data-label="@lang('Course Code')">{{$application->course->title}}</td>
                                <td data-label="@lang('Course Code')">{{optional($application->user)->firstname . " " . optional($application->user)->lastname}}</td>


                                <td data-label="@lang('More Info.')"><button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#more-info{{$application->id}}">
                                        <i class="las la-eye"></i>
                                    </button></td>

                                <td data-label="@lang('Status')">
                                    @if ($application->status == "pending")
                                    <span class="badge badge--warning">Pending</span>
                                    @elseif($application->status == "approved")
                                    <span class="badge badge--success">Approved</span>
                                    @elseif($application->status == "declined")
                                    <span class="badge badge--danger">Declined</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">

                                    @if ($application->status == "pending")
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="actionDropdown" data-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                            <li>
                                                <a href="javascript:void(0)"
                                                    data-route="{{ route('admin.applications.update-status', $application->id) }}?status=approved"
                                                    class="dropdown-item"
                                                    onclick="confirmAction(this)">
                                                    <i class="las la-thumbs-up"></i> Approve
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    data-route="{{ route('admin.applications.update-status', $application->id) }}?status=declined"
                                                    class="dropdown-item"
                                                    onclick="confirmAction(this)">
                                                    <i class="las la-thumbs-down"></i> Decline
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    @endif


                                </td>
                            </tr>

                            <div class="modal fade" id="more-info{{$application->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg--base">
                                            <h5 class="modal-title">@lang('More Info.')</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <!-- Education Section -->
                                                <li class="list-group-item bg-dark text-white text-center font-weight-bold">Education & Employment</li>
                                                <li class="list-group-item">
                                                    <div><strong>Highest Education</strong></div>
                                                    <div class="text-muted">{{ $application->highest_education }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>Current Institution/Employment</strong></div>
                                                    <div class="text-muted">{{ $application->current_institution_employment }}</div>
                                                </li>

                                                <!-- Career Section -->
                                                <li class="list-group-item bg-dark text-white text-center font-weight-bold mt-2">Career Interests</li>
                                                <li class="list-group-item">
                                                    <div><strong>Field of Study or Career Interest</strong></div>
                                                    <div class="text-muted">{{ $application->field_of_study_or_career_interest }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>Reason for Interest in Course</strong></div>
                                                    <div class="text-muted">{{ $application->course_interest_reason }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>Sponsorship Reason</strong></div>
                                                    <div class="text-muted">{{ $application->sponsorship_reason }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>Impact of Course</strong></div>
                                                    <div class="text-muted">{{ $application->impact_of_course }}</div>
                                                </li>

                                                <!-- Social and Reference Section -->
                                                <li class="list-group-item bg-dark text-white text-center font-weight-bold mt-2">Social & References</li>
                                                <li class="list-group-item">
                                                    <div><strong>Social Media Handle</strong></div>
                                                    <div class="text-muted">{{ $application->social_media_handle ?? 'N/A' }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>How Heard About Platform</strong></div>
                                                    <div class="text-muted">{{ $application->heard_about_platform }}</div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div><strong>Heard About Reference</strong></div>
                                                    <div class="text-muted">{{ $application->heard_about_reference ?? 'N/A' }}</div>
                                                </li>

                                                <!-- Give Back Plan Section -->
                                                <li class="list-group-item bg-dark text-white text-center font-weight-bold mt-2">Future Plans</li>
                                                <li class="list-group-item">
                                                    <div><strong>Give Back Plan</strong></div>
                                                    <div class="text-muted">{{ $application->give_back_plan }}</div>
                                                </li>
                                            </ul>
                                        </div>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn--secondary btn-sm" data-dismiss="modal">@lang('Close')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td class="text-center" colspan="12">No Applications Found</td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            <div class="card-footer py-4">
                {{paginateLinks($applications)}}
            </div>
        </div><!-- card end -->
    </div>
    @include('admin.courses.action_modals')
</div>
@endsection

@push('script')
<script>
    'use strict';
    (function($) {
        $('.info').on('click', function() {
            var discount = $(this).data('discount')
            var level = $(this).data('level')
            var chapter = $(this).data('chapter')
            var lecture = $(this).data('lec')

            $('#info-modal').find('.level').text(level)
            $('#info-modal').find('.discount').text(discount + '%')
            $('#info-modal').find('.chapter').text(chapter)
            $('#info-modal').find('.lecture').text(lecture)

            $('#info-modal').modal('show')
        })

        $('.ban').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#banModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
        $('.unban').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#unbanModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
        $('.reject').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#rejectModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
        $('.approve').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#approveModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
        $('.removeTop').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#removeTopModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
        $('.approveTop').on('click', function() {
            var route = $(this).data('route')
            var modal = $('#approveTopModal');
            modal.find('form').attr('action', route)
            modal.modal('show');
        })
    })(jQuery);
</script>
<script>
    function confirmAction(element) {
        if (confirm("Are you sure you want to perform this action?")) {
            // Redirect to the route if confirmed
            window.location.href = element.getAttribute('data-route');
        }
    }
</script>
@endpush



@push('breadcrumb-plugins')
<form action="" method="GET" class="form-inline float-sm-right bg--white">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="@lang('Search by title or code')" value="{{$search ?? ''}}" autocomplete="off">
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@endpush