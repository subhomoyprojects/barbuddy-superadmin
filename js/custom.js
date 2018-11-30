(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle").on('click',function(e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  });

  sidemenu();
  function sidemenu(){
    if ($(window).width() < 768) {
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    }
  }


  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll',function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });


//owl with lightbox
// Multyple Image Slider

var owl = $('.owl1');
      owl.owlCarousel({
        margin: 10,
    // autoplay: true,
        autoplayTimeout: 2000,
        // loop: true,
    nav: true,
    margin:20,
    navText : ["<img src='images/myprevimage.png'>","<img src='images/mynextimage.png'>"],
        responsive: {
          0: {
            items: 1
          }
        }
      })
    
    $('.owl-carousel').on('mouseleave',function(e){
    owl.trigger('play.owl.autoplay');
})
$('.owl-carousel').on('mouseover',function(e){
    owl.trigger('stop.owl.autoplay');
})


var owl = $('.superadmin1');
      owl.owlCarousel({
    // autoplay: true,
     // autoplayTimeout: 2000,
    // loop: true,
      nav: true,
      // margin:20,
    navText : ["<i class='fa fa-chevron-left'  aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
        responsive: {
          0: {
            items: 1
          },
          480: {
            items: 2
          },
          640: {
            items: 3
          }
        }
      })
    
    $('.owl-carousel').on('mouseleave',function(e){
    owl.trigger('play.owl.autoplay');
})
$('.owl-carousel').on('mouseover',function(e){
    owl.trigger('stop.owl.autoplay');
})


var owl = $('.superadmin2');
      owl.owlCarousel({
    // autoplay: true,
     // autoplayTimeout: 2000,
    // loop: true,
      nav: true,
      // margin:20,
    navText : ["<i class='fa fa-chevron-left'  aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
        responsive: {
          0: {
            items: 1
          },
          480: {
            items: 2
          },
          640: {
            items: 3
          }
        }
      })
    
    $('.owl-carousel').on('mouseleave',function(e){
    owl.trigger('play.owl.autoplay');
})
$('.owl-carousel').on('mouseover',function(e){
    owl.trigger('stop.owl.autoplay');
})


// For Light Box /

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});

// For Light Box /



  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

})(jQuery); // End of use strict
