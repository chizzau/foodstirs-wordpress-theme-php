<?php get_header(); ?>

	<div id="primary" class="content-area">
        
        <div id="content" class="site-content archive" role="main">
                
            <?php if ( have_posts() ) : ?>
            
				<div class="row">
					
					<div class="xlarge-8 xlarge-centered large-10 large-centered columns">
					
						<header class="entry-header-page">
								
								<?php 
									
									if ( is_category() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Category Archives', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo single_cat_title("", false) ?></h1>                                            
										<?php
								  
									elseif ( is_tag() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Tag Archives', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo single_tag_title("", false) ?></h1>                                            
										<?php
									   
			
									elseif ( is_author() ) :
										the_post();
										?>
										<div class="page-type page-title-desc"><?php _e( 'Author', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo get_the_author() ?></h1>                                            
										<?php
										rewind_posts();
			
									elseif ( is_day() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Day Archives', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo get_the_date() ?></h1>                                            
										<?php
			
									elseif ( is_month() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Month Archives', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo get_the_date( 'F Y' ) ?></h1>                                            
										<?php
			
									elseif ( is_year() ) :
										?>
										<div class="page-type page-title-desc"><?php _e( 'Year Archives', 'bazien' ); ?></div>
										<h1 class="page-title blog-listing"><?php echo get_the_date( 'Y' ) ?></h1>                                            
										<?php
			
									else :
										_e( 'Archives', 'bazien' );
			
									endif;
								
								?>
							
							<?php
								// Show an optional term description.
								$term_description = term_description();
								if ( ! empty( $term_description ) ) :
									printf( '<div class="taxonomy-description">%s</div>', $term_description );
								endif;
							?>
										
						</header><!-- .page-header -->
						
					</div><!-- .columns -->
					
				</div><!-- .row -->
						
				<div class="row">
			
					<?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
					<div class="large-9 columns large-push-3 with-sidebar">
					<?php else : ?>
					<div class="xxlarge-10 xlarge-11 large-12 large-centered columns">
					<?php endif; ?>

                        <div class="blog-standard-container">

                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'post_templates/formats/content', get_post_format() );
                                ?>
                            <?php endwhile; ?>

                            <?php if (function_exists("emm_paginate")) { emm_paginate(); } ?>
                        </div><!-- .blog-standard-container-->
			
					</div><!-- .columns-->
			
					<?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
					<div class="large-3 large-pull-9 columns">
						<?php get_sidebar(); ?>
					</div><!-- .columns-->
					<?php endif; ?>
	
				</div><!-- .row-->
            
            <?php else : ?>
            
                <?php get_template_part( 'content', 'none' ); ?>
            
            <?php endif; ?>
                    
		</div><!-- #content -->                            
                     
	</div><!-- #primary -->
            
<?php get_footer(); ?>
