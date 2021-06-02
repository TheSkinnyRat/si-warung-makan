(function($) {
  "use strict"; // Start of use strict

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

    // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict

// Enable Tooltop and PopOver
$("[data-toggle=popover]").popover();
$("[data-toggle=tooltip]").tooltip();


// PLACEHOLDER LOADING
$(window).on('load',function() {
  if ($('#place_load').is(':visible')) {
    $('#place_load').fadeOut("fast", function() {
      $('#main_content').css({'display':'','visibility':''}).hide().fadeIn();
      $('#place_load').remove();
    });
  }
});

setTimeout(function(){
  if ($('#place_load').is(':visible')) {
    $('#place_load').fadeOut("fast", function() {
      $('#main_content').css({'display':'','visibility':''}).hide().fadeIn();
      $('#place_load').remove();
    });
  }
}, 3000);