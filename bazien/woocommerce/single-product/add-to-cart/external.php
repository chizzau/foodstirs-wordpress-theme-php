<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $bazien_theme_options;

?>

<?php if ( (isset($bazien_theme_options['catalog_mode'])) && ($bazien_theme_options['catalog_mode'] == 1) ) : ?>
<?php else : ?>

    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <p class="cart">
        <a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo $button_text; ?></a>
    </p>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

<?php endif; ?>
<?php
if (class_exists('YITH_Woocompare_Frontend')) {
    echo nova_add_compare_details_link();
}
?>