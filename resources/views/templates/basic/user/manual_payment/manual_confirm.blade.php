@extends($activeTemplate.'layouts.master')

@section('content')
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom--card">
                    <div class="card-body px-4 py-3">
                        <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <p class="text-center mt-2">@lang('You have requested') <b class="text-success">{{ getAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                        <b class="text-success">{{getAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                    </p>
                                    <h4 class="text-center mb-4">@lang('Please follow the instruction below')</h4>
                                    <div class="mb-4">
                                        @php echo  $data->gateway->description @endphp
                                    </div>
                                 

                                </div>

                                @if($method->gateway_parameter)

                                    @foreach(json_decode($method->gateway_parameter) as $k => $v)

                                        @if($v->type == "text")
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input type="text" class="form--control form-control-lg" name="{{$k}}" value="{{old($k)}}" placeholder="{{__($v->field_level)}}">
                                                </div>
                                           
                                        @elseif($v->type == "textarea")
                                         
                                                    <div class="form-group">
                                                        <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                        <textarea name="{{$k}}"  class="form--control"  placeholder="{{__($v->field_level)}}" rows="3">{{old($k)}}</textarea>

                                                    </div>
                                               
                                        @elseif($v->type == "file")
                                            <div class="form-group">
                                                    <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview" style="background-image: url({{getImage('/','500x500')}})"></div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" name="{{$k}}" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="col-md-12 mt-3">
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn--base w-100">@lang('Pay Now')</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@push('style')
<style>
    .withdraw-thumbnail{
        max-width: 220px;
        max-height: 220px
    }
</style>
@endpush
