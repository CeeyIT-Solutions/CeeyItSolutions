@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-end pt-50">
        <div class="col-md-3">
            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control outline-none shadow-none" placeholder="@lang('Search')" name="search" value="{{$search??''}}">
                    <button type="submit" class="input-group-text bg--base text-white border-0"><i class="las la-search"></i></button>
                  </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-3 pb-50">
        <div class="col-md-12">
            <div class="custom--card">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--md">
                        <table class="table custom--table">
                            <thead class="thead-dark">
                            <tr>
                                <th>@lang('Course Title')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('Sub Category')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('More Info.')</th>
                                <th>@lang('Status')</th>
                                <th> @lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $k=> $data)
                               
                                    <tr>
                                        <td data-label="@lang('Course Title')">{{$data->title}}</td>
                                        <td data-label="@lang('Category')">{{@$data->category->name}}</td>
                                        <td data-label="@lang('Sub Category')">{{@$data->subcategory->name}}</td>
                                        <td data-label="@lang('Price')">{{$general->cur_sym}} {{showAmount($data->price)}}</td>
                                        <td data-label="@lang('More Info.')"><button class="icon-btn bg--dark info" data-discount="{{$data->discount??'N/A'}}" data-level="{{@$data->level->name}}" data-chapter="{{$data->chapter()->count()}}" data-lec="{{$data->lectures()->count()}}" data-purchased="{{@$data->courseUsers->count()}}"> <i class="las la-eye"></i> @lang(' see')</button></td>
                                        
                                        <td data-label="@lang('Status')">
                                            @if ($data->status == 1)
                                                <span class="badge badge--success">@lang('active')</span>
                                            @elseif($data->status == 0)
                                                <span class="badge badge--warning">@lang('pending')</span>
                                                @if ($data->reasons != null)
                                                <small data-toggle="tooltip" title="@lang('See Reasons')" class="bg--info p-1 rounded ms-1 text-white res" data-reasons="{{$data->reasons}}" ><i class="las la-info"></i></small>
                                                @endif

                                            @elseif($data->status == 2)
                                                <span class="badge badge--danger">@lang('banned')</span><small data-toggle="tooltip" title="@lang('See Reasons')" class="bg--info p-1 rounded ms-1 text-white res" data-reasons="{{$data->reasons}}" ><i class="las la-info"></i></small>
                                            @elseif($data->status == 3)
                                                <span class="badge badge--info">@lang('un-published')</span>
                                            @endif
                                        </td>
                                    
                                        <td data-label="@lang('Action')">
                                            <a href="{{route('user.course.chapters',[$data->id,$data->slug])}}" data-toggle="tooltip" title="@lang('Chapters')" class="icon-btn bg--primary">
                                                <i class="las la-book-open"></i>
                                            </a>
                                            @if ($data->status == 3)
                                              <a href="{{route('user.course.publish',$data->code)}}" class="icon-btn bg--success" data-toggle="tooltip" title="@lang('Publish')">
                                                <i class="las la-redo"></i>
                                                </a>
    
                                            @endif
                                            <a href="{{route('user.edit.course',[$data->id,$data->slug])}}" class="icon-btn" data-toggle="tooltip" title="@lang('Details')">
                                                <i class="las la-edit"></i>
                                            </a>
                                        </td>
                                        </td>
                                       
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="12">@lang('No Courses Found')</td>
                                </tr>
                                
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                  {{paginateLinks($courses,'')}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="info-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg--base">
              <h5 class="modal-title text-white">@lang('More Info.')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Course Level')</span>
                        <span class="level"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Discount')</span>
                        <span class="discount"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Total Chapter')</span>
                        <span class="chapter"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Total Lectures')</span>
                        <span class="lecture"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Total Purchased')</span>
                        <span class="purchase"></span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
          </div>
    </div>
  </div>
<div class="modal fade" id="reasonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg--base">
              <h5 class="modal-title text-white">@lang('Rejection/Banned Reasons')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <textarea  rows="5" readonly class="reasons" class="form--control"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
          </div>
    </div>
  </div>
@stop

@push('script')
     <script>
            'use strict';
            (function ($) {
                $('.info').on('click',function () { 
                    var discount = $(this).data('discount')
                    var level = $(this).data('level')
                    var chapter = $(this).data('chapter')
                    var lecture = $(this).data('lec')
                    var purchase = $(this).data('purchased')

                    $('#info-modal').find('.level').text(level)
                    $('#info-modal').find('.discount').text(discount+'%')
                    $('#info-modal').find('.chapter').text(chapter)
                    $('#info-modal').find('.lecture').text(lecture)
                    $('#info-modal').find('.purchase').text(purchase)

                    $('#info-modal').modal('show')
                 })  
                $('.res').on('click',function () { 
                    var reasons = $(this).data('reasons')
                    $('#reasonModal').find('.reasons').val(reasons)
                    $('#reasonModal').modal('show')
                 })  
            })(jQuery);
     </script>
@endpush