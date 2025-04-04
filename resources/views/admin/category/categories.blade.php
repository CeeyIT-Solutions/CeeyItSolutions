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
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Slug')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td data-label="@lang('Name')">
                                    <div class="user">
                                        <div class="thumb"><img src="{{getImage('assets/images/category/'.$category->image,'512x512')}}" alt="image"></div>
                                        <span class="name">{{$category->name}}</span>
                                    </div>
                                </td>
         
                                <td data-label="@lang('Slug')">{{$category->slug}}</td>
                                <td data-label="@lang('Status')">
                                    @if ($category->status == 1)
                                     <span class="text--small badge font-weight-normal badge--success">@lang('active')</span>
                                    @else
                                     <span class="text--small badge font-weight-normal badge--warning">@lang('inactive')</span>
                                    @endif
                                </td>          
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" data-category="{{$category}}" class="icon-btn edit" data-toggle="tooltip" title="@lang('Edit')">
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
                <div class="card-footer py-4">
                    {{paginateLinks($categories)}}
                </div>
            </div><!-- card end -->
        </div>

         <!--Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Add New Category')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                           <div class="form-group">
                               <label>@lang('Category Name')</label>
                               <input  class="form-control" type="text" placeholder="@lang('Category Name')" name="name" required value="{{old('name')}}">
                           </div>
                           <div class="form-group">
                               <label>@lang('Category Image')</label>
                               <div class="file-upload-wrapper" data-text="@lang('Select your image!')">
                                <input type="file" name="image" id="inputAttachments"
                                class="file-upload-field"/ required>
                               </div>
                           </div>
                           <div class="form-group">
                                <label>@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('active')" data-off="@lang('inactive')" name="status">
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
          <!--Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Edit Category')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id">
                           <div class="form-group">
                               <label>@lang('Category Name')</label>
                               <input  class="form-control" type="text" placeholder="@lang('Category Name')" name="name" required>
                           </div>
                           <div class="form-group">
                            <label>@lang('Category Image')</label>
                            <div class="file-upload-wrapper" data-text="@lang('Select your image!')">
                             <input type="file" name="image" id="inputAttachments"
                             class="file-upload-field"/>
                            </div>
                        </div>
                           <div class="form-group">
                                <label>@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('active')" data-off="@lang('inactive')" name="status">
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
    <button type="button" class="btn btn--primary mr-2 mt-2" data-toggle="modal" data-target="#addModal">
        <i class="las la-plus"></i> @lang('Add New')
    </button>

    <form action="" method="GET" class="form-inline float-sm-right bg--white mt-2">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Name')" value="{{$search??''}}" autocomplete="off">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    
   
@endpush

@push('script')
     <script>
            'use strict';
            (function ($) {
                $('.edit').on('click',function () { 
                    var category = $(this).data('category')
                    $('#editModal').find('input[name=name]').val(category.name)
                    $('#editModal').find('input[name=id]').val(category.id)
                    if(category.status == 1){
                        $('#editModal').find('input[name=status]').bootstrapToggle('on');
                    }
                    $('#editModal').modal('show');
                 })
            })(jQuery);
     </script>
@endpush


