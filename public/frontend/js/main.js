(function ($) {
 "use strict";
 
/*----------------------------
 TOP Menu Stick
------------------------------ */
$(window).on('scroll',function() {
if ($(this).scrollTop() > 240){  
    $('#sticky-header').addClass("sticky");
  }
  else{
    $('#sticky-header').removeClass("sticky");
  }

});

/*header menu start*/
$('.header-account li.dropdown').hover(function() {
	$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
}, function() {
	$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(200);
});
/*header menu start*/
$('.mean-menu li.dropdown').hover(function() {
	$(this).find('.dropdown-menu-menu').stop(true, true).delay(100).fadeIn(200);
}, function() {
	$(this).find('.dropdown-menu-menu').stop(true, true).delay(100).fadeOut(200);
});
/*header menu end*/  

	/*----------------------------
     tooltip
    ------------------------------ */
  $('[data-toggle="tooltip"]').tooltip({
      animated: 'fade',
      container: 'body'
}); 
 
/*----------------------------
 jQuery MeanMenu
------------------------------ */
	jQuery('#mobile-menu-active').meanmenu();	
		
/*----------------------------
 nivoSlider
------------------------------ */	
	$("#slider").nivoSlider({ 
    effect: 'fold',                 // Specify sets like: 'fold,fade,sliceDown' 
    slices: 15,                       // For slice animations 
    boxCols: 8,                       // For box animations 
    boxRows: 4,                       // For box animations 
    animSpeed: 500,                   // Slide transition speed 
    pauseTime: 3000,                  // How long each slide will show 
    startSlide: 0,                    // Set starting Slide (0 index) 
    directionNav: false,               // Next & Prev navigation 
    controlNav: true,                 // 1,2,3... navigation 
    controlNavThumbs: false,          // Use thumbnails for Control Nav 
    pauseOnHover: true,               // Stop animation while hovering 
    manualAdvance: true,             // Force manual transitions 
    prevText: '<i class="fa fa-angle-left"></i>',   // Prev directionNav text 
    nextText: '<i class="fa fa-angle-right"></i>',  // Next directionNav text 
    randomStart: false,               // Start on a random slide 
    beforeChange: function(){},       // Triggers before a slide transition 
    afterChange: function(){},        // Triggers after a slide transition 
    slideshowEnd: function(){},       // Triggers after all slides have been shown 
    lastSlide: function(){},          // Triggers when last slide is shown 
    afterLoad: function(){}           // Triggers when slider has loaded 
});	

/*----------------------------
 wow js active
------------------------------ */
 new WOW().init();

/*----------------------------
 tab-active
------------------------------ */  
  $(".tab-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 5,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });
  
/*----------------------------
 tab-active2
------------------------------ */  
  $(".tab-active2").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,3],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });  
  
/*----------------------------
 protofolio-active
------------------------------ */  
  $(".protofolio-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,	  
      items : 3,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,3],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
   
/*----------------------------
related-products-active
------------------------------ */  
  $(".related-products-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:true,
	  navigation:false,	 
	  autoHeight: false, 
      items : 5,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,3],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
 
/*----------------------------
 brand-active
------------------------------ */  
  $(".brand-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,
	  lazyLoad : true,
      items : 6,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<a class='prev' data-toggle='tooltip'>&nbsp;</a>","<a class='next' data-toggle='tooltip'>&nbsp;</a>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,4],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });

 /*----------------------------
 brand-active
------------------------------ */  
  $("#section-blog").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:true,
	  lazyLoad : true,
      items : 8,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,4],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
/*----------------------------
 banner slider
------------------------------ */ 
  var owl = $("#owl-slider-banner");
  owl.owlCarousel({
	  autoPlay: 10000,
      items : 1, 
      itemsDesktop : [992,1],
      itemsDesktopSmall : [768,1], 
      itemsTablet: [480,1], 
      itemsMobile : [320,1]
  });

/*----------------------------
 blog
------------------------------ */ 
var owl = $("#owl-blog");
  owl.owlCarousel({
      items : 4, 
      itemsDesktop : [992,3],
      itemsDesktopSmall : [768,2], 
      itemsTablet: [600,1], 
      itemsMobile : [320,1]
  });
  $(".next").click(function(){ owl.trigger('owl.next'); });
  $(".prev").click(function(){ owl.trigger('owl.prev'); });

