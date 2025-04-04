<?php
header("Content-Type:text/css");
$color = "#ff0000"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
} 

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>

.header .main-menu li a:hover, .header .main-menu li a:focus, .header .main-menu li.menu_has_children:hover > a::before, .header .main-menu li .sub-menu li a:hover, .btn-outline--base, .hero-search-form i, a:hover, .footer .footer-menu li a:hover, .page-breadcrumb li a:hover, .page-breadcrumb li:first-child::before, .custom--accordion-two .accordion-button:not(.collapsed), .short-link-list li a:hover, .footer-contact-list li i, .instructor-info-list li i, .contact-card__header .icon i, .contact-card a:hover {
  color: <?php echo $color; ?>;
}
.text--base {
  color: <?php echo $color; ?> !important;
}
.btn--base, .btn-outline--base:hover, .hero-search-form__btn, .testimonial-slider .slick-dots li.slick-active button, .single-review .progress .progress-bar, .contact-area::before, .social-media-list li a:hover, .btn--base:hover,.social-links li a:hover, .scroll-to-top, .cumtom--nav-tabs .nav-item .nav-link.active, .sidebar .widget .widget__title::after, .section-subtitle.border-left::before, .custom--file-upload::before, .icon-btn, .custom--table thead, .preloader .preloader-container .animated-preloader, .preloader .preloader-container .animated-preloader:before, .custom--accordion .accordion-button:not(.collapsed) {
  background-color: <?php echo $color; ?>;
}

.tags a:hover{
  background-color: <?php echo $color; ?> !important;
  border-color : <?php echo $color; ?> !important;
}

.bg--base {
  background-color: <?php echo $color; ?> !important;
}
.header.menu-fixed, .footer__bottom, .footer::before {
  background-color: <?php echo $secondColor; ?>;
}
.btn-outline--base, .category-card:hover, .mentor-card:hover, .testimonial-card:hover, .blog-card:hover, .social-links li a:hover, .form--control:focus, .custom--accordion .accordion-item {
  border-color: <?php echo $color; ?>
}