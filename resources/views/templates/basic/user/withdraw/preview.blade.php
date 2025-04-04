@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container pt-50 pb-50">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-12 ">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="custom--card">
                            <div class="card-header">
                                <h5 class="text-center my-1">@lang('Current Balance') :
                                <strong>{{ getAmount(auth()->user()->balance)}}  {{ __($general->cur_text) }}</strong></h5>
                            </div>
                            <div class="card-body">
                                <label for=""><strong>@lang('Informations')</strong></label>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="font-weight-bold">@lang('Request Amount') :</span>
                                        <span class="font-weight-bold pull-right">{{getAmount($withdraw->amount)  }} {{__($general->cur_text)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="font-weight-bold">@lang('Withdrawal Charge') :</span>
                                        <span class="font-weight-bold pull-right">{{getAmount($withdraw->charge) }} {{__($general->cur_text)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="font-weight-bold">@lang('After Charge') :</span>
                                        <span class="font-weight-bold pull-right">{{getAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="font-weight-bold">@lang('Conversion Rate') : 1 {{__($general->cur_text)}} </span>
                                        <span class="font-weight-bold pull-right">  {{getAmount($withdraw->rate)  }} {{__($withdraw->currency)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="font-weight-bold">@lang('You Will Get') :</span>
                                        <span class="font-weight-bold pull-right">{{getAmount($withdraw->final_amount) }} {{__($withdraw->currency)}}</span>
                                    </li>
                                </ul>

                            
                                <div class="form-group mt-5">
                                    <label class="font-weight-bold">@lang('Balance Will be') : </label>
                                    <div class="input-group">
                                        <input type="text" value="{{getAmount($withdraw->user->balance - ($withdraw->amount))}}"  class="form--control" placeholder="@lang('Enter Amount')" required disabled>
                                        <span class="input-group-text ">{{ __($general->cur_text) }} </span>
                                    </div>
                                </div>
                                <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if($withdraw->method->user_data)
                                    @foreach($withdraw->method->user_data as $k => $v)
                                        @if($v->type == "text")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <input type="text" name="{{$k}}" class="form--control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
                                            </div>
                                        @elseif($v->type == "textarea")
                                            <div class="form-group">
                                                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                <textarea name="{{$k}}"  class="form--control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                                                @if ($errors->has($k))
                                                    <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                @endif
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
                                    @if(auth()->user()->ts)
                                    <div class="form-group">
                                        <label>@lang('Google Authenticator Code')</label>
                                        <input type="text" name="authenticator_code" class="form--control" required>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <button type="submit" class="btn btn--base w-100">@lang('Confirm')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

