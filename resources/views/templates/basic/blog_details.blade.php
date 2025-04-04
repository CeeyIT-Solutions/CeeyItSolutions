@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-100 pb-100">
	<div class="container">
	  <div class="row">
		<div class="col-lg-8">
		  <div class="blog-details-area">
			<div class="blog-details-thumb">
			  <img src="{{ getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image,'800x800') }}" alt="image" class="w-100 rounded-3">
			</div>
			<div class="blog-details-content">
			  <p>
				  @php
					  echo  $blog->data_values->description;
				  @endphp
			  </p>
			</div>
			<div class="blog-details-footer">
			  <span class="share-caption">@lang('share post')</span>
			  <ul class="share-post-links">
				<li><a target="_blank" href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{urlencode(url()->current()) }}" class="twitter"><i class="lab la-twitter"></i> @lang('Twitter')</a></li>
				<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" class="facebook"><i class="lab la-facebook-f"></i>@lang('Facebook')</a></li>
			  </ul>
			</div>
		  </div>
		  <div class="comments-area">
			<div class="fb-comments mt-3" data-href="{{ route('blog.details',[$blog->id , slug($blog->data_values->title)]) }}" data-numposts="5" data-width="850"></div>
		  </div><!-- comments-area end -->
		</div>
		<div class="col-lg-4">
		  <div class="sidebar">
			<div class="widget">
			  <h5 class="widget__title">@lang('Recent Posts')</h5>
			  <ul class="small-post-list">
		     	@foreach ($recentblog as $rb)
					@if ($rb->id != $blog->id)
					<li class="small-post">
						<div class="small-post__thumb"><img src="{{ getImage('assets/images/frontend/blog/thumb_'.$rb->data_values->blog_image,'360x250') }}" alt="image"></div>
						<div class="small-post__content">
							<h5 class="post__title"><a href="{{ route('blog.details',[$rb->id , slug($rb->data_values->title)]) }}">{{Str::limit($rb->data_values->title,20)}}</a></h5>
						</div>
					</li><!-- small-post end -->
					@endif
				@endforeach
			  </ul><!-- small-post-list end -->
			</div><!-- widget end -->
		  </div><!-- sidebar end -->
		</div>
	  </div>
	</div>
  </section>

@endsection
@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush