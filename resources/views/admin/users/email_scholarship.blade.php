
@extends('admin.layouts.app')

@section('panel')

    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('admin.users.email.scholarship') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h3 class="font-weight-bold mb-2">Course: <span class="badge badge-success" style="font-size: 28px;">{{ $course->title }}</span></h3>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Subject') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Email subject')" name="subject"  required/>
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Message') <span class="text-danger">*</span></label>
                                <textarea name="message" rows="10" class="form-control nicEdit"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Send Email')</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
