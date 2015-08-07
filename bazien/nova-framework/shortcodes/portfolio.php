<?php

// [portfolio]

function shortcode_portfolio($atts, $content = null) {
	
	global $post;
	
	$sliderrandomid = rand();
	
	extract(shortcode_atts(array(
		"items" 					=> '9999',
		"category" 					=> '',
		"show_filters" 				=> 'yes',
		"order_by" 					=> 'date',
		"order" 					=> 'desc',
		"grid" 						=> 'default',
		"portfolio_items_per_row" 	=> '5'
	), $atts));
	ob_start();
	?>
    
    <?php
				
	if ($order_by == "alphabetical") $order_by = 'title';
	
	$args = array(					
		'post_status' 			=> 'publish',
		'post_type' 			=> 'portfolio',
		'posts_per_page' 		=> $items,
		'portfolio_categories' 	=> $category,
		'orderby' 				=> $order_by,
		'order' 				=> $order,
	);
	
	$portfolioItems = new WP_Query( $args );
	
	while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();
		
		$terms = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.
		
		if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
			foreach($terms as $term) {
				$portfolio_categories_queried[$term->slug] = $term->name;
			}
		}
		
	endwhile;
	
	$portfolio_categories_queried = array_unique($portfolio_categories_queried);
	
	if ($grid == "default") {
		$items_per_row_class = ' default_grid items_per_row_'."$portfolio_items_per_row";
	} else {
		$items_per_row_class ='';
	}
	
	?>
    
	<div class="portfolio-isotope-container<?php echo esc_html($items_per_row_class);?>">
                
        <?php if ($category == "") : ?>
        <?php if ($show_filters == "yes") : ?>
        <div class="portfolio-filters">            
            <?php
			
			if ( !empty( $portfolio_categories_queried ) && !is_wp_error( $portfolio_categories_queried ) ){
                echo '<ul class="filters-group list-categories-center">';
                    echo '<li class="filter-item is-checked" data-filter="*">' . __("Show all", "bazien") . '</li>';
                foreach ( $portfolio_categories_queried as $key => $value ) {
                    echo '<li class="filter-item" data-filter=".' . $key . '">' . $value . '</li>';
                }
                echo '</ul>';
            }
			           
            ?>            
        </div>
        <?php endif; ?>
        <?php endif; ?>
        
        <div class="portfolio-isotope">
            
            <div class="portfolio-grid-sizer"></div>
                
                <?php
				
                $post_counter = 0;
                                
                while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();
                    
					$post_counter++;
                    
					$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );
                    
                    $terms_slug = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.

                    $term_slug_class = "";
                    
                    if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
                        foreach ( $terms_slug as $term_slug ) {
                            $term_slug_class .=  $term_slug->slug . " ";
                        }
                    }
					
					$portfolio_item_width = "";
					$portfolio_item_height = "";
					
					switch ($grid) {
						
						case "grid1":							
							
							switch ($post_counter) {
								case (($post_counter == 1)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "height2";
									break;
								case (($post_counter == 2)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 7)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 8)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "height2";
									break;
								default :
									$portfolio_item_width = "";
									$portfolio_item_height = "";
							}							
							break;
							
						case "grid2":
							
							switch ($post_counter) {
								case (($post_counter == 3)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "height2";
									break;
								case (($post_counter == 8)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 13)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								default :
									$portfolio_item_width = "";
									$portfolio_item_height = "";
							}							
							break;
							
						case "grid3":
						
							switch ($post_counter) {
								case (($post_counter == 3)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 8)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 11)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								case (($post_counter == 14)) :
									$portfolio_item_width = "width2";
									$portfolio_item_height = "";
									break;
								default :
									$portfolio_item_width = "";
									$portfolio_item_height = "";
							}							
							break;
							
						default:
							
							$portfolio_item_width = "";
							$portfolio_item_height = "";
							
					}
                    
                ?>

                    <div class="portfolio_item hidden <?php echo esc_html($portfolio_item_width); ?> <?php echo esc_html($portfolio_item_height); ?> <?php echo esc_html($term_slug_class); ?>">

                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="portfolio_item_inner portfolio_hover_link_effect">

                            <div class="portfolio_item_content_wap portfolio_content_effect">

                                <?php if ($related_thumb[0] != "") : ?>
                                    <span class="portfolio-image portfolio_hover_image_effect" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
                                <?php endif; ?>

                                <h2 class="portfolio-title portfolio_title_effect"><?php the_title(); ?></h2>

                                <p class="portfolio-categories portfolio_text_effect"><?php echo strip_tags (get_the_term_list(get_the_ID(), 'portfolio_categories', "", ", "));?></p>

                            </div>

                        </a>

                    </div>
                
                <?php endwhile; // end of the loop. ?>

        </div><!--portfolio-isotope-->
    
    </div><!--portfolio-isotope-container-->
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("portfolio", "shortcode_portfolio");