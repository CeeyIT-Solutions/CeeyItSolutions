
@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
      <div class="row gy-4 justify-content-center">
        @foreach ($blogs as $blog)
        <div class="col-lg-4 col-md-6">
            <div class="blog-card">
              <div class="blog-card__thumb">
                <img src="{{getImage('assets/images/frontend/blog/thumb_'.@$blog->data_values->blog_image,'384x255')}}" alt="image">
              </div>
              <div class="blog-card__content">
                <ul class="post-meta mb-1">
                  
                  <li>
                    <a href="javascript:void(0)"><i class="lar la-calendar-alt"></i>{{showDateTime($blog->created_at,'d/m/Y')}}</a>
                  </li>
                </ul>
                <h4><a href="{{route('blog.details',[$blog->id,slug($blog->data_values->title)])}}">{{@$blog->data_values->title}}</a></h4>
                <p class="mt-3">{{Str::limit(strip_tags(@$blog->data_values->description,200))}}</p>
                <a href="{{route('blog.details',[$blog->id,slug($blog->data_values->title)])}}" class="btn btn-sm btn-outline--base mt-4">@lang('Read More')</a>
              </div>
            </div><!-- blog-card end -->
          </div>
        @endforeach
      </div>
    </div>
  </section>
@stop