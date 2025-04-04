@extends('admin.layouts.app')

@section('panel')

    <div class="row">
        <div class="col mb-2">
            <form action="" method="GET" class="form-inline float-sm-right bg--white">
                <div class="input-group has_append">
                    <input type="text" name="search" style="width:300px;" class="form-control"
                        placeholder="@lang('Search by name , email or phone....')" value="{{$keyword ?? ''}}"
                        autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $item)
                                    <tr>
                                        <td data-label="@lang('Name')">{{$item->name ?? "---"}}</td>
                                        <td data-label="@lang('Name')">{{$item->email ?? "---"}}</td>
                                        <td data-label="@lang('Name')">{{$item->phone ?? "---"}}</td>
                                        <td data-label="@lang('Amount')"><span
                                                class="text--small badge font-weight-normal badge--success">{{$item->amount}}</span>
                                        </td>
                                        {{-- <td data-label="@lang('Name')">{{ ucwords(str_replace('_', ' ', $item->frequency))
                                            }}</td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{paginateLinks($donations)}}
                </div>
            </div><!-- card end -->
        </div>


    </div>
@endsection