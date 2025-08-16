/*-----------------------------------------------------------------------------------

    Theme Name: Monity - CCTV & Security HTML Template
    Description: CCTV & Security HTML Template
    Author: Website Design Templates
    Version: 1.1
        
    ---------------------------------- */    

(function($) {

    "use strict";

    var $window = $(window);

        $("#preloader").fadeOut("normall",function(){$(this).remove()}),$window.on("scroll",function(){var o=$window.scrollTop(),r=$(".navbar-brand img"),a=$(".navbar-brand.logodefault img"),e=$(".navbar-brand.dark img");o<=50?($("header").removeClass("scrollHeader").addClass("fixedHeader"),r.attr("src","img/logos/logo-inner.png")):($("header").removeClass("fixedHeader").addClass("scrollHeader"),r.attr("src","img/logos/logo.png")),a.attr("src","img/logos/logo.png"),e.attr("src","img/logos/logo.png")});

        /*------------------------------------
            03. Scroll To Top
        --------------------------------------*/

        const scrollTopPercentage = ()=> {
            const scrollPercentage = () => {
                const scrollTopPos = document.documentElement.scrollTop;
                const calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollValue = Math.round((scrollTopPos / calcHeight) * 100);
                const scrollElementWrap = $(".scroll-top-percentage");

                scrollElementWrap.css("background", `conic-gradient( #fcaf17 ${scrollValue}%, #1158e7 ${scrollValue}%)`);

                if ( scrollTopPos > 100 ) {
                    scrollElementWrap.addClass("active");
                } else {
                    scrollElementWrap.removeClass("active");
                }

                if( scrollValue < 96 ) {
                    $("#scroll-value").text(`${scrollValue}%`);
                } else {
                    $("#scroll-value").html('<i class="fa-solid fa-angle-up"></i>');
                }
            }
            window.onscroll = scrollPercentage;
            window.onload = scrollPercentage;

            // Back to Top
            function scrollToTop() {
                document.documentElement.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            }

            $(".scroll-top-percentage").on("click", scrollToTop);
        }
        scrollTopPercentage();

        var pageSection=$(".parallax,.bg-img");pageSection.each(function(a){$(this).attr("data-background")&&$(this).css("background-image","url("+$(this).data("background")+")")}),$(".story-video").magnificPopup({delegate:".video",type:"iframe"}),$(".popup-social-video").magnificPopup({disableOn:700,type:"iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1}),$(".source-modal").magnificPopup({type:"inline",mainClass:"mfp-fade",removalDelay:160}),0!==$(".copy-clipboard").length&&(new ClipboardJS(".copy-clipboard"),$(".copy-clipboard").on("click",function(){var a=$(this);a.text();a.text("Copied"),setTimeout(function(){a.text("Copy")},2e3)}));var wow=new WOW({boxClass:"wow",animateClass:"animated",offset:0,mobile:!1,live:!0});wow.init();


    // === when document ready === //
    $(document).ready(function(){
    
        $(".service-slider").owlCarousel({center:!1,items:2,loop:!0,dots:!1,nav:!0,navText:["<i class='ti-arrow-left text-primary'></i>","<i class='ti-arrow-right text-primary'></i>"],margin:30,autoplay:!0,autoplayTimeout:5e3,smartSpeed:1500,responsive:{0:{items:1},768:{items:2},992:{items:3},1200:{items:4},1400:{items:4}}}),$(".service-carousel1").owlCarousel({center:!1,items:2,loop:!0,dots:!1,nav:!0,navText:["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],margin:28,autoplay:!0,autoplayTimeout:5e3,smartSpeed:1500,responsive:{0:{items:1},768:{items:2},992:{items:3},1399:{items:4},1599:{items:5}}}),$(".testimonial-style1").owlCarousel({loop:!0,responsiveClass:!0,nav:!1,navText:["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],dots:!1,margin:0,autoplay:!0,thumbs:!0,thumbsPrerendered:!0,autoplayTimeout:5e3,smartSpeed:800,responsive:{0:{items:1},600:{items:1},768:{items:1,nav:!0}}}),$(".testimonial-carousel1").owlCarousel({loop:!0,responsiveClass:!0,nav:!1,navText:["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],dots:!1,margin:20,autoplay:!0,thumbs:!0,thumbsPrerendered:!0,autoplayTimeout:5e3,smartSpeed:800,responsive:{0:{items:1,nav:!1},600:{items:1,nav:!1},1e3:{items:1}}}),$(".testimonial-carousel2").owlCarousel({loop:!0,responsiveClass:!0,nav:!1,navText:["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],dots:!1,margin:30,autoplay:!0,autoplayTimeout:5e3,smartSpeed:800,responsive:{0:{items:1},992:{items:2},1e3:{items:2}}}),$(".testimonial-carousel4").owlCarousel({loop:!0,responsiveClass:!0,nav:!1,dots:!1,margin:40,autoplay:!0,thumbs:!0,thumbsPrerendered:!0,autoplayTimeout:5e3,smartSpeed:1500,items:1}),$(".portfolio-carousel-one").owlCarousel({loop:!0,responsiveClass:!0,autoplay:!0,center:!1,autoplayTimeout:5e3,smartSpeed:1500,nav:!1,dots:!1,margin:30,responsive:{0:{items:1},767:{items:2},1199:{items:3},1599:{items:4}}}),$(".portfolio-carousel").owlCarousel({loop:!0,responsiveClass:!0,autoplay:!0,center:!1,autoplayTimeout:5e3,smartSpeed:1500,nav:!1,dots:!1,margin:30,responsive:{0:{items:1},767:{items:2},1199:{items:3},1599:{items:4}}}),$(".portfolio-carousel-02").owlCarousel({loop:!0,responsiveClass:!0,autoplay:!0,center:!1,autoplayTimeout:5e3,smartSpeed:1500,nav:!0,navText:["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],dots:!1,margin:30,responsive:{0:{items:1,nav:!1},768:{items:2},992:{items:3},1200:{items:3}}}),$(".client-style1").owlCarousel({loop:!0,nav:!1,dots:!1,autoplay:!0,smartSpeed:1500,autoplayTimeout:12e3,responsiveClass:!0,autoplayHoverPause:!1,responsive:{0:{items:1,margin:30},481:{items:2,margin:15},576:{items:3,margin:30},992:{items:4,margin:40},1200:{items:5,margin:60},1600:{items:7,margin:80}}}),$(".team-carousel").owlCarousel({center:!1,items:2,loop:!0,dots:!1,margin:30,autoplay:!0,autoplayTimeout:5e3,smartSpeed:1500,responsive:{0:{items:1},768:{items:2,center:!1},1200:{items:2,center:!1},1399:{items:2}}}),$(".slider-fade1").owlCarousel({items:1,loop:!0,dots:!1,margin:0,nav:!0,navText:["<i class='ti-arrow-left text-secondary'></i>","<i class='ti-arrow-right text-secondary'></i>"],autoplay:!0,smartSpeed:1500,mouseDrag:!1,animateIn:"fadeIn",animateOut:"fadeOut",responsive:{992:{nav:!1,dots:!0}}}),$(".slider-fade2").owlCarousel({items:1,loop:!0,dots:!0,margin:0,nav:!1,navText:["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],autoplay:!0,autoplayTimeout:6e3,smartSpeed:1500,animateIn:"fadeIn",animateOut:"fadeOut",responsive:{992:{nav:!0,dots:!1}}}),$(".slider-fade3").owlCarousel({items:1,loop:!0,dots:!0,margin:0,nav:!1,navText:["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],autoplay:!0,autoplayTimeout:6e3,smartSpeed:1500,mouseDrag:!1,animateIn:"fadeIn",animateOut:"fadeOut",responsive:{992:{nav:!0,dots:!1}}}),$(".owl-carousel").owlCarousel({items:1,loop:!0,dots:!1,margin:0,autoplay:!0,smartSpeed:500});var owl=$(".slider-fade1");owl.on("changed.owl.carousel",function(e){e=e.item.index-2;$("span").removeClass("animated fadeInUp"),$("h1").removeClass("animated fadeInUp"),$("p").removeClass("animated fadeInUp"),$("a").removeClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("span").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("p").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("a").addClass("animated fadeInUp")}),(owl=$(".slider-fade3")).on("changed.owl.carousel",function(e){e=e.item.index-2;$("span").removeClass("animated fadeInUp"),$("h1").removeClass("animated fadeInUp"),$("a").removeClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("span").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),$(".owl-item").not(".cloned").eq(e).find("a").addClass("animated fadeInUp")}),$(".countdown").countdown({date:"01 Jun 2027 00:01:00",format:"on"}),$(".current-year").text((new Date).getFullYear()),$(".odometer").waypoint(function(e){"down"===e&&(e=$(this.element).attr("data-count"),$(this.element).html(e))},{offset:"80%"});
      
    });

    // === when window loading === //
    $window.on("load", function() {

        $(".portfolio-gallery").lightGallery(),$(".portfolio-link").on("click",o=>{o.stopPropagation()});
    
    });

})(jQuery);