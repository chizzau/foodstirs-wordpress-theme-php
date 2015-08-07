<?php
	global $bazien_theme_options, $woocommerce;
?>

<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
	if ( (isset($bazien_theme_options['favicon']['url'])) && (trim($bazien_theme_options['favicon']['url']) != "" ) ) {
        
        if (is_ssl()) {
            $favicon_image_img = str_replace("http://", "https://", $bazien_theme_options['favicon']['url']);		
        } else {
            $favicon_image_img = $bazien_theme_options['favicon']['url'];
        }
	?>   
    <link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
        
    <?php } ?>  
    <?php if ( (isset($bazien_theme_options['header_js'])) && ($bazien_theme_options['header_js'] != "") ) : ?>
        <?php echo $bazien_theme_options['header_js']; ?>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">

            <!-- Off Canvas Menu -->

            <aside class="left-off-canvas-menu">
                <nav class="mobile-navigation primary-navigation" role="navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'main-navigation',
                        'fallback_cb'     => false,
                        'container'       => false,
                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                    ));
                    ?>
                </nav>
            </aside>
                    <?php

					$header_sticky_class = "";
					$header_transparency_class = "";
					$transparency_scheme = "";
					
					if ( (isset($bazien_theme_options['sticky_header'])) && ($bazien_theme_options['sticky_header'] == "1" ) ) {
						$header_sticky_class = "sticky_header";
					}
					
					if ( (isset($bazien_theme_options['main_header_transparency'])) && ($bazien_theme_options['main_header_transparency'] == "1" ) ) {
						$header_transparency_class = "transparent_header";
					}
					
					if ( (isset($bazien_theme_options['main_header_transparency_scheme'])) ) {
						$transparency_scheme = $bazien_theme_options['main_header_transparency_scheme'];
					}
					
					$page_id = "";
					if ( is_single() || is_page() ) {
						$page_id = get_the_ID();
					} else if ( is_home() ) {
						$page_id = get_option('page_for_posts');		
					}
					
					if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit") ) {
						$header_transparency_class = "transparent_header";
						$transparency_scheme = get_post_meta( $page_id, 'page_header_transparency', true );
					}
					
					if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
						$header_transparency_class = "";
						$transparency_scheme = "";
					}
                    if ( isset($bazien_theme_options['main_header_layout']) ) {
                        if($bazien_theme_options['main_header_layout'] == "1" ){
                            $header_layout = "";
                        }elseif($bazien_theme_options['main_header_layout'] == "2") {
                            $header_layout = "header_2";
                        }elseif($bazien_theme_options['main_header_layout'] == "3") {
                            $header_layout = "header_3";
                        }elseif($bazien_theme_options['main_header_layout'] == "4") {
	                        $header_layout = "header_4";
                        }
                    }else{
                        $header_layout = "";
                    }
					?>
                    <div id="page_wrapper" class="<?php echo $header_sticky_class; ?> <?php echo $header_transparency_class; ?> <?php echo $transparency_scheme; ?> <?php echo $header_layout;?>">
                    
                        <?php do_action( 'before' ); ?>                     
                        
                        <?php
    
						$header_max_width_style = "100%";
						if ( (isset($bazien_theme_options['header_width'])) && ($bazien_theme_options['header_width'] == "custom") ) {
							$header_max_width_style = $bazien_theme_options['header_max_width']."px";
						} else {
							$header_max_width_style = "100%";
						}
						
						?>
                        
                        <div class="top-headers-wrapper">
						
                            <?php if ( (isset($bazien_theme_options['top_bar_switch'])) && ($bazien_theme_options['top_bar_switch'] == "1" ) && $header_layout != "header_4") : ?>
                                <?php include_once('header-topbar.php'); ?>						
                            <?php endif; ?>
                            
                            <?php if ( isset($bazien_theme_options['main_header_layout']) ) : ?>
								
								<?php if ( $bazien_theme_options['main_header_layout'] == "1" ) : ?>
									<?php include_once('headers/header-default.php'); ?>
                                <?php elseif ( $bazien_theme_options['main_header_layout'] == "2" ) : ?>
                                	<?php include_once('headers/header-2.php'); ?>
                                <?php elseif ( $bazien_theme_options['main_header_layout'] == "3" ) : ?>
                                	<?php include_once('headers/header-3.php'); ?>
		                        <?php elseif ( $bazien_theme_options['main_header_layout'] == "4" ) : ?>
                                	<?php include_once('headers/header-4.php'); ?>
								<?php endif; ?>
                                
                            <?php else : ?>
                            
                            	<?php include_once('headers/header-default.php'); ?>
                            
                            <?php endif; ?>
                        
                        </div>
						
						