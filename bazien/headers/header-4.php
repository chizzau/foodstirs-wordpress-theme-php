<?php global $woocommerce; ?>

<header id="masthead" class="site-header" role="banner">
    <nav id="header4-top-menu" class="main-navigation" role="navigation">
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'top-bar-navigation',
            'fallback_cb'     => false,
            'container'       => false,
            'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
        ));
        ?>
    </nav><!-- #site-navigation-top-bar -->
	<div class="site-logo">

		<?php

		if ( (isset($bazien_theme_options['site_logo']['url'])) && (trim($bazien_theme_options['site_logo']['url']) != "" ) ) {
			if (is_ssl()) {
				$site_logo = str_replace("http://", "https://", $bazien_theme_options['site_logo']['url']);
				if ($header_transparency_class == "transparent_header")	{
					if ( ($transparency_scheme == "header_transparent_light_present") && (isset($bazien_theme_options['light_transparent_header_logo']['url'])) && (trim($bazien_theme_options['light_transparent_header_logo']['url']) != "") ) {
						$site_logo = str_replace("http://", "https://", $bazien_theme_options['light_transparent_header_logo']['url']);
					}
					if ( ($transparency_scheme == "header_transparent_dark_present") && (isset($bazien_theme_options['dark_transparent_header_logo']['url'])) && (trim($bazien_theme_options['dark_transparent_header_logo']['url']) != "") ) {
						$site_logo = str_replace("http://", "https://", $bazien_theme_options['dark_transparent_header_logo']['url']);
					}
				}
			} else {
				$site_logo = $bazien_theme_options['site_logo']['url'];
				if ($header_transparency_class == "transparent_header")	{
					if ( ($transparency_scheme == "header_transparent_light_present") && (isset($bazien_theme_options['light_transparent_header_logo']['url'])) && (trim($bazien_theme_options['light_transparent_header_logo']['url']) != "") ) {
						$site_logo = $bazien_theme_options['light_transparent_header_logo']['url'];
					}
					if ( ($transparency_scheme == "header_transparent_dark_present") && (isset($bazien_theme_options['dark_transparent_header_logo']['url'])) && (trim($bazien_theme_options['dark_transparent_header_logo']['url']) != "") ) {
						$site_logo = $bazien_theme_options['dark_transparent_header_logo']['url'];
					}
				}
			}

			if ( (isset($bazien_theme_options['sticky_header_logo']['url'])) && (trim($bazien_theme_options['sticky_header_logo']['url']) != "" ) ) {
				if (is_ssl()) {
					$sticky_header_logo = str_replace("http://", "https://", $bazien_theme_options['sticky_header_logo']['url']);
				} else {
					$sticky_header_logo = $bazien_theme_options['sticky_header_logo']['url'];
				}
			}


			?>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="site-logo-image" src="<?php echo esc_url($site_logo); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				<?php if ( (isset($bazien_theme_options['sticky_header_logo']['url'])) && (trim($bazien_theme_options['sticky_header_logo']['url']) != "" ) ) { ?>
					<img class="sticky-logo" src="<?php echo esc_url($sticky_header_logo); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				<?php } ?>
			</a>

		<?php } else { ?>

			<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>

		<?php } ?>

	</div><!-- .site-logo -->

    <div class="header-actions">

        <ul>
            <li class="mobile-canvas-menu"><a class="left-off-canvas-toggle" href="#" ><span class="tools_button_icon"><i class="fa fa-bars"></i></span></a></li>
            <?php if ( (isset($bazien_theme_options['main_header_search_bar'])) && ($bazien_theme_options['main_header_search_bar'] == "1") ) : ?>
                <li class="search-button">
                    <a id="trigger-overlay" class="tools_button">
                                <span class="tools_button_icon">
                                    <i class="fa fa-search"></i>
                                </span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ( (isset($bazien_theme_options['main_header_shopping_bag'])) && ($bazien_theme_options['main_header_shopping_bag'] == "1") ) : ?>
                <?php if ( (isset($bazien_theme_options['catalog_mode'])) && ($bazien_theme_options['catalog_mode'] == 1) ) : ?>
                <?php else:?>
                    <?php if (class_exists('WooCommerce')) : ?>
                        <li class="shopping-bag-button">
                            <a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="tools_button">
                                <span class="tools_button_icon"><i class="fa fa-shopping-cart"></i></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </ul>

    </div><!-- .header-actions -->
	<div class="sidebar-navigation">
	<?php
	wp_nav_menu(array(
		'theme_location' => 'main-navigation',
		'container' => '',
		'menu_class' => 'main-menu sidebar-menu',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'fallback_cb' => false,
		'walker' => new bazien_sidebar_navwalker
	));
	?>
    <?php if ( (isset($bazien_theme_options['main_header_shopping_bag'])) && ($bazien_theme_options['main_header_shopping_bag'] == "1") ) : ?>
        <?php if ( (isset($bazien_theme_options['catalog_mode'])) && ($bazien_theme_options['catalog_mode'] == 1) ) : ?>
        <?php else:?>
            <?php echo bazien_minicart_header_2()?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ( (isset($bazien_theme_options['main_header_search_bar'])) && ($bazien_theme_options['main_header_search_bar'] == "1") ) : ?>
        <div class="search-header-4">
            <?php
            if (class_exists('WooCommerce')) {
                the_widget( 'WC_Widget_Product_Search', 'title=' );
            } else {
                the_widget( 'WP_Widget_Search', 'title=' );
            }
            ?>
        </div>
    <?php endif; ?>
	</div>

    <?php if ( (isset($bazien_theme_options['footer_copyright_text'])) && (trim($bazien_theme_options['footer_copyright_text']) != "" ) ) { ?>
        <div class="header-4-copyright-text">
            <?php _e( $bazien_theme_options['footer_copyright_text'], 'bazien' ); ?>
        </div>
    <?php } ?>
    <?php if ( (isset($bazien_theme_options['footer_social_icons'])) && (trim($bazien_theme_options['footer_social_icons']) == "1" ) ) : ?>
        <div class="header-4-socials">
            <ul class="footer_socials_wrapper">

                <?php

                $facebook = "";
                $pinterest = "";
                $linkedin = "";
                $twitter = "";
                $googleplus = "";
                $rss = "";
                $tumblr = "";
                $instagram = "";
                $youtube = "";
                $vimeo = "";
                $behance = "";
                $dribble = "";
                $flickr = "";
                $git = "";
                $skype = "";
                $weibo = "";
                $foursquare = "";
                $soundcloud = "";

                if ( isset ($bazien_theme_options['facebook_link']) ) $facebook = $bazien_theme_options['facebook_link'];
                if ( isset ($bazien_theme_options['pinterest_link']) ) $pinterest = $bazien_theme_options['pinterest_link'];
                if ( isset ($bazien_theme_options['linkedin_link']) ) $linkedin = $bazien_theme_options['linkedin_link'];
                if ( isset ($bazien_theme_options['twitter_link']) ) $twitter = $bazien_theme_options['twitter_link'];
                if ( isset ($bazien_theme_options['googleplus_link']) ) $googleplus = $bazien_theme_options['googleplus_link'];
                if ( isset ($bazien_theme_options['rss_link']) ) $rss = $bazien_theme_options['rss_link'];
                if ( isset ($bazien_theme_options['tumblr_link']) ) $tumblr = $bazien_theme_options['tumblr_link'];
                if ( isset ($bazien_theme_options['instagram_link']) ) $instagram = $bazien_theme_options['instagram_link'];
                if ( isset ($bazien_theme_options['youtube_link']) ) $youtube = $bazien_theme_options['youtube_link'];
                if ( isset ($bazien_theme_options['vimeo_link']) ) $vimeo = $bazien_theme_options['vimeo_link'];
                if ( isset ($bazien_theme_options['behance_link']) ) $behance = $bazien_theme_options['behance_link'];
                if ( isset ($bazien_theme_options['dribble_link']) ) $dribble = $bazien_theme_options['dribble_link'];
                if ( isset ($bazien_theme_options['flickr_link']) ) $flickr = $bazien_theme_options['flickr_link'];
                if ( isset ($bazien_theme_options['git_link']) ) $git = $bazien_theme_options['git_link'];
                if ( isset ($bazien_theme_options['skype_link']) ) $skype = $bazien_theme_options['skype_link'];
                if ( isset ($bazien_theme_options['weibo_link']) ) $weibo = $bazien_theme_options['weibo_link'];
                if ( isset ($bazien_theme_options['foursquare_link']) ) $foursquare = $bazien_theme_options['foursquare_link'];
                if ( isset ($bazien_theme_options['soundcloud_link']) ) $soundcloud = $bazien_theme_options['soundcloud_link'];

                if ( $facebook != "" ) echo('<li><a href="' . $facebook . '" target="_blank" class="social_media"><i class="fa fa-facebook"></i></a></li>' );
                if ( $pinterest != "" ) echo('<li><a href="' . $pinterest . '" target="_blank" class="social_media"><i class="fa fa-pinterest"></i></a></li>' );
                if ( $linkedin != "" ) echo('<li><a href="' . $linkedin . '" target="_blank" class="social_media"><i class="fa fa-linkedin"></i></a></li>' );
                if ( $twitter != "" ) echo('<li><a href="' . $twitter . '" target="_blank" class="social_media"><i class="fa fa-twitter"></i></a></li>' );
                if ( $googleplus != "" ) echo('<li><a href="' . $googleplus . '" target="_blank" class="social_media"><i class="fa fa-google-plus"></i></a></li>' );
                if ( $rss != "" ) echo('<li><a href="' . $rss . '" target="_blank" class="social_media"><i class="fa fa-rss"></i></a></li>' );
                if ( $tumblr != "" ) echo('<li><a href="' . $tumblr . '" target="_blank" class="social_media"><i class="fa fa-tumblr"></i></a></li>' );
                if ( $instagram != "" ) echo('<li><a href="' . $instagram . '" target="_blank" class="social_media"><i class="fa fa-instagram"></i></a></li>' );
                if ( $youtube != "" ) echo('<li><a href="' . $youtube . '" target="_blank" class="social_media"><i class="fa fa-youtube"></i></a></li>' );
                if ( $vimeo != "" ) echo('<li><a href="' . $vimeo . '" target="_blank" class="social_media"><i class="fa fa-vimeo-square"></i></a></li>' );
                if ( $behance != "" ) echo('<li><a href="' . $behance . '" target="_blank" class="social_media"><i class="fa fa-behance"></i></a></li>' );
                if ( $dribble != "" ) echo('<li><a href="' . $dribble . '" target="_blank" class="social_media"><i class="fa fa-dribbble"></i></a></li>' );
                if ( $flickr != "" ) echo('<li><a href="' . $flickr . '" target="_blank" class="social_media"><i class="fa fa-flickr"></i></a></li>' );
                if ( $git != "" ) echo('<li><a href="' . $git . '" target="_blank" class="social_media"><i class="fa fa-git"></i></a></li>' );
                if ( $skype != "" ) echo('<li><a href="' . $skype . '" target="_blank" class="social_media"><i class="fa fa-skype"></i></a></li>' );
                if ( $weibo != "" ) echo('<li><a href="' . $weibo . '" target="_blank" class="social_media"><i class="fa fa-weibo"></i></a></li>' );
                if ( $foursquare != "" ) echo('<li><a href="' . $foursquare . '" target="_blank" class="social_media"><i class="fa fa-foursquare"></i></a></li>' );
                if ( $soundcloud != "" ) echo('<li><a href="' . $soundcloud . '" target="_blank" class="social_media"><i class="fa fa-soundcloud"></i></a></li>' );

                ?>

            </ul>
        </div>
    <?php endif; ?>
</header><!-- #masthead -->


