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
                                <th>@lang('Course Title/Author')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Category/Sub Category')</th>
                                <th>@lang('Price')</th>
                                {{-- <th>@lang('More Info.')</th> --}}
                                <th>@lang('Status')</th>
                                {{-- <th>@lang('Is Top')</th> --}}
                                <th>@lang('Action')</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($coursesUser as $k=> $data)
                                  @if($data->course->value != 1)
                                <tr>
                                    {{-- {{dd($data->user)}} --}}
                                    <td data-label="@lang('Course Title/Author')">{{$data->course->title}} <br> <a href="{{route('admin.users.detail',$data->user_id)}}">@ {{@$data->user->username}}</a> </td>
                                    <td data-label="@lang('Course Code')">{{$data->course->code}}</td>
                         
                                    <td data-label="@lang('Category/Sub Category')"><span class="text--primary">{{@$data->course->category->name}}</span> <br> <span class="text--warning">{{@$data->subcategory->name}}</span></td>
                                   
                                    <td data-label="@lang('Price')">{{getAmount($data->course->price) ? $general->cur_sym:''}} {{getAmount($data->course->price) ? : 'Free' }}</td>
                                    {{-- <td data-label="@lang('More Info.')"><button class="icon-btn bg--dark info" data-discount="{{$data->discount??'N/A'}}" data-level="{{@$data->level->name}}" data-chapter="{{$data->chapter()->count()}}" data-lec="{{$data->lectures()->count()}}"> <i class="las la-eye"></i> @lang(' see')</button></td> --}}
                                    
                                    <td data-label="@lang('Status')">
                                        @if ($data->status == "success")
                                            <span class="badge badge--success">@lang('success')</span>
                                         @elseif($data->status == "pending" || $data->status == "")
                                            <span class="badge badge--warning">@lang('pending')</span>
                                          @elseif($data->status == "rejected")
                                            <span class="badge badge--danger">@lang('rejected')</span>
                                        @endif
                                    </td>
                                
                                  
                                
                                    <td data-label="@lang('Action')">
                                      
                                        @if ($data->status != "rejected")
                                            @if ($data->status == "success")
                                              
                                             @elseif($data->status == "pending" || $data->status == "")
                                                <a href="javascript:void(0)" data-route="{{route('admin.course.user',$data->id)}}" class="icon-btn btn--success mr-2 approve" data-toggle="tooltip" title="@lang('Approve')">
                                                    <i class="las la-check-double"></i>
                                                </a>
                                             @endif
                                        @endif
                                        @if ($data->status == "rejected")
                                            <a href="javascript:void(0)" data-route="{{route('admin.course.ban_user',$data->id)}}" class="icon-btn btn--info approve" data-toggle="tooltip" title="@lang('Approve')">
                                                <i class="las la-check-circle"></i>
                                            </a>
                                        @else
                                      
                                            <a href="javascript:void(0)" data-route="{{route('admin.course.user',$data->id)}}" class="icon-btn btn--dark mr-2 reject" data-toggle="tooltip" title="@lang('Reject')">
                                                    <i class="las la-thumbs-down"></i>
                                                </a>
                                              
                                        @endif
                                   
                                    </td>
                                </tr>
                                  @endif
                            @empty
                            <tr>
                                <td class="text-center" colspan="12">@lang('No Courses User Found')</td>
                            </tr>
                            
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{paginateLinks($coursesUser)}}
                </div>
            </div><!-- card end -->
        </div>
       @include('admin.courses.action_modals')
    </div>
@endsection

@push('script')
     <script>
            'use strict';
            (function ($) {
                

               
                $('.reject').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#rejectCourseUserModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.approve').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#approveCourseUserModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
             
               
            })(jQuery);

            
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
