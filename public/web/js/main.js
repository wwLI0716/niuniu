
//WOW Scroll Spy
var wow = new WOW({
    //disabled for mobile
    mobile: false
});
wow.init();

/* Slicknav Mobile Menu
========================================================*/
$(document).ready(function(){
  $('.wpb-mobile-menu').slicknav({
    prependTo: '.navbar-header',
    parentTag: 'liner',
    allowParentLinks: true,
    duplicate: true,
    label: '',
    closedSymbol: '<i class="fa fa-angle-right"></i>',
    openedSymbol: '<i class="fa fa-angle-down"></i>',
  });
});

// Sticky Nav
$(window).on('scroll', function() {
    if ($(window).scrollTop() > 200) {
        $('.scrolling-navbar').addClass('top-nav-collapse');
    } else {
        $('.scrolling-navbar').removeClass('top-nav-collapse');
    }
});
// Testimonial
$('testimonial-carousel').carousel();
$('a[data-slide="prev"]').click(function () {
    $('#testimonial-carousel').carousel('prev');
});

$('a[data-slide="next"]').click(function () {
    $('#testimonial-carousel').carousel('next');
});

// Progress Bar
$('.skill-shortcode').appear(function() {
  $('.progress').each(function() {
    $('.progress-bar').css('width', function() {
      return ($(this).attr('data-percentage') + '%')
    });
  });
}, {
  accY: -100
});


 // Back Top Link
  var offset = 200;
  var duration = 500;
  $(window).scroll(function() {
    if ($(this).scrollTop() > offset) {
      $('.back-to-top').fadeIn(400);
    } else {
      $('.back-to-top').fadeOut(400);
    }
  });
  $('.back-to-top').click(function(event) {
    event.preventDefault();
    $('html, body').animate({
      scrollTop: 0
    }, 600);
    return false;
  })
