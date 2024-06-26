$(document).ready(function(){
 "use strict";

 $('.alert').alert();

 var window_width 	 = $(window).width(),
 window_height 		 = window.innerHeight,
 header_height 		 = $(".default-header").height(),
 header_height_static = $(".site-header.static").outerHeight(),
 fitscreen 			 = window_height - header_height;


 $(".fullscreen").css("height", window_height)
 $(".fitscreen").css("height", fitscreen);

 if(document.getElementById("default-select")){
  $('select').niceSelect();
};

if(document.getElementById("default-selects")){
  $('select').niceSelect();
};   

if(document.getElementById("default-selects2")){
  $('select').niceSelect();
};        

$('.img-pop-up').magnificPopup({
  type: 'image',
  gallery:{
    enabled:true
  }
});


$('.play-btn').magnificPopup({
  type: 'iframe',
  mainClass: 'mfp-fade',
  removalDelay: 160,
  preloader: false,
  fixedContentPos: false
}); 

        /* 
     Select one checkbox at a time
     ========================================================================== */

     $("input:checkbox").on('click', function() {
      // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
        });


        /* 
     Testimonials
     ========================================================================== */

     $("#testimonial-slider").owlCarousel({
      items:1,
      itemsDesktop:[1000,1],
      itemsDesktopSmall:[979,1],
      itemsTablet:[768,1],
	  itemsMobile:[260,1],
      pagination:true,
      navigation:false,
      navigationText:["",""],
      slideSpeed:100,
      singleItem:true,
      transitionStyle:"fade",
      autoPlay:true
    });
		$("#companies-slider").owlCarousel({
      items:2,
      itemsDesktop:[1000,2],
      itemsDesktopSmall:[979,2],
      itemsTablet:[768,2],
      itemsMobile:[260,2],
      pagination:true,
      navigation:false,
      navigationText:["",""],
      singleItem:true,
      transitionStyle:"fade", 
      autoPlay:true
    });
	 $("#premium-slider").owlCarousel({
      items:1,
      itemsDesktop:[1000,1],
      itemsDesktopSmall:[979,1],
      itemsTablet:[768,1],
      pagination:false,
      navigation:false,
      navigationText:["",""],
      slideSpeed:100,
      singleItem:true,
      transitionStyle:"fade",
      autoPlay:true
    });
	$("#sponsor-slider").owlCarousel({
      items:1,
      itemsDesktop:[1000,1],
      itemsDesktopSmall:[979,1],
      itemsTablet:[768,1],
      pagination:false,
      navigation:false,
      navigationText:["",""],
      slideSpeed:100,
      singleItem:true,
      transitionStyle:"fade",
      autoPlay:true
    });
	
	$("#bottomads-slider").owlCarousel({
      items:1,
      itemsDesktop:[1000,1],
      itemsDesktopSmall:[979,1],
      itemsTablet:[768,1],
      pagination:false,
      navigation:false,
         singleItem:true,
      transitionStyle:"fade",
         navigationText:["",""],
      slideSpeed:100,
autoPlay:true
    });
	$('.sponsor').owlCarousel({
    animateOut: 'slideOutDown',
    animateIn: 'flipInX',
    items:1,
    margin:30,
    stagePadding:30,
    smartSpeed:450
});
      /* 
     VIDEO POP-UP
     ========================================================================== */
     $('.video-popup').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });



    // Initiate superfish on nav menu
    $('.nav-menu').superfish({
      animation: {
        opacity: 'show'
      },
      speed: 400
    });

    // Mobile Navigation
    if ($('#nav-menu-container').length) {
      var $mobile_nav = $('#nav-menu-container').clone().prop({
        id: 'mobile-nav'
      });
      $mobile_nav.find('> ul').attr({
        'class': '',
        'id': ''
      });
      $('body').append($mobile_nav);
      $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i></button>');
      $('body').append('<div id="mobile-body-overly"></div>');
      $('#mobile-nav').find('.menu-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');

      $(document).on('click', '.menu-has-children i', function(e) {
        $(this).next().toggleClass('menu-item-active');
        $(this).nextAll('ul').eq(0).slideToggle();
        $(this).toggleClass("lnr-chevron-up lnr-chevron-down");
      });

      $(document).on('click', '#mobile-nav-toggle', function(e) {
        $('body').toggleClass('mobile-nav-active');
        $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
        $('#mobile-body-overly').toggle();
      });

      $(document).click(function(e) {
        var container = $("#mobile-nav, #mobile-nav-toggle");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
          if ($('body').hasClass('mobile-nav-active')) {
            $('body').removeClass('mobile-nav-active');
            $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
            $('#mobile-body-overly').fadeOut();
          }
        }
      });
    } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
      $("#mobile-nav, #mobile-nav-toggle").hide();
    }

    // Smooth scroll for the menu and links with .scrollto classes
    $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        if (target.length) {
          var top_space = 0;

          if ($('#header').length) {
            top_space = $('#header').outerHeight();

            if( ! $('#header').hasClass('header-fixed') ) {
              top_space = top_space;
            }
          }

          $('html, body').animate({
            scrollTop: target.offset().top - top_space
          }, 1500, 'easeInOutExpo');

          if ($(this).parents('.nav-menu').length) {
            $('.nav-menu .menu-active').removeClass('menu-active');
            $(this).closest('li').addClass('menu-active');
          }

          if ($('body').hasClass('mobile-nav-active')) {
            $('body').removeClass('mobile-nav-active');
            $('#mobile-nav-toggle i').toggleClass('lnr-times lnr-bars');
            $('#mobile-body-overly').fadeOut();
          }
          return false;
        }
      }
	  
    });

    $('.nav-menu a, #header a, .scrollto').on('click', function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        if (target.length) {
          var top_space = 0;

          if ($('#header').length) {
            top_space = $('#header').outerHeight();

            if( ! $('#header').hasClass('header-fixed') ) {
              top_space = top_space;
            }
          }

          $('html, body').animate({
            scrollTop: target.offset().top - top_space
          }, 1500, 'easeInOutExpo');
          return false;
        }
      }
	  
    });


    $(document).ready(function() {

      $('html, body').hide();

      if (window.location.hash) {

        setTimeout(function() {

          $('html, body').scrollTop(0).show();

          $('html, body').animate({

            scrollTop: $(window.location.hash).offset().top

          }, 1000)

        }, 0);

      }

      else {

        $('html, body').show();

      }

    });
    

    // Header scroll class
    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        $('#header').addClass('header-scrolled');
      } else {
        $('#header').removeClass('header-scrolled');
      }
    })


    $('.active-relatedjob-carusel').owlCarousel({
      items:1,
      autoplay:true,
      loop:true,
      margin:30,
      dots: true
    });

    $('.active-review-carusel').owlCarousel({
      items:2,
      margin:30,
      autoplay:true,
      loop:true,
      dots: true,       
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 1,
        },
        768: {
          items: 2,
        }
      }
    });

    $('.active-popular-post-carusel').owlCarousel({
      items:2,
      margin:30,
      autoplay:true,
      loop:true,
      dots: true,       
      responsive: {
        0: {
          items: 1
        },
        480: {
          items: 1,
        },
        768: {
          items: 1,
        },
        961: {
          items: 2,
        }
      }
    });




      //  Start Google map 

              // When the window has finished loading create our google map below

              if(document.getElementById("map")){

                google.maps.event.addDomListener(window, 'load', init);

                function init() {
                  // Basic options for a simple Google Map
                  // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                  var mapOptions = {
                      // How zoomed in you want the map to start at (always required)
                      zoom: 11,

                      // The latitude and longitude to center the map (always required)
                      center: new google.maps.LatLng(40.6700, -73.9400), // New York

                      // How you would like to style the map. 
                      // This is where you would paste any style found on Snazzy Maps.
                      styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                    };

                  // Get the HTML DOM element that will contain your map 
                  // We are using a div with id="map" seen below in the <body>
                  var mapElement = document.getElementById('map');

                  // Create the Google Map using our element and options defined above
                  var map = new google.maps.Map(mapElement, mapOptions);

                  // Let's also add a marker while we're at it
                  var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Snazzy!'
                  });
                }
              }


              $(document).ready(function() {
                $('#mc_embed_signup').find('form').ajaxChimp();
              });      

            });


