/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

 jQuery(function ($) {

    // ************    START Helix 1.4 JS    ************** //
    // **************************************************** //

    //Default
    if (typeof sp_offanimation === 'undefined' || sp_offanimation === '') {
        sp_offanimation = 'default';
    }

    if (sp_offanimation == 'default') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('offcanvas');
        });

        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('offcanvas');
        });
    }

    // Slide Top Menu
    if (sp_offanimation == 'slidetop') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('slide-top-menu');
        });

        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('slide-top-menu');
        });
    }

    //Full Screen
    if (sp_offanimation == 'fullscreen') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('full-screen-off-canvas');
        });
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('full-screen');
        });
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('full-screen-off-canvas');
        });
    }

    //Full screen from top
    if (sp_offanimation == 'fullScreen-top') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('full-screen-off-canvas-ftop');
        });
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('full-screen-ftop');
        });
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('full-screen-off-canvas-ftop');
        });
    }

    // if ($(window).width() < 480) {
    //     $('#offcanvas-toggler').click(function(){
    //         $('body').addClass('offcanvas');
    //     });
    // }
    
    //button reviews
    $('.reviews_button').click(function(event){
        var tabTop=$(".tab-product").offset().top;
        $("html, body").animate({scrollTop:tabTop},1000);
        $('a[href=\'#reviews\']').trigger('click'); return false;
    });
    
    //Dark with plus
    if (sp_offanimation == 'drarkplus') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('new-look-off-canvas');
        });
        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('new-look');
        });
        $('.close-offcanvas,.offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('new-look-off-canvas');
        });
    }

    // if sticky header
    // if ($("body.sticky-header").length > 0) {
    //     var fixedSection = $('#sp-header');
    //     // sticky nav
    //     var headerHeight = fixedSection.outerHeight();
    //     var stickyNavTop = fixedSection.offset().top;
    //     fixedSection.addClass('animated');
    //     fixedSection.before('<div class="nav-placeholder"></div>');
    //     $('.nav-placeholder').height('inherit');
    //     //add class
    //     fixedSection.addClass('menu-fixed-out');
    //     var stickyNav = function () {
    //         var scrollTop = $(window).scrollTop();
    //         if (scrollTop > stickyNavTop) {
    //             fixedSection.removeClass('menu-fixed-out').addClass('menu-fixed');
    //             $('.nav-placeholder').height(headerHeight);
    //         } else {
    //             if (fixedSection.hasClass('menu-fixed')) {
    //                 fixedSection.removeClass('menu-fixed').addClass('menu-fixed-out');
    //                 $('.nav-placeholder').height('inherit');
    //             }
    //         }
    //     };
    //     stickyNav();
    //     $(window).scroll(function () {
    //         stickyNav();
    //     });
    // }
    // go to top
    if (typeof sp_gotop === 'undefined') {
        sp_gotop = '';
    }

    if (sp_gotop) {
        // go to top
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut(400);
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    } // has go to top

    // Preloader
    if (typeof sp_preloader === 'undefined') {
        sp_preloader = '';
    }

    if (sp_preloader) {
        $(window).on('load', function () {
            if ($('.sp-loader-with-logo').length > 0) {
                move();
            }
            setTimeout(function () {
                $('.sp-pre-loader').fadeOut();
            }, 1000);
        });
    } // has preloader
    //preloader Function
    function move() {
        var elem = document.getElementById("line-load");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
            }
        }
    }
    // ************    END:: Helix 1.4 JS    ************** //
    // **************************************************** //

    // **************   START Mega SCRIPT   *************** //
    // **************************************************** //

    //mega menu
    $('.sp-megamenu-wrapper').parent().parent().css('position', 'static').parent().css('position', 'relative');
    $('.sp-menu-full').each(function () {
        $(this).parent().addClass('menu-justify');
    });
    
    // boxlayout
    if ($("body.layout-boxed").length > 0) {
        var windowWidth = $('#sp-header').parent().outerWidth();
        $("#sp-header").css({"max-width": windowWidth, "left": "auto"});
    }

    // **************   END:: Mega SCRIPT   *************** //
    // **************************************************** //

    // **************  START Others SCRIPT  *************** //
    // **************************************************** //

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Article Ajax voting
    $(document).on('click', '.sp-rating .star', function (event) {
        event.preventDefault();

        var data = {
            'action': 'voting',
            'user_rating': $(this).data('number'),
            'id': $(this).closest('.post_rating').attr('id')
        };

        var request = {
            'option': 'com_ajax',
            'plugin': 'helix3',
            'data': data,
            'format': 'json'
        };

        $.ajax({
            type: 'POST',
            data: request,
            beforeSend: function () {
                $('.post_rating .ajax-loader').show();
            },
            success: function (response) {
                var data = $.parseJSON(response.data);

                $('.post_rating .ajax-loader').hide();

                if (data.status == 'invalid') {
                    $('.post_rating .voting-result').text('You have already rated this entry!').fadeIn('fast');
                } else if (data.status == 'false') {
                    $('.post_rating .voting-result').text('Somethings wrong here, try again!').fadeIn('fast');
                } else if (data.status == 'true') {
                    var rate = data.action;
                    $('.voting-symbol').find('.star').each(function (i) {
                        if (i < rate) {
                            $(".star").eq(-(i + 1)).addClass('active');
                        }
                    });

                    $('.post_rating .voting-result').text('Thank You!').fadeIn('fast');
                }

            },
            error: function () {
                $('.post_rating .ajax-loader').hide();
                $('.post_rating .voting-result').text('Failed to rate, try again!').fadeIn('fast');
            }
        });
    });

    // **************  END:: Others SCRIPT  *************** //
    // **************************************************** //
    if($(window).width() >= 1200 ) {
        $('.yt-gmap').css('pointer-events', 'none');

        $('.maps').on('click', function () {
            $('.maps .yt-gmap').css("pointer-events", "auto");
        });

        $( ".maps" ).on('mouseleave', function() {
            $('.maps .yt-gmap').css("pointer-events", "none"); 
        });
    }

    $('#btn-search').on('click', function() {
        if($('.search .popup-search').hasClass('open')) {
            $('.search .popup-search').removeClass('open').fadeOut(300);
            $
        } else {
            $('.search .popup-search').addClass('open').fadeIn(300);
        }
    });
    $('.btn-close').on('click', function() {
        $('.search .popup-search').removeClass('open').fadeOut(300);
    });

    $('a.btn-share-social').attr('href','javascript:void(0);');
    $('.btn-share-social').on('click', function() {
        if($('#socialShare').hasClass('open')) {
            $('#socialShare').removeClass('open');
        } else {
            $('#socialShare').addClass('open');
        }
    });

    $('#btn-search-mobile').on('click', function() {
        if($('#search-top-bar .form-search').hasClass('open')) {
            $('#search-top-bar .form-search').removeClass('open').slideUp(300);
        } else {
            $('#search-top-bar .form-search').addClass('open').slideDown(300);
        }
    });


    /*Embed an SVG and change its color */
    jQuery('img.sppb-img-responsive').each(function(){
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');

      jQuery.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
			if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
				$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
			}

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');

  });
    if( $(window).width() >= 1200 ) {
        var $height = $('.pricing_tab .main_pricing_tab').height();
        $('.pricing_tab .content_pricing_tab .main_pricing_tab li').css('height', $height);
    }

    var $height_video = $('.sj-videobox .sj-video-current iframe').height();
    $('.sj-videobox .sj-video-list').css('height', $height_video);


        //Enable swiping...
   /* $(".sppb-carousel-inner").swipe( {
    //Generic swipe handler for all directions
    swipeLeft:function(event, direction, distance, duration, fingerCount) {

        $(this).parent().sppbcarousel('next');
    },
    swipeRight: function() {
        $(this).parent().sppbcarousel('prev');
    },
    //Default is 75px, set to 0 for demo so any distance triggers swipe
    threshold:0
});*/


    // Slideshow disaper and conflict with motools
    var carousel = jQuery('.carousel');
    if(carousel){
        if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {
            Element.implement({
                slide: function(how, mode){
                    return this;
                }
            });
        }
    }

    if ($(window).width() > 991 && $(window).width() < 1199 && $('.menu-vertical').length > 0) {
        var btn = $('.menu-vertical .sp-module-title');
        var ul = $('.menu-vertical .sp-module-content');
        var overlay = $('.offcanvas-overlay');
        btn.click(function(){
            ul.stop().slideToggle(500);
            overlay.addClass("show");
            if (overlay.hasClass("show")) {
                overlay.click(function(){
                    ul.slideUp(500);
                    overlay.removeClass("show");
                });
            }
        });
    }

    else if ($(window).width() < 991 && $('.menu-vertical').length > 0){
        var ul = $('.menu-vertical .sp-module-content');
        ul.prepend('<span class="close-menu-vertical"><i class="fa fa-times"> </i> </span>');
        var fm_button = ul.find('.fm-button');
        fm_button.each(function(){
            if ($(this).children('img').length > 0) {
                $(this).prepend('<i class="fa fa-angle-down" aria-hidden="true"></i>');
            }
        });
        var btn = $('.menu-vertical .sp-module-title');
        var overlay = $('.offcanvas-overlay');
        var close_btn = $('.close-menu-vertical');
        btn.click(function(){
            ul.toggleClass("active");
            overlay.addClass("show");
            if (overlay.hasClass("show") && ul.hasClass("active")) {
                overlay.click(function(){
                    ul.removeClass("active");
                    overlay.removeClass("show");
                    fm_button.each(function(){
                        $(this).children('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                    });
                });
                close_btn.click(function(){
                    ul.removeClass("active");
                    overlay.removeClass("show");
                    fm_button.each(function(){
                        $(this).children('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                    });
                });
            }
        });
    }

    if ($('.menu-vertical').length > 0 && $(window).width() < 991) {
        var nav = $('.menu-vertical .sj-flat-menu');
        var btn = nav.find("li .fm-button");
        btn.each(function(){
            $(this).click(function(){
                var ul = $(this).parent().parent().children(".fm-container");
                ul.slideToggle(500);
                $(this).children('i').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
            });
        });
    }

    if ($(window).width() < 991 && $('.box-footer .footer-block-title').length > 0) {
        var title = $('.box-footer .footer-block-title');
        title.each(function(){
            $(this).append('<span class="expander"><i class="fa fa-plus" aria-hidden="true"></i></span>');
        });
        var btn = $('.box-footer .footer-block-title').children('.expander');
        btn.each(function(){
            $(this).click(function(){
                var dropdown = $(this).parents('.box-footer').children('.sp-module-content');
                dropdown.stop().slideToggle(500);
                $(this).children('i').toggleClass("fa-plus").toggleClass('fa-minus');
            });
        });
    }

    if($('.open-sidebar').length > 0 && $(window).width() < 991){
        var btn_open = $('.open-sidebar');
        var sidebar_ = $('#sp-left');
        var overlay = $('.offcanvas-overlay');
        sidebar_.prepend('<span class="close-sidebar"><i class="fa fa-times"> </i> </span>');
        var btn_close = $('#sp-left .close-sidebar');
        btn_open.click(function(){
            sidebar_.toggleClass('active');
            overlay.toggleClass('show');
        });

        btn_close.click(function(){
            sidebar_.toggleClass("active");
            overlay.toggleClass("show");
        });

        if ($(sidebar_).hasClass('active')) {
            overlay.click(function(){
                sidebar_.removeClass("active");
                overlay.removeClass("show");
            });
            close_btn.click(function(){
                sidebar_.removeClass("active");
                overlay.removeClass("show");
            });
        }
    }

    if ($('.minicart-header').length > 0 && $('.vm_cart_products').length > 0) {
        $('.minicart-header').hover(function(){
            $('.minicart-header').toggleClass('open');
        })
    }

});
