@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-end pt-50">
        <a class="btn btn--base btn-sm me-3  mb-2" href="{{route('user.courses')}}"> <i class="las la-backward"></i> @lang('Back')</a>
        <button class="btn btn--base btn-sm me-3  mb-2" data-bs-toggle="modal" data-bs-target="#chapter-modal"> <i class="las la-plus"></i> @lang('Add New Chapter')</button>
        <form action="" method="GET">
            <div class="input-group mb-2">
                <input type="text" class="form-control outline-none shadow-none" placeholder="@lang('Search')" name="search" value="{{$search??''}}">
                <button type="submit" class="input-group-text bg--base text-white border-0"><i class="las la-search"></i></button>
                </div>
        </form>
    </div>
    <div class="row justify-content-center mt-3 pb-50">
        <div class="col-md-12">
            <div class="custom--card">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--md">
                        <table class="table custom--table">
                            <thead>
                            <tr>
                                <th>@lang('Chapter')</th>
                                <th>@lang('Total Lectures')</th>
                                <th>@lang('Status')</th>
                                <th> @lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($chapters as  $chapter)
                                    <tr>
                                        <td data-label="@lang('Chapter')">{{$chapter->title}}</td>
                                        <td data-label="@lang('Total Lectures')">{{@$chapter->lectures->count()}}</td>
                                        <td data-label="@lang('Status')">
                                            @if ($chapter->status == 1)
                                                <span class="badge badge--success">@lang('active')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('inactive')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{route('user.course.lectures',[$chapter->course->slug,$chapter->slug])}}" class="icon-btn bg--primary" data-toggle="tooltip" title="@lang('Lectures')">
                                                <i class="las la-list"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="icon-btn edit" data-chapter="{{$chapter}}" data-toggle="tooltip" title="@lang('Edit')">
                                                <i class="las la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="12">@lang('No Chapters Found')</td>
                                </tr>
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                  {{paginateLinks($chapters)}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add modal --}}
<div class="modal fade" id="chapter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{route('user.course.chapter.store')}}" method="POST">
          @csrf
        <div class="modal-content">
            <div class="modal-header bg--base">
              <h5 class="modal-title text-white">@lang('Add New Chapter')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="course_id" value="{{$course->id}}">
                <div class="form-group">
                    <label >@lang('Chapter Title')</label>
                    <input class="form--control" type="text" name="title" placeholder="@lang('Chapter title')" required value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                        @lang(' Status:')
                        <label class="switch">
                            <input type="checkbox" name="status" id="checkbox">
                            <div class="slider round"></div>
                        </label>
                    </li>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
              <button type="submit" class="btn btn--base btn-sm">@lang('Submit')</button>
            </div>
          </div>
      </form>
    </div>
  </div>

{{-- edit modal --}}
<div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{route('user.course.chapter.update')}}" method="POST">
          @csrf
        <div class="modal-content">
            <div class="modal-header bg--base">
              <h5 class="modal-title text-white">@lang('Edit Chapter')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="chapter_id">
               
                <div class="form-group">
                    <label >@lang('Chapter Title')</label>
                    <input class="form--control" type="text" name="title" placeholder="@lang('Chapter title')" required>
                </div>
                <div class="form-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                        @lang(' Status:')
                        <label class="switch">
                            <input type="checkbox" name="status" id="checkbox">
                            <div class="slider round"></div>
                        </label>
                    </li>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
              <button type="submit" class="btn btn--base btn-sm">@lang('Submit')</button>
            </div>
          </div>
      </form>
    </div>
</div>


@stop

@push('script')
     <script>
            'use strict';
            (function ($) {
                $('.edit').on('click',function () { 
                    var chapter = $(this).data('chapter')
                    $('#edit-modal').find('input[name=chapter_id]').val(chapter.id)
                    $('#edit-modal').find('input[name=title]').val(chapter.title)
                    if(chapter.status == 1){
                        $('#edit-modal').find('input[name=status]').attr('checked',true)
                    } else {
                        $('#edit-modal').find('input[name=status]').attr('checked',false)
                    }
                    $('#edit-modal').modal('show')
                 })  
            })(jQuery);
     </script>
@endpush