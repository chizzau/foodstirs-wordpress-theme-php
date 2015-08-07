<?php
$post_permalink = get_permalink();
$post_comments = get_comments_number();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single_post nova_entry">
        <div class="entry_image">
            <figure class="media-wrapper player">
                <?php
                $video = get_post_meta( get_the_ID(), '_format_video_embed', true );
                echo wp_oembed_get( $video );
                ?>
            </figure>
            <div class="entry_format"><span class="entry_format_icon"><i class="fa fa-film"></i></span></div>
        </div>
        <div class="entry_title">
            <h2><?php the_title(); ?></h2>
        </div>
        <div class="entry_meta_archive"><?php bazien_entry_meta(); ?></div>
        <div class="entry_content">
            <?php if (get_option('rss_use_excerpt') == 0) : ?>
                <?php echo the_content(''); ?>
            <?php elseif (get_option('rss_use_excerpt') == 1) : ?>
                <?php echo the_excerpt(); ?>
            <?php else : ?>
                <?php echo the_content(__('Read More', 'bazien')); ?>
            <?php endif ?>
        </div>
    </div>
</div>