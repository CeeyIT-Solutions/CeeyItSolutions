
@extends($activeTemplate.'layouts.frontend')
@section('content')
<div class="container ">
    <div class="row justify-content-center pt-50">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title">{{__(@$heading->data_values->heading)}}</h2>
            <p class="mt-2">{{__(@$heading->data_values->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
    <div class="accordion custom--accordion  pb-100" id="faqAccordion">
        @foreach ($elements as $item)
        <div class="accordion-item">
          <h2 class="accordion-header" id="h-{{$loop->iteration}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{$loop->iteration}}" aria-expanded="false" aria-controls="c-1">
             {{__(@$item->data_values->question)}}
            </button>
          </h2>
          <div id="c-{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="h-{{$loop->iteration}}" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <p>@php
                  echo @$item->data_values->answer
              @endphp</p>
            </div>
          </div>
        </div><!-- accordion-item-->
            
        @endforeach
      
    </div>
</div>
@endsection