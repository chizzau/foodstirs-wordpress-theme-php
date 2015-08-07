<?php get_header(); ?>

	<div id="primary" class="content-area">

        <div class="row">	
            <div class="large-10 large-centered columns">    
                <div id="content" class="site-content" role="main">
                
                    <section class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php _e( "404 <br/> We’re Sorry...", 'bazien' ); ?></h1>
                        </header><!-- .page-header -->
        
                        <div class="page-content">
                            <p class="error-404-button"><a href="<?php echo get_home_url(); ?>" class="nova-button default"><?php _e('Back to Home page','bazien')?></a> </p>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                    
                </div><!-- #content -->
            </div><!-- .large-12 .columns -->                
        </div><!-- .row -->
             
    </div><!-- #primary -->

<?php get_footer(); ?>