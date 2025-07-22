(function ($) {
"use strict";

$(window).on('load',function(){
	 $('#loader-wrapper').hide();
	 var contentpad = $(".footer-area").outerHeight();

       // Bind to the resize event of the window object
$(window).on("resize", function () {

    // Set .right's width to the window width minus 480 pixels
    $(".category-slider .item a").height( $(".category-slider .item a").width());
    $(".fo-item").height( $(".fo-item").width());
    // $(".testimonial-item").height( $(".home-news").height());
    $(".content-area").css( 'padding-bottom',contentpad);

// Invoke the resize event immediately
}).resize();
})


$(window).scroll(function(){
    if ($(window).scrollTop() >= 100) {
        $('header').addClass('fixed-header');
    }
    else {
        $('header').removeClass('fixed-header');
    }
});
		
$( document ).ready(function() {

	// Side Bar Cart 

	$(".cartopenbutton").click(function(){ 
		$(".side-cart").addClass("isopen");
		$(".wrapper").addClass("faded");
		$("body").addClass("overflow-hidden");
	});

	$(".side-modal-close").click(function(){ 
		$(".side-cart").removeClass("isopen");
		$(".wrapper").removeClass("faded");
		$("body").removeClass("overflow-hidden");
	});	

	// Side Bar Menu

	$(function(){
	  var $button = $('.menu').clone();
	  $('.sm-container').html($button);
	});

	$(".menuopenbutton").click(function(){ 
		$(".side-menu").addClass("isopen");
		$(".wrapper").addClass("faded");
		$("body").addClass("overflow-hidden");
	});

	$(".side-menu-close").click(function(){ 
		$(".side-menu").removeClass("isopen");
		$(".wrapper").removeClass("faded");
		$("body").removeClass("overflow-hidden");
	});

	// $(".has-submenu").click(function(){
	// 	$(".sub-menu").slideToggle(500);
	// }); 	

// Homepage Banner

$('.ba-slider').slick({
 // centerMode: true,
 //  centerPadding: '280px',
  arrows: false,
  dots:true,
  autoplay:true,
  fade: true,
  speed: 500,
  infinite: true,
  cssEase: 'ease-in-out',
  touchThreshold: 100,
  slidesToShow: 1,
  responsive: [
    {
      breakpoint: 1880,
      settings: {
        arrows: false,
        // centerMode: true,
        // centerPadding: '200px',
        slidesToShow: 1
      }
    },  
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        // centerMode: true,
        // centerPadding: '100px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        // centerMode: true,
        // centerPadding: '0px',
        slidesToShow: 1
      }
    }
  ]
});

// Home Top Picks Carousel

$('.htp-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  autoplay:true,
  slidesToShow: 3,
  centerMode: true,
  variableWidth: true,
  responsive: [
    {
      breakpoint: 1399,
      settings: {
        slidesToShow: 4
      }
    },  
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2
      }
    }
  ]
});

// Home Advertisements

$('.home-ads').slick({
  dots: true,
  arrows:false,
  autoplay:true,
  fade: true,
  speed: 1000,
  delay: 1000,
  infinite: true,
  cssEase: 'ease-in-out',
  slidesToShow: 1,
});

// Home News Section

$('.ht-container').slick({
  dots: true,
  arrows:false,
  infinite: true,
  autoplay:true,
  speed: 600,
  slidesToShow: 1,
  fade: true,
});


// eCom Features

$('.ecom-features').slick({
  dots: false,
  arrows:false,
  infinite: false,
  speed: 300,
  autoplay:false,
  slidesToShow: 3,
  centerMode: false,
  variableWidth: false,
  responsive: [  
    {
      breakpoint: 768,
      settings: {
      	dots: true,
      	autoplay:true,
        slidesToShow: 1

      }
    }
  ]
});


// Home Category Slider

$('.category-slider').slick({
  dots: false,
  arrows: true,
  infinite: true,
  speed: 300,
  autoplay:true,
  slidesToShow: 6,
  responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 5
      }
    },  
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3
      }
    }
  ]
});

// Home Category Slider

$('.hbp-carousel').slick({
  dots: false,
  arrows: true,
  infinite: true,
  speed: 300,
  autoplay:true,
  slidesToShow: 6,
  responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 5
      }
    },  
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2
      }
    }
  ]
});

// Grid Changer

let $card = $(".each-item");

$(".grid-4").on("click", () => {
	if ($card.hasClass("col-xl-4")) {
		$card.removeClass("col-xl-4");
		$card.addClass("col-xl-3");
	} else if ($card.hasClass("col-lg-4")) {
		$card.removeClass("col-lg-4");
		$card.addClass("col-lg-3");
	}
	$(".grid-4").addClass("active");
	$(".grid-3").removeClass("active");
	$(".grid-2").removeClass("active");
	$(".grid-1").removeClass("active");
});
$(".grid-3").on("click", () => {
	if ($card.hasClass("col-xl-3")) {
		$card.removeClass("col-xl-3");
		$card.addClass("col-xl-4");
	} else if ($card.hasClass("col-lg-3")) {
		$card.removeClass("col-lg-3");
		$card.addClass("col-lg-4");
	}
	$(".grid-4").removeClass("active");
	$(".grid-3").addClass("active");
	$(".grid-2").removeClass("active");
	$(".grid-1").removeClass("active");
});

$(".grid-2").on("click", () => {
	if ($card.hasClass("col-12")) {
		$card.removeClass("col-12");
		$card.addClass("col-6");
	};
	$(".grid-4").removeClass("active");
	$(".grid-3").removeClass("active");
	$(".grid-2").toggleClass("active");
	$(".grid-1").removeClass("active");
});

$(".grid-1").on("click", () => {
	if ($card.hasClass("col-6")) {
		$card.removeClass("col-6");
		$card.addClass("col-12");
	};
	$(".grid-4").removeClass("active");
	$(".grid-3").removeClass("active");
	$(".grid-2").removeClass("active");
	$(".grid-1").toggleClass("active");
});

 $('.pp-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  // centerMode:true,
  arrows: false,
  fade: true,
  asNavFor: '.pp-slider-thumbnail'
});

$('.pp-slider-thumbnail').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.pp-slider',
  dots: false,
  centerMode: true,
  centerPadding: '60px',
  loop:true,
  infinite: true, 
  focusOnSelect: true,
  arrows: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  focusOnSelect: true,
      }
    },
    {
      breakpoint: 980,
      settings: {
  	  centerPadding: '10px',
      }
    },
    {
      breakpoint: 480,
      settings: {
	  slidesToShow: 3,
	  slidesToScroll: 1,
  	  centerPadding: '5px',

      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
})

// Product Tabs

		$("#ac-tab h2.ac-title").click(function()
			{
	    		$(this).toggleClass('active').next("div.ac-content").slideToggle(750).siblings("div.ac-content").slideUp("500");
	    		$(this).siblings().removeClass('active');
		});


// Message Box

		$(".expand-btn").on('click', function(e){
			e.preventDefault();
			var target = $(this).attr('href');
			$(target).slideToggle(500);
		});

// Address Area


		$("#all-addresses h6.address-label").click(function()
		{
		    $(this).toggleClass('active').next("div.address-body").slideToggle(300).siblings("div.address-body").slideUp(300);
		    $(this).siblings().removeClass('active');
		    $(this).toggleClass('toggle');
				$(this).siblings().removeClass('toggle');
		});

		$('#all-addresses h6.address-label').click(function () {

	   var val =  $(this).find('input:radio').prop('checked')?false:true;
	   $(this).find('input:radio').prop('checked', val);
		});

		$("#show-more-address h6.address-label").click(function()
		{
		    $(this).toggleClass('active').next("div.address-body").slideToggle(300).siblings("div.address-body").slideUp(300);
		    $(this).siblings().removeClass('active');
		    $(this).toggleClass('toggle');
				$(this).siblings().removeClass('toggle');
		});

		$('#show-more-address h6.address-label').click(function () {

	   var val =  $(this).find('input:radio').prop('checked')?false:true;
	   $(this).find('input:radio').prop('checked', val);
		});


		$('#showaddress').change(function(){
		    if(this.checked) {
		         $('.show-more-address').show();
		    } else {
		        $('.show-more-address').hide();
		    }
		});

// Payment Info

        $('input[name="payment-method"]').on('click', function () {

            var $value = $(this).attr('value');
            $(this).parents('.payment-group').siblings('.payment-group').children('.payment-info').slideUp('300');
            $('[data-method="' + $value + '"]').slideToggle('300');
        });

// Date Picker

		$('[data-toggle="datepicker"]').datepicker({format: 'dd-mm-yyyy'});


// Mobile Iti Init


		$(".callnoinput").intlTelInput({
		preferredCountries: ["tz" ]
		});

});

// ASM Toggle

	       $(".asm-toggle").click(function() {

	       	$(".acc-sidebar-menu").toggleClass("open");
	       	$(".wrapper").toggleClass("faded");

	       	});

// Menu Header

$(document).ready(function() {
  $('.has-submenu').hover(
    function() {
      $('header').addClass('menu-hov');
    },
    function() {
      $('header').removeClass('menu-hov');
    }
  );
});

})(jQuery);
