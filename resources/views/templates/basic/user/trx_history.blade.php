@extends($activeTemplate.'layouts.master')
@section('content')
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-md-12">
                <div class="custom--card">
                    <div class="card-body p-0">
                        <div class="table-responsive table-responsive--md">
                            <table class="table custom--table mb-0">
                                <thead class="thead-dark">
                                <tr>
                                    <th>@lang('Transaction ID')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Post Balance')</th>
                                    <th>@lang('Details')</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                    @forelse($trxs as $k =>$data)
                                        <tr>
                                            <td data-label="#@lang('Transaction ID')">{{$data->trx}}</td>
                                            <td data-label="@lang('Amount')"> 
                                                @if ($data->trx_type == '+')
                                                    <span class="text--success">+{{$general->cur_sym}}{{ __(getAmount(@$data->amount))  }}</span>
                                                @else
                                                    <span class="text--danger">-{{$general->cur_sym}}{{ __(getAmount(@$data->amount))  }}</span>
                                                @endif
                                            </td>
                                            <td data-label="@lang('Charge')">
                                                <strong>{{__($general->cur_sym)}}{{getAmount($data->charge)}}</strong>
                                            </td>
                                            <td data-label="@lang('Post Balance')">
                                                {{__($general->cur_sym)}}{{getAmount($data->post_balance)}}
                                            </td>
                                            <td data-label="@lang('Details')">
                                            {{__($data->details)}}
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="12">@lang('No transactions found')</td>
                                    </tr>
                                    @endforelse
                            
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3">
                            {{paginateLinks($trxs)}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection