<?php get_header(); ?>

<?php $term = $wp_query->queried_object; ?>

<div id="primary" class="content-area">
       
    <div id="content" class="site-content" role="main">
    
        <header class="entry-header">
            
            <div class="row">
                <div class="large-10 large-centered columns">
                          
                    <h1 class="page-title"><?php echo esc_html($term->name); ?></h1>
                    
                </div>
            </div>
    
        </header><!-- .entry-header -->
        
        <?php

		$args = array(					
			'post_status' 			=> 'publish',
			'post_type' 			=> 'portfolio',
			'posts_per_page' 		=> 9999,
			'portfolio_categories' 	=> $term->slug,
			'orderby' 				=> 'date',
			'order' 				=> 'desc'
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


        <div class="portfolio-cat-page portfolio-standard-container">
            <div id="nova_portfolio">
                <div class="row">
                    <div class="large-12 column">
                        <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">

                            <?php
                            while ( $portfolioItems->have_posts() ) : $portfolioItems->the_post();

                                $related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );

                                $terms_slug = get_the_terms( get_the_ID(), 'portfolio_categories' ); // get an array of all the terms as objects.

                                $term_slug_class = "";

                                if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
                                    foreach ( $terms_slug as $term_slug ) {
                                        $term_slug_class .=  $term_slug->slug . " ";
                                    }
                                }
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
    
    </div><!-- #content -->           
    
</div><!-- #primary -->

<?php get_footer(); ?>