<?php
	
	global $bazien_theme_options;
	
	$page_id = "";
	if ( is_single() || is_page() ) {
		$page_id = get_the_ID();
	} else if ( is_home() ) {
		$page_id = get_option('page_for_posts');		
	}

    $blog_with_sidebar = "";
    if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

    $page_header_src = "";

    if (has_post_thumbnail()) $page_header_src = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );
	
	if (get_post_meta( $page_id, 'page_title_meta_box_check', true )) {
		$page_title_option = get_post_meta( $page_id, 'page_title_meta_box_check', true );
	} else {
		$page_title_option = "on";
	}	
	
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">                    
                
    <div id="content" class="site-content blog" role="main">             
        
        
        <?php if ( have_posts() ) : ?>

			<header class="entry-header-page">
				<div class="row">
					<div class="xlarge-8 large-10 xlarge-centered large-centered columns ">

						<?php
						if( is_home() && get_option('page_for_posts') ) {
							if ( (isset($page_title_option)) && ($page_title_option == "on") ) {
								$blog_page_id = get_option('page_for_posts');
								echo '<p class="top-page-excerpt">'.get_page($blog_page_id)->post_excerpt.'</p>';
								echo '<h1 class="page-title blog-listing">'.get_page($blog_page_id)->post_title.'</h1>';
							}
						}
						?>

					</div><!-- .large-10-->
				</div><!-- .row-->
			</header>
					
			<div class="row">
				<?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
				<div class="large-9 large-push-3 columns with-sidebar">
				<?php else : ?>
				<div class="large-9 large-centered columns">
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

            <?php get_template_part( 'no-results', 'index' ); ?>

        <?php endif; ?>
       
        </div><!-- #content -->                            
                     
    </div><!-- #primary -->
            
<?php get_footer(); ?>