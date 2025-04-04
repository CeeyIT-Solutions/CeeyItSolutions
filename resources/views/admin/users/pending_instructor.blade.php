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
                                <th>@lang('User')</th>
                                <th>@lang('Email-Phone')</th>
                                <th>@lang('Country')</th>
                                <th>@lang('About Details')</th>
                                <th>@lang('Resume/CV')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{@$user->instructor_info->firstname.' '.@$user->instructor_info->lastname}}</span>
                                    <br>
                                    <span class="small">
                                    <a href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                    </span>
                                </td>


                                <td data-label="@lang('Email-Phone')">
                                    {{ @$user->instructor_info->email }}<br>{{ @$user->instructor_info->mobile }}
                                </td>
                                <td data-label="@lang('Country')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
                                </td>
                                <td data-label="@lang('About Details')">
                                    <button class="btn btn--dark btn-sm detail" data-details="{{@$user->instructor_info->detail}}"><i class="las la-eye"></i> @lang('see')</button>
                                </td>
                                <td data-label="@lang('Resume/CV')">
                                    <a href="{{route('admin.instructor.download.resume',$user->id)}}" class="btn btn--primary btn-sm"><i class="las la-download"></i> @lang('Download')</a>
                                </td>

                                <td data-label="@lang('Action')">
                                    
                                    <a href="javascript:void(0)" data-id="{{$user->id}}" class="ml-2 icon-btn btn--success approve" data-toggle="tooltip"  data-original-title="@lang('Approve')">
                                        <i class="las la-check-double text--shadow"></i>
                                    </a>

                                    <a href="javascript:void(0)" data-id="{{$user->id}}" class="ml-2 icon-btn btn--danger reject" data-toggle="tooltip"  data-original-title="@lang('Approve')">
                                        <i class="las la-ban text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($users) }}
                </div>
            </div>
        </div>

    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                <form action="{{route('admin.approve.instructor')}}" method="POST">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" name="instructor_id">
                        <i class="las la-exclamation-circle text--success display-2 mb-15"></i>
                        <h4 class="text--secondary mb-15">@lang('Are You Sure Want to Approve?')</h4>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit"  class="btn btn--success">@lang('Approve')</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                <form action="{{route('admin.reject.instructor')}}" method="POST">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" name="instructor_id">
                        <i class="las la-exclamation-circle text--danger display-2 mb-15"></i>
                        <h4 class="text--secondary mb-15">@lang('Are You Sure Want to Reject?')</h4>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit"  class="btn btn--danger">@lang('Reject')</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg--primary">
                    <h5 class="modal-title text-white">@lang('Instructor Details')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p class="ins_details"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection



@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
    <script>
        'use strict';
        $('.approve').on('click',function(){
            var id = $(this).data('id')
            var modal = $('#approveModal');
            modal.find('input[name=instructor_id]').val(id)
            modal.modal('show');
        })
        $('.reject').on('click',function(){
            var id = $(this).data('id')
            var modal = $('#rejectModal');
            modal.find('input[name=instructor_id]').val(id)
            modal.modal('show');
        })
        $('.detail').on('click',function(){
            var details = $(this).data('details')
            var modal = $('#details');
            modal.find('.ins_details').text(details)
            modal.modal('show');
        })
    </script> 
@endpush

    