<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
    global $post, $product, $bazien_theme_options;

    //woocommerce_before_single_product
	//nothing changed
	
	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	
	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );
	
	//woocommerce_single_product_summary
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
	add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );
	
	//woocommerce_after_single_product_summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	
	add_action( 'woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10 );

	//woocommerce_after_single_product
	//nothing changed

	//custom actions
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );


?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top_bar_shop">
		<div class="row">
			<div class="medium-10 columns text-left">
				<?php do_action('woocommerce_before_main_content_breadcrumb'); ?>
			</div>
			<div class="medium-2 columns text-right">
			   <div class="product_navigation">
				   <?php bazien_product_nav( 'nav-below' ); ?>
			   </div>
		   </div>
	   </div>
	</div><!-- .top_bar_shop-->    
	<div class="row">
        <div class="large-12 xlarge-10 xxlarge-9 large-centered columns">     
			<div class="product_content_wrapper">
				
				<?php do_action( 'woocommerce_before_single_product' ); ?>
			
				<div class="row">
			
					<div class="large-1 columns product_summary_thumbnails_wrapper">
						<div><?php do_action( 'woocommerce_product_summary_thumbnails' ); ?>&nbsp;</div>
					</div><!-- .columns -->
					
					<div class="large-6 columns">
						<div class="product-images-wrapper">
							<?php				
								do_action( 'woocommerce_before_single_product_summary_sale_flash' );
								do_action( 'woocommerce_before_single_product_summary_product_images' );
								do_action( 'woocommerce_before_single_product_summary' );
							?>
							
							<?php if ( !$product->is_in_stock() ) : ?>            
								<div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php _e( 'Out of stock', 'woocommerce' ); ?></div>            
							<?php endif; ?>
							
							&nbsp;
						</div>
					</div><!-- .columns -->
					
					<?php
					
					$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
					$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
					
					?>
					
					<div class="large-1 columns show-for-xlarge-only"></div>
					
					<div class="large-5 xxlarge-5 large-push-0 columns">
					
						<div class="product_infos">
							
							 <div class="product_summary_top">
								<?php
									do_action( 'woocommerce_single_product_summary_single_title' );
									do_action( 'woocommerce_single_product_summary_single_rating' );									
									
									if ( post_password_required() ) {
										echo get_the_password_form();
										return;
									}
								?>
							</div><!--.product_summary_top-->
							
							<?php
								do_action( 'woocommerce_single_product_summary_single_price' );
								do_action( 'woocommerce_single_product_summary_single_excerpt' );
								do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
								
								do_action( 'woocommerce_single_product_summary' );
							?>
						
						</div>
						<?php do_action( 'woocommerce_single_product_summary_single_meta' ); ?>
						<?php if ( (isset($bazien_theme_options['sharing_options'])) && ($bazien_theme_options['sharing_options'] == "1" ) ) : ?>
						<div class="novaworks-social-share">
			        	<h2><?php _e('Share this product', 'woocommerce' ); ?></h2>
			        	<?php
							//Get the Thumbnail URL
							$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
						?>
						<ul>
							<li class="facebook">
								<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_facebook">
									<i class="fa fa-facebook"></i>	
								</a>
							</li>
	
							<li class="twitter">
								<a href="//twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_twitter">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							
							<li class="googleplus">
								<a href="//plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_googleplus">
									<i class="fa fa-google-plus"></i>
								</a>
							</li>
	
							<li class="pinterest">
								<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social_media social_media_pinterest">
									<i class="fa fa-pinterest"></i>
								</a>
							</li>
	
						</ul>
					</div><!-- .novaworks-social-share -->
					 <?php endif; ?>
					</div><!-- .columns -->
						   
				</div><!-- .row -->
				
			</div><!--.product_content_wrapper-->
	
	   </div><!--large-9-->
    </div><!-- .row -->

	
	<?php do_action( 'woocommerce_after_single_product_summary_data_tabs' ); ?>
	
    <div class="row">
        <div class="large-9 large-centered columns">
            <?php
				
				do_action( 'woocommerce_single_product_summary_single_sharing' );
				do_action( 'woocommerce_after_single_product_summary' );
			?>
            
        </div><!-- .columns -->
    </div><!-- .row -->
    
    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<div class="row">
    <div class="xlarge-9 xlarge-centered columns">

		<?php do_action( 'woocommerce_after_single_product' ); ?>
		
    </div><!-- .columns -->
</div><!-- .row -->		