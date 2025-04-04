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
                                <th scope="col">@lang('Category Name')</th>
                                <th scope="col">@lang('Sub Category Name')</th>
                                <th scope="col">@lang('Slug')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subcategories as $subcat)
                            <tr>
                               
                                <td data-label="@lang('Category Name')">{{$subcat->category->name}} 
                                    @if ($subcat->category->status ==1)
                                     <small class="ml-1 badge pill-badge badge-success">@lang('active')</small>
                                    @else
                                    <small class="ml-1 badge  pill-badge badge-warning">@lang('active')</small>
                                    @endif
                                </td>
                                <td data-label="@lang('Name')">{{$subcat->name}}</td>
                                <td data-label="@lang('Slug')">{{$subcat->slug}}</td>
                                <td data-label="@lang('Status')">
                                    @if ($subcat->status == 1)
                                     <span class="text--small badge font-weight-normal badge--success">@lang('active')</span>
                                    @else
                                     <span class="text--small badge font-weight-normal badge--warning">@lang('inactive')</span>
                                    @endif
                                </td>          
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" data-subcat="{{$subcat}}" data-cat_id="{{$subcat->category->id}}" class="icon-btn edit" data-toggle="tooltip" title="@lang('Edit')">
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
                    {{paginateLinks($subcategories)}}
                </div>
            </div><!-- card end -->
        </div>

         <!--Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="{{route('admin.subcategory.store')}}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Add New Sub Category')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                           <div class="form-group">
                               <label>@lang('Select Category')</label>
                               <select name="category_id" class="form-control">
                                   @foreach ($categories as $category)
                                   <option value="{{$category->id}}">{{__($category->name)}}</option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="form-group">
                               <label>@lang('Sub Category Name')</label>
                               <input  class="form-control" type="text" placeholder="@lang('Sub Category Name')" name="name" required value="{{old('name')}}">
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
                <form action="{{route('admin.subcategory.update')}}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg--primary">
                            <h5 class="modal-title text-white">@lang('Edit Sub Category')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>@lang('Select Category')</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{__($category->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                           <div class="form-group">
                               <label>@lang('Sub Category Name')</label>
                               <input  class="form-control" type="text" placeholder="@lang('Sub Category Name')" name="name" required>
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
                    var subcat = $(this).data('subcat')
                    var cat_id = $(this).data('cat_id')
                    $('#editModal').find('select[name=category_id]').val(cat_id)
                    $('#editModal').find('input[name=name]').val(subcat.name)
                    $('#editModal').find('input[name=id]').val(subcat.id)
                    if(subcat.status == 1){
                        $('#editModal').find('input[name=status]').bootstrapToggle('on');
                    }
                    $('#editModal').modal('show');
                 })
            })(jQuery);
     </script>
@endpush