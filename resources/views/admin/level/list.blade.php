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
                                <th scope="col">@lang('SL')</th>
                                <th scope="col">@lang('Level Name')</th>
                                <th scope="col">@lang('Total Courses')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($levels as $key => $level)
                            <tr>
                                
                                <td data-label="@lang('SL')">{{ ++$key}}</td>
                                <td data-label="@lang('Level Name')">{{__($level->name)}}</td>
                                <td data-label="@lang('Total Course')">{{$level->courses()->count()}}</td>
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn edit" data-level="{{$level}}" data-route="{{route('admin.course.level.update',$level->id)}}" data-toggle="tooltip"  data-original-title="edit">
                                        <i class="las la-edit text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                
            </div><!-- card end -->
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="" method="POST">
                   @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Add New')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('Level Name')</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--primary">@lang('Save')</button>
                        </div>
                    </div>
               </form>
            </div>
        </div>

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="" method="POST">
                   @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Update Level')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('Level Name')</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--primary">@lang('Update')</button>
                        </div>
                    </div>
               </form>
            </div>
        </div>

    </div>
@endsection



@push('breadcrumb-plugins')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#add">
      <i class="las la-plus"></i> @lang('Add New')
    </button>
    
@endpush

@push('script')
     <script>
            'use strict';
            (function ($) {
                $('.edit').on('click',function () { 
                    var level = $(this).data('level')
                    var route = $(this).data('route')

                    $('#edit').find('input[name=name]').val(level.name)
                    $('#edit').find('form').attr('action',route)
                    $('#edit').modal('show')
                 })
            })(jQuery);
     </script>
@endpush