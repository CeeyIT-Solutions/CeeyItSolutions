@extends($activeTemplate.'layouts.master')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
     <div class="text-end mb-3">
      <a class="btn btn--base btn-sm" href="{{route('user.courses')}}"> <i class="las la-backward"></i> @lang('Back')</a>
     </div>
      <div class="custom--card p-4">
          <div class="card-body p-0">
            <form method="post" action="{{route('user.update.course')}}" enctype="multipart/form-data">
              @csrf
              <input name="id" type="hidden"  value="{{ $course->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Course Title')</label>
                      <input name="title" type="text" placeholder="@lang('Course Title')" class="form--control" value="{{ $course->title }}" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">@lang('Preview Image')</label>
                        <div class="thumb">
                            <div class="avatar-preview">
                                <div class="profilePicPreview" style="background-image: url('{{getImage('assets/course/thumbnail/'.$course->thumbnail,'1280x850')}}')"></div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" name="thumbnail" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg">
                                <label for="image" class="bg--primary text-white"><i class="la la-pencil"></i></label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>@lang('What a learner will learn?')</label>
                      <textarea name="will_learn" wrap="off" rows="30"  class="form--control nicEdit">{{$course->will_learn}}</textarea>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Course Description')</label>
                      <textarea name="description" wrap="off" rows="30" class="form--control nicEdit">{{$course->description}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('Select Category')</label>
                        <select id="category" class="form--control" name="category_id" required>
                            <option value="">--@lang('Select Category')--</option>
                            @foreach ($categories as $cat)
                              @php 
                                  $subcat = $cat->subcategories->where('status',1);
                              @endphp
                              @if($subcat->count() > 0)
                                <option value="{{$cat->id}}" data-subcat="{{$subcat}}" {{$course->category_id == $cat->id ? 'selected':''}} >@lang($cat->name)</option>
                              @endif
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Select Sub Category')</label>
                        <select id="subcat" class="form--control" name="subcategory_id" disabled required>
                            <option value="">--@lang('Select Sub Category')--</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Select Level')</label>
                        <select id="my-select" class="form--control" name="level_id"  required>
                            @foreach ($levels as $lvl)
                              <option value="{{$lvl->id}}" {{$course->level_id == $lvl->id ? 'selected':''}}>@lang($lvl->name)</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Select Value')</label>
                        <select id="value" class="form--control" name="value" required>
                            <option value="0"{{$course->value == 0 ? 'selected':''}} >@lang('Free')</option>
                            <option value="1"{{$course->value == 1 ? 'selected':''}} >@lang('Price')</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group {{$course->value == 0 ? 'd-none':''}}">
                      <label>@lang('Price')</label>
                      <input name="price" type="text" placeholder="@lang('Price')" class="form--control price" value="{{$course->price ?getAmount($course->price) : ''}}" required {{$course->price ?? 'disabled'}}>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group {{$course->value == 0 ? 'd-none':''}}">
                      <label>@lang('Set Discount (optional)')</label>
                      <div class="input-group">
                        <input name="discount" type="text" placeholder="@lang('Discount')" class="form--control discount" value="{{$course->discount ? getAmount($course->discount) : ''}}">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Tags')<code> (max 10 tags)</code></label>
                      <input type="text" id="input-tags" class="" name="tags" value="{{@implode(',',$course->tags)}}">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Preview Video')</label>
                      <select id="preview" class="form--control" name="preview" required>
                        <option value="1" {{$course->preview == 1 ? 'selected' : ''}} >@lang('Upload')</option>
                        <option value="2" {{$course->preview == 2 ? 'selected' : ''}} >@lang('Video Url')</option>
                      </select>
                    </div>
                  </div>

                
                  <div class="col-lg-12 preview_video {{$course->preview == 2 ? 'd-none':''}}">
                    <div class="form-group">
                      <label>@lang('Update Preview Video')</label> <a href="javascript:void(0)"   title="See Preview"><i class="las la-info-circle video-show"  data-source="{{asset('assets/course/preview_video/'.$course->preview_video)}}" data-bs-toggle="modal" data-bs-target="#file-video-modal"></i></a>
                      <input name="preview_video" type="file"  class="form-control custom--file-upload" {{$course->preview == 2 ? 'disabled':''}}>
                    </div>
                  </div>
                  
                  <div class="col-lg-12 preview_url {{$course->preview == 1 ? 'd-none':''}}">
                    <div class="form-group">
                      <label>@lang('Video Url')</label>
                      <input name="preview_url" type="text"  class="form--control" placeholder="@lang('e.g. https://www.youtube.com/embed/XGD0eGfKwlE  or  https://player.vimeo.com/video/551835274?title=0&byline=0&portrait=0')" required {{$course->preview == 1 ? 'disabled':''}} value="{{$course->preview_url}}">
                    </div>
                  </div>
                  
                  <div class="col-lg-12 text-end">
                    <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
                  </div>
                </div>
            </form>
          </div>
      </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="file-video-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
       
          <div class="modal-content">
              <div class="modal-header bg--base">
                <h5 class="modal-title text-white">@lang('Preview Video')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <video id="my_video_1" class="video-js vjs-default-skin w-100" controls preload="none"
                      poster=''
                      data-setup='{ "aspectRatio":"1366:620", "playbackRates": [1, 1.5, 2] }' autoplay>
                      <source src="" type="application/x-mpegURL" autoplay id="source">
                 </video>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn--secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
              </div>
            </div>
     
      </div>
  </div>
</section>
@endsection

@push('style')
<link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/selectize.default.min.css')}}"/>
@endpush
@push('script-lib')
<script src="{{asset($activeTemplateTrue.'js/selectize.min.js')}}"></script>
@endpush


@push('script')
     <script>
            'use strict';
            (function ($) {
                  $("#input-tags").selectize({
                    delimiter: ",",
                    persist: false,
                    create: function (input) {
                      return {
                        value: input,
                        text: input,
                      };
                    },
                  });

                    var sub_id =  '{{$course->subcategory_id}}'
                    var subcategories = $("#category option:selected").data('subcat')
                    $('#subcat').removeAttr('disabled')

                $.each(subcategories, function (i, val) { 
                  var html = `<option value="${val.id}" ${val.id == sub_id ? 'selected':'' } >@lang('${val.name}')</option>`
                  $('#subcat').append(html)
                });

             
              
                $('#preview').on('change', function () {
                  if($(this).val()==1){
                       $('.preview_video').removeClass('d-none')
                       $('.preview_url').addClass('d-none')
                       $('.preview_video').find('input[name=preview_video]').removeAttr('disabled')
                       $('.preview_url').find('input[name=preview_url]').attr('disabled',true)
                    } else if ($(this).val()==2){
                       $('.preview_video').addClass('d-none')
                       $('.preview_url').removeClass('d-none')
                       $('.preview_video').find('input[name=preview_video]').attr('disabled',true)
                       $('.preview_url').find('input[name=preview_url]').removeAttr('disabled')
                    } else {
                        return false;
                    }
                 });

                  //select course price
                $('#value').on('change', function () {
                    if($(this).val()==1){
                       $('.price,.discount').removeAttr('disabled')
                       $('.price,.discount').parents('.form-group').removeClass('d-none')
                    } else if ($(this).val()==0){
                        $('.price,.discount').attr('disabled',true)
                        $('.price,.discount').parents('.form-group').addClass('d-none')
                    } else {
                        return false;
                    }
                });

                //category subcategory select
                $('#category').on('change', function () {
                    var selected = $("#category option:selected");
                    $('#subcat').children().remove()
                    if(selected.val()==''){
                        $('#subcat').attr('disabled',true)
                        $('#subcat').html('<option value="">--@lang('Select Sub Category')--</option>')
                    } else{
                        $('#subcat').removeAttr('disabled')
                    }
                   
                     var subcategories = selected.data('subcat')
                     $.each(subcategories, function (i, val) { 
                       var html = `<option value="${val.id}" >@lang('${val.name}')</option>`
                       $('#subcat').append(html)
                      });
                });

                $('.video-show').on('click',function () { 
                    $('#file-video-modal').find('#source').attr('src',$(this).data('source'))
                })


            })(jQuery);
     </script>
@endpush