(function ($) {
  "use strict";

      /*==================================================================
      [ Validate ]*/
      var input = $('.validate-input .input100');

      $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
          if(validate(input[i]) == false){
            showValidate(input[i]);
            check=false;
          }
        }

        return check;
      });


      $('.validate-form .input100').each(function(){
        $(this).focus(function(){
         hideValidate(this);
       });
      });

      function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
          if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            return false;
          }
        }
        else {
          if($(input).val().trim() == ''){
            return false;
          }
        }
      }

      function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
      }

      function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
      }
      
      

    })(jQuery);

$('.owl-carouse1').owlCarousel({
    margin:10,
    loop:true,
    items:1,
      pagination:true,
      navigation:false,
      navigationText:["",""],
      slideSpeed:100,
      singleItem:true,
      transitionStyle:"fade",
	  autowidth:true,
      autoPlay:true
})
$(document).ready(function() {
 
  var owl = $("#slider-main");
 
  owl.owlCarousel({
    navigation : false,
    singleItem : true,
    transitionStyle :"fadeUp",
	slideSpeed: 500,
	 paginationSpeed : 400,
    singleItem:true,
	autowidth:true,
	autoheight:true,
    autoPlay:true
  });
 
});
$(document).ready(function() {
 
  var owl = $("#sliderbottom-main");
 
  owl.owlCarousel({
    navigation : false,
    singleItem : true,
	pagination:false,
    transitionStyle :"fadeUp",
	slideSpeed: 500,
	 paginationSpeed : 400,
    singleItem:true,
	autowidth:true,
	autoheight:true,
    autoPlay:true
  });
 
});

$('.owl-company').owlCarousel({
  loop: true,
  pagination:false,
  nav: true,
  autoplay: true,
  stagePadding: 10,
  margin: 2,
  animateOut: 'backSlide',
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
  dots: false,
  mouseDrag: true,
  responsive: {
      0: {
          items: 1,
      },
      600: {
          items: 4,
      },
      1000: {
          items: 6,
      }
  }
});