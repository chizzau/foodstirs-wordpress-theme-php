<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
<div class="row">
	<div class="large-12 large-centered columns">
		<div id="woocomerce-tabs">
		    <ul class="resp-tabs-list hor_1">
					<?php foreach ( $tabs as $key => $tab ) : ?>
		
						<li><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></li>
		
					<?php endforeach; ?>
		    </ul>
		    <div class="resp-tabs-container hor_1">
			    <?php foreach ( $tabs as $key => $tab ) : ?>
			    <div>
				    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
			    </div>
			    <?php endforeach; ?>
		    </div>
		</div>
	</div>
</div>
<?php endif; ?>