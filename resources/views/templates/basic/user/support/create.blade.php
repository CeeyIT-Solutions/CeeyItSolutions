@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container pb-50 pt-50">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card custom--card">
                    <div class="card-header d-flex justify-content-between">
                        <h6>{{ __($pageTitle) }}</h6>
                        <a href="{{route('ticket') }}" class="btn btn--base">
                            @lang('My Support Ticket')
                        </a>
                    </div>

                    <div class="card-body">
                        <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form--control form--control-lg" placeholder="@lang('Enter your name')" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">@lang('Email address')</label>
                                    <input type="email"  name="email" value="{{@$user->email}}" class="form--control form--control-lg" placeholder="@lang('Enter your email')" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="website">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form--control form--control-lg" placeholder="@lang('Subject')" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="priority">@lang('Priority')</label>
                                    <select name="priority" class="form--control form--control-lg">
                                        <option value="3">@lang('High')</option>
                                        <option value="2">@lang('Medium')</option>
                                        <option value="1">@lang('Low')</option>
                                    </select>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="inputMessage">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form--control form--control-lg">{{old('message')}}</textarea>
                                </div>
                            </div>

                            <div class="row form-group ">
                                <div class="col-sm-9 file-upload">
                                    <label for="inputAttachments">@lang('Attachments')</label>
                                    <input class="form-control custom--file-upload"  name="attachments[]" type="file" id="supportTicketFile">
                                   
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted">
                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </p>
                                </div>

                                <div class="col-sm-1">
                                    <label for="inputAttachments" class="d-block">&nbsp;</label>
                                    <button type="button" class="btn btn--base btn-md addFile">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row form-group justify-content-end">
                                <div class="col-md-2">
                                    <button class="btn btn--base" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(`
                    <div class="input-group mt-2">
                        <input class="form-control custom--file-upload"  name="attachments[]" type="file" id="supportTicketFile" required>
                        <div class="input-group-append support-input-group">
                            <span class="input-group-text btn btn--danger support-btn remove-btn">x</span>
                        </div>
                    </div>
                `)
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
