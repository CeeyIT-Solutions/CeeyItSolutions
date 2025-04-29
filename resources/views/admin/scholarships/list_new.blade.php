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
                                    {{-- <th>@lang("ID")</th> --}}
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Phone No.')</th>
                                    <th>@lang('Course')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Slack Invite')</th>
                                    {{-- <th>@lang('Send Channel Invite')</th> --}}
                                    <th>@lang('Action')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $key => $data)
                                    <tr>
                                        {{-- <td><strong>
                                                                        {{ $data['id']}}
                                                                    </strong></td> --}}
                                        <td><strong>{{ $data['full_name'] ?? '-' }} </strong></td>
                                        <td>{{ $data['email'] ?? '-' }}</td>
                                        <td>{{ $data['phone'] ?? '-' }}</td>
                                        <td>{{ $data['course']['title'] ?? '-' }}</td>
                                        <td>{{ showDateTime($data['created_at']) }} </td>

                                        {{-- <td>
                                                                    @if ($data['is_email_sent'] == 0)
                                                                    <span class="badge bg-warning text-white p-2"><b>Pending</b></span>
                                                                    @elseif ($data['is_email_sent'] == 1)
                                                                    <span class="badge bg-success p-2"><strong>Sent</strong></span>
                                                                    @elseif ($data['is_email_sent'] == 2)
                                                                    <span class="badge bg-danger p-2"><strong>Failed</strong></span>
                                                                    @else
                                                                    <span class="badge bg-secondary p-2">Unknown Status</span>
                                                                    @endif
                                                                </td> --}}

                                        <td>
                                            @if ($data['approval_status'] == 0)
                                                <span class="badge bg-warning text-white p-2">Pending</span>
                                            @elseif ($data['approval_status'] == 1)
                                                <span class="badge bg-success text-white p-2">Accepted</span>
                                            @elseif ($data['approval_status'] == 2)
                                                <span class="badge bg-danger text-white p-2">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown Status</span>
                                            @endif
                                        </td>

                                        {{-- sends slack invite  --}}
                                        <td>
                                            @if ($data['is_slack_invite_sent'] == 0)
                                                <button class="btn btn-sm btn-primary send-slack-invite-user"
                                                    data-user-id="{{ $data['id'] }}">
                                                    Send Slack Invite
                                                </button>
                                            @elseif ($data['is_slack_invite_sent'] == 1)
                                                <span class="badge bg-success text-white p-2">Sent</span>
                                            @elseif ($data['is_slack_invite_sent'] == 2)
                                                <span class="badge bg-danger text-white p-2">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown Status</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if ($data['is_slack_invite_sent'] == 0)
                                                <span class="badge bg-warning text-white p-2">Pending</span>
                                            @elseif ($data['is_slack_invite_sent'] == 1)
                                                <span class="badge bg-success text-white p-2">Sent</span>
                                            @elseif ($data['is_slack_invite_sent'] == 2)
                                                <span class="badge bg-danger text-white p-2">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown Status</span>
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            @if ($data['channel_invite_email'] == 0)
                                                <span class="badge bg-warning text-white p-2">Pending</span>
                                            @elseif ($data['channel_invite_email'] == 1)
                                                <span class="badge bg-success text-white p-2">Sent</span>
                                            @elseif ($data['channel_invite_email'] == 2)
                                                <span class="badge bg-danger text-white p-2">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown Status</span>
                                            @endif
                                        </td> --}}

                                        @php
                                            $occupation =
                                                $data['occupation'] == 'non_it_professional'
                                                    ? 'Non IT Professional'
                                                    : 'IT
                                                                                                Professional';
                                            if ($data['approval_status'] == 0) {
                                                $status = 'Pending';
                                            } elseif ($data['approval_status'] == 1) {
                                                $status = 'Accepted';
                                            } else {
                                                $status = 'Rejected';
                                            }
                                        @endphp
                                        <td>
                                            @if ($data['approval_status'] == 0)
                                                <button class="btn btn-success approve-btn" data-id="{{ $data['id'] }}"
                                                    data-status="1">Approve</button>
                                                <button class="btn btn-danger deny-btn" data-id="{{ $data['id'] }}"
                                                    data-status="2">Deny</button>
                                            @endif
                                            <button class="btn btn-primary view-btn" data-id="{{ $data['application_id'] }}"
                                                data-full_name="{{ $data['full_name'] }}" data-email="{{ $data['email'] }}"
                                                data-phone="{{ $data['phone'] }}"
                                                data-course="{{ $data['course']['title'] }}"
                                                data-occupation="{{ $occupation }}" data-status="{{ $status }}"
                                                data-interest="{{ $data['interest'] }}"
                                                data-challenges="{{ $data['challenges'] }}"
                                                data-tech_experience="{{ $data['tech_experience'] }}"
                                                data-tech_experience_details="{{ $data['tech_experience_details'] }}"
                                                data-toggle="modal" data-target="#viewModal">
                                                <i class="las la-eye text--shadow"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="12">@lang('No data available.')</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4 d-flex justify-content-between">
                    <div>
                        Total Records : <strong> {{ $totalCount }}</strong>
                    </div>
                    <div>

                        {{ paginateLinks($applications) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Viewing Details -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Scholarship Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <strong>Application ID:</strong>
                            <span id="modal-application-id"></span>
                        </div>
                        <hr>
                        <div>
                            <strong>Full Name:</strong>
                            <span id="modal-full-name"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Email:</strong>
                            <span id="modal-email"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Phone:</strong>
                            <span id="modal-phone"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Occupation:</strong>
                            <span id="modal-occupation"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Course:</strong>
                            <span id="modal-course"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Interest:</strong>
                            <span id="modal-interest"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Challenges:</strong>
                            <span id="modal-challenges"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Tech Experience:</strong>
                            <span id="modal-tech_experience"></span>
                        </div>

                        <div class="tect_exp" style="display: none;">
                            <hr>

                            <strong>Tech Experience Details:</strong>
                            <span id="modal-tech_experience_details"></span>
                        </div>
                        <hr>

                        <div>
                            <strong>Status:</strong>
                            <span id="modal-status"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deny Confirmation Modal -->
        <div class="modal fade" id="confirmDenyModal" tabindex="-1" role="dialog" aria-labelledby="confirmDenyModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDenyModalLabel">Confirm Deny</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to deny this application?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDenyButton">Confirm Deny</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval Confirmation Modal -->
        <div class="modal fade" id="confirmApprovalModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmApprovalModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmApprovalModalLabel">Confirm Approval</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to accept this application?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="confirmApprovalButton">Confirm
                            Approval</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        $(document).ready(function() {
            $('.view-btn').on('click', function() {
                $('#modal-full-name').text($(this).data('full_name'));
                $('#modal-email').text($(this).data('email'));
                $('#modal-phone').text($(this).data('phone'));
                $('#modal-course').text($(this).data('course'));
                $('#modal-occupation').text($(this).data('occupation'));
                $('#modal-status').text($(this).data('status'));
                $('#modal-application-id').text($(this).data('id'));
                $('#modal-interest').text($(this).data('interest'));
                $('#modal-challenges').text($(this).data('challenges'));
                $('#modal-tech_experience').text($(this).data('tech_experience'));
                $('#modal-tech_experience_details').text($(this).data('tech_experience_details'));

                if ($(this).data('tech_experience') == 'No') {
                    $(".tect_exp").hide();
                } else {
                    $(".tect_exp").show();

                }

                $('#viewModal').modal('show');
            });
        });


        /* APPROVAL BUTTON CLICK FUNCTION  */

        $(".approve-btn").click(function() {

            var Id = $(this).data('id');
            var status = $(this).data('status');

            // Show the confirmation modal
            $('#confirmApprovalModal').modal('show');

            // On confirm deny button click
            $('#confirmApprovalButton').click(function() {
                $(this).prop('disabled', true);
                $(this).text('Processing...');
                // Send AJAX request to deny the application
                $.ajax({
                    url: '/admin/approve-application',
                    method: 'POST',
                    data: {
                        application_id: Id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: status
                    },
                    success: function(response) {
                        $('#confirmApprovalModal').modal('hide');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred. Please try again later.');
                    }
                });
            });
        });


        $(".deny-btn").click(function() {
            var applicationId = $(this).data('id');
            var status = $(this).data('status');

            $('#confirmDenyModal').modal('show');

            $('#confirmDenyButton').click(function() {

                $(this).prop('disabled', true);
                $(this).text('Processing...');

                $.ajax({
                    url: '/admin/deny-application',
                    method: 'POST',
                    data: {
                        application_id: applicationId,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: status
                    },
                    success: function(response) {
                        $('#confirmDenyModal').modal('hide');
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred. Please try again later.');
                    }
                });
            });
        });
    </script>
@endpush

@push('breadcrumb-plugins')
    <button type="button" class="btn btn--success ml-2 mr-2 mb-2" data-bs-toggle="modal" data-bs-target="#courseModal">
        <i class="fas fa-envelope"></i>
        @lang('Send Channel Invite')
    </button>
    <button type="button" id="sendSlackInvite" value="1" class="btn btn--info ml-2 mr-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-slack"
            style="width: 20px;color:white" viewBox="0 0 448 512">
            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path
                d="M94.1 315.1c0 25.9-21.2 47.1-47.1 47.1S0 341 0 315.1c0-25.9 21.2-47.1 47.1-47.1h47.1v47.1zm23.7 0c0-25.9 21.2-47.1 47.1-47.1s47.1 21.2 47.1 47.1v117.8c0 25.9-21.2 47.1-47.1 47.1s-47.1-21.2-47.1-47.1V315.1zm47.1-189c-25.9 0-47.1-21.2-47.1-47.1S139 32 164.9 32s47.1 21.2 47.1 47.1v47.1H164.9zm0 23.7c25.9 0 47.1 21.2 47.1 47.1s-21.2 47.1-47.1 47.1H47.1C21.2 244 0 222.8 0 196.9s21.2-47.1 47.1-47.1H164.9zm189 47.1c0-25.9 21.2-47.1 47.1-47.1 25.9 0 47.1 21.2 47.1 47.1s-21.2 47.1-47.1 47.1h-47.1V196.9zm-23.7 0c0 25.9-21.2 47.1-47.1 47.1-25.9 0-47.1-21.2-47.1-47.1V79.1c0-25.9 21.2-47.1 47.1-47.1 25.9 0 47.1 21.2 47.1 47.1V196.9zM283.1 385.9c25.9 0 47.1 21.2 47.1 47.1 0 25.9-21.2 47.1-47.1 47.1-25.9 0-47.1-21.2-47.1-47.1v-47.1h47.1zm0-23.7c-25.9 0-47.1-21.2-47.1-47.1 0-25.9 21.2-47.1 47.1-47.1h117.8c25.9 0 47.1 21.2 47.1 47.1 0 25.9-21.2 47.1-47.1 47.1H283.1z" />
        </svg>
        @lang('Send Slack Invite')
    </button>

    <form action="" method="GET" class="form-inline float-sm-right bg--white gap-1 justify-content-end"
        id="filterForm">
        <div class="input-group">
            <select name="date_sort" class="form-control" onchange="document.getElementById('filterForm').submit()">
                <option value="">@lang('Sort By Date')</option>
                <option value="asc" {{ ($dateSort ?? '') === 'asc' ? 'selected' : '' }}>
                    @lang('Oldest')
                </option>
                <option value="desc" {{ ($dateSort ?? '') === 'desc' ? 'selected' : '' }}>
                    @lang('Latest')
                </option>
            </select>
        </div>
        @php
            $applyYear = 2025; // or use dynamic year from controller or URL
        @endphp
        <button id="approve-all-btn" class="btn btn--success ml-2" data-year="{{ $applyYear }}">
            <i class="fa fa-check"></i> @lang('Approve All {{ $applyYear }}  Pending Applications')
        </button>
        <button type="submit" name="export" value="1" class="btn btn--success ml-2">
            <i class="fa fa-file-excel"></i> @lang('Export')
        </button>
        <div class="input-group has_append">
            <input type="text" name="search" style="width:300px;" class="form-control"
                placeholder="@lang('Search by id , name ,  email or phone....')" value="{{ $keyword ?? '' }}" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    {{-- <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" style="width:300px;" class="form-control"
                placeholder="@lang('Search by id , name ,  email or phone....')" value="{{ $keyword ?? '' }}" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <button type="submit" name="export" value="1" class="btn btn--success ml-2">
            <i class="fa fa-file-excel"></i> @lang('Export')
        </button>
    </form> --}}
@endpush
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseModalLabel">@lang('Select Course')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Inside Modal -->
                <form id="courseForm" action="{{ route('admin.invite.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">@lang('Courses')</label>
                        <br>
                        <select id="courseSelect" name="course_id" class="form-select" required
                            style="width: 100%;">
                            <option value="">@lang('Select a Course')</option>
                            @foreach ($courses as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">@lang('Proceed')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@push('script')
    <script>
        $(document).ready(function() {
            $('#sendSlackInvite').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin"></i> Sending...');
                $.ajax({
                    url: '{{ route('admin.send.slack.invite') }}',
                    method: 'GET',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-slack"></i> Send Slack Invite');
                        if (response.success) {
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-slack"></i> Send Slack Invite');
                        notify('error', 'An error occurred. Please try again later.');
                    }
                });
            });

            // send slack invite to user
            $(document).on('click', '.send-slack-invite-user', function() {
                const userId = $(this).data('user-id');
                const button = $(this);

                button.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: `/admin/send/slack/invite/${userId}`,
                    method: 'GET',
                    success: function(res) {
                        button.replaceWith(
                            '<span class="badge bg-success text-white p-2">Sent</span>');
                    },
                    error: function(xhr) {
                        button.prop('disabled', false).text('Send Slack Invite');

                        let message = 'Something went wrong. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        } else if (xhr.status === 0) {
                            message = 'Network error. Please check your internet connection.';
                        } else if (xhr.status === 404) {
                            message = 'User not found or not approved.';
                        } else if (xhr.status === 500) {
                            message = 'Internal server error. Please contact support.';
                        }

                        alert('Failed to send Slack invite: ' + message);
                    }
                });
            });

            // approve all pending applications
            $('#approve-all-btn').on('click', function() {
                const button = $(this);
                const applyYear = button.data('year');

                if (!confirm(`Are you sure you want to approve all pending applications for ${applyYear}?`))
                    return;

                button.prop('disabled', true).text('Approving...');

                $.ajax({
                    url: '{{ route('admin.approve.all.applications') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        apply_year: applyYear
                    },
                    success: function(res) {
                        alert(res.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        let msg = 'Something went wrong.';

                        if (xhr.responseJSON?.message) {
                            msg = xhr.responseJSON.message;
                        } else if (xhr.status === 500) {
                            msg = 'Server error. Please contact support.';
                        }

                        alert("Failed: " + msg);
                        button.prop('disabled', false).text(
                            `Approve All ${applyYear} Pending Applications`);
                    }
                });
            });
            // $('#approve-all-btn').on('click', function() {
            //     const button = $(this);
            //     if (!confirm("Are you sure you want to approve all pending applications?")) return;

            //     button.prop('disabled', true).text('Approving...');

            //     $.ajax({
            //         url: '{{ route('admin.approve.all.applications') }}',
            //         method: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}'
            //         },
            //         success: function(res) {
            //             alert(res.message);
            //             location.reload(); // Optionally reload to reflect changes
            //         },
            //         error: function(xhr) {
            //             let msg = 'Something went wrong.';

            //             if (xhr.responseJSON?.message) {
            //                 msg = xhr.responseJSON.message;
            //             } else if (xhr.status === 500) {
            //                 msg = 'Server error. Please contact support.';
            //             }

            //             alert("Failed: " + msg);
            //             button.prop('disabled', false).text('Approve All Pending Applications');
            //         }
            //     });
            // });
        });
    </script>
@endpush
