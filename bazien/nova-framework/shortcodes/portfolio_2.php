<?php

// [portfolio]

function shortcode_portfolio_2($atts, $content = null) {
	
	global $post;
	
	$sliderrandomid = rand();
	
	extract(shortcode_atts(array(
		"items" 					=> '9999',
		"category" 					=> '',
		"show_filters" 				=> 'yes',
		"order_by" 					=> 'date',
		"order" 					=> 'desc',
		"portfolio_items_per_row" 	=> '4'
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
	
	?>
    
	<div class="portfolio-standard-container">
        <?php if ($category == "") : ?>
        <div class="portfolio-filters">
            <?php

			if ( !empty( $portfolio_categories_queried ) && !is_wp_error( $portfolio_categories_queried ) ){
                echo '<ul class="filters-group list-categories-center">';
                foreach ( $portfolio_categories_queried as $key => $value ) {
                    $cat_link = get_term_link( $value, 'portfolio_categories' );
                    echo '<li class="filter-item"><a href="'.$cat_link.'"> ' . $value . '</a></li>';
                }
                echo '</ul>';
            }

            ?>
        </div>
        <?php endif; ?>
        <?php
            switch ($portfolio_items_per_row) {
                case (($portfolio_items_per_row == 2)) :
                    $portfolio_item_column = "large-block-grid-2";
                    break;
                case (($portfolio_items_per_row == 3)) :
                    $portfolio_item_column = "large-block-grid-3";
                    break;
                case (($portfolio_items_per_row == 4)) :
                    $portfolio_item_column = "large-block-grid-4";
                    break;
                default :
                    $portfolio_item_column = "large-block-grid-4";
            }
        ?>
        <div id="nova_portfolio">
            <div class="row">
                <div class="large-12 column">
                    <ul class="small-block-grid-1 medium-block-grid-2 <?php echo $portfolio_item_column?>">
                    <?php
                    while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();

                        $related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );



                        ?>
                        <li class="portfolio-item">
                            <a href="<?php echo get_permalink(get_the_ID()); ?>" class="img_link">
                                <span class="icon_box"><span class="fa fa-link"></span></span>
                                <img src="<?php echo esc_url($related_thumb[0]); ?>" />
                            </a>
                            <h2 class="portfolio-title"><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a></h2>
                        </li>

                    <?php endwhile; // end of the loop. ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- .portfolio-standard-container -->
	
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("portfolio_2", "shortcode_portfolio_2");