@php
    if(auth()->user()){
        $extend = $activeTemplate.'layouts.master';
    } else{
        $extend = $activeTemplate.'layouts.frontend';
    }
@endphp
@extends($extend)

@section('content')
<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card custom--card shadow-none">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-10 d-flex flex-wrap align-items-center">
                    @if($my_ticket->status == 0)
                    <span class="badge badge--success">@lang('Open')</span>
                    @elseif($my_ticket->status == 1)
                        <span class="badge badge--primary">@lang('Answered')</span>
                    @elseif($my_ticket->status == 2)
                        <span class="badge badge--warning">@lang('Replied')</span>
                    @elseif($my_ticket->status == 3)
                        <span class="badge badge--dark">@lang('Closed')</span>
                    @endif
                   <h4 class="ms-2">[@lang('Ticket') :#{{$my_ticket->ticket}}]</h4>
                </div>
                <div class="col-sm-2 text-end">
                  <button class="btn btn--danger btn-sm" data-bs-toggle="modal" data-bs-target="#DelModal"><i class="las la-times"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('ticket.reply', $my_ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <textarea name="message" placeholder="@lang('Your reply...')" class="form--control" required>{{old('message')}}</textarea>
                </div>
                <div class="form-group">
                  <label for="supportTicketFile" class="form-label">@lang('Select file')</label>
                  <div class="input-group">
                      <input class="form-control custom--file-upload" type="file" id="supportTicketFile" name="attachments[]">
                    <span class="input-group-text addFile btn btn--base">+</span>
                    
                  </div>

                  <div id="fileUploadsContainer"></div>

                  <div class="form-text text-muted">@lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')</div>
                </div>
                <div class="form-group text-end">
                  <button type="submit" class="btn btn--base" name="replayTicket" value="1">@lang('Reply')</button>
                </div>
              </form>

            @foreach($messages as $message)
              @if($message->admin_id == 0)
              <div class="single-reply">
                <div class="left">
                  <h4>{{ $message->ticket->name }}</h4>
                </div>
                <div class="right">
                  <span class="fst-italic font-size--14px text--base mb-2">@lang('Post on') {{$message->created_at->format('l, dS F Y @ H:i')}}</span>
                  <p>{{$message->message}}</p>
                  @if($message->attachments()->count() > 0)
                  <div class="mt-2">
                      @foreach($message->attachments as $k=> $image)
                          <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                      @endforeach
                  </div>
                  @endif
                </div>
              </div><!-- single-reply end -->
              @else
              <div class="single-reply border border-warning">
                <div class="left">
                  <h4>{{ $message->admin->name }}</h4>
                </div>
                <div class="right">
                  <span class="fst-italic font-size--14px text--base mb-2">@lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</span>
                  <p>{{$message->message}}</p>
                  @if($message->attachments()->count() > 0)
                  <div class="mt-2">
                      @foreach($message->attachments as $k=> $image)
                          <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                      @endforeach
                  </div>
                  @endif
                </div>
              </div><!-- single-reply end -->
              @endif
             @endforeach
            </div>
          </div><!-- card end -->
        </div>
      </div>
    </div> 
  </section>

  <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Confirmation')!</h5>
                </div>
                <div class="modal-body">
                    <strong class="text-dark">@lang('Are you sure you want to close this support ticket')?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        @lang('Close')
                    </button>
                    <button type="submit" class="btn btn--base btn-sm" name="replayTicket" value="2"><i class="fa fa-check"></i> @lang("Confirm")
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            });
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(
                    `<div class="input-group mt-2">
                        <input class="form-control custom--file-upload" type="file" id="supportTicketFile" name="attachments[]">
                        <div class="input-group-append support-input-group">
                            <span class="input-group-text btn btn-danger support-btn remove-btn">x</span>
                        </div>
                    </div>`
                )
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);

    </script>
@endpush

