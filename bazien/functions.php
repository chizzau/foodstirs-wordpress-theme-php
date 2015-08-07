<?php

/******************************************************************************/
/***************************** LOAD TEXT DOMAIN *******************************/
/******************************************************************************/
load_theme_textdomain( 'bazien', get_template_directory() . '/languages' );

/******************************************************************************/
/***************************** THEME OPTIONS **********************************/
/******************************************************************************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/redux/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/redux/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/theme-options.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/theme-options.php' );
}

global $bazien_theme_options;

// frontend presets
if (isset($_GET["_version"])) {
    $preset = $_GET["_version"];
} else {
    $preset = "";
}

if ($preset != "") {
    if ( file_exists( dirname( __FILE__ ) . '/_version/'.$preset.'.json' ) ) {
        $theme_options_json = file_get_contents( dirname( __FILE__ ) . '/_version/'.$preset.'.json' );
        $bazien_theme_options = json_decode($theme_options_json, true);
    }
}
/******************************************************************************/
/******************************** INCLUDED ************************************/
/******************************************************************************/	

include_once('nova-framework/custom-styles/custom-styles.php'); // Load Custom Styles
include_once('nova-framework/templates/post-meta.php'); // Load Post meta template
include_once('nova-framework/templates/template-tags.php'); // Load Template Tags

include_once('nova-framework/widgets/widget-recent-posts.php'); // Load Widget Recent Posts


//Include Shortcodes
include_once('nova-framework/shortcodes/product-categories.php');
include_once('nova-framework/shortcodes/product-blocks.php');
include_once('nova-framework/shortcodes/socials.php');
include_once('nova-framework/shortcodes/from-the-blog.php');
include_once('nova-framework/shortcodes/google-map.php');
include_once('nova-framework/shortcodes/block-title.php');
include_once('nova-framework/shortcodes/page-title.php');
include_once('nova-framework/shortcodes/animated-heading.php');
include_once('nova-framework/shortcodes/nova-buttons.php');
include_once('nova-framework/shortcodes/nova-brands-brands-slider.php');
include_once('nova-framework/shortcodes/portfolio.php');
include_once('nova-framework/shortcodes/portfolio_2.php');
include_once('nova-framework/shortcodes/add-to-cart.php');
include_once('nova-framework/shortcodes/wc-mod-product.php');
include_once('nova-framework/shortcodes/social_icons.php');



//Include Metaboxes
include_once('nova-framework/metaboxes/page.php');

//Custom Menu
include_once('nova-framework/nova-menu/menu.php');

// Plugins
include_once('nova-framework/plugins/aq_resizer.php');


/******************************************************************************/
/************************ PLUGIN RECOMMENDATIONS ******************************/
/******************************************************************************/

require_once dirname( __FILE__ ) . '/nova-framework/tgm/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/nova-framework/tgm/plugins.php';





/******************************************************************************/
/*************************** VISUAL COMPOSER **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
		
		//enable vc on post types
		if(function_exists('vc_set_default_editor_post_types')) vc_set_default_editor_post_types( array('post','page','product','portfolio','block') );
		
		if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);
		vc_disable_frontend();
		
		// Modify and remove existing shortcodes from VC
		include_once('nova-framework/visual-composer/custom_vc.php');
		
		// VC Templates
		$vc_templates_dir = get_template_directory() . '/nova-framework/visual-composer/vc_templates/';
		vc_set_template_dir($vc_templates_dir);
		
		// Add custom field
		include_once('nova-framework/visual-composer/elements/icon-field.php');
		
		// Add new shortcodes to VC
		include_once('nova-framework/visual-composer/from-the-blog.php');
		include_once('nova-framework/visual-composer/social-media-profiles.php');
		include_once('nova-framework/visual-composer/google-map.php');
		include_once('nova-framework/visual-composer/banner.php');
		include_once('nova-framework/visual-composer/block-title.php');
		include_once('nova-framework/visual-composer/page-title.php');
		include_once('nova-framework/visual-composer/animated-heading.php');
		include_once('nova-framework/visual-composer/nova-buttons.php');
		include_once('nova-framework/visual-composer/portfolio.php');
        include_once('nova-framework/visual-composer/portfolio_2.php');
		
		// Add new Shop shortcodes to VC
		if (class_exists('WooCommerce')) {
			include_once('nova-framework/visual-composer/wc-recent-products.php');
			include_once('nova-framework/visual-composer/wc-featured-products.php');
			include_once('nova-framework/visual-composer/wc-products-by-category.php');
			include_once('nova-framework/visual-composer/wc-products-by-attribute.php');
			include_once('nova-framework/visual-composer/wc-product-by-id-sku.php');
			include_once('nova-framework/visual-composer/wc-products-by-ids-skus.php');
			include_once('nova-framework/visual-composer/wc-sale-products.php');
			include_once('nova-framework/visual-composer/wc-top-rated-products.php');
			include_once('nova-framework/visual-composer/wc-best-selling-products.php');
			include_once('nova-framework/visual-composer/wc-add-to-cart-button.php');
			include_once('nova-framework/visual-composer/wc-product-categories.php');
			include_once('nova-framework/visual-composer/wc-product-categories-grid.php');
		}
		
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}

}


/******************************************************************************/
/*************************** BAZIEN SETUP *************************************/
/******************************************************************************/


if ( ! function_exists( 'bazien_setup' ) ) :
function bazien_setup() {
	
	global $bazien_theme_options;
	
	/** Theme support **/
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce');
	add_theme_support( 'title-tag');

	function custom_header_custom_bg() {
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
	}
	add_post_type_support('page', 'excerpt');

    /** Add post formats (http://codex.wordpress.org/Post_Formats) **/

    add_theme_support( 'structured-post-formats', array(
        'link',
        'video'
    ) );

    add_theme_support( 'post-formats', array(
        'quote',
        'image',
        'video',
        'link',
        'audio'
    ) );

	/** Add Image Sizes **/
	$shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
	$shop_single_image_size = get_option( 'shop_single_image_size' );
	add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, $shop_catalog_image_size['crop']); // made from shop_catalog_image_size
	add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, $shop_single_image_size['crop']); // made from shop_single_image_size
	add_image_size( 'blog-standard', 870, 360, true );
	add_image_size( 'mini_list_thumbnail', 349, 433, true );

	/** Register menus **/	
	register_nav_menus( array(
		'top-bar-navigation' => __( 'Top Bar Navigation', 'bazien' ),
		'main-navigation' => __( 'Main Navigation', 'bazien' ),
	) );

	
	/** WooCommerce Number of products displayed per page **/	
	if ( (isset($bazien_theme_options['products_per_page'])) ) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $bazien_theme_options['products_per_page'] . ';' ), 20 );
	}

}
endif; // bazien_setup
add_action( 'after_setup_theme', 'bazien_setup' );

/******************************************************************************/
/**************************** ENQUEUE STYLES **********************************/
/******************************************************************************/

// frontend
function bazien_styles() {
	
	global $bazien_theme_options;

	wp_enqueue_style('bazien-normalize', get_template_directory_uri() . '/css/normalize.css', array(), '3.0.2', 'all' );		
	wp_enqueue_style('bazien-foundation', get_template_directory_uri() . '/css/foundation.min.css', array(), '5.5.1', 'all' );	
	wp_enqueue_style('bazien-animate', get_template_directory_uri() . '/css/animate.css', array(), '2.0', 'all' );
	
	wp_enqueue_style('bazien-icon-font', get_template_directory_uri() . '/css/icon-fonts.min.css', array(), '4.2.0', 'all' );
	wp_enqueue_style('bazien-fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '1.3.0', 'all' );
	wp_enqueue_style('bazien-idangerous-swiper', get_template_directory_uri() . '/css/idangerous.swiper.css', array(), '2.3', 'all' );
	wp_enqueue_style('bazien-owl', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.1', 'all' );
	wp_enqueue_style('bazien-owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.1', 'all' );
	wp_enqueue_style('bazien-easy-responsive-tabs', get_template_directory_uri() . '/css/easy-responsive-tabs.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('bazien-default-style', get_stylesheet_uri());
	wp_enqueue_style('bazien-select2', get_template_directory_uri() . '/css/select2.css', array(), '3.4.5', 'all' );
	wp_enqueue_style('bazien-easyzoom', get_template_directory_uri() . '/css/easyzoom.css', array(), '1.0', 'all' );
	wp_enqueue_style('bazien-defaults', get_template_directory_uri() . '/css/defaults.css', array(), '1.0', 'all' );
	wp_enqueue_style('bazien-nova-woocommerce', get_template_directory_uri() . '/css/nova-woocommerce.css', array(), '1.1', 'all' );
	wp_enqueue_style('bazien-top-bar', get_template_directory_uri() . '/css/header-topbar.css', array(), '1.1', 'all' );
	wp_enqueue_style('bazien-headers', get_template_directory_uri() . '/css/headers.css', array(), '1.0', 'all' );
	wp_enqueue_style('bazien-navigations', get_template_directory_uri() . '/css/navigations.css', array(), '1.1', 'all' );
	wp_enqueue_style('bazien-top-search', get_template_directory_uri() . '/css/default-top-search.css', array(), '1.1', 'all' );
    if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
        wp_dequeue_style('jquery-colorbox');
        wp_enqueue_style('bazien-colorbox', get_template_directory_uri() . '/css/colorbox.css', array(), '1.0', 'all');
    }
	
	if ( isset($bazien_theme_options['main_header_layout']) ) {		
		if ( $bazien_theme_options['main_header_layout'] == "1" ) {
			wp_enqueue_style('bazien-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );
		} 		
		elseif ( $bazien_theme_options['main_header_layout'] == "2" ) {
			wp_enqueue_style('bazien-header-layout-2', get_template_directory_uri() . '/css/header-2.css', array(), '1.0', 'all' );
		}
		elseif ( $bazien_theme_options['main_header_layout'] == "3" ) {
			wp_enqueue_style('bazien-header-layout-3', get_template_directory_uri() . '/css/header-3.css', array(), '1.0', 'all' );
		}
		elseif ( $bazien_theme_options['main_header_layout'] == "4" ) {
			wp_enqueue_style( 'bazien-header-layout-4', get_template_directory_uri() . '/css/header-4.css', array(), '1.0', 'all' );
		}
	}		
	else {	
		wp_enqueue_style('bazien-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );	
	}
	
	if (isset($bazien_theme_options['font_source']) && ($bazien_theme_options['font_source'] == "2")) {
		if ( (isset($bazien_theme_options['font_google_code'])) && ($bazien_theme_options['font_google_code'] != "") ) {
			wp_enqueue_style('bazien-font_google_code', $bazien_theme_options['font_google_code'], array(), '1.0', 'all' );
		}
	}
	
	wp_enqueue_style('bazien-main-css', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all' );
	wp_enqueue_style('bazien-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all' );

}
add_action( 'wp_enqueue_scripts', 'bazien_styles', 99 );



// admin area
function bazien_admin_styles() {
    if ( is_admin() ) {
        
		wp_enqueue_style("wp-color-picker");
		wp_enqueue_style("bazien_admin_styles", get_template_directory_uri() . "/css/wp-admin-custom.css", false, "1.0", "all");
    }
}
add_action( 'admin_enqueue_scripts', 'bazien_admin_styles' );







/******************************************************************************/
/*************************** ENQUEUE SCRIPTS **********************************/
/******************************************************************************/

// frontend
function bazien_scripts() {
	
	global $bazien_theme_options;
	
	/** In Header **/
	
	wp_enqueue_script('bazien-google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', array(), '1.0', FALSE);
	
	if (isset($bazien_theme_options['font_source']) && ($bazien_theme_options['font_source'] == "3")) {
		if ( (isset($bazien_theme_options['font_typekit_kit_id'])) && ($bazien_theme_options['font_typekit_kit_id'] != "") ) {
			wp_enqueue_script('bazien-font_typekit', '//use.typekit.net/'.$bazien_theme_options['font_typekit_kit_id'].'.js', array(), NULL, FALSE );
			wp_enqueue_script('bazien-font_typekit_exec', get_template_directory_uri() . '/js/typekit.js', array(), NULL, FALSE );
		}
	}	
	
	/** In Footer **/
    wp_enqueue_script('bazien-foundation', get_template_directory_uri() . '/js/foundation/foundation.min.js', array('jquery'), '5.0', TRUE);
    wp_enqueue_script('bazien-foundation-dropdown', get_template_directory_uri() . '/js/foundation/foundation.offcanvas.js', array('jquery'), '5.5.2', TRUE);
	wp_enqueue_script('bazien-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.6.5', TRUE);
	wp_enqueue_script('bazien-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0.3', TRUE);
	wp_enqueue_script('bazien-idangerous-swiper', get_template_directory_uri() . '/js/idangerous.swiper-2.4.1.min.js', array('jquery'), '2.4.1', TRUE);
	wp_enqueue_script('bazien-owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.3.1', TRUE);
	wp_enqueue_script('bazien-fresco', get_template_directory_uri() . '/js/fresco.js', array('jquery'), '1.3.0', TRUE);
	wp_enqueue_script('bazien-select2', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), '3.5.1', TRUE);
	wp_enqueue_script('bazien-stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), '0.6.2', TRUE);
	wp_enqueue_script('bazien-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '2.7.1', TRUE);
    wp_enqueue_script('bazien-hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery'), '1.8.0', TRUE);
	
	wp_enqueue_script('bazien-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '2.0.0', TRUE);
	wp_enqueue_script('bazien-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array('jquery'), '3.1.4', TRUE);
	wp_enqueue_script('bazien-classie', get_template_directory_uri() . '/js/classie.js', array('jquery'), '1.0', TRUE);
	wp_enqueue_script('bazien-easyzoom', get_template_directory_uri() . '/js/easyzoom.js', array('jquery'), '1.0', TRUE);
	wp_enqueue_script('bazien-default-top-search', get_template_directory_uri() . '/js/default-top-search.js', array('jquery'), '1.0', TRUE);
	wp_enqueue_script('bazien-easyResponsiveTabs', get_template_directory_uri() . '/js/easyResponsiveTabs.js', array('jquery'), '1.0', TRUE);
	
	wp_enqueue_script('bazien-scripts', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0', TRUE);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'bazien_scripts', 99 );



// admin area
function bazien_admin_scripts() {
    if ( is_admin() ) {
        global $post_type;
        if (function_exists('add_thickbox'))
            add_thickbox();

        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script('bazien-admin-menu', get_template_directory_uri() .'/js/wp-admin-menu.js', array('common', 'jquery', 'media-upload', 'thickbox'),false, '1.0');
		if ( (isset($_GET['post_type']) && ($_GET['post_type'] == 'portfolio')) || ($post_type == 'portfolio')) :
			wp_enqueue_script("bazien_admin_scripts", get_template_directory_uri() . "/js/wp-admin-portfolio.js", array('wp-color-picker'), false, "1.0");
		endif;
		
    }
}
add_action( 'admin_enqueue_scripts', 'bazien_admin_scripts' );





/*********************************************************************************************/
/******************************** TWEAK WP ADMIN BAR  ****************************************/
/*********************************************************************************************/

add_action( 'wp_head', 'bazien_override_toolbar_margin', 11 );
function bazien_override_toolbar_margin() {	
	if ( is_admin_bar_showing() ) {
		?>
			<style type="text/css" media="screen">
				@media only screen and (max-width: 80em) {
					html { margin-top: 0 !important; }
					* html body { margin-top: 0 !important; }
				}
			</style>
		<?php 
	}
}




/*********************************************************************************************/
/******************************** TITLE FORMAT  **********************************************/
/*********************************************************************************************/

function bazien_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'bazien_name_wp_title', 10, 2 );


/******************************************************************************/
/***************************** REGISTER SIDEBAR *******************************/
/******************************************************************************/

function bazien_widgets_init() {
	
	$sidebars_widgets = wp_get_sidebars_widgets();	
	$footer_area_widgets_counter = "0";	
	if (isset($sidebars_widgets['footer-second-area'])) $footer_area_widgets_counter  = count($sidebars_widgets['footer-second-area']);
	
	switch ($footer_area_widgets_counter) {
		case 0:
			$footer_area_widgets_columns ='large-12';
			break;
		case 1:
			$footer_area_widgets_columns ='large-12';
			break;
		case 2:
			$footer_area_widgets_columns ='large-6';
			break;
		case 3:
			$footer_area_widgets_columns ='large-4';
			break;
		case 4:
			$footer_area_widgets_columns ='large-3';
			break;
		default:
			$footer_area_widgets_columns ='large-3';
	}
	
	//default sidebar
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'bazien' ),
		'id'            => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	//footer first widget area
	register_sidebar( array(
		'name'          => __( 'Footer First Widget Area', 'bazien' ),
		'id'            => 'footer-first-area',
		'before_widget' => '<div class="large-12 columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	//footer second widget area
	register_sidebar( array(
		'name'          => __( 'Footer Second Widget Area', 'bazien' ),
		'id'            => 'footer-second-area',
		'before_widget' => '<div class="'.$footer_area_widgets_columns.' columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span><p class="line-ft"></p></h3>',
	) );	
	//catalog widget area
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'bazien' ),
		'id'            => 'catalog-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'bazien_widgets_init' );





/******************************************************************************/
/****** Remove Woocommerce prettyPhoto ***********************************************/
/******************************************************************************/

add_action( 'wp_enqueue_scripts', 'bazien_remove_woo_lightbox', 99 );
function bazien_remove_woo_lightbox() {
    wp_dequeue_script('prettyPhoto-init');
}



/******************************************************************************/
/****** Add Fresco to Galleries ***********************************************/
/******************************************************************************/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd', 10, 6);
function sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<a class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}

/******************************************************************************/
/********* Limit text for blog sumary *****************************************/
/******************************************************************************/

function nova_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/******************************************************************************/
/* Change breadcrumb separator on woocommerce page ****************************/
/******************************************************************************/

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'  
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}

/******************************************************************************/
/**************** Add em paginate *********************************************/
/******************************************************************************/

function emm_paginate($args = null) {
    $defaults = array(
        'page' => null, 'pages' => null,
        'range' => 3, 'gap' => 3, 'anchor' => 1,
        'before' => '<div class="emm-paginate">', 'after' => '</div>',
        'title' => __('Pages:','novaworks'),
        'nextpage' => '&raquo;',
        'previouspage' => '&laquo',
        'echo' => 1
    );

    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    if (!$page && !$pages) {
        global $wp_query;

        $page = get_query_var('paged');
        $page = !empty($page) ? intval($page) : 1;

        $posts_per_page = intval(get_query_var('posts_per_page'));
        $pages = intval(ceil($wp_query->found_posts / $posts_per_page));
    }

    $output = "";
    if ($pages > 1) {
        $output .= "$before<span class='emm-title'>$title</span>";
        $ellipsis = "<span class='emm-gap'>...</span>";

        if ($page > 1 && !empty($previouspage)) {
            $output .= "<a href='" . esc_url( get_pagenum_link($page - 1) ) . "' class='emm-prev'>$previouspage</a>";
        }

        $min_links = $range * 2 + 1;
        $block_min = min($page - $range, $pages - $min_links);
        $block_high = max($page + $range, $min_links);
        $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
        $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

        if ($left_gap && !$right_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $pages, $page)
            );
        }
        else if ($left_gap && $right_gap) {
            $output .= sprintf('%s%s%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else if ($right_gap && !$left_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else {
            $output .= emm_paginate_loop(1, $pages, $page);
        }

        if ($page < $pages && !empty($nextpage)) {
            $output .= "<a href='" . esc_url( get_pagenum_link($page + 1) ) . "' class='emm-next'>$nextpage</a>";
        }

        $output .= $after;
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}

function emm_paginate_loop($start, $max, $page = 0) {
    $output = "";
    for ($i = $start; $i <= $max; $i++) {
        $output .= ($page === intval($i))
            ? "<span class='emm-page emm-current'>$i</span>"
            : "<a href='" . esc_url( get_pagenum_link($i) ) . "' class='emm-page'>$i</a>";
    }
    return $output;
}

/******************************************************************************/
/****** Add Font Awesome to Redux *********************************************/
/******************************************************************************/

function newIconFont() {

    wp_register_style(
        'redux-font-awesome',
        get_template_directory_uri() . '/nova-framework/fonts/font-awesome/css/font-awesome.min.css',
        array(),
        time(),
        'all'
    );  
    wp_enqueue_style( 'redux-font-awesome' );
}
add_action( 'redux/page/bazien_theme_options/enqueue', 'newIconFont' );




/******************************************************************************/
/* Remove Admin Bar - Only display to administrators **************************/
/******************************************************************************/

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}


/******************************************************************************/
/* WooCommerce Number of Related Products *************************************/
/******************************************************************************/

function woocommerce_output_related_products() {
	$atts = array(
		'posts_per_page' => '6',
		'orderby'        => 'rand'
	);
	woocommerce_related_products($atts);
}






/******************************************************************************/
/* WooCommerce Add data-src & lazyOwl to Thumbnails ***************************/
/******************************************************************************/

function woocommerce_get_product_thumbnail( $size = 'product_small_thumbnail', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	if ( has_post_thumbnail() ) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_catalog' );
		return get_the_post_thumbnail( $post->ID, $size, array('data-src' => $image_src[0], 'class' => 'lazyOwl') );
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}




/******************************************************************************/
/* WooCommerce remove review tab **********************************************/
/******************************************************************************/

if ( (isset($bazien_theme_options['review_tab'])) && ($bazien_theme_options['review_tab'] == "0" ) ) {
add_filter( 'woocommerce_product_tabs', 'bazien_remove_reviews_tab', 98);
	function bazien_remove_reviews_tab($tabs) {
		unset($tabs['reviews']);
		return $tabs;
	}
}
/******************************************************************************/
/********* WooCommerce Mini Cart **********************************************/
/******************************************************************************/
function bazien_minicart() {
    global $woocommerce;

    ob_start();
    if ( class_exists( 'WooCommerce' ) ) :
        $_cartQty = $woocommerce->cart->cart_contents_count;
        ?>
        <div id="mini-cart" class="dropdown mini-cart">
            <div class="show-for-large-up">
                <div class="dropdown-toggle cart-head">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="cart-items"><?php echo (($_cartQty > 0) ? $_cartQty : '0'); ?></span>
                </div>
                <div class="dropdown-menu cart-popup widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <div class="cart-loading"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;

    return ob_get_clean();
}
function bazien_minicart_header_2() {
    global $woocommerce;

    ob_start();
    if ( class_exists( 'WooCommerce' ) ) :
        $_cartQty = $woocommerce->cart->cart_contents_count;
        ?>
        <div id="mini-cart" class="dropdown mini-cart header_2">
            <div class="dropdown-toggle cart-head">
                <span class="title"><?php echo __('Shopping Cart', 'bazien');?></span>
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-items"><?php echo (($_cartQty > 0) ? $_cartQty : '0'); ?></span>
            </div>
            <div class="dropdown-menu cart-popup widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <div class="cart-loading"></div>
                </div>
            </div>
        </div>
    <?php
    endif;

    return ob_get_clean();
}
function bazien_woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $porto_settings;

    $_cartQty = WC()->cart->cart_contents_count;
    $fragments['#mini-cart .cart-items'] = '<span class="cart-items">'.$_cartQty.'</span>';

    return $fragments;
}
add_filter('add_to_cart_fragments', 'bazien_woocommerce_header_add_to_cart_fragment');



/******************************************************************************/
/******				 Quickview Button		***********************************/
/******************************************************************************/
if (class_exists('jckqv')) {
	function nova_quickview_button($prodId = false){
		global $post;
		$prodId = ($prodId) ? $prodId : $post->ID;
		
		if($prodId){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $prodId ), 'medium' );
			echo '<a data-jckqvpid="'.$prodId.'" class="quickview_button"><i class="fa fa-search"></i></a>';
		}
	}	
}
/******************************************************************************/
/******				 Compare Button 		***********************************/
/******************************************************************************/
 
if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
	$wc_compare = new YITH_Woocompare_Frontend();
	function nova_add_compare_details_link( $product_id = false, $args = array() ) {
		global $wc_compare;
		remove_action( 'woocommerce_single_product_summary', array( $wc_compare, 'add_compare_link' ), 35 );
	    extract( $args );
	
	    if ( ! $product_id ) {
	        global $product;
	        $product_id = isset( $product->id ) && $product->exists() ? $product->id : 0;
	    }
	
	    // return if product doesn't exist
	    if ( empty( $product_id ) ) return;
	
	    $is_button = !isset( $button_or_link ) || !$button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;
	
	    printf( '<a href="%s" class="%s" data-product_id="%d">%s</a>', $wc_compare->add_product_url( $product_id ), 'compare nova-compare compare_details_overhead', $product_id, ( __( 'Compare', 'yit' ) ) );
	}
	function nova_add_compare_link( $product_id = false, $args = array() ) {
		global $wc_compare;
		remove_action( 'woocommerce_after_shop_loop_item', array( $wc_compare, 'add_compare_link' ), 20 );
	    extract( $args );
	
	    if ( ! $product_id ) {
	        global $product;
	        $product_id = isset( $product->id ) && $product->exists() ? $product->id : 0;
	    }
	
	    // return if product doesn't exist
	    if ( empty( $product_id ) ) return;
	
	    $is_button = !isset( $button_or_link ) || !$button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;
	
	    printf( '<a href="%s" class="%s" data-product_id="%d">%s</a>', $wc_compare->add_product_url( $product_id ), 'compare nova-compare', $product_id, ( __( '<i class="fa fa-retweet"></i>', 'yit' ) ) );
	}
}

function nova_wishlist_button() {
    global $product, $yith_wcwl;

    if ( class_exists( 'YITH_WCWL_UI' ) )  {
        $url = $yith_wcwl->get_wishlist_url();
        $product_type = $product->product_type;
        $exists = $yith_wcwl->is_product_in_wishlist( $product->id );

        $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';

        $html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-' . $product->id . '">';
        $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

        $html .= $exists ? ' hide" style="display:none;"' : ' show"';

        $html .= '><a href="' . esc_url( htmlspecialchars($yith_wcwl->get_addtowishlist_url()) ) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' >'.__("Wishlist","woocommerce").'</a>';
        $html .= '</div>';

        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <a href="' . esc_url( $url ) . '">'.__("<span class='txt-wishlist'>Wishlist</span>","woocommerce").'</a></div>';
        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '">'.__("<span class='txt-wishlist'>Wishlist</span>","woocommerce").'</a></div>';
        $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

        $html .= '</div>';

        return $html;

    }

}
/******************************************************************************/
/******   WooCommerce Grid / List toggle	***********************************/
/******************************************************************************/
if (class_exists('WC_List_Grid')) {
	add_action( 'wp','nova_setup_gridlist');
	function nova_setup_gridlist() {
		wp_enqueue_script('grid-list-scripts', get_template_directory_uri() . '/js/jquery.gridlistview.min.js', array('jquery'));

	}
	function nova_gridlist_toggle_button() {
	?>
			<nav class="nova_gridlist_toggle">
				<a href="#" id="grid" title="<?php _e('Grid view', 'wc_list_grid_toggle'); ?>" class="active"><i class="icon sline-grid"></i></span></a>
				<a href="#" id="list" title="<?php _e('List view', 'wc_list_grid_toggle'); ?>"><i class="icon sline-list"></i></span></a>
			</nav>
		<?php
	}
}
/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'bazien_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function bazien_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '434',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '570',	// px
		'height'	=> '706',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '70',	// px
		'height'	=> '87',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/**
 * Remove cart total in collateral
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

if ( ! isset( $content_width ) ) $content_width = 900;