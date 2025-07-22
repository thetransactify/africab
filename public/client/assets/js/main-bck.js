(function ($) {
"use strict";


$(window).on('load',function(){
	 $('#loader-wrapper').hide();
})

// Menu Toggle

	$(".menu-icon").click(function(){ 
		$(".menu-container").addClass("isopen");
	});

	$(".menu-close").click(function(){ 
		$(".menu-container").removeClass("isopen");
	});	
	
// Menu Toggle

	$(".cart-open").click(function(){ 
		$(".side-cart").addClass("isopen");
	});

	$(".cart-close").click(function(){ 
		$(".side-cart").removeClass("isopen");
	});	

// Product Filters

	$("a.filter-button").click(function(){ 
		$(".product-filters").toggleClass("isopen");
	});		

// Category Slider	

$('.category-slider').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  dots: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 1,
        dots: false,
        arrows: true
      }
    }
  ]
});

// Category Slider	

	$('.tt-tab').slick({
	  centerMode: true,
	  arrows: true,
	  centerPadding: '0px',
	  slidesToShow: 1,
	  autoplay: true,
      autoplaySpeed: 5000,
	  prevArrow:"<a class='tt-arrow ss-prev'><i class='las la-angle-left'></i></a>",
	  nextArrow:"<a class='tt-arrow ss-next'><i class='las la-angle-right'></i></a>",
  responsive: [
    {   
      breakpoint: 768,
      settings: {
    //    arrows: false,
   //     centerMode: true,
  //      centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
   //     arrows: false,
     //   centerMode: true,
     //   centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
  });

// Mobile Service Slider	

$('.service-section-mobile').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  dots: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 1,
      }
    }
  ]
});

// Product Single Slider	

$('.product-image-gallery').slick({
  slidesToShow: 1,
  dots: false,
  arrows: true,
  infinite: false
});

// Quantity A2C

function incrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal)) {
    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

function decrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal) && currentVal > 0) {
    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

$('.qty-input').on('click', '.button-plus', function(e) {
  incrementValue(e);
});

$('.qty-input').on('click', '.button-minus', function(e) {
  decrementValue(e);
});

// Mobile Iti Init


		$(".callnoinput").intlTelInput({
		preferredCountries: ["in" ]
		});

// FAQ 

		$("#ac-tab h2.ac-title").click(function()
			{
	    		$(this).toggleClass('active').next("div.ac-content").slideToggle(750).siblings("div.ac-content").slideUp("500");
	    		$(this).siblings().removeClass('active');
		});


// Message Box

		$(".expand-btn").on('click', function(e){
			e.preventDefault();
			var target = $(this).attr('href');
			$(target).slideToggle(700);
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


// ASM Toggle

	       $(".asm-toggle").click(function() {

	       	$(".acc-sidebar-menu").toggleClass("open");
	       	$(".wrapper").toggleClass("faded");

	       	});

// Date Picker

		$('[data-toggle="datepicker"]').datepicker({format: 'dd-mm-yyyy'});


})(jQuery);
