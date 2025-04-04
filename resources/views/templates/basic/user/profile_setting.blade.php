@extends($activeTemplate.'layouts.master')
@section('content')

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card custom--card">
            <div class="card-header px-4 py-3">
              <h4>@lang($pageTitle)</h4>
            </div>
            <div class="card-body px-4 py-3">
                <form class="register" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputFirstname" class="col-form-label">@lang('Profile Picture'):</label>
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{getImage('assets/images/user/profile/'.$user->image,'350x350')}})"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="InputFirstname" class="col-form-label">@lang('First Name'):</label>
                            <input type="text" class="form--control" id="InputFirstname" name="firstname" placeholder="@lang('First Name')" value="{{$user->firstname}}" >
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="lastname" class="col-form-label">@lang('Last Name'):</label>
                            <input type="text" class="form--control" id="lastname" name="lastname" placeholder="@lang('Last Name')" value="{{$user->lastname}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="email" class="col-form-label">@lang('E-mail Address'):</label>
                            <input class="form--control" id="email" placeholder="@lang('E-mail Address')" value="{{$user->email}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone" class="col-form-label">@lang('Mobile Number')</label>
                            <input class="form--control" id="phone" value="{{$user->mobile}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="address" class="col-form-label">@lang('Address'):</label>
                            <input type="text" class="form--control" id="address" name="address" placeholder="@lang('Address')" value="{{@$user->address->address}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="state" class="col-form-label">@lang('State'):</label>
                            <input type="text" class="form--control" id="state" name="state" placeholder="@lang('state')" value="{{@$user->address->state}}" required="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="zip" class="col-form-label">@lang('Zip Code'):</label>
                            <input type="text" class="form--control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{@$user->address->zip}}" required="">
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="city" class="col-form-label">@lang('City'):</label>
                            <input type="text" class="form--control" id="city" name="city" placeholder="@lang('City')" value="{{@$user->address->city}}" required="">
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="col-form-label">@lang('Country'):</label>
                            <input class="form--control" value="{{@$user->address->country}}" disabled>
                        </div>

                    </div>
                    @if ($user->is_instructor == 1)
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="col-form-label">@lang('Details About You'):</label>
                            <textarea class="form--control" name="detail">{{@$user->instructor_info->detail}}</textarea>
                        </div>
                    </div>
                        
                    @endif

                  
                    <div class="form-group">
                        <button type="submit" class="btn btn--base w-100">@lang('Update Profile')</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
@push('style-lib')
    <link href="{{ asset($activeTemplateTrue.'css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endpush
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100%;!important;
        }
    </style>
@endpush

