@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container pt-50 pb-50">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                <div class="card custom--card">
                    <div class="card-header px-4 py-3 bg-transparent">
                        <h6>{{$pageTitle}}</h6>
                    </div>
                    <div class="card-body px-4 py-3">
                        <form action="{{route('user.apply.instructor')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>@lang('First Name')</label>
                                    <input class="form--control" type="text" name="fname" value="{{auth()->user()->firstname}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>@lang('Last Name')</label>
                                    <input class="form--control" type="text" name="lname" value="{{auth()->user()->lastname}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>@lang('Email')</label>
                                    <input class="form--control" type="text" name="email" value="{{auth()->user()->email}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>@lang('Mobile No.')</label>
                                    <input class="form--control" type="text" name="mobile" value="{{auth()->user()->mobile}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Occupation')</label>
                                    <input class="form--control" type="text" name="occupation" required/>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Details About You')</label>
                                    <textarea class="form--control" type="text" name="detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Upload Resume')</label>
                                    <input class="form-control custom--file-upload" type="file" name="resume" required>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection