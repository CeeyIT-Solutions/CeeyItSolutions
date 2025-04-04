@extends($activeTemplate.'layouts.master')
@section('content')
<section class="pt-100 pb-100">
    <div class="container">
      <div class="custom--card">
          <div class="card-body p-4">
            <form method="post" action="" enctype="multipart/form-data">
              @csrf
              
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Course Title')</label>
                      <input name="title" type="text" placeholder="@lang('Course Title')" class="form--control" value="{{ old('title') }}" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">@lang('Preview Image')</label>
                        <div class="thumb">
                            <div class="avatar-preview">
                                <div class="profilePicPreview" style="background-image: url('{{getImage('/','1280x850')}}')"></div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" name="thumbnail" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" required>
                                <label for="image" class="bg--primary text-white"><i class="la la-pencil"></i></label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>@lang('What a learner will learn?')</label>
                      <textarea name="will_learn" wrap="off" rows="30"  class="form--control nicEdit">{{old('will_learn')}}</textarea>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Course Description')</label>
                      <textarea name="description" wrap="off" rows="30" class="form--control nicEdit">{{old('description')}}</textarea>
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
                                <option value="{{$cat->id}}" data-subcat="{{$subcat}}">@lang($cat->name)</option>
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
                            <option value="">--@lang('Select Level')--</option>
                            @foreach ($levels as $level)
                              <option value="{{$level->id}}">@lang($level->name)</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Select Value')</label>
                        <select id="value" class="form--control" name="value" required>
                            <option value="0">@lang('Free')</option>
                            <option value="1" selected>@lang('Price')</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Price')</label>
                      <input name="price" type="text" placeholder="@lang('Price')" class="form--control price" required>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Set Discount (optional)')</label>
                      <div class="input-group">
                        <input name="discount" type="text" placeholder="@lang('Discount')" class="form--control discount">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Tags') <code>(max 10 tags)</code></label>
                        <input type="text" id="input-tags" class="" name="tags">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>@lang('Preview Video')</label>
                      <select id="preview" class="form--control" name="preview" required>
                        <option value="1">@lang('Upload')</option>
                        <option value="2">@lang('Video Url')</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-lg-12 preview_video">
                    <div class="form-group">
                      <label>@lang('Uplaod Preview Video')</label>
                      <input name="preview_video" type="file"  class="form-control custom--file-upload" required>
                    </div>
                  </div>
                  <div class="col-lg-12 preview_url d-none">
                    <div class="form-group">
                      <label>@lang('Video Url')</label>
                      <input name="preview_url" type="text"  class="form--control" placeholder="@lang('e.g. https://www.youtube.com/embed/XGD0eGfKwlE  or  https://player.vimeo.com/video/551835274?title=0&byline=0&portrait=0')" required disabled>
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
                       var html = `<option value="${val.id}">@lang('${val.name}')</option>`
                       $('#subcat').append(html)
                      });
                });


            })(jQuery);
     </script>
@endpush