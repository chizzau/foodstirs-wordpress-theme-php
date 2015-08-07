<?php
// [share]
function nova_share_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'style'  => '',
	), $atts));
	global $post, $bazien_theme_options;
	$permalink = get_permalink($post->ID);
	$featured_image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
	$featured_image_2 = $featured_image['0'];
	$post_title = rawurlencode(get_the_title($post->ID));
	ob_start();
	?>

	<div class="social-icons">
		<?php if($bazien_theme_options['social-share-facebook']) { ?>
			 <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_attr( $permalink ); ?>" target="_blank" class="icon icon_facebook tip-top" data-tip="<?php _e('Share on Facebook','novaworks'); ?>"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if($bazien_theme_options['social-share-twitter']) { ?>
            <a href="https://twitter.com/share?url=<?php echo esc_attr( $permalink ); ?>" target="_blank" class="icon icon_twitter tip-top" data-tip="<?php _e('Share on Twitter','novaworks'); ?>"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if($bazien_theme_options['social-share-email']) { ?>
            <a href="mailto:enteryour@addresshere.com?subject=<?php echo esc_attr( $post_title ); ?>&amp;body=Check%20this%20out:%20<?php echo esc_attr( $permalink ); ?>" class="icon icon_email tip-top" data-tip="<?php _e('Email to a Friend','novaworks'); ?>"><i class="fa fa-envelope"></i></a>
		<?php } ?>
		<?php if($bazien_theme_options['social-share-pinterest']) { ?>
            <a href="//pinterest.com/pin/create/button/?url=<?php echo esc_attr( $permalink ); ?>&amp;media=<?php echo esc_attr( $featured_image_2 ); ?>&amp;description=<?php echo esc_attr( $post_title ); ?>" target="_blank" class="icon icon_pintrest tip-top" data-tip="<?php _e('Pin on Pinterest','novaworks'); ?>"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
		<?php if($bazien_theme_options['social-share-google-plus']) { ?>
            <a href="//plus.google.com/share?url=<?php echo esc_attr( $permalink ); ?>" target="_blank" class="icon icon_googleplus tip-top" data-tip="<?php _e('Share on Google+','novaworks'); ?>"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
    </div>
    
    <?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
} 
add_shortcode('nova_share','nova_share_shortcode');


// [follow]
function nova_follow_shortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'size' => 'normal',
		'style' => 'style-1',
		'twitter' => '',
		'facebook' => '',
		'pinterest' => '',
		'email' => '',
		'googleplus' => '',
		'instagram' => '',
		'rss' => '',
		'linkedin' => '',
		'youtube' => '',
		'flickr' => '',
	), $atts));
	ob_start();
	?>

    <div class="social-icons <?php echo $style ?> <?php echo $size;?>">

    	<?php if($facebook){ ?>
    	<a href="<?php echo esc_url( $facebook ); ?>" target="_blank"  class="icon icon_facebook" title="<?php _e('Follow us on Facebook','novaworks') ?>"><i class="fa fa-facebook"></i></a>
		<?php }?>
		<?php if($twitter){ ?>
		       <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="icon icon_twitter" title="<?php _e('Follow us on Twitter','novaworks') ?>"><i class="fa fa-twitter"></i></a>
		<?php }?>
		<?php if($email){ ?>
		       <a href="mailto:<?php echo esc_url( $email ); ?>" target="_blank" class="icon icon_email" title="<?php _e('Send us an email','novaworks') ?>"><i class="fa fa-envelope"></i></a>
		<?php }?>
		<?php if($pinterest){ ?>
		       <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" class="icon icon_pintrest" title="<?php _e('Follow us on Pinterest','novaworks') ?>"><i class="fa fa-pinterest"></i></a>
		<?php }?>
		<?php if($googleplus){ ?>
		       <a href="<?php echo esc_url( $googleplus ); ?>" target="_blank" class="icon icon_googleplus" title="<?php _e('Follow us on Google+','novaworks')?>"><i class="fa fa-google-plus"></i></a>
		<?php }?>
		<?php if($instagram){ ?>
		       <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" class="icon icon_instagram" title="<?php _e('Follow us on Instagram','novaworks')?>"><i class="fa fa-instagram"></i></a>
		<?php }?>
		<?php if($rss){ ?>
		       <a href="<?php echo esc_url( $rss ); ?>" target="_blank" class="icon icon_rss" title="<?php _e('Subscribe to RSS','novaworks') ?>"><i class="fa fa-rss"></i></a>
		<?php }?>
		<?php if($linkedin){ ?>
		       <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="icon icon_linkedin" title="<?php _e('LinkedIn','novaworks') ?>"><i class="fa fa-linkedin"></i></a>
		<?php }?>
		<?php if($youtube){ ?>
		       <a href="<?php echo esc_url( $youtube ); ?>" target="_blank" class="icon icon_youtube" title="<?php _e('YouTube','novaworks') ?>"><i class="fa fa-youtube"></i></a>
		<?php }?>
		<?php if($flickr){ ?>
		       <a href="<?php echo esc_url( $flickr ); ?>" target="_blank" class="icon icon_flickr" title="<?php _e('Flickr','novaworks') ?>"><i class="fa fa-flickr"></i></a>
		<?php }?>
     </div>
    	

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("nova_follow", "nova_follow_shortcode");