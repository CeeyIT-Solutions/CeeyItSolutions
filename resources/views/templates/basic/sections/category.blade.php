@php
    $category = getContent('category.content',true)->data_values;
    $categories = \App\Models\Category::where('status',1)->whereHas('courses')->withCount('courses')->inRandomOrder()->take(8)->get();
@endphp

<section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-header text-center">
            <h2 class="section-title">{{__(@$category->heading)}}</h2>
            <p class="mt-2">{{__(@$category->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="category-slider">
        @foreach ($categories as $cat)
        @if ($cat->subcategories->count() > 0)
        <div class="single-slide">
          <div class="category-card has--link">
            <a href="{{route('courses',['category'=>$cat->slug])}}" class="item--link"></a>
            <div class="category-card__icon">
              <img src="{{getImage('assets/images/category/'.$cat->image,'512x512')}}" alt="image">
            </div>
            <div class="category-card__content">
              <h6 class="title">{{__($cat->name)}}</h6>
              <span class="fs--14px">{{$cat->courses_count}} @lang('courses')</span>
            </div>
          </div><!-- category-card end -->
        </div><!-- single-slide end -->
            
        @endif 
        @endforeach
       
      </div>
    </div>
  </section>