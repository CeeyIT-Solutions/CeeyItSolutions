'use strict';

$( document ).ready(function() {
  //preloader js code
  $(".preloader").delay(300).animate({
    "opacity" : "0"
    }, 300, function() {
    $(".preloader").css("display","none");
  });
});



// menu options custom affix
var fixed_top = $(".header");
$(window).on("scroll", function(){
    if( $(window).scrollTop() > 50){  
        fixed_top.addClass("animated fadeInDown menu-fixed");
    }
    else{
        fixed_top.removeClass("animated fadeInDown menu-fixed");
    }
});

// mobile menu js
$(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
  const element = $(this).parent("li");
  if (element.hasClass("open")) {
    element.removeClass("open");
    element.find("li").removeClass("open");
  }
  else {
    element.addClass("open");
    element.siblings("li").removeClass("open");
    element.siblings("li").find("li").removeClass("open");
  }
});

const widgetBtn = $('.sidebar-widget .title-btn');
const widgetBody = $('.sidebar-widget__body');

widgetBtn.each(function(){
  $(this).on('click', function(){
    $(this).parent().siblings(widgetBody).slideToggle();
  });
});

const selectMenuItem = $('.select-menu-list > li');
selectMenuItem.each(function(){
  $(this).on('click', function(){
    var el = $(this);
    if (el.hasClass('active')) {
      el.toggleClass('active').siblings().show();
    }else{
      el.toggleClass('active').siblings().hide();
    }
  });
});

// wow js init
new WOW().init();



// main wrapper calculator
var bodySelector = document.querySelector('body');
var header = document.querySelector('.header');
var footer = document.querySelector('.footer');
(function(){
  if(bodySelector.contains(header) && bodySelector.contains(footer)){
    var headerHeight = document.querySelector('.header').clientHeight;
    var footerHeight = document.querySelector('.footer').clientHeight;

    // if header isn't fixed to top
    var totalHeight = parseInt( headerHeight, 10 ) + parseInt( footerHeight, 10 ) + 'px'; 
    
    // if header is fixed to top
    // var totalHeight = parseInt( footerHeight, 10 ) + 'px'; 
    var minHeight = '100vh';
    document.querySelector('.main-wrapper').style.minHeight = `calc(${minHeight} - ${totalHeight})`;
  }
})();


// Show or hide the sticky footer button
$(window).on("scroll", function() {
	if ($(this).scrollTop() > 200) {
			$(".scroll-to-top").fadeIn(200);
	} else {
			$(".scroll-to-top").fadeOut(200);
	}
});

// Animate the scroll to top
$(".scroll-to-top").on("click", function(event) {
	event.preventDefault();
	$("html, body").animate({scrollTop: 0}, 300);
});


$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    boundary: 'window'
  })
});

// custom input animation js
$('.custom--form-group .form--control').on('input', function(){
  let passfield = $(this).val();
  if (passfield.length < 1){
      $(this).removeClass('hascontent');
  }else{
      $(this).addClass('hascontent');
  }
});

const advanceOpenBtn = $('.advance-btn');
const advanceCloseBtn = $('.sidebar-close-btn');
const advanceWrapper = $('.advance-search-area');
advanceOpenBtn.on('click', function(){
  advanceWrapper.slideToggle();
});


// grid & list view js 
const gridBtn = $('.grid-view-btn');
const listBtn = $('.list-view-btn');

const gridView = $('.grid-view');
const listView = $('.list-view');

const cardView = $('.card-view-area');

gridBtn.on('click', function(){
  // button active class check
  if($(this).hasClass('active')){
    return true
  } else {
    $(this).addClass('active');
    $(this).siblings('.list-view-btn').removeClass('active');
  }
  // grid & list view check
  if(cardView.hasClass('list-view')) {
    cardView.removeClass('list-view');
    cardView.addClass('grid-view');
  } 
})

listBtn.on('click', function(){
  if($(this).hasClass('active')){
    return true
  } else {
    $(this).addClass('active');
    $(this).siblings('.grid-view-btn').removeClass('active');
  }
  // grid & list view check
  if(cardView.hasClass('grid-view')) {
    cardView.removeClass('grid-view');
    cardView.addClass('list-view');
  } 
})

// action-sidebar js 
const actionSidebar = $('.action-sidebar');
const actionSidebarOpenBtn = $('.action-sidebar-open');
const actionSidebarCloseBtn = $('.action-sidebar-close');

actionSidebarOpenBtn.on('click', function(){
  actionSidebar.addClass('active');
});
actionSidebarCloseBtn.on('click', function(){
  actionSidebar.removeClass('active');
});

/* ==============================
					slider area
================================= */

$('.category-slider').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  dots: false,
  infinite: true,
  arrows: true,
  prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
  nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 420,
      settings: {
        slidesToShow: 2,
      }
    }
  ]
});

// course-slider js 
$('.course-slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  infinite: true,
  arrows: true,
  prevArrow: '<div class="prev"><i class="las la-angle-left"></i></div>',
  nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
});


// testimonial-slider js 
$('.testimonial-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  infinite: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
}); 

function proPicURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          var preview = $(input).parents('.thumb').find('.profilePicPreview');
          $(preview).css('background-image', 'url(' + e.target.result + ')');
          $(preview).addClass('has-image');
          $(preview).hide();
          $(preview).fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
$(".profilePicUpload").on('change', function () {
  proPicURL(this);
});

$(".remove-image").on('click', function () {
  $(this).parents(".profilePicPreview").css('background-image', 'none');
  $(this).parents(".profilePicPreview").removeClass('has-image');
  $(this).parents(".thumb").find('input[type=file]').val('');
});
