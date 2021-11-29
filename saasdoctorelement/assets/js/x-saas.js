(function ($) {
    "use strict";

    var SaaSGlobal = function ($scope, $) {

        // Js Start
        $('[data-background]').each(function () {
            $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
        });

        if ($('.wow').length) {
            new WOW({
                offset: 100,
                mobile: true
            }).init()
        }

        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() > 250) {
                jQuery('.saasdoctor-sticky-header').addClass('sticky-on')
            } else {
                jQuery('.saasdoctor-sticky-header').removeClass('sticky-on')
            }
        });

        $(".saasdoctor-icon-lightbox a").magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src',
            }
        });

        if ($('.saasdoctor-icon-back-btn').length) {
            $(".saasdoctor-icon-back-btn .elementor-icon").attr("onclick", "window.history.back();");
        }

        // Js End

    };

    var CDNavMenu = function ($scope, $) {

        $scope.find('.saasdoctor-nav-builder').each(function () {
            var settings = $(this).data('saas');

            // Js Start
            $('.str-open_mobile_menu').on("click", function () {
                $('.str-mobile_menu_wrap').toggleClass("mobile_menu_on");
            });
            $('.str-open_mobile_menu').on('click', function () {
                $('body').toggleClass('mobile_menu_overlay_on');
            });
            if ($('.str-mobile_menu li.dropdown ul').length) {
                $('.str-mobile_menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
                $('.str-mobile_menu li.dropdown .dropdown-btn').on('click', function () {
                    $(this).prev('ul').slideToggle(500);
                });
            }
            // Js End
        });

    };

    var SaaSTestimonial = function ($scope, $) {

        $scope.find('.saas-testimonial-section').each(function () {
            var settings = $(this).data('saas');
            // Js Start
            var swiper = new Swiper(".testimonial-slider-loop", {
                slidesPerView: 3,
                spaceBetween: 30,
                slidesPerGroup: 3,
                loop: true,
                loopFillGroupWithBlank: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                },
                breakpoints: {
                    375: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
            // $('.testimonial-slider-loop').owlCarousel({
            //     loop:true,
            //     margin:30,
            //     nav:true,
            //     smartSpeed: 500,
            //     autoplay: 6000,
            //     navText: [ ' ', '<i class="fas fa-arrow-right"></i>' ],
            //     responsive:{
            //         0:{
            //             items:1
            //         },
            //         600:{
            //             items:2
            //         },
            //         800:{
            //             items:2
            //         },
            //         1024:{
            //             items:3
            //         },
            //         1200:{
            //             items:3
            //         },
            //         1500:{
            //             items:3
            //         }
            //     }
            // });
            // Js End
        });

    };

    var SaaSListing = function ($scope, $) {

        $scope.find('.saas-listing-section').each(function () {
            var settings = $(this).data('saas');
            // Js Start
            var swiper = new Swiper(".related-listing-slider-loop", {
                slidesPerView: 3,
                spaceBetween: 30,
                slidesPerGroup: 3,
                loop: true,
                loopFillGroupWithBlank: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                },
                breakpoints: {
                    375: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
            // Js End
        });

    };

    var SaaSHero = function ($scope, $) {

        $scope.find('.saas-hero-section').each(function () {
            var settings = $(this).data('saas');
            // Js Start
            $(".hero-content-inner").mousemove(function (e) {
                handleMouseMove(e);
            });

            function handleMouseMove(event) {

                var x = event.pageX;
                var y = event.pageY;

                $(".hero-video").animate({
                    left: x,
                    top: y
                }, 1);
            }

            // Js End
        });

    };

    var SaaSGallery = function ($scope, $) {

        $scope.find('.saas-post-gallery').each(function () {
            var settings = $(this).data('saas');
            // Js Start
            $('.saas-post-gallery').magnificPopup({
                type: 'image',
                delegate: 'a',
                mainClass: 'gallery-item-saas',
                tLoading: 'Loading image #%curr%...',
                gallery:{
                    enabled:true,
                    navigateByImgClick: true,
                    preload: [0,1]
                }
            });


            // Js End
        });

    };


    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            console.log('Elementor editor mod loaded');
            elementorFrontend.hooks.addAction('frontend/element_ready/global', SaaSGlobal);
            elementorFrontend.hooks.addAction('frontend/element_ready/nav-builder.default', CDNavMenu);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-leader.default', SaaSTestimonial);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-listing.default', SaaSListing);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-gallery.default', SaaSGallery);
            //elementorFrontend.hooks.addAction('frontend/element_ready/saas-hero.default', SaaSHero);
        } else {
            console.log('Elementor frontend mod loaded');
            elementorFrontend.hooks.addAction('frontend/element_ready/global', SaaSGlobal);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-leader.default', SaaSTestimonial);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-listing.default', SaaSListing);
            elementorFrontend.hooks.addAction('frontend/element_ready/saas-gallery.default', SaaSGallery);
            //elementorFrontend.hooks.addAction('frontend/element_ready/saas-hero.default', SaaSHero);
        }
    });
    console.log('addon js loaded');
})(jQuery);
