<?php
global $bazien_theme_options, $woocommerce;
if ( isset($bazien_theme_options['main_header_layout']) && ($bazien_theme_options['main_header_layout'] == "3" || $bazien_theme_options['main_header_layout'] == "4")):
    ?>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'bazien' ); ?></label>
        <button class="button"><i class="fa fa-search"></i></button>
    </form>
<?php
else:
    ?>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'bazien' ); ?></label>
        <input type="search" class="search-field" placeholder="<?php _e( 'Search &hellip;', 'bazien' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
        <input type="submit" class="search-submit" value="<?php _e( 'Search', 'bazien' ); ?>">
    </form>
<?php endif;?>