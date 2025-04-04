@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container pt-50 pb-50">
        <div class="custom--card card-deposit">
            <div class="card-header d-flex justify-content-between">
                <h6 class="">{{__($pageTitle)}}</h6>
                <a href="{{route('user.withdraw')}}" class="btn btn--base btn-sm">@lang('Withdraw Money')</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-responsive--lg">
                    <table class="table custom--table mb-0">
                        <thead>
                        <tr>
                            <th>@lang('Transaction ID')</th>
                            <th>@lang('Gateway')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Charge')</th>
                            <th>@lang('After Charge')</th>
                            <th>@lang('Rate')</th>
                            <th>@lang('Receivable')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Time')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($withdraws as $k=>$data)
                            <tr>
                                <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                                <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                                <td data-label="@lang('Amount')">
                                    <strong>{{getAmount($data->amount)}} {{__($general->cur_text)}}</strong>
                                </td>
                                <td data-label="@lang('Charge')" class="text-danger">
                                    {{getAmount($data->charge)}} {{__($general->cur_text)}}
                                </td>
                                <td data-label="@lang('After Charge')">
                                    {{getAmount($data->after_charge)}} {{__($general->cur_text)}}
                                </td>
                                <td data-label="@lang('Rate')">
                                    {{getAmount($data->rate)}} {{__($data->currency)}}
                                </td>
                                <td data-label="@lang('Receivable')" class="text--success">
                                    <strong>{{getAmount($data->final_amount)}} {{__($data->currency)}}</strong>
                                </td>
                                <td data-label="@lang('Status')">
                                    @if($data->status == 2)
                                        <span class="badge badge--warning">@lang('Pending')</span>
                                    @elseif($data->status == 1)
                                        <span class="badge badge--success">@lang('Completed')</span>
                                        <button class="btn-info btn-rounded  badge approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></button>
                                    @elseif($data->status == 3)
                                        <span class="badge badge-danger">@lang('Rejected')</span>
                                        <button class="btn--info btn-rounded badge approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></button>
                                    @endif

                                </td>
                                <td data-label="@lang('Time')">
                                    <i class="fa fa-calendar"></i> {{showDateTime($data->created_at)}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('No data found')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div> 
        <div class="mt-4 text-end">
            {{$withdraws->links()}}
        </div>
    </div>


    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($){
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
