@extends($activeTemplate.'layouts.frontend')

@section('content')


<section class="exam-section pt-100 pb-100 ">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                       @php
                           echo $policy->data_values->description
                       @endphp
                </div>
        </div>
    </div>
</section>
@endsection