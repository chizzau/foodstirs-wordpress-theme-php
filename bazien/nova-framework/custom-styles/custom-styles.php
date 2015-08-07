<?php
if ( !function_exists ('bazien_custom_styles') ) {
function bazien_custom_styles() {	
	global $post, $bazien_theme_options;	
	
	//convert hex to rgb
	function nova_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
	
	ob_start();	
	?>

		
	<style type="text/css" media="screen">
		
		/***************************************************************/
		/* Body ********************************************************/
		/***************************************************************/
		
		.inner-wrap {
			<?php if ( (isset($bazien_theme_options['main_background']['background-color'])) ) : ?>
			background-color:<?php echo esc_html($bazien_theme_options['main_background']['background-color']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_background']['background-image'])) && ($bazien_theme_options['main_background']['background-image'] != "") ) : ?>
			background-image:url(<?php echo esc_url($bazien_theme_options['main_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_background']['background-repeat'])) ) : ?>
			background-repeat:<?php echo esc_html($bazien_theme_options['main_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_background']['background-position'])) ) : ?>
			background-position:<?php echo esc_html($bazien_theme_options['main_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_background']['background-size'])) ) : ?>
			background-size:<?php echo esc_html($bazien_theme_options['main_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_background']['background-attachment'])) ) : ?>
			background-attachment:<?php echo esc_html($bazien_theme_options['main_background']['background-attachment']); ?>;
			<?php endif; ?>
		}
		/***************************************************************/
		/* Fonts *******************************************************/
		/***************************************************************/
		
			h1, h2, h3, h4, h5, h6,
			.comments-title,
			.comment-author,
			#reply-title,
			#site-footer .widget-title,
			.accordion_title,
			.ui-tabs-anchor,
			.products .button,
			.site-title a,
			.entry_meta_archive a,
			.post_meta a,
			.post_tags a,
			 #nav-below a,
			.list_categories a,
			.list_shop_categories a,
			.main-navigation > ul > li > a,
			.main-navigation .mega-menu > ul > li > a,
			.more-link,
			.top-page-excerpt,
			.select2-container .select2-choice > .select2-chosen,
			.woocommerce .products-grid a.button,
			.page-numbers,
			input.qty,
			.woocommerce form .form-row label,
			.woocommerce-page form .form-row label,
			.button,
			button,
			.button_text,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.woocommerce a.button,
			.woocommerce-page a.button,
			.woocommerce button.button,
			.woocommerce-page button.button,
			.woocommerce input.button,
			.woocommerce-page input.button,
			.woocommerce #respond input#submit,
			.woocommerce-page #respond input#submit,
			.woocommerce #content input.button,
			.woocommerce-page #content input.button,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce #respond input#submit.alt,
			.woocommerce #content input.button.alt,
			.woocommerce-page a.button.alt,
			.woocommerce-page button.button.alt,
			.woocommerce-page input.button.alt,
			.woocommerce-page #respond input#submit.alt,
			.woocommerce-page #content input.button.alt,
			.yith-wcwl-wishlistexistsbrowse.show a,
			.share-product-text,
			.tabs > li > a,
			label,
			.comment-respond label,
			.product_meta_title,
			.woocommerce table.shop_table th, 
			.woocommerce-page table.shop_table th,
			#map_button,
			.coupon_code_text,
			.woocommerce .cart-collaterals .cart_totals tr.order-total td strong,
			.woocommerce-page .cart-collaterals .cart_totals tr.order-total td strong,
			.cart-wishlist-empty,
			.return-to-shop .wc-backward,
			.order-number a,
			.account_view_link,
			.post-edit-link,
			.latest_posts_title,
			.icon_box_read_more,
			.vc_pie_chart_value,
			.shortcode_banner_simple_bullet,
			.shortcode_banner_simple_height_bullet,
			.category_name,
			.woocommerce span.onsale,
			.woocommerce-page span.onsale,
			.out_of_stock_badge_single,
			.out_of_stock_badge_loop,
			.page-numbers,
			.page-links,
			.add_to_wishlist,
			.yith-wcwl-wishlistaddedbrowse,
			.yith-wcwl-wishlistexistsbrowse,
			.filters-group,
			.product-name,
			.woocommerce-page .my_account_container table.shop_table.order_details_footer tr:last-child td:last-child .amount,
			.customer_details dt,
			.widget h3,
			.widget ul a,
			.widget a,
			.widget .total .amount,
			.wishlist-in-stock,
			.wishlist-out-of-stock,
			.comment-reply-link,
			.comment-edit-link,
			.widget_calendar table thead tr th,
			.page-type,
			.mobile-navigation a,
			table thead tr th,
			.portfolio_single_list_cat,
			.portfolio-categories
			{ 
				font-family: 
				<?php if ($bazien_theme_options['font_source'] == "3") echo '\'' . $bazien_theme_options['main_typekit_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "2") echo '\'' . $bazien_theme_options['main_google_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "1") echo '\'' . $bazien_theme_options['main_font']['font-family'] . '\','; ?> 
				sans-serif;
			}			
		
		
			body,
			p,
			#site-navigation-top-bar,
			.site-title,
			.widget_product_search #searchsubmit,
			.widget_search #searchsubmit,
			.widget_product_search .search-submit,
			.widget_search .search-submit,
			#site-menu,
			.copyright_text,
			blockquote cite,
			table thead th,
			.recently_viewed_in_single h2,
			.woocommerce .cart-collaterals .cart_totals table th,
			.woocommerce-page .cart-collaterals .cart_totals table th,
			.woocommerce .cart-collaterals .shipping_calculator h2,
			.woocommerce-page .cart-collaterals .shipping_calculator h2,
			.qty,
			.shortcode_banner_simple_inside h4,
			.shortcode_banner_simple_height h4,
			.fr-caption,
			.entry_meta_archive,
			.post_meta,
			.page-links-title,
			.yith-wcwl-wishlistaddedbrowse .feedback,
			.yith-wcwl-wishlistexistsbrowse .feedback,
			.product-name span,
			.widget_calendar table tbody a,
			.fr-touch-caption-wrapper
			{
				font-family: 
				<?php if ($bazien_theme_options['font_source'] == "3") echo '\'' . $bazien_theme_options['secondary_typekit_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "2") echo '\'' . $bazien_theme_options['secondary_google_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "1") echo '\'' . $bazien_theme_options['secondary_font']['font-family'] . '\','; ?> 
				sans-serif;
			}	
			
			.bazien_block_sub_title h2.title,
			.lookbook_content h4,
            .aboutus-subtitle
			 {
				font-family: 
				<?php if ($bazien_theme_options['font_source'] == "3") echo '\'' . $bazien_theme_options['subtitle_typekit_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "2") echo '\'' . $bazien_theme_options['subtitle_google_font_face'] . '\','; ?>
				<?php if ($bazien_theme_options['font_source'] == "1") echo '\'' . $bazien_theme_options['subtitle_font']['font-family'] . '\','; ?> 
				sans-serif;
			}		
		
		/***************************************************************/
		/* Body Text Colors  *******************************************/
		/***************************************************************/		
		<?php if ( (isset($bazien_theme_options['body_color'])) && (trim($bazien_theme_options['body_color']) != "" ) ) : ?>
		body,
		p {
			color: <?php echo esc_html($bazien_theme_options['body_color']); ?>;
		}
		<?php endif; ?>
		/***************************************************************/
		/* Second Text Colors  *******************************************/
		/***************************************************************/
		
		<?php if ( (isset($bazien_theme_options['second_color'])) && (trim($bazien_theme_options['second_color']) != "" ) ) : ?>
		a,
		table tr th,
		table tr td,
		table thead tr th,
		blockquote p,
		label,
		.select2-dropdown-open.select2-drop-above .select2-choice,
		.select2-dropdown-open.select2-drop-above .select2-choices, 
		.select2-container .select2-choice,
		.select2-container,
		.big-select,
		.select.big-select,
		.blog-single h6,
		.page-description,
		.woocommerce div.product span.price,
		.woocommerce-page div.product span.price,
		.woocommerce #content div.product span.price,
		.woocommerce-page #content div.product span.price,
		.woocommerce div.product p.price,
		.woocommerce-page div.product p.price,
		.woocommerce #content div.product p.price,
		.woocommerce-page #content div.product p.price,		
		.woocommerce #content nav.woocommerce-pagination ul li span.current,
		.woocommerce nav.woocommerce-pagination ul li span.current,
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
		.woocommerce-page nav.woocommerce-pagination ul li span.current,
		.woocommerce table.shop_table th,
		.woocommerce-page table.shop_table th,
		.woocommerce .cart-collaterals .cart_totals h2,
		.woocommerce-page .cart-collaterals .cart_totals h2,
		.woocommerce .cart-collaterals .cart_totals table tr.order-total td:last-child,
		.woocommerce-page .cart-collaterals .cart_totals table tr.order-total td:last-child,
		.woocommerce-checkout .woocommerce-info,
		.woocommerce-checkout h3,
		.woocommerce-checkout h2,
		.woocommerce-account h2,
		.woocommerce-account h3,
		.woocommerce .woocommerce-breadcrumb a,
		.customer_details dt,
		.wpb_widgetised_column .widget.widget_layered_nav li,
		.latest_posts_title,
		.entry_meta_archive a,
        .project-detail .title,
        .latestbyauthor li:before,
        .portfolio_content_nav #nav-below .nav-previous span:before,
        .portfolio_content_nav #nav-below .nav-next span:after,
        .nova-testimonial-grid-wrapper .testimonial_text,
        .nova-testimonial-grid-wrapper .testimonial_author,
        .cart-empty.sub-alert,
        .wpcf7-form p,
        .gallery-caption-trigger
		{
			color: <?php echo esc_html($bazien_theme_options['second_color']); ?>;
		}
		.bazien_block_title p,
        .comments-title,
        .filters-group li,
        #reply-title {

			border-color: <?php echo esc_html($bazien_theme_options['second_color']); ?>;
		}
		input[type="text"],
		input[type="password"],
		input[type="date"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="month"], input[type="week"],
		input[type="email"], input[type="number"],
		input[type="search"], input[type="tel"],
		input[type="time"], input[type="url"],
		textarea,
		select,
		.chosen-container-single .chosen-single,
		#coupon_code
		{
			border-color: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.1);
		}
		
		input[type="text"]:focus, input[type="password"]:focus,
		input[type="date"]:focus, input[type="datetime"]:focus,
		input[type="datetime-local"]:focus, input[type="month"]:focus,
		input[type="week"]:focus, input[type="email"]:focus,
		input[type="number"]:focus, input[type="search"]:focus,
		input[type="tel"]:focus, input[type="time"]:focus,
		input[type="url"]:focus, textarea:focus,
		select:focus,
		#coupon_code:focus,
		.chosen-container-single .chosen-single:focus,
		.woocommerce .product_infos .quantity input.qty,
		.woocommerce #content .product_infos .quantity input.qty,
		.woocommerce-page .product_infos .quantity input.qty,
		.woocommerce-page #content .product_infos .quantity input.qty,
		.post_tags a,
		.wpb_widgetised_column .tagcloud a,
		.woocommerce-cart.woocommerce-page #content .quantity input.qty,
		.woocommerce form.checkout_coupon,
		.woocommerce-page form.checkout_coupon,
		.woocommerce ul.digital-downloads:before,
		.woocommerce-page ul.digital-downloads:before,
		.woocommerce ul.digital-downloads li:after,
		.woocommerce-page ul.digital-downloads li:after,
		.widget_search .search-form
		{
			border-color: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.1);
		}
		
		table tr,
		.my_address_title,
		.woocommerce .my_account_container table.shop_table.order_details tr:last-child,
		.woocommerce-page .my_account_container table.shop_table.order_details tr:last-child,
		.woocommerce #payment ul.payment_methods li,
		.woocommerce-page #payment ul.payment_methods li,
		.comment-separator,
		.comment-list .pingback,
		.wpb_widgetised_column .widget,
		.search_result_item
		{
			border-bottom-color: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.1);
		}
		
		table.shop_attributes tr,
		.wishlist_table tr,
		.shop_table.cart tr
		{
			border-bottom-color: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.05);
		}
		
		.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register,
		.woocommerce .cart-collaterals,
		.woocommerce-page .cart-collaterals,
		.checkout_right_wrapper,
		.track_order_form,
		.order-info
		{
			border: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.1) solid 1px;
		}
		.cart-buttons .update_and_checkout .update_cart
		{
			background: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.55) !important;
		}
		
		.cart-buttons .update_and_checkout .update_cart:hover
		{
			background: rgba(<?php echo nova_hex2rgb($bazien_theme_options['second_color']); ?>,0.44) !important;
		}
		<?php endif; ?>
		
		<?php if ( (isset($bazien_theme_options['headings_color'])) && (trim($bazien_theme_options['headings_color']) != "" ) ) : ?>
		h1, h2, h3, h4, h5, h6,
		.entry-title-archive a,
		.woocommerce table.cart .product-name a,
		.product-title-link
		{
			color: <?php echo esc_html($bazien_theme_options['headings_color']); ?>;
		}
		
		<?php endif; ?>
		
		
		
		
		/***************************************************************/
		/* Main Color  *************************************************/
		/***************************************************************/
		
		<?php if ( (isset($bazien_theme_options['main_color'])) && (trim($bazien_theme_options['main_color']) != "" ) ) : ?>
		::-moz-selection {
		  color:#ffffff;
		  background: <?php echo esc_html($bazien_theme_options['main_color']); ?>;
		}
		::selection {
		  color:#ffffff;
		  background: <?php echo esc_html($bazien_theme_options['main_color']); ?>;
		}	
		a:hover,
		a:focus,
        .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > a, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > h5,
        .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:hover, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > h5:hover,
        .mega-menu > li.menu-item.active > a, .mega-menu > li.menu-item:hover > a, .mega-menu > li.menu-item.active > h5, .mega-menu > li.menu-item:hover > h5,
        .mega-menu .narrow .popup li.menu-item > a:hover,
        .mega-menu > li.menu-item > a:hover,
        .sidebar-menu > li.menu-item.active:hover > a, .sidebar-menu > li.menu-item.active:hover > h5,
        .sidebar-menu > li.menu-item:hover > a, .sidebar-menu > li.menu-item:hover > h5,
        .sidebar-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > a, .sidebar-menu .wide .popup > .inner > ul.sub-menu > li.menu-item > h5,
        .sidebar-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:hover, .sidebar-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item:hover > h5,
        .sidebar-menu .narrow .popup li.menu-item > a:hover, .sidebar-menu .narrow .popup li.menu-item > h5:hover,
        .mobile-navigation .current-menu-item > a,
		.edit-link,
        .comment-reply-link,
		.entry_meta_archive a:hover,
		.post_meta a:hover,
		.entry-title-archive a:hover,
		blockquote:before,
		.no-results-text:before,
		.list-categories-center a:hover,
		.comment-reply i,
		.comment-edit-link i,
		.comment-edit-link,
		.filters-group li:hover,
		#map_button,
		.widget_bazien_social_media a,
		.account-tab-link-mobile,
		.lost-reset-pass-text:before,
		.list_shop_categories a:hover,
		.add_to_wishlist:hover,
		.woocommerce .star-rating span:before,
		.woocommerce-page .star-rating span:before,
		.woocommerce p.stars a.star-1.active:after,
		.woocommerce p.stars a.star-1:hover:after,
		.woocommerce-page p.stars a.star-1.active:after,
		.woocommerce-page p.stars a.star-1:hover:after,
		.woocommerce p.stars a.star-2.active:after,
		.woocommerce p.stars a.star-2:hover:after,
		.woocommerce-page p.stars a.star-2.active:after,
		.woocommerce-page p.stars a.star-2:hover:after,
		.woocommerce p.stars a.star-3.active:after,
		.woocommerce p.stars a.star-3:hover:after,
		.woocommerce-page p.stars a.star-3.active:after,
		.woocommerce-page p.stars a.star-3:hover:after,
		.woocommerce p.stars a.star-4.active:after,
		.woocommerce p.stars a.star-4:hover:after,
		.woocommerce-page p.stars a.star-4.active:after,
		.woocommerce-page p.stars a.star-4:hover:after,
		.woocommerce p.stars a.star-5.active:after,
		.woocommerce p.stars a.star-5:hover:after,
		.woocommerce-page p.stars a.star-5.active:after,
		.woocommerce-page p.stars a.star-5:hover:after,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,		
		.yith-wcwl-add-button:before,
		.yith-wcwl-wishlistaddedbrowse .feedback:before,
		.yith-wcwl-wishlistexistsbrowse .feedback:before,
		.products .yith-wcwl-wishlistexistsbrowse a:before,
		.products .yith-wcwl-wishlistaddedbrowse a:before,
		.product_infos .yith-wcwl-wishlistaddedbrowse,
		.yith-wcwl-wishlistexistsbrowse,
		.product_meta a:hover,
		.product_content_wrapper .nova-compare:hover,
		.woocommerce .shop-has-sidebar .no-products-info .woocommerce-info:before,
		.woocommerce-page .shop-has-sidebar .no-products-info .woocommerce-info:before,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce-page .woocommerce-breadcrumb a:hover,
		.intro-effect-fadeout.modify .post_meta a:hover,
		.latest_posts_link:hover .latest_posts_title,
		.portfolio_single_list_cat a:hover,
		#jckqv .woocommerce-product-rating .star-rating span:before,
		.product_meta a,
		.resp-vtabs li.resp-tab-active,
		.wpb_tour.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a, 
		.wpb_tabs.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
		.wpb_tour.wpb_content_element .wpb_tabs_nav li a:hover, 
		.wpb_tabs.wpb_content_element .wpb_tabs_nav li a:hover,
        .vc_tta-color-white.vc_tta-style-flat .vc_tta-tab.vc_active > a,
        .vc_tta-color-white.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-title > a,
        .emm-paginate a:hover,
        .emm-paginate a:active,
        .emm-paginate .emm-current,
        .promotion-block p,
        #mini-cart .widget_shopping_cart_content .amount,
        #mini-cart .widget_shopping_cart_content a:hover,
        .overlay-top-search .site-search-inner input.search-field,
        .overlay-top-search .site-search-inner input.search-field:focus,
        .error-404 h1.page-title,
        .cart-wishlist-empty,
        .active-text
		{
			color: <?php echo esc_html($bazien_theme_options['main_color']); ?>;
		}
        .overlay-top-search .site-search-inner input.search-field::-webkit-input-placeholder {
            color: <?php echo esc_html($soffia_theme_options['main_color']); ?>;
        }
        .overlay-top-search .site-search-inner input.search-field:-moz-placeholder {
            color: <?php echo esc_html($soffia_theme_options['main_color']); ?>;
        }
        .overlay-top-search .site-search-inner input.search-field::-moz-placeholder {
            color: <?php echo esc_html($soffia_theme_options['main_color']); ?>;
        }
        .overlay-top-search .site-search-inner input.search-field:-ms-input-placeholder {
            color: <?php echo esc_html($soffia_theme_options['main_color']); ?>;
        }
		@media only screen and (min-width: 40.063em) {
			
			.nav-next a:hover,
			.nav-previous a:hover
			{
				color: <?php echo esc_html($bazien_theme_options['main_color']) ?>;
			}
		
		}
        .header-4-socials a:hover,
        .widget_shopping_cart .buttons a.view_cart,
		.widget.widget_price_filter .price_slider_amount .button,
		.woocommerce-page .products .added_to_cart.wc-forward,
		.woocommerce a.added_to_cart
		{
			color: <?php echo esc_html($bazien_theme_options['main_color']) ?> !important;
		}
		
		.order-info mark,
		.post_tags a:hover,
		.with_thumb_icon,
        #mini-cart .cart-items,
		.wpb_wrapper .wpb_toggle:before,
		#content .wpb_wrapper h4.wpb_toggle:before,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
		.widget .tagcloud a:hover,
		.woocommerce .products span.onsale, 
		.woocommerce-page .products span.onsale, 
		.woocommerce span.onsale, 
		.woocommerce-page span.onsale,		
		.woocommerce .widget_layered_nav ul li.chosen a,
		.woocommerce-page .widget_layered_nav ul li.chosen a,
		.woocommerce .widget_layered_nav_filters ul li a,
		.woocommerce-page .widget_layered_nav_filters ul li a,
		.product_infos .yith-wcwl-wishlistaddedbrowse a,
		.product_infos .yith-wcwl-wishlistexistsbrowse.show a,
		.thumbnail_archive_container:before,
		#jckqv .onsale,
		#jckqv button:hover,
		.wpb_wrapper .vc_progress_bar .vc_single_bar .vc_bar,
		.nova-button.stroke:hover,
		.lookbook_content_container,
        .entry_format span,
        .filters-group li:hover,
        .portfolio-item .icon_box,
        .nova-button.default,
		.select2-results .select2-highlighted
		{
			background: <?php echo esc_html($bazien_theme_options['main_color']) ?>;
		}
		
		
		@media only screen and (max-width: 40.063em) {
			
			.nav-next a:hover,
			.nav-previous a:hover
			{
				background: <?php echo esc_html($bazien_theme_options['main_color']) ?>;
                border-color: <?php echo esc_html($bazien_theme_options['main_color']) ?>;
                color:#fff;
			}
		
		}
		
		
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .quantity .plus,
		.woocommerce .quantity .minus,
		.woocommerce #content .quantity .plus,
		.woocommerce #content .quantity .minus,
		.woocommerce-page .quantity .plus,
		.woocommerce-page .quantity .minus,
		.woocommerce-page #content .quantity .plus,
		.woocommerce-page #content .quantity .minus
		{
			background: <?php echo esc_html($bazien_theme_options['main_color']) ?> !important;
		}
		
		.button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"]
		{
			background-color: <?php echo esc_html($bazien_theme_options['main_color']) ?> !important;
		}
		
		
		.shipping-calculator-button:hover,
		.products a.button:hover,
		.woocommerce .products .added_to_cart.wc-forward:hover,
		.woocommerce-page .products .added_to_cart.wc-forward:hover,
		.order-number a:hover,
		.account_view_link:hover,
		.post-edit-link:hover,
		.url:hover
		{
			color:  rgba(<?php echo nova_hex2rgb($bazien_theme_options['main_color']); ?>,0.8) !important;
		}

		.button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.woocommerce .product_infos .quantity .minus:hover,
		.woocommerce #content .product_infos .quantity .minus:hover,
		.woocommerce-page .product_infos .quantity .minus:hover,
		.woocommerce-page #content .product_infos .quantity .minus:hover,
		.woocommerce .quantity .plus:hover,
		.woocommerce #content .quantity .plus:hover,
		.woocommerce-page .quantity .plus:hover,
		.woocommerce-page #content .quantity .plus:hover
		{
			background: rgba(<?php echo nova_hex2rgb($bazien_theme_options['main_color']); ?>,0.8) !important;
		}
		
		.post_tags a:hover,
		.widget .tagcloud a:hover,
		.widget_shopping_cart .buttons a.view_cart,
		.account-tab-link-mobile,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.nova-button.stroke:hover,
		.latest-post-shortcode-wrapper .owl-theme .owl-controls .owl-page:hover span,
		.latest-post-shortcode-wrapper .owl-theme .owl-controls .owl-page.active span,
		.nova-lookbook-list-wrapper .owl-theme .owl-controls .owl-page:hover span,
		.nova-lookbook-list-wrapper .owl-theme .owl-controls .owl-page.active span,
        .more-link:hover,
        .filters-group li:hover,
        .vc_toggle_active,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle
		{
			border-color: <?php echo esc_html($bazien_theme_options['main_color']) ?>;
		}

		.product_images_wrapper:hover .product_images_hover {
			background: rgba(<?php echo nova_hex2rgb($bazien_theme_options['main_color']); ?>,0.6);
		}
		
		<?php endif; ?>
		
		
		/***************************************************************/
		/* Top Bar *****************************************************/
		/***************************************************************/
        <?php
        if ( (isset($bazien_theme_options['top_bar_switch'])) && ($bazien_theme_options['top_bar_switch'] == "1" ) ) {
            $site_top_bar_height = 45;
        } else {
            $site_top_bar_height = 0;
        }
        ?>
		<?php if ( (isset($bazien_theme_options['top_bar_navigation_position'])) && (trim($bazien_theme_options['top_bar_navigation_position']) == "left" ) ) : ?>
		#site-navigation-top-bar {
			float:left;
		}
		<?php endif; ?>
		
		
		#site-top-bar {
			<?php if ( (isset($bazien_theme_options['top_bar_background_color'])) && (trim($bazien_theme_options['top_bar_background_color']) != "" ) ) : ?>
				background: <?php echo esc_html($bazien_theme_options['top_bar_background_color']) ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($bazien_theme_options['top_bar_typography'])) && (trim($bazien_theme_options['top_bar_typography']) != "" ) ) : ?>
		#site-top-bar,
		#site-top-bar a
		{
			color:<?php echo esc_html($bazien_theme_options['top_bar_typography']) ?>;
		}
		<?php endif; ?>
		#site-top-bar .sub-menu a
		{
			color: #c2c2c2;
		}
		
		
		/***************************************************************/
		/* 	Header *****************************************************/
		/***************************************************************/
		
		<?php if ( (isset($bazien_theme_options['sticky_header_background_color'])) && (trim($bazien_theme_options['sticky_header_background_color']) != "" ) ) : ?>
			.site-header
			{
				background: <?php echo esc_html($bazien_theme_options['sticky_header_background_color']) ?>;
			}
		<?php endif; ?>
		
		@media only screen and (min-width: 1281px) {
		.site-header {
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-color'])) ) : ?>
			background-color:<?php echo esc_html($bazien_theme_options['main_header_background']['background-color']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-image'])) && ($bazien_theme_options['main_header_background']['background-image']) != "" ) : ?>
			background-image:url(<?php echo esc_url($bazien_theme_options['main_header_background']['background-image']); ?>);
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-repeat'])) ) : ?>
			background-repeat:<?php echo esc_html($bazien_theme_options['main_header_background']['background-repeat']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-position'])) ) : ?>
			background-position:<?php echo esc_html($bazien_theme_options['main_header_background']['background-position']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-size'])) ) : ?>
			background-size:<?php echo esc_html($bazien_theme_options['main_header_background']['background-size']); ?>;
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_background']['background-attachment'])) ) : ?>
			background-attachment:<?php echo esc_html($bazien_theme_options['main_header_background']['background-attachment']); ?>;
			<?php endif; ?>
		}
		}
		
		
		<?php 
		$site_logo_height = 33;
		if ( (isset($bazien_theme_options['site_logo']['url'])) && (trim($bazien_theme_options['site_logo']['url']) != "" ) ) {
			$site_logo_height = $bazien_theme_options['logo_height']; 
		} else {
			$site_logo_height = 33;
		}
		?>
		
		<?php 
		
		$content_margin = 0;
				
		$page_id = "";
		if ( is_single() || is_page() ) {
			$page_id = get_the_ID();
		} else if ( is_home() ) {
			$page_id = get_option('page_for_posts');						
		}
					
		
		if ( 
		((isset($bazien_theme_options['sticky_header'])) && (trim($bazien_theme_options['sticky_header']) == "1" )) || 
		((isset($bazien_theme_options['main_header_transparency'])) && (trim($bazien_theme_options['main_header_transparency']) == "1" )) ||
		((get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit"))
		) { 
			
			if ( isset($bazien_theme_options['main_header_layout']) ) {		
				if ( $bazien_theme_options['main_header_layout'] == "1" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $bazien_theme_options['spacing_above_logo'] + $bazien_theme_options['spacing_below_logo'];
				} 		
				elseif ( $bazien_theme_options['main_header_layout'] == "2" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $bazien_theme_options['spacing_above_logo'] + $bazien_theme_options['spacing_below_logo'];
				}
				elseif ( $bazien_theme_options['main_header_layout'] == "3" ) {
					$content_margin = $content_margin + $site_top_bar_height + $site_logo_height + $bazien_theme_options['spacing_above_logo'] + $bazien_theme_options['spacing_below_logo'] + 50;
				} 		
			}		
			else {	
				wp_enqueue_style('bazien-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );	
			}
			
		}
		?>
		
		
		<?php
		
		if ( (isset($bazien_theme_options['site_logo']['url'])) && (trim($bazien_theme_options['site_logo']['url']) != "" ) ) {
			
			if (is_ssl()) {
				$site_logo = str_replace("http://", "https://", $bazien_theme_options['site_logo']['url']);		
			} else {
				$site_logo = $bazien_theme_options['site_logo']['url'];
			}
			
		?>
		
			<?php if ( (isset($bazien_theme_options['logo_height'])) && (trim($bazien_theme_options['logo_height']) != "" ) ) { ?>
			
			@media only screen and (min-width: 1281px) {
			.site-logo img {
				height:<?php echo esc_html($site_logo_height); ?>px;
				width:auto;
			}
			
			.site-header .main-navigation,
			.site-header .header-actions
			{
				height:<?php echo esc_html($site_logo_height); ?>px;
				line-height:<?php echo esc_html($site_logo_height); ?>px;
			}
			}
			
			<?php } ?>

		<?php
		}
		?>

		<?php if ( (isset($bazien_theme_options['spacing_above_logo'])) && (trim($bazien_theme_options['spacing_above_logo']) != "" ) ) { ?>
		@media only screen and (min-width: 1281px) {
			.site-header {
				padding-top:<?php echo esc_html($bazien_theme_options['spacing_above_logo']); ?>px;
			}
		}
		<?php } ?>
		
		<?php if ( (isset($bazien_theme_options['spacing_below_logo'])) && (trim($bazien_theme_options['spacing_below_logo']) != "" ) ) { ?>
		@media only screen and (min-width: 1281px) {
			.site-header {
				padding-bottom:<?php echo esc_html($bazien_theme_options['spacing_below_logo']); ?>px;
			}
		}
		<?php } ?>
		<?php
		 if ( isset($bazien_theme_options['main_header_layout']) ) {
                        if($bazien_theme_options['main_header_layout'] == "1" ){

                        }elseif($bazien_theme_options['main_header_layout'] == "2") {
                            $content_margin = $content_margin + 70;
                        }elseif($bazien_theme_options['main_header_layout'] == "3") {

                        }
                    }else{
                        $header_layout = "";
                    }
        ?>
		@media only screen and (min-width: 1281px) {
			#page_wrapper.sticky_header .content-area,
			#page_wrapper.transparent_header .content-area
			{
				margin-top:<?php echo esc_html($content_margin); ?>px;
			}

			.transparent_header .single-post-header .title,
			#page_wrapper.transparent_header .shop_header .page-title
			{
				padding-top: <?php echo esc_html($content_margin); ?>px;
			}
			
			.transparent_header .single-post-header.with-thumb .title
			{
				padding-top: <?php echo esc_html(200 + $content_margin); ?>px;
			}
		}
		
		<?php if ( (isset($bazien_theme_options['main_header_font_size'])) && (trim($bazien_theme_options['main_header_font_size']) != "" ) ) : ?>
		.site-header,
		.default-navigation,
		.main-navigation .mega-menu > ul > li > a
		{
			font-size: <?php echo esc_html($bazien_theme_options['main_header_font_size']) ?>px;
		}
		<?php endif; ?>		
		
		<?php if ( (isset($bazien_theme_options['sticky_header_color'])) && (trim($bazien_theme_options['sticky_header_color']) != "" ) ) : ?>
		.site-header,
		.main-navigation a,
		.header-actions ul li a,
		.shopping_bag_items_number,
		.wishlist_items_number,
		.site-title a,
		.widget_product_search .search-but-added,
		.widget_search .search-but-added
		{
			color:<?php echo esc_html($bazien_theme_options['sticky_header_color']) ?>;
		}

		.site-logo
		{
			border-color: <?php echo esc_html($bazien_theme_options['main_header_font_color']) ?>;
		}
		<?php endif; ?>
		
		<?php if ( (isset($bazien_theme_options['main_header_font_color'])) && (trim($bazien_theme_options['main_header_font_color']) != "" ) ) : ?>
		@media only screen and (min-width: 1281px) {
			.site-header,
			.main-navigation a,
			.header-actions ul li a,
			.shopping_bag_items_number,
			.wishlist_items_number,
			.site-title a,
			.widget_product_search .search-but-added,
			.widget_search .search-but-added
			{
				color:<?php echo esc_html($bazien_theme_options['main_header_font_color']) ?>;
			}
	
			.site-logo
			{
				border-color: <?php echo esc_html($bazien_theme_options['main_header_font_color']) ?>;
			}
		}
		.main-navigation .sub-menu a {
			color: #c2c2c2;
		}
		<?php endif; ?>
		
		
		<?php if ( (isset($bazien_theme_options['main_header_transparent_light_color'])) && (trim($bazien_theme_options['main_header_transparent_light_color']) != "" ) ) : ?>
		@media only screen and (min-width: 1281px) {
            #page_wrapper.transparent_header.header_transparent_light_present #site-top-bar,
            #page_wrapper.transparent_header.header_transparent_light_present #site-top-bar a,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header ul.mega-menu > li > a ,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .header-actions ul li a,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .site-title a,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.header_transparent_light_present .page-title,
			#page_wrapper.transparent_header.header_transparent_light_present .site-header .widget_search .search-but-added
			{
				color:<?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
			}
            #page_wrapper.transparent_header.header_transparent_light_present .site-header ul.mega-menu > li > a:hover {
                color:<?php echo esc_html($bazien_theme_options['main_color']) ?>
            }
            #page_wrapper.transparent_header.header_transparent_light_present .site-header ul.mega-menu > li.active {
                border-color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }

            .header_transparent_light_present .site-header:not(.sticky) .promotion-block h2 {
                color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }

            .header_transparent_light_present .main-navigation-2:not(.sticky) #mini-cart {
                color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }
            .header_transparent_light_present .main-navigation-2:not(.sticky) .cart-head,
            .header_transparent_light_present .main-navigation-2:not(.sticky) .mega-menu > li.active {
                border-color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }
            .header_transparent_light_present .main-navigation-2:not(.sticky) .mega-menu > li.menu-item > a,
            .header_transparent_light_present .main-navigation-2:not(.sticky) .mega-menu > li.menu-item > h5 {
                color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }
            .header_transparent_light_present .main-navigation-2:not(.sticky) .mega-menu > li.menu-item > a:hover,
            .header_transparent_light_present .main-navigation-2:not(.sticky) .mega-menu > li.menu-item > h5:hover {
                color:<?php echo esc_html($bazien_theme_options['main_color']) ?>
            }
            .header_transparent_light_present .site-header:not(.sticky) .header-3-mini-cart #mini-cart {
                color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }
            .header_transparent_light_present .site-header:not(.sticky) .header-3-mini-cart .cart-head,
            .header_transparent_light_present .main-navigation-3:not(.sticky) .mega-menu > li.active {
                border-color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }

            .header_transparent_light_present .main-navigation-3:not(.sticky) .mega-menu > li.menu-item > a,
            .header_transparent_light_present .main-navigation-3:not(.sticky) .search-header-3 button.button,
            .header_transparent_light_present .main-navigation-3:not(.sticky) .mega-menu > li.menu-item > h5 {
                color: <?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
            }
            .header_transparent_light_present .main-navigation-3:not(.sticky) .mega-menu > li.menu-item > a:hover,
            .header_transparent_light_present .main-navigation-3:not(.sticky) .mega-menu > li.menu-item > h5:hover {
                color:<?php echo esc_html($bazien_theme_options['main_color']) ?>
            }
		}
        #page_wrapper.transparent_header.header_transparent_light_present .page-title {

            color:<?php echo esc_html($bazien_theme_options['main_header_transparent_light_color']) ?>;
        }
		<?php endif; ?>
		
		
		<?php if ( (isset($bazien_theme_options['main_header_transparent_dark_color'])) && (trim($bazien_theme_options['main_header_transparent_dark_color']) != "" ) ) : ?>
		@media only screen and (min-width: 1281px) {
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .main-navigation a,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .header-actions ul li a,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .shopping_bag_items_number,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .wishlist_items_number,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .site-title a,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .widget_product_search .search-but-added,
			#page_wrapper.transparent_header.header_transparent_dark_present .site-header .widget_search .search-but-added
			{
				color:<?php echo esc_html($bazien_theme_options['main_header_transparent_dark_color']) ?>;
			}
		}
		#page_wrapper.transparent_header.header_transparent_dark_present .site-header .main-navigation .sub-menu a {
			color: #c2c2c2;
		}
		<?php endif; ?>
		
		.main-navigation a:hover {
			color: <?php echo esc_html($bazien_theme_options['main_color']) ?> !important;
		}		
		/* sticky */
		
		<?php if ( (isset($bazien_theme_options['sticky_header_background_color'])) && (trim($bazien_theme_options['sticky_header_background_color']) != "" ) ) : ?>
		@media only screen and (min-width: 1281px) {
			.site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky,
            .main-navigation-2.sticky,
            .main-navigation-3.sticky
            {
				background: <?php echo esc_html($bazien_theme_options['sticky_header_background_color']) ?>;
			}
		}
		<?php endif; ?>
		
		<?php if ( (isset($bazien_theme_options['sticky_header_color'])) && (trim($bazien_theme_options['sticky_header_color']) != "" ) ) : ?>
		@media only screen and (min-width: 1281px) {
			.site-header.sticky,
			.site-header.sticky ul.mega-menu > li > a,
			.site-header.sticky .header-actions ul li a,
			.site-header.sticky .shopping_bag_items_number,
			.site-header.sticky .wishlist_items_number,
			.site-header.sticky .site-title a,
			.site-header.sticky .widget_product_search .search-but-added,
			.site-header.sticky .widget_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky,
			#page_wrapper.transparent_header .site-header.sticky ul.mega-menu > li > a,
			#page_wrapper.transparent_header .site-header.sticky .header-actions ul li a,
			#page_wrapper.transparent_header .site-header.sticky .shopping_bag_items_number,
			#page_wrapper.transparent_header .site-header.sticky .wishlist_items_number,
			#page_wrapper.transparent_header .site-header.sticky .site-title a,
			#page_wrapper.transparent_header .site-header.sticky .widget_product_search .search-but-added,
			#page_wrapper.transparent_header .site-header.sticky .widget_search .search-but-added
			{
				color:<?php echo esc_html($bazien_theme_options['sticky_header_color']) ?>;
			}
			
			.site-header.sticky .site-logo
			{
				border-color: <?php echo esc_html($bazien_theme_options['sticky_header_color']) ?>;
			}
			.site-header.sticky .main-navigation .sub-menu a {
				color: #c2c2c2;
			}
		}
		<?php endif; ?>
		<?php 
		
		if ( 
		(isset($bazien_theme_options['main_header_wishlist'])) && 
		(isset($bazien_theme_options['main_header_shopping_bag'])) && 
		(isset($bazien_theme_options['main_header_search_bar'])) && 
		(isset($bazien_theme_options['main_header_off_canvas'])) && 
		($bazien_theme_options['main_header_wishlist'] == "0") && 
		($bazien_theme_options['main_header_shopping_bag'] == "0") && 
		($bazien_theme_options['main_header_search_bar'] == "0") && 
		($bazien_theme_options['main_header_off_canvas'] == "0") ) : 
		?>
		
		.header-actions { margin:0; }
		
		<?php endif; ?>
		
		
		<?php if ( (isset($bazien_theme_options['sticky_header_logo']['url'])) && (trim($bazien_theme_options['sticky_header_logo']['url']) != "" ) ) : ?>
		@media only screen and (max-width: 1281px) {
			.site-logo-image {
				display:none;
			}
			.sticky-logo {
				display:block;
			}
		}
		<?php endif; ?>
		
		
		
		
		<?php if ( (isset($bazien_theme_options['main_header_layout'])) && ($bazien_theme_options['main_header_layout'] == "2") ) : ?>
		
			<?php
			
			$header_col_right_menu_right_padding = 0;
			
			if ( (isset($bazien_theme_options['main_header_wishlist'])) && ($bazien_theme_options['main_header_wishlist'] == "1") ) $header_col_right_menu_right_padding += 60;
			if ( (isset($bazien_theme_options['main_header_shopping_bag'])) && ($bazien_theme_options['main_header_shopping_bag'] == "1") ) $header_col_right_menu_right_padding += 60;
			if ( (isset($bazien_theme_options['main_header_search_bar'])) && ($bazien_theme_options['main_header_search_bar'] == "1") ) $header_col_right_menu_right_padding += 40;
			if ( (isset($bazien_theme_options['main_header_off_canvas'])) && ($bazien_theme_options['main_header_off_canvas'] == "1") ) $header_col_right_menu_right_padding += 40;
			
			?>
			
			.header_col.right_menu {
				padding-right:<?php echo esc_html($header_col_right_menu_right_padding); ?>px;
			}
			
			<?php if ( (isset($bazien_theme_options['main_header_navigation_position_header_2'])) && ($bazien_theme_options['main_header_navigation_position_header_2'] == "1") ) : ?>
			.header_col.left_menu .main-navigation {
				text-align:right !important;
				margin:0 -15px !important;
			}
			.header_col.right_menu .main-navigation {
				text-align:left !important;
				margin:0 -15px !important;
			}
			<?php endif; ?>
			
			<?php if ( (isset($bazien_theme_options['main_header_navigation_position_header_2'])) && ($bazien_theme_options['main_header_navigation_position_header_2'] == "2") ) : ?>
			.header_col.left_menu .main-navigation {
				text-align:left !important;
				margin:0 -15px !important;
			}
			.header_col.right_menu .main-navigation {
				text-align:right !important;
				margin:0 -15px !important;
			}
			<?php endif; ?>
			
			.site-header .header-actions {
				height:30px !important;
				line-height:30px !important;
				position:absolute;
				top:2px;
				right:0;
			}
			
			<?php if ( (isset($bazien_theme_options['logo_min_height'])) && (trim($bazien_theme_options['logo_min_height']) != "" ) ) : ?>
			.header_col.branding {
				min-width:<?php echo esc_html($bazien_theme_options['logo_min_height']); ?>px;
			}
			<?php endif; ?>
		
		<?php endif; ?>
		
		
		/* header-centered-menu-under */
		
		<?php if ( (isset($bazien_theme_options['main_header_layout'])) && ($bazien_theme_options['main_header_layout'] == "3") ) : ?>
		
			.main-navigation {
				text-align:center !important;
			}
			
			.site-header .main-navigation {
				height:50px !important;
				line-height:50px !important;
				margin:10px 0 -10px 0;
			}
			
			.site-header .header-actions {
				height:30px !important;
				line-height:30px !important;
				position:absolute;
				top:2px;
				right:0;
			}
		
		<?php endif; ?>

		
		
		
		
		/***************************************************************/
		/* Footer ******************************************************/
		/***************************************************************/

		#site-footer
		{
			<?php if ( (isset($bazien_theme_options['footer_background_color'])) && (trim($bazien_theme_options['footer_background_color']) != "" ) ) : ?>
				background: <?php echo esc_html($bazien_theme_options['footer_background_color']) ?>;
			<?php endif; ?>
		}
		
		<?php if ( (isset($bazien_theme_options['footer_background_color'])) && (trim($bazien_theme_options['footer_background_color']) == "transparent" ) ) : ?>
			@media only screen and (max-width: 641px) {
				#site-footer {
					padding-top:0;
				}
			}
		<?php endif; ?>
		
		<?php if ( (isset($bazien_theme_options['footer_texts_color'])) && (trim($bazien_theme_options['footer_texts_color']) != "" ) ) : ?>
		#site-footer,
		#site-footer p,
		#site-footer .copyright_text a
		{
			color:<?php echo esc_html($bazien_theme_options['footer_texts_color']) ?>;
		}
		<?php endif; ?>
		<?php if ( (isset($bazien_theme_options['footer_heading_color'])) && (trim($bazien_theme_options['footer_heading_color']) != "" ) ) : ?>
		.site-footer-second-widget-area h3 {
			color:<?php echo esc_html($bazien_theme_options['footer_heading_color']) ?> !important; 
		}
		<?php endif; ?>
		<?php if ( (isset($bazien_theme_options['footer_links_color'])) && (trim($bazien_theme_options['footer_links_color']) != "" ) ) : ?>
		#site-footer a,
		#site-footer .widget-title,
		.footer-navigation-wrapper ul li:after
		{
			color:<?php echo esc_html($bazien_theme_options['footer_links_color']) ?>;
		}
		#site-footer a:hover {
			color:<?php echo esc_html($bazien_theme_options['main_color']) ?>;
		}
		
		<?php endif; ?>
		
		
		
		
		/***************************************************************/
		/* Breadcrumbs *************************************************/
		/***************************************************************/
		
		
		<?php if ( (isset($bazien_theme_options['breadcrumbs'])) && ($bazien_theme_options['breadcrumbs']) == "0" ) : ?>
		.woocommerce .woocommerce-breadcrumb,
		.woocommerce-page .woocommerce-breadcrumb
		{
			display:none;
		}
		<?php endif; ?>
		
		
			
		/********************************************************************/
		/* Custom CSS *******************************************************/
		/********************************************************************/
		
		<?php if ( (isset($bazien_theme_options['custom_css'])) && (trim($bazien_theme_options['custom_css']) != "" ) ) : ?>
			<?php echo esc_html($bazien_theme_options['custom_css']) ?>
		<?php endif; ?>
	</style>

<?php
$content = ob_get_clean();
$content = str_replace(array("\r\n", "\r"), "\n", $content);
$lines = explode("\n", $content);
$new_lines = array();
foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }
	echo implode($new_lines);
} //if
} //function
?>
<?php add_action( 'wp_head', 'bazien_custom_styles', 99 ); ?>