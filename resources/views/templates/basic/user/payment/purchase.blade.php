@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="container">
            <div class="row gy-4 my-5">
                @foreach($gatewayCurrency as $data)
                <div class="col-lg-3">
                    <form action="{{route('user.deposit.insert')}}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <input type="hidden" name="method_code" value="{{$data->method_code}}">
                        <input type="hidden" name="currency" value="{{$data->currency}}">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                     <div class="payment-card has--link">
                      <button type="submit" class="item--link"></button>
                      <div class="payment-card__thumb">
                        <img src="{{$data->methodImage()}}" alt="image">
                      </div>
                      <div class="payment-card__content">
                        <h4 class="title">{{__($data->name)}}</h4>
                      </div>
                    </div><!-- payment-card end -->
                   </form>
                  </div>

                   
                @endforeach
            </div>
       
       
    </div>

@endsection
