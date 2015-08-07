<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="nova_entry">
        <div class="entry_image">
            <blockquote>
                <?php the_content(); ?>
                <footer><?php echo get_post_meta( get_the_ID(), '_format_quote_source_name', true ); ?></footer>
            </blockquote>
        </div>
    </div>
</div>