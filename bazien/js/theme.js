jQuery(document).foundation({
    offcanvas : {
        // Sets method in which offcanvas opens.
        // [ move | overlap_single | overlap ]
        open_method: 'move',
        // Should the menu close when a menu link is clicked?
        // [ true | false ]
        close_on_click : true
    }
});
jQuery(document).ready(function ($) {

	"use strict";
    var window_width = $(window).innerWidth();
    var scrollbar_width = window_width-$(window).width();
    var rtl = false;

    //Custom Mega menu
    function megamenu_popupwidth() {
        var winWidth = $(window).width() + scrollbar_width;
        var container_width= $('.mega-menu').closest('.columns').width();

        if (winWidth >= container_width)
            return container_width;
        if (winWidth >= 992)
            return 940;
        if (winWidth >= 768)
            return 710;
        return $(window).width() - 30;

    }
    function nova_mega_menu() {
        var $menu = $('.mega-menu');
        var hoverIntentConfig = {
            sensitivity: 2,
                interval: 0,
                timeout: 0
        };
        $menu.each( function() {
            var $menu = $(this);
            var $menu_container = $menu.closest('.columns');
            var container_width = megamenu_popupwidth();
            var offset = 0;
            if ($menu_container.length) {
                if (rtl) {
                    offset = ($menu_container.offset().left + $menu_container.width()) - ($menu.offset().left + $menu.width()) + parseInt($menu_container.css('padding-right'));
                } else {
                    offset = $menu.offset().left - $menu_container.offset().left - parseInt($menu_container.css('padding-left'));
                }
                offset = (offset == 1) ? 0 : offset;
            }

            var $menu_items = $menu.find('> li');

            $menu_items.each( function() {
                var $menu_item = $(this);
                var $popup = $menu_item.find('> .popup');
                if ($popup.length > 0) {
                    $popup.css('display', 'block');
                    if ($menu_item.hasClass('wide')) {
                        $popup.css('left', 0);
                        var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                            parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                        var row_number;

                        if ($menu_item.hasClass('col-2')) row_number = 2;
                        if ($menu_item.hasClass('col-3')) row_number = 3;
                        if ($menu_item.hasClass('col-4')) row_number = 4;
                        if ($menu_item.hasClass('col-5')) row_number = 5;
                        if ($menu_item.hasClass('col-6')) row_number = 6;

                        if ($(window).width() < 992 - scrollbar_width)
                            row_number = 1;

                        var col_length = 0;

                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseInt($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;

                            if (cols > row_number)
                                cols = row_number;

                            col_length += cols;
                        });

                        if (col_length > row_number) col_length = row_number;

                        var col_width = container_width / row_number;

                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseFloat($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;

                            if (cols > row_number)
                                cols = row_number;

                            if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                $(this).css('width', (100 / col_length * cols) + '%');
                            else
                                $(this).css('width', (100 / row_number * cols) + '%');

                        });

                        if ($menu_item.hasClass('pos-center')) { // position center
                            $popup.find('> .inner > ul').width(col_width * col_length - padding);
                            var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                            $popup.css({
                                'left': -left_position
                            });
                        } else if ($menu_item.hasClass('pos-left')) { // position left
                            $popup.find('> .inner > ul').width(col_width * col_length - padding);
                            $popup.css({
                                'left': 0
                            });
                        } else if ($menu_item.hasClass('pos-right')) { // position right
                            $popup.find('> .inner > ul').width(col_width * col_length - padding);
                            $popup.css({
                                'left': 'auto',
                                'right': 0
                            });
                        } else { // position justify

                            $popup.find('> .inner > ul').width(container_width - padding);

                            if (rtl) {
                                $popup.css({
                                    'right': 0,
                                    'left': 'auto'
                                });
                                var right_position = ($popup.offset().left + $popup.width()) - ($menu.offset().left + $menu.width()) - offset;
                                $popup.css({
                                    'right': right_position,
                                    'left': 'auto'
                                });
                            } else {
                                $popup.css({
                                    'left': 0,
                                    'right': 'auto'
                                });
                                var left_position = $popup.offset().left - $menu.offset().left + offset;
                                $popup.css({
                                    'left': -left_position,
                                    'right': 'auto'
                                });
                            }
                        }
                    }
                    $popup.css('display', 'none');

                    $menu_item.hoverIntent(
                        $.extend({}, hoverIntentConfig, {
                            over: function(){
                                $menu_items.find('.popup').hide();
                                $popup.show();
                            },
                            out: function(){
                                $popup.hide();
                            }
                        })
                    );
                }
            });
        });
    }
    nova_mega_menu();

    //Custom Sidebar menu
    function sidebar_popupwidth() {
        var winWidth = $(window).width() + scrollbar_width;
        var container_width= $('.site-content').find('.columns').width();
        if (winWidth >= container_width)
            return container_width-310;
        if (winWidth >= 992)
            return 940;
        if (winWidth >= 768)
            return 710;
        return $(window).width() - 30;
    }
    function nova_sidebar_menu() {
        var $menu = $('.sidebar-menu');
        var is_right_sidebar = false;
        var hoverIntentConfig = {
            sensitivity: 2,
            interval: 0,
            timeout: 0
        };
        $menu.each( function() {
            var $menu = $(this);
            var $menu_container = $menu.closest('.sidebar-navigation');
            var container_width;
            if ($(window).width() < 992 - scrollbar_width)
                container_width = sidebar_popupwidth();
            else
                container_width = sidebar_popupwidth() - $menu.width() - 45;

            var $menu_items = $menu.find('> li');

            $menu_items.each( function() {
                var $menu_item = $(this);
                var $popup = $menu_item.find('> .popup');
                if ($popup.length > 0) {
                    $popup.css('display', 'block');
                    if ($menu_item.hasClass('wide')) {
                        $popup.css('left', 0);
                        var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                            parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                        var row_number;

                        if ($menu_item.hasClass('col-2')) row_number = 2;
                        if ($menu_item.hasClass('col-3')) row_number = 3;
                        if ($menu_item.hasClass('col-4')) row_number = 4;
                        if ($menu_item.hasClass('col-5')) row_number = 5;
                        if ($menu_item.hasClass('col-6')) row_number = 6;

                        if ($(window).width() < 992 - scrollbar_width)
                            row_number = 1;

                        var col_length = 0;
                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseInt($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;

                            if (cols > row_number)
                                cols = row_number;

                            col_length += cols;
                        });

                        if (col_length > row_number) col_length = row_number;

                        var col_width = container_width / row_number;

                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseFloat($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;

                            if (cols > row_number)
                                cols = row_number;

                            if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                $(this).css('width', (100 / col_length * cols) + '%');
                            else
                                $(this).css('width', (100 / row_number * cols) + '%');
                        });

                        $popup.find('> .inner > ul').width(col_width * col_length + 1);
                        if (is_right_sidebar) {
                            $popup.css({
                                'left': 'auto',
                                'right': $(this).width()
                            });
                        } else {
                            $popup.css({
                                'left': $(this).width(),
                                'right': 'auto'
                            });
                        }
                    }
                    $popup.css('display', 'none');

                    $menu_item.hoverIntent(
                        $.extend({}, hoverIntentConfig, {
                            over: function(){
                                $menu_items.find('.popup').hide();
                                $popup.show();
                                $popup.parent().addClass('open');
                            },
                            out: function(){
                                $popup.hide();
                                $popup.parent().removeClass('open');
                            }
                        })
                    );
                }
            });
        });
    }
    nova_sidebar_menu();

    //mobile menu
    $(".mobile-navigation .menu-item-has-children").append('<div class="more"><i class="fa fa-plus-circle"></i></div>');

    $(".mobile-navigation").on("click", ".more", function(e) {
        e.stopPropagation();

        $(this).parent().toggleClass("current")
            .children(".sub-menu").toggleClass("open");

        $(this).html($(this).html() == '<i class="fa fa-plus-circle"></i>' ? '<i class="fa fa-minus-circle"></i>' : '<i class="fa fa-plus-circle"></i>');
    });

    // Mini Cart
    jQuery('#mini-cart').hover(
        function () {
            jQuery(this).find('.dropdown-menu').fadeIn(100);

        },
        function () {
            jQuery(this).find('.dropdown-menu').fadeOut(100);
        }
    );

    // Woocomerce Tabs
    $('#woocomerce-tabs').easyResponsiveTabs({
        type: 'vertical', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: 'accordion', // Start closed if in accordion view
        tabidentify: 'hor_1', // The tab groups identifier
        inactive_bg: '#FFFFFF'
    });

	function button_hover() {
	    if(jQuery('.nova-button').length) {
	        jQuery('.nova-button').each(function() {

	            //hover background color
	            if(typeof jQuery(this).data('hover-background-color') !== 'undefined' && jQuery(this).data('hover-background-color') !== false) {
	                var hover_background_color = jQuery(this).data('hover-background-color');
	                var initial_background_color = jQuery(this).css('background-color');
	                jQuery(this).hover(
	                function() {
	                    jQuery(this).css('background-color', hover_background_color);
	                },
	                function() {
	                    jQuery(this).css('background-color', initial_background_color);
	                });
	            }

	            //hover border color
	            if(typeof jQuery(this).data('hover-border-color') !== 'undefined' && jQuery(this).data('hover-border-color') !== false) {
	                var hover_border_color = jQuery(this).data('hover-border-color');
	                var initial_border_color = jQuery(this).css('border-top-color');
	                jQuery(this).hover(
	                    function() {
	                        jQuery(this).css('border-color', hover_border_color);
	                    },
	                    function() {
	                        jQuery(this).css('border-color', initial_border_color);
	                    });
	            }

	            //hover color
	            if(typeof jQuery(this).data('hover-color') !== 'undefined' && jQuery(this).data('hover-color') !== false) {
	                var hover_color =jQuery(this).data('hover-color');
	                var initial_color = jQuery(this).css('color');
	                jQuery(this).hover(
	                    function() {
	                        jQuery(this).css('color', hover_color);
	                    },
	                    function() {
	                        jQuery(this).css('color', initial_color);
	                    });
	            }
	        });
	    }
	}
	button_hover();

    //product animation (thanks Sam Sehnert)
    $.fn.visible = function(partial) {

      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

    };

	// Add (+/-) Button Number Incrementers
	$(".button-qty").on("click", function() {
	  var $button = jQuery(this);
	  var oldValue = $button.parent().find("input").val();

	  if ($button.text() == "+") {
		  var newVal = parseFloat(oldValue) + 1;
		} else {
	   // Don't allow decrementing below zero
	    if (oldValue > 1) {
	      var newVal = parseFloat(oldValue) - 1;
	    } else {
	      newVal = 1;
	    }
	  }
	  $button.parent().find("input").val(newVal);

	});


	$("#related-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		pagination :false,
		navigation : true,
		navigationText : ["<a class=\"fa fa-angle-left\"></a>","<a class=\"fa fa-angle-right\"></a>"]
	});

	$("#cross-sell-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		navigation : true,
		navigationText : ["<a class=\"fa fa-angle-left\"></a>","<a class=\"fa fa-angle-right\"></a>"]
	});

	$("#upsells-products-carousel").owlCarousel({
		items:4,
		itemsDesktop : [1200,4],
		itemsDesktopSmall : [1000,3],
		itemsTablet: false,
		itemsMobile : [600,2],
		lazyLoad : true,
		navigation : true,
		navigationText : ["<a class=\"fa fa-angle-left\"></a>","<a class=\"fa fa-angle-right\"></a>"]
	});

	function replace_img_source(selector) {
		var data_src = $(selector).attr('data-src');
		$(selector).one('load', function() {
		}).each(function() {
			$(selector).attr('src', data_src);
			$(selector).css("opacity", "1");
		});
	}

	$('#products-grid li img').each(function(){
		replace_img_source(this);
	});

	$('.related.products:not(.owl-carousel) li img').each(function(){
		replace_img_source(this);
	});

	$('.upsells.products:not(.owl-carousel) li img').each(function(){
		replace_img_source(this);
	});

	$('.add_to_wishlist').on('click',function(){
		$(this).parents('.yith-wcwl-add-button').addClass('show_overlay');
	})

    // Remove list class in visual Composer
    if($(".wpb_wrapper .products").hasClass("list")){
        jQuery(".wpb_wrapper .products").addClass('grid').removeClass('list');
    }
    
    // Disable fresco
    function disable_fresco() {
		if ($(window).innerWidth() < 640 ) {
			$(".product_content_wrapper .fresco").on('click',function() {
					return false;
			});
		}
	}

    disable_fresco();


	//add fresco groups to images galleries
	$(".gallery").each(function() {

		var that = $(this);

		that.find('.gallery-item').each(function(){

			var this_gallery_item = $(this);

			this_gallery_item.find('.fresco').attr('data-fresco-group', that.attr('id'));

			if ( this_gallery_item.find('.gallery-caption').length > 0 ) {
				this_gallery_item.find('.fresco').attr('data-fresco-caption', this_gallery_item.find('.gallery-caption').text());
			}

		});

	});


	function handleSelect() {
		if ($(window).innerWidth() > 1023 ) {

			var select2 = $(".orderby, .big-select").select2({
				allowClear: true,
				minimumResultsForSearch: Infinity
			});

		}
	}

	handleSelect();


	//gallery caption

	$('.gallery-item').each(function(){

		var that = $(this);

		if ( that.find('.gallery-caption').length > 0 ) {
			that.append('<span class="gallery-caption-trigger">i</span>')
		}

	})

	$('.gallery-caption-trigger').on('mouseenter',function(){
		$(this).siblings('.gallery-caption').addClass('show');
	});

	$('.gallery-caption-trigger').on('mouseleave',function(){
		$(this).siblings('.gallery-caption').removeClass('show');
	});



	//portfolio isotope - hover effect
	$('.portfolio_text_effect').each(function(){

		var that = $(this);

		that.css('bottom',-that.outerHeight())
			.attr('data-height',that.outerHeight());
	})

	$('.portfolio_hover_link_effect').mouseenter(function(){

		var that = $(this);

		if ( !that.find('.portfolio_text_effect').is(':empty') ) {

			var portfolio_cat_height = that.find('.portfolio_text_effect').outerHeight();

			that.find('.portfolio_title_effect').css('bottom',portfolio_cat_height);
			that.find('.portfolio_text_effect').css('bottom',0);

		}

	});


	$('.portfolio_hover_link_effect').mouseleave(function(){

		var that = $(this);

		if ( !that.find('.portfolio_text_effect').is(':empty') ) {

			var portfolio_cat_height = that.find('.portfolio_text_effect').attr('data-height');

			that.find('.portfolio_title_effect').css('bottom',28);
			that.find('.portfolio_text_effect').css('bottom',-portfolio_cat_height);
		}

	});


	//portfolio isotope - adjust wrapper width, return portfolio_grid
    function portfolioIsotopeWrapper () {

		if ( $(window).innerWidth() > 1584 ) {
			$portfolio_grid = 5;
		} else if ( $(window).innerWidth() <= 480 ) {
			$portfolio_grid = 1;
		} else if ( $(window).innerWidth() <= 901 ) {
			$portfolio_grid = 2;
		} else if ( $(window).innerWidth() <= 1248 ) {
			$portfolio_grid = 3;
		} else {
			$portfolio_grid = 4;
		}

		if ( $('.items_per_row_3').length > 0 && $(window).innerWidth() > 1248 )
		{
			$portfolio_grid = 3;
		}

		if ( $('.items_per_row_4').length > 0 && $(window).innerWidth() > 1584 )
		{
			$portfolio_grid = 4;
		}

        $portfolio_wrapper_width = $('.portfolio-isotope-container').width();

        if ( $portfolio_wrapper_width % $portfolio_grid > 0 ) {
            $portfolio_wrapper_width = $portfolio_wrapper_width + ( $portfolio_grid - $portfolio_wrapper_width%$portfolio_grid);
        };

        $('.portfolio-isotope').css('width',$portfolio_wrapper_width);

        return $portfolio_grid;
    } // end portfolioIsotopeWrapper

    //portfolio isotope
    if ( $('.portfolio-isotope-container').size() ) {

		var $portfolio_wrapper_inner,
            $portfolio_wrapper_width,
            $portfolio_grid,
            $filterValue;

        $filterValue = $('.filters-group .is-checked').attr('data-filter');

        $portfolio_grid =  portfolioIsotopeWrapper();
        portfolioIsotopeWrapper();

        var afterIsotope = function(){
            setTimeout(function(){
                $(".portfolio_item").removeClass('hidden');
            },200);
        }

        var portfolioIsotope=function(){
            var imgLoad = imagesLoaded($('.portfolio-isotope'));

            imgLoad.on('done',function(){

                $portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio_item",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });

                afterIsotope()
            })

            imgLoad.on('fail',function(){

                portfolio_wrapper_inner = $('.portfolio-isotope').isotope({
                    "itemSelector": ".portfolio_item",
					 //layoutMode: 'fitRows',
                    "masonry": { "columnWidth": ".portfolio-grid-sizer" }
                });

                afterIsotope()
            })

        }

        portfolioIsotope();

        // filter items on button click
        $('.filters-group').on( 'click', '.filter-item', function() {

            $filterValue = $(this).attr('data-filter');
            $(this).parents('.portfolio-filters').siblings('.portfolio-isotope').isotope({ filter: $filterValue });

		});
    }//endif portfolio isotope


	//load images
	var images = $('.parallax');
	$.each(images, function(){
		var el = $(this),
		image = el.css('background-image').replace(/"/g, '').replace(/url\(|\)$/ig, '');
		if(image && image !== '' && image !== 'none')
			images = images.add($('<img>').attr('src', image));
		if(el.is('img'))
			images = images.add(el);
	});

	images.imagesLoaded('done',function(){

		if ($(window).outerWidth() > 1024) {
			$.stellar({
				horizontalScrolling: false,
			});
		}

		setTimeout(function(){
			$('.parallax').addClass('loaded');
		},150)

	});

    //columns auto height

    function columns_auto_height_func() {

        $('.columns_auto_height').each(function(){

            var column_min_height = 0;

            var that = $(this);

            that.imagesLoaded('always',function(){

                that.find('.column_container').first().siblings().addBack().css('min-height',0).each(function(){
                    if ( $(this).outerHeight(true) > column_min_height ) {
                        column_min_height = $(this).outerHeight(true);
                    }
                })

                that.addClass('height_balanced')
                    .find('.column_container').first().siblings().addBack().css('min-height',column_min_height);

            });


        });
    };


    if ( $('.row').hasClass('columns_auto_height') )  {
        if ( window_width > 640 ) {
            setTimeout(function(){
                columns_auto_height_func();
            },1)
        } else {
            $('.columns_auto_height').addClass('height_balanced');
        }
    }





	$(window).load(function(){

		$('body').hide().show(); //fix invisible fonts on refresh.

		//product thumbnails swiper
		var product_thumbnails_swiper = $('.product_thumbnails .product_thumbnails_swiper_container').swiper({
			slidesPerView: "auto",
			watchActiveIndex: true,
			mousewheelControl: true,
			mode:'vertical',
			onSlideClick : function(swiper) {
				owl.goTo(product_thumbnails_swiper.clickedSlideIndex);
				for (var i = 0; i < product_thumbnails_swiper.slides.length; i++){
					product_thumbnails_swiper.slides[i].style.opacity = 0.2;
					product_thumbnails_swiper.slides[i].style.cursor = 'pointer';
				}
				product_thumbnails_swiper.slides[product_thumbnails_swiper.clickedSlideIndex].style.opacity = 1;
				product_thumbnails_swiper.slides[product_thumbnails_swiper.clickedSlideIndex].style.cursor = 'default';
				product_thumbnails_swiper.swipeTo(product_thumbnails_swiper.clickedSlideIndex, 300, '');
			}
		});


		//owl

		var curent_dragging_item;

		$(".featured_img_temp").hide();

		$("#product-images-carousel").owlCarousel({
			singleItem : true,
			autoHeight : true,
			transitionStyle:"fade",
			lazyLoad : true,
			slideSpeed : 300,
			dragBeforeAnimFinish: false,
			afterAction : afterAction,
			beforeUpdate : function() {},
			startDragging:function() {},
			afterMove:function() {}
		});

		//get carousel instance data and store it in variable owl
		var owl = $("#product-images-carousel").data('owlCarousel');

		function afterAction() {
			/*jshint validthis: true */

			$('.product_thumbnails_swiper_container').css('max-height', $('.product_images').height());

			if ($(".product_thumbnails").length) {

				for (var i = 0; i < product_thumbnails_swiper.slides.length; i++){
					product_thumbnails_swiper.slides[i].style.opacity = 0.2;
				}
				product_thumbnails_swiper.slides[this.owl.currentItem].style.opacity = 1;
				product_thumbnails_swiper.swipeTo(this.owl.currentItem, 300, '');
			}

		}

		//Product Gallery zoom
		if ($(".easyzoom").length ) {
			if ( $(window).width() > 1024 ) {
				var $easyzoom = $(".easyzoom").easyZoom({
					loadingNotice: '',
					errorNotice: '',
					preventClicks: false,
				});

				var easyzoom_api = $easyzoom.data('easyZoom');

				$(".variations").on('change', 'select', function() {
					owl.goTo(0);
					easyzoom_api.teardown();
					easyzoom_api._init();
				});
			}
		}
	    // show product description in product list
        $(".products-grid .product_list_button").css('display','block');
	});

	$(window).resize(function(){

        //custom menu
        nova_mega_menu();
        nova_sidebar_menu();

		$('.product_thumbnails_swiper_container').css('max-height', $('.product_images').height());

		$(".main-navigation > ul > .menu-item > .sub-menu").css("left", "-15px");

        disable_fresco();

        if ( $('.row').hasClass('columns_auto_height') )  {
            if ( $(window).width() > 640 ) {
                columns_auto_height_func();
            } else {
                $('.columns_auto_height').find('.column_container').css('min-height',300);
            }
        }

		//portfolio isotope
        if ( $('.portfolio-isotope-container').size() ) {

            var $portfolio_grid_on_resize;

            portfolioIsotopeWrapper()
            $portfolio_grid_on_resize =  portfolioIsotopeWrapper();

            if ( $portfolio_grid != $portfolio_grid_on_resize ) {

                $('.filters-group .filter-item').each(function(){
                    if ( $(this).attr('data-filter') == $filterValue ){
                            $(this).trigger('click');
                    }
                })

                $portfolio_grid = $portfolio_grid_on_resize;

				resizeIsotopeEnd();

            }

        }

		//do something on end resize
        var window_resizeTo = this.resizeTO;
        function resizeIsotopeEnd() {
            if(window_resizeTo) clearTimeout(window_resizeTo);
                 window_resizeTo = setTimeout(function() {
                    $(this).trigger('onEndResizingIsotope');
            }, 100);
        }


	});

	//do something, window hasn't changed size in 100ms
    $(window).bind('onEndResizingIsotope', function() { console.log('resizeend')
        $('.filters-group .filter-item').each(function(){
            if ( $(this).attr('data-filter') == $filterValue ){
                $(this).trigger('click'); console.log('trigger resize')
            }
        })
    });


    $(window).scroll(function() {

    	$('#page_wrapper.sticky_header .top-headers-wrapper').css('top', $(window).scrollTop());

    });


});