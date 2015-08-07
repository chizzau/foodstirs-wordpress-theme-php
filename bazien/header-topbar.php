<?php
	global $bazien_theme_options;
?>
<div id="site-top-bar">
    <div class="row">		
        <div class="large-6 columns"><?php if ( isset($bazien_theme_options['top_bar_text']) ) _e( $bazien_theme_options['top_bar_text'], 'bazien' ); ?></div><!-- .columns -->
        <div class="large-6 columns">
            <nav id="site-navigation-top-bar" class="main-navigation" role="navigation">                    
                <?php 
                    wp_nav_menu(array(
                        'theme_location'  => 'top-bar-navigation',
                        'fallback_cb'     => false,
                        'container'       => false,
                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                    ));
                ?>
                <?php if ( is_user_logged_in() ) { ?>
                    <ul><li class="logout-link"><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php _e('Logout', 'bazien'); ?></a></li></ul>
                <?php } ?>          
            </nav><!-- #site-navigation-top-bar -->
          </div><!-- .columns -->
    </div><!-- .row -->    
</div><!-- #site-top-bar -->