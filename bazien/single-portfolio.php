<?php
	global $bazien_theme_options;
	
	if (get_post_meta( $post->ID, 'portfolio_title_meta_box_check', true )) {
		$portfolio_title_option = get_post_meta( $post->ID, 'portfolio_title_meta_box_check', true );
	} else {
		$portfolio_title_option = "on";
	}
    $terms = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.

    if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
        foreach($terms as $term) {
            $portfolio_categories_queried[$term->slug] = $term->name;
        }
    }

?>

<?php get_header(); ?>

 <div class="page-portfolio-single <?php echo ( (isset($portfolio_title_option)) && ($portfolio_title_option == "on") ) ? 'has_page_title':'hasnt_page_title';?>">
		
    <div id="primary" class="content-area">
	   
		<div id="content" class="site-content" role="main">

			<header class="entry-header entry-header-portfolio-single">
	
				<div class="row">
					<div class="large-10 large-centered columns">
		
						<?php while ( have_posts() ) : the_post(); ?>
    
                            <?php if ( (isset($portfolio_title_option)) && ($portfolio_title_option == "on") ) : ?>                        
                            	<h1 class="page-title portfolio_item_title"><?php the_title(); ?></h1>


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
						
						<?php endwhile; // end of the loop. ?>
						
						
						
					</div><!--.large-->
				</div><!--.row-->
	
			</header><!-- .entry-header -->
    
			<div class="entry-content entry-content-portfolio">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; // end of the loop. ?>
            </div>

		</div><!-- #content .site-content -->
	
		
		<div class="portfolio_content_nav">
			<?php bazien_content_nav( 'nav-below' ); ?>
		</div>
        <?php
        $post_counter = 0;
        if ( $terms && ! is_wp_error( $terms) ) {
            foreach( $terms as $term ) {
                $wp_query = new WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 4,
                    'orderby'=> 'menu_order',
                    'paged'=>$paged,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' 		=> 'portfolio_categories',
                            'terms' 		=> array( esc_attr($term->slug)),
                            'field' 		=> 'slug',
                            'operator' => 'IN'
                        )
                    )
                ));
            }
        }

        ?>
        <div class="portfolio_related">
            <div class="row">
                <div class="large-12 column">
                    <h3 class="portfolio_related_title"><?php echo __('Related Projects','bazien')?></h3>
                    <ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post();$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' ); ?>
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
	
	
	</div><!-- #primary .content-area -->


<?php /*

$terms = get_the_terms( $post->ID, 'portfolio_categories');

if ($terms) {

	$terms_array = array();
	
	foreach ($terms as $term) {
		$terms_array[] = $term->slug;
	}
	
	$args = array(
		'posts_per_page'	=> 5,
		'order_by' 			=> 'rand',
		'post_type' 		=> 'portfolio',
		'post_status' 		=> 'publish',
		'exclude' 			=> $post->ID,
		'tax_query' 		=> array(
							array('taxonomy'	=> 'portfolio_categories',
									'field' 	=> 'slug',
									'terms' 	=> $terms_array
							))
	);
	
	$related = get_posts($args);

}

?>

<?php if (isset($related)) { ?>

	<div class="portfolio-related-container">
		
	<?php foreach( $related as $related_post ) { ?>
		<?php
		
		$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($related_post->ID), 'medium' );
		
		?>
		
		<div class="portfolio_related_item">
			<a class="portfolio-related-item-inner portfolio_hover_link_effect" href="<?php echo get_permalink($related_post->ID); ?>">
				
				<div class="portfolio-related-content portfolio_content_effect">
					  
					<?php if ($related_thumb[0] != "") : ?>
						<span class="portfolio-related-thumb portfolio_hover_image_effect" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
					<?php endif; ?>
					
					<h2 class="portfolio-related-title portfolio_title_effect"><?php echo esc_html($related_post->post_title); ?></h2>
					
					<p class="portfolio-related-categories portfolio_text_effect">
					   <?php 
						echo strip_tags (
							get_the_term_list( $related_post->ID, 'portfolio_categories', "",", " )
						);
						?>
					</p>
					   
				</div>
				
			</a>
		</div> 
	<?php } ?><!-- endforeach-->
    
	<?php
	
	$related_portfolio_items = count($related);
	
	if ( $related_portfolio_items < 5 ) {
		
		$empty_related_portfolio_items = 5 - $related_portfolio_items;
	
		while ( $empty_related_portfolio_items > 0 ) :
		?>
			<div class="portfolio_related_item item_<?php echo ++$related_portfolio_items; ?>  empty"><span class="portfolio_hover_link_effect"></span></div>
			
			<?php $empty_related_portfolio_items--; ?>
			
		<?php endwhile; ?>
		
	<?php } ?> <!--endif-->
	
	</div><!--.portfolio-related-container-->
	
<?php } */ ?> <!--endif related-->

</div><!--.full-width-page-->


<?php get_footer(); ?>