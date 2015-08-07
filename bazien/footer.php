					<?php global $page_id, $woocommerce, $bazien_theme_options; ?>
                    
                    <?php
					
					if (get_post_meta( $page_id, 'footer_meta_box_check', true )) {
						$page_footer_option = get_post_meta( $page_id, 'footer_meta_box_check', true );
					} else {
						$page_footer_option = "on";
					}
					
					?>
					
					<?php if ( $page_footer_option == "on" ) : ?>
                    
                    <footer id="site-footer" role="contentinfo">						
							<div class="site-footer-first-widget-area">
								<div class="row">
								<?php if ( is_active_sidebar( 'footer-first-area' ) ) : ?>
									<?php dynamic_sidebar( 'footer-first-area' ); ?>
								<?php endif; ?>	
									<?php if ( (isset($bazien_theme_options['footer_social_icons'])) && (trim($bazien_theme_options['footer_social_icons']) == "1" ) ) : ?>
                                    
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
                                    
                                    <?php endif; ?>									
								</div><!-- .row -->
							</div><!-- .site-footer-first-widget-area -->
                        <?php if ( is_active_sidebar( 'footer-second-area' ) ) : ?>
						<div class="site-footer-second-widget-area">
							<div class="row">
								<?php dynamic_sidebar( 'footer-second-area' ); ?>
							</div><!-- .row -->
						</div><!-- .site-footer-second-widget-area -->
						<?php endif; ?>	
                        <div class="site-footer-copyright-area">
                            <div class="row">
                                <div class="copyright_text large-7 columns">
                                    <?php if ( (isset($bazien_theme_options['footer_copyright_text'])) && (trim($bazien_theme_options['footer_copyright_text']) != "" ) ) { ?>
                                        <?php _e( $bazien_theme_options['footer_copyright_text'], 'bazien' ); ?>
                                    <?php } ?>
                                </div><!-- .copyright_text -->  
                                <div class="payment_methods large-5 columns">
                                    <?php if ( (isset($bazien_theme_options['footer_copyright_right_text'])) && (trim($bazien_theme_options['footer_copyright_right_text']) != "" ) ) { ?>
                                        <?php echo $bazien_theme_options['footer_copyright_right_text']; ?>
                                    <?php } ?>
                                </div><!-- .payment_method -->  
							</div><!-- .row --> 
                        </div><!-- .site-footer-copyright-area -->
                               
                    </footer>
                    
                    <?php endif; ?>
                    
                </div><!-- #page_wrapper -->
                    <a class="exit-off-canvas"></a>
            </div><!-- .inner-wrap -->
    </div><!-- .off-canvas-wrap -->
	<div class="overlay-top-search overlay-hugeinc">
		<button type="button" class="overlay-close-search"></button>
		<div class="site-search-inner">
		<?php
		if (class_exists('WooCommerce')) {
			the_widget( 'WC_Widget_Product_Search', 'title=' );
		} else {
			the_widget( 'WP_Widget_Search', 'title=' );
		}
		?>
		</div>
	</div>
 
    <?php if ( (isset($bazien_theme_options['footer_js'])) && ($bazien_theme_options['footer_js'] != "") ) : ?>
		<?php echo $bazien_theme_options['footer_js']; ?>
    <?php endif; ?>
	<?php wp_footer(); ?>
    
</body>

</html>