<?php get_header(); ?>

	<div id="primary" class="content-area blog-single">
        
		<div id="content" class="site-content" role="main">

            <div class="row">

                <?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
                <div class="xxlarge-8 xlarge-10 large-12 large-centered columns with-sidebar">
                    <?php else : ?>
                    <div class="xxlarge-6 xlarge-8 large-10 large-centered columns ">
                        <?php endif; ?>

                        <div class="row">
                            <?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
                            <div class="large-9 large-push-3 columns">
                                <?php else : ?>
                                <div class="large-12 columns ">
                                    <?php endif; ?>

                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php get_template_part( 'post_templates/single_formats/content', get_post_format() ); ?>
                                        <div class="entry-meta">

                                            <div class="post_tags"> <?php bazien_entry_tags(); ?></div>

                                        </div><!-- .entry-meta -->
                                        <div class="entry-share">
                                            <?php echo do_shortcode( '[nova_share]' );?>
                                        </div><!-- .entry-share -->
                                        <div class="author-infomations row">
                                            <div class="author-info-avatar large-2 columns"><?php echo get_avatar(get_the_author_meta('ID'), '70')?></div>
                                            <div class="author-info-description large-10 columns">
                                                <div class="author-info-name"><?php echo __('Author','bazien')?>: <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>"><?php echo get_the_author_link()?></a></div>
                                                <?php echo get_the_author_meta('user_description');?>
                                                <?php if (function_exists('latest_posts_by_author')): ?>
                                                <div class="author-info-post">
                                                    <div class="author-info-post-title"><?php echo __('Latest post by','bazien')?>: <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>"><?php echo get_the_author_link()?></a></div>
                                                    <?php echo do_shortcode( '[latestbyauthor author="'.get_the_author_link().'" show="3"]' );?>
                                                </div>
                                                <?php endif;?>
                                            </div><!-- .author-info-description -->
                                        </div><!-- .author-infomations -->
                                        <?php
                                        // If comments are open or we have at least one comment, load up the comment template
                                        if ( comments_open() || '0' != get_comments_number() )
                                            comments_template();
                                        ?>

                                    <?php endwhile; // end of the loop. ?>

                                </div><!-- .columns-->
                                <?php if ( (isset($bazien_theme_options['sidebar_blog_listing'])) && ($bazien_theme_options['sidebar_blog_listing'] == "1" ) ) : ?>
                                    <div class="large-3 large-pull-9 columns">
                                        <?php get_sidebar(); ?>
                                    </div><!-- .columns-->
                                <?php endif; ?>

                            </div><!-- .row-->

                        </div><!-- .columns -->
                    </div><!-- .row -->

		</div><!-- #content -->
           
    </div><!-- #primary -->

<?php get_footer(); ?>