@php
    $features = getContent('features.element',false,'',1);
@endphp

<section class="feature-section">
    <div class="container">
      <div class="row gy-4 justify-content-center">
          @foreach ($features as $item)
          <div class="col-lg-3 col-sm-6 d-flex justify-content-center feature-card">
            <div class="feature-item">
              <div class="feature-item__icon">
                <img src="{{getImage('assets/images/frontend/features/'.@$item->data_values->icon,'40x40')}}" alt="image">
              </div>
              <div class="feature-item__content">
                <h6 class="title text-white">{{__(@$item->data_values->title)}}</h6>
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>
  </section>