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
                                <th>@lang('More Info.')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Is Top')</th>
                                <th>@lang('Action')</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $k=> $data)
                                <tr>
                                    <td data-label="@lang('Course Title/Author')">{{$data->title}} <br> <a href="{{route('admin.users.detail',$data->author_id)}}">@ {{@$data->author->username}}</a> </td>
                                    <td data-label="@lang('Course Code')">{{$data->code}}</td>
                         
                                    <td data-label="@lang('Category/Sub Category')"><span class="text--primary">{{@$data->category->name}}</span> <br> <span class="text--warning">{{@$data->subcategory->name}}</span></td>
                                   
                                    <td data-label="@lang('Price')">{{getAmount($data->price) ? $general->cur_sym:''}} {{getAmount($data->price) ? : 'Free' }}</td>
                                    <td data-label="@lang('More Info.')"><button class="icon-btn bg--dark info" data-discount="{{$data->discount??'N/A'}}" data-level="{{@$data->level->name}}" data-chapter="{{$data->chapter()->count()}}" data-lec="{{$data->lectures()->count()}}"> <i class="las la-eye"></i> @lang(' see')</button></td>
                                    
                                    <td data-label="@lang('Status')">
                                        @if ($data->status == 1)
                                            <span class="badge badge--success">@lang('active')</span>
                                         @elseif($data->status == 0)
                                            <span class="badge badge--warning">@lang('inactive')</span>
                                          @elseif($data->status == 2)
                                            <span class="badge badge--danger">@lang('banned')</span>
                                        @endif
                                    </td>
                                
                                    <td data-label="@lang('Is Top')">
                                        @if ($data->is_top == 1 && $data->status != 2)
                                            <span class="badge badge--success">@lang('TOP')</span>
                                            <span>
                                                <a href="javascript:void(0)" data-route="{{route('admin.course.top',$data->id)}}" class="icon-btn btn--warning mt-2 removeTop" data-toggle="tooltip" title="@lang('Remove from top course')">
                                                    <i class="las la-reply"></i>
                                                </a>
                                           </span>
                                         @elseif($data->is_top == 0 && $data->status != 2)
                                            <span class="badge badge--warning">@lang('NOT YET')</span>
                                            <span>
                                                <a href="javascript:void(0)" data-route="{{route('admin.course.top',$data->id)}}" class="icon-btn btn--success mt-2 approveTop" data-toggle="tooltip" title="@lang('Mark as top course')">
                                                    <i class="las la-check-square"></i>
                                                </a>
                                           </span>
                                         @else
                                         @lang('N/A')
                                        @endif
                                       
                                    </td>
                                
                                    <td data-label="@lang('Action')">
                                        <a href="{{route('admin.course.details',$data->id)}}" data-toggle="tooltip" title="@lang('Play this course')" class="icon-btn bg--primary mr-2">
                                            <i class="las la-play"></i>
                                        </a>
                                        @if ($data->status != 2)
                                            @if ($data->status == 1)
                                                <a href="javascript:void(0)" data-route="{{route('admin.course.action',$data->id)}}" class="icon-btn btn--dark mr-2 reject" data-toggle="tooltip" title="@lang('Reject')">
                                                    <i class="las la-thumbs-down"></i>
                                                </a>
                                             @elseif($data->status == 0)
                                                <a href="javascript:void(0)" data-route="{{route('admin.course.action',$data->id)}}" class="icon-btn btn--success mr-2 approve" data-toggle="tooltip" title="@lang('Approve')">
                                                    <i class="las la-check-double"></i>
                                                </a>
                                             @endif
                                        @endif
                                        @if ($data->status == 2)
                                            <a href="javascript:void(0)" data-route="{{route('admin.course.ban',$data->id)}}" class="icon-btn btn--info unban" data-toggle="tooltip" title="@lang('Un-Ban')">
                                                <i class="las la-check-circle"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" data-route="{{route('admin.course.ban',$data->id)}}" class="icon-btn btn--danger ban" data-toggle="tooltip" title="@lang('Ban')">
                                                <i class="las la-ban"></i>
                                            </a>
                                        @endif
                                   
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="12">@lang('No Courses Found')</td>
                            </tr>
                            
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{paginateLinks($courses)}}
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
                $('.info').on('click',function () { 
                    var discount = $(this).data('discount')
                    var level = $(this).data('level')
                    var chapter = $(this).data('chapter')
                    var lecture = $(this).data('lec')

                    $('#info-modal').find('.level').text(level)
                    $('#info-modal').find('.discount').text(discount+'%')
                    $('#info-modal').find('.chapter').text(chapter)
                    $('#info-modal').find('.lecture').text(lecture)

                    $('#info-modal').modal('show')
                 })  

                $('.ban').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#banModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.unban').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#unbanModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.reject').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#rejectModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.approve').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#approveModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.removeTop').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#removeTopModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('.approveTop').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#approveTopModal');
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