/*----------------------------
 enlever le hidden du texte dans le header
------------------------------ */ 
$( ".slider-text" ).removeClass( "hidden" );

		
/*----------------------------
 product-active
------------------------------ */  
  $(".product-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:false,
	  navigation:false,	  
      items : 1,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });
      
/*----------------------------
 testmonial-active
------------------------------ */  
  $(".testmonial-active").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  pagination:true,
	  navigation:false,
      items : 1,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });
	
/*--------------------------
   chosen
---------------------------- */		
	var config = {
	'.chosen-select-deselect'  : {allow_single_deselect:true},
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
/*---------------------
	Category menu
--------------------- */
	$('#cate-toggle>ul>li.has-sub>a').append('<span class="holder"></span>');
	$('#cate-toggle li.has-sub').on('click', function () {
		var $that = $(this).find('a');
		var element = $that.parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp();
		} else if ($that.next().hasClass('category-sub')) {
			element.addClass('open');
			element.children('ul').slideDown();
		}
	})

	/*--------------------------
   Countdown
---------------------------- */	
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
        $this.html(event.strftime('<div class="cdown days"><span class="counting">%-D</span>days</div><div class="cdown hours"><span class="counting">%-H</span>hrs</div><div class="cdown minutes"><span class="counting">%M</span>mins</div><div class="cdown seconds"><span class="counting">%S</span>secs</div>'));
        });
    });
	
/* --------------------------------------------------------
   header-area
* -------------------------------------------------------*/ 	
	$('.btn_close').on('click',function(){
		$('.header_area').animate({left:'-199px'},500);
		$(this).hide();
		$('.btn_open').css('display','block');
	});
	
	$('.btn_open').on('click',function(){
		$('.header_area').animate({left:'0px'},500);
		$(this).hide();
		$('.btn_close').css('display','block');
	});

	
/*----------------------------
 price-slider active
 ------------------------------ */
	/*var max_price = $("#max_price").data("max-price");
	var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
	var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: max_price,
		values: [start_price, end_price],	
		slide: function( event, ui ) {
        },
        change: function (e, ui) {
            price_filter(ui.values[0], ui.values[1])
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
	});
	$("#amount").val("$" + start_price +
		" - $" + end_price);
	$('.show-price-start').append('<span>$'+start_price+'</span>');
    $('.show-price-end').append('<span>$'+end_price+'</span>');
*/
    
	$('#filter-by-price').on('click', function() {
		var max_price = $("#max_price").data("max-price");
        var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
        var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;
        if(start_price > end_price){
            $('.facet-content.content-price-filter.show-filter .error').css('display', 'block');
        }else{
            price_filter(start_price, end_price);
        }
    });

/*--------------------------
 scrollUp
---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 
	
/*--------------------------
 Zoom
---------------------------- */	
	$("#zoompro").elevateZoom({
		gallery : "gallery",
		galleryActiveClass: "active",
		zoomType: "inner",
		cursor: "crosshair"
	}); 	
/*----------------------------
 Instantiate MixItUp:
------------------------------ */
	$('#Container') .mixItUp();	

 /*----------------------------
 magnificPopup:
------------------------------ */	
	$('.magnify').magnificPopup({
	  type: 'image'
	});	
	
/* --------------------------------------------------------
   accordion
* -------------------------------------------------------*/ 
  $('.panel-heading a').on('click', function() {
    $('.panel-default').removeClass('actives');
    $(this).parents('.panel-default').addClass('actives');
  });	
  	
/* --------------------------------------------------------
   cart-plus-minus-button
* -------------------------------------------------------*/ 
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</i></div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	}); 
		
/* --------------------------------------------------------
   header-search2
* -------------------------------------------------------*/	
	$('.open').on('click',function(){
		$('.test ').toggleClass("show");
	});
	/*------language changes--------*/
