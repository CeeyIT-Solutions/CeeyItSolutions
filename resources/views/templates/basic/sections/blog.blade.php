@php
    $content = getContent('blog.content',true)->data_values;
    $elements = getContent('blog.element',false,3);
@endphp

<section class="pt-100 pb-100">
  <br/><br/><br/><br/>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title" style="font-size:24px">{{__(@$content->heading)}}</h2>
            <p class="mt-2">{{@$content->sub_heading}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row gy-4 justify-content-center">
        @foreach ($elements as $el)
        <div class="col-lg-4 col-md-6">
            <div class="blog-card">
              <div class="blog-card__thumb">
                <img src="{{getImage('assets/images/frontend/blog/thumb_'.@$el->data_values->blog_image,'384x255')}}" alt="image">
              </div>
              <div class="blog-card__content">
                <ul class="post-meta mb-1">
                  
                  <li>
                    <a href="javascript:void(0)"><i class="lar la-calendar-alt"></i>{{showDateTime($el->created_at,'d/m/Y')}}</a>
                  </li>
                </ul>
                <h4><a href="{{route('blog.details',[$el->id,slug($el->data_values->title)])}}">{{@$el->data_values->title}}</a></h4>
                <p class="mt-3" style="font-size: 14px">{{Str::limit(strip_tags(@$el->data_values->description,200))}}</p>
                {{-- <a href="{{route('blog.details',[$el->id,slug($el->data_values->title)])}}" class="btn btn-sm btn-outline--base mt-4">@lang('Read More')</a> --}}
              </div>
            </div><!-- blog-card end -->
          </div>
        @endforeach
      </div>
    </div>
    <br/><br/><br/><br/>
  </section>