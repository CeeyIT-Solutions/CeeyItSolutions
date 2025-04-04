@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-end pt-50">
        <a class="btn btn--base btn-sm me-3  mb-2" href="{{route('user.course.chapters',[$course->id,$course->slug])}}"> <i class="las la-backward"></i> @lang('Back')</a>
        <a class="btn btn--base btn-sm me-3  mb-2" href="{{route('user.course.lecture.create',[$course->slug,$chapter->slug])}}"> <i class="las la-plus"></i> @lang('Add New Lecture')</a>
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
                            <thead class="thead-dark">
                            <tr>
                                <th>@lang('Title')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('File')</th>
                                <th>@lang('Visibility')</th>
                                <th>@lang('Status')</th>
                                <th> @lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($lectures as  $lecture)
                                    <tr>
                                        <td data-label="@lang('Title')">{{$lecture->title}}</td>
                                        <td data-label="@lang('Type')">
                                            @if ($lecture->type == 1)
                                               <span class="badge badge--success">@lang('Uploaded')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Url')</span>
                                            @endif
                                        </td>
                                      
                                        <td data-label="@lang('File')">
                                            @if($lecture->file)
                                            <a href="{{route('user.course.lecture.file.download',$lecture->id)}}" class="icon-btn bg--dark">@lang('Download')</button>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td data-label="@lang('Visibilty')">
                                            @if ($lecture->visibility == 0)
                                               <span class="badge badge--warning">@lang('unlocked')</span>
                                            @else
                                                <span class="badge badge--primary">@lang('locked')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($lecture->status == 1)
                                                <span class="badge badge--success">@lang('active')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('inactive')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{route('user.course.lecture.edit',[$course->slug,$chapter->slug,$lecture->slug])}}" class="icon-btn edit" data-chapter="{{$lecture}}" data-toggle="tooltip" title="@lang('Edit')">
                                                <i class="las la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="12">@lang('No Lectures Found')</td>
                                </tr>
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                  {{paginateLinks($lectures)}}
                </div>
            </div>
        </div>
    </div>
</div>

@stop