/*	$('#language').change(function () {
		var language_code = $(this).val();
		var pathname = location.href;
		var url = pathname.split('/');
		url[3]=language_code;
		location.href = url.join('/');


		$.ajax({
			type: 'get',
			url: $('#language_form').attr('action'),
			data: "language="+$(this).val(),
			beforeSend: function () {
				$.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
			},
			success: function (response, status) {
				$.LoadingOverlay("hide");
				location.reload();
			}
		});

	});*/

	/*-----------language click----------------*/
	$('#language').click(function () {
		var language_code = $(this).val();
		var pathname = location.href;
		var url = pathname.split('/');
		url[3]=language_code;
		location.href = url.join('/');
	});

	$("#subscribe").on('click',function (e) {
		e.preventDefault();
		var form = $(this).parent('form');
		if($(this).parent('form').valid()){
			$.ajax({
				type: 'post',
				url: $(this).parent('form').attr('action'),
				data: $(this).parent('form').serialize(),
				beforeSend: function () {
					$.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
				},
				success: function (response, status) {
					form.get(0).reset();
					$.LoadingOverlay("hide");
					if(response.success){
						toastr.success(response.message);
					} else{
						toastr.error(response.message);
					}
				}
			});	
		}
	})

	/*---------------------------------------------
	Image-animation-hover
	---------------------------------------------*/
	$(".product-container").find('.product-img a img').off('hover');
	$(".product-container").on('mouseenter', '.product-img a img', function(){
	        $(this).parent().parent().next().find('a').css('color', '#f99759');
	        $(this).parent().parent().next().find('span').first().css('color', '#f7850c');
	});
	$(".product-container").on('mouseleave', '.product-img a img',  function() {
	      $(this).parent().parent().next().find('a').css('color',"#333");
	      $(this).parent().parent().next().find('span').first().css('color', '#333333');
	});

	/*------------------------------------------------
	Init autocomple header search
	------------------------------------------------*/
	$.ajax({
		url: 'autocomplete-product',
		type: 'GET',
		dataType: 'json',
		data: {category: 0},
	})
	.done(function(data) {
			var options = {
				data: data,
				getValue: 'product_name',
				template: {
					type: "description",
					fields: {
						description: "brand_name"
					}
				},
				list: {
					maxNumberOfElements: 6,	
					match: {
						enabled: true
					},
					onChooseEvent: function(){
						$('#form-search').submit();
					}
				}
			};
		$("#search-input").easyAutocomplete(options);
		$(".easy-autocomplete").css('width', 'auto');
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	/*------------------------------------------------
	Change autocomple header search
	------------------------------------------------*/
	$("#selected-category").on('change', function(){
		$('#search-input').val("");
		$.ajax({
			url: 'autocomplete-product',
			type: 'GET',
			dataType: 'json',
			data: {category: $('#selected-category').val()},
		})
		.done(function(data) {
			var options = {
				data: data,
				getValue: 'product_name',
				template: {
					type: "description",
					fields: {
						description: "brand_name"
					}
				},
				list: {
					maxNumberOfElements: 6,	
					match: {
						enabled: true
					},
					onChooseEvent: function(){
						$('#form-search').submit();
					}
				}
			};
			$("#search-input").easyAutocomplete(options);
			$(".easy-autocomplete").css('width', 'auto');
			console.log(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		
	});

	$("#show_popup_login_auth").trigger('click');
	
	$('.receive-notification').click(function(e){
		e.preventDefault();
		if($('.receive-notification i').hasClass('fa-square-o')){
			$('.receive-notification i').removeClass('fa-square-o');
			$('.receive-notification i').addClass('fa-check-square');
		}else{
			$('.receive-notification i').removeClass('fa-check-square');
			$('.receive-notification i').addClass('fa-square-o');
		}
	});
	$('.receive-email').click(function(e){
		e.preventDefault();
		if($('.receive-email i').hasClass('fa-square-o')){
			$('.receive-email i').removeClass('fa-square-o');
			$('.receive-email i').addClass('fa-check-square');
		}else{
			$('.receive-email i').removeClass('fa-check-square');
			$('.receive-email i').addClass('fa-square-o');
		}
	});
	$('#Femme').click(function(e) {
		e.preventDefault();
		if ($('#Femme i').hasClass('fa-square-o')) {
			$('#Femme i').removeClass('fa-square-o');
			$('#Femme i').addClass('fa-check-square');
			$('#Homme i').removeClass('fa-check-square');
			$('#Homme i').addClass('fa-square-o');
			$('#civility').val('2');
		}
	});
	$('#Homme').click(function(e) {
		e.preventDefault();
		if ($('#Homme i').hasClass('fa-square-o')) {
			$('#Homme i').removeClass('fa-square-o');
			$('#Homme i').addClass('fa-check-square');
			$('#Femme i').removeClass('fa-check-square');
			$('#Femme i').addClass('fa-square-o');
			$('#civility').val('1');
		}
	});
		
	
})(jQuery); 