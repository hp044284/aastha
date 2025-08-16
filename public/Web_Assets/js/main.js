(function ($) {
	"use strict";

	var windowOn = $(window);
	// 01. PreLoader Js
	windowOn.on('load', function () {
		$("#loading").fadeOut(500);
	});
	// 02. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "1199",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

	// 03. Sidebar Js
	$(".tp-menu-toggle").on("click", function () {
		$(".tp-sidebar-menu").addClass("sidebar-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".sidebar-close").on("click", function () {
		$(".tp-sidebar-menu").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});

	$(".body-overlay").on("click", function () {
		$(".tp-sidebar-menu").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});


	// 04. Body overlay Js
	$(".body-overlay").on("click", function () {
		$(".offcanvas__area").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});

	// 05. Search Js
	$(".search-toggle").on("click", function () {
		$(".search__area").addClass("opened");
	});
	$(".search-close-btn").on("click", function () {
		$(".search__area").removeClass("opened");
	});

	// 06. Sticky Header Js
	windowOn.on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 50) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});


	// 07. Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	// 08. Nice Select Js
	$('select').niceSelect();


	//09. Home-1-Slider js
	$('.slider-active').slick({
		fade:true,
		slidesToShow: 1,
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-left-arrow"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
				}
			}
		]
	});

	$('.slider-active-3').slick({
		slidesToShow: 1,
		fade:true,
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="far fa-long-arrow-right"></i></button>',
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
				}
			}
		]
	});
	$('.blog-slider-active').slick({
		slidesToShow: 1,
		fade:false,
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="far fa-long-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="far fa-long-arrow-right"></i></button>',
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
				}
			}
		]
	});
	
	//10. Service-slider Js
	$('.service-tab-slider-active').slick({
		slidesToShow: 5,
		arrows: true,
		autoplay:true,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
				}
			}
		]
	});

	//11. Team slider Js
    $('.team-slider-active').slick({
		slidesToShow: 4,
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="far fa-long-arrow-alt-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="far fa-long-arrow-alt-right"></i></button>',
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					arrows: false,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});

    //12. Project-slider Js
	$('.tp-project-active').slick({
		dots: true,
		centerMode: true,
		centerPadding: '500px',
		slidesToShow: 1,
		arrows: false,
		responsive: [
			{
				breakpoint: 1600,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '350px',
					slidesToShow: 1
				}
			},
			{
				breakpoint: 1200,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '200px',
					slidesToShow: 1
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '150px',
					slidesToShow: 1
				}
			},
			{
				breakpoint: 778,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '0px',
					slidesToShow: 1
				}
			}
		]
	});

	//13. Testimonial-slider Js
	$('.tp-testimonial-active').slick({
		slidesToShow: 3,
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev"><i class="far fa-long-arrow-alt-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="far fa-long-arrow-alt-right"></i></button>',
		appendArrows: $(".tp-test-arrow"),
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 767,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});

    //14. Brand-slider Js
	$('.tp-brand-active').slick({
		slidesToShow:5,
		arrows: false,
		autoplay:true,
		Infinity:true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					arrows: false,
					slidesToShow: 4
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});

	//15. Shop-slider Js
	$('.shop-details-active').slick({
		slidesToShow:4,
		arrows: true,
		autoplay:false,
		prevArrow: '<button type="button" class="slick-prev"><i class="far fa-long-arrow-alt-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="far fa-long-arrow-alt-right"></i></button>',
		appendArrows: $(".tp-test-arrow"),
		Infinity:true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					arrows: false,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});

	//16. Gallary-slider Js
	$('.gallary-slider-active').slick({
		slidesToShow:4,
		arrows: false,
		autoplay:true,
		Infinity:true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					arrows: false,
					slidesToShow: 4
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});

	//17. MagnificPopup image view Js
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	 //18. MagnificPopup video view Js
	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	// 19. Cart Quantity Js
	$('.cart-minus').click(function () {
		var $input = $(this).parent().find('input');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$('.cart-plus').click(function () {
		var $input = $(this).parent().find('input');
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});

	// 20. Show Login Toggle Js
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});

	// 21. Counter Js
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});
	
	//22. Search form Js
	$(".tp-h-search").on("click", function () {
		$(".search-form").toggleClass("header_search-open");
		$(".tp-h-search").toggleClass("opened");
	});
	$("body > *:not(header)").on("click", function () {
		$(".search-form").removeClass("header_search-open");
		$(".tp-h-search").removeClass("opened");
	});
	
	//23.isotope
	$('.grid').imagesLoaded(function () {
		// init Isotope
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				// use outer width of grid-sizer for columnWidth
				columnWidth: '.grid-item',
			}
		});


		// filter items on button click
		$('.masonary-menu').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
		});

		//for menu active class
		$('.masonary-menu button').on('click', function (event) {
			$(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
			event.preventDefault();
		});

	});


})(jQuery);