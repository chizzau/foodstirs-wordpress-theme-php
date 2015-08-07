<?php

// [from_the_blog]
function shortcode_from_the_blog($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" => '8',
		"columns" => '2',
		"columns_2" => '2',
		"columns_3" => '2',
		"columns_4" => '1',
		"columns_5" => '1',
		"show_readmore" => 'yes',
		"category" => ''
	), $atts));
	ob_start();
	?> 
    
    <script>
	jQuery(document).ready(function($) {
		$("#latest-post-<?php echo $sliderrandomid ?>").owlCarousel({
			items:<?php echo $columns ?>,
			itemsDesktop : [1200,<?php echo $columns_2 ?>],
			itemsDesktopSmall : [1000,<?php echo $columns_3 ?>],
			itemsTablet: [600,<?php echo $columns_4 ?>],
			itemsMobile : [320,<?php echo $columns_5 ?>],
			lazyLoad : true,
		});
	});
	</script>
    
    <div class="latest-post-shortcode-wrapper blog-<?php echo $columns?>-columns">
	
        <div id="latest-post-<?php echo $sliderrandomid ?>" class="owl-carousel">
					
			<?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'category_name' => $category,
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <?php $post_format = get_post_format(get_the_ID()); ?>
                    
                    <div class="latest_posts_item">
                        
						<a class="latest_posts_link" href="<?php the_permalink() ?>">
							<span class="latest_posts_image_container">
								<span class="latest_posts_overlay"></span>
								
								<?php if ( has_post_thumbnail()) :
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id,'large', true);
								?>
									<span class="latest_posts_image" style="background-image: url(<?php echo esc_url($image_url[0]); ?> );"></span>
								<?php else : ?>
									<span class="latest_posts_no_image"></span>
								<?php endif;  ?>
							</span><!--.latest_posts_image_container-->
							<a class="latest_posts_title" href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
						</a>
                        
                        <div class="latest_posts_content">
                            <div class="entry_meta_archive"><?php bazien_entry_archives(); ?></div>  
                            <div class="post_excerpt_sumary">
	                            <?php
									$excerpt = get_the_excerpt();
									echo nova_string_limit_words($excerpt,30).' [...]';
								?>
								<?php if($show_readmore == 'yes'):?>
								<div class="post_read_more"><a href="<?php the_permalink() ?>" class="nova-button stroke"><?php echo __('Read More','bazien')?></a></div>
								<?php endif;  ?>
							</div>                     
                        </div>
                        
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
            <?php

            endif;
            
            ?> 
              
        </div>
	</div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("from_the_blog", "shortcode_from_the_blog");