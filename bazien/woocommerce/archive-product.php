<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 

global $bazien_theme_options;

//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20 );

//woocommerce_before_shop_loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

$category_header_src = "";
$shop_has_sidebar = false;

if (function_exists('woocommerce_get_header_image_url'))  $category_header_src = woocommerce_get_header_image_url();

if ( 
	is_active_sidebar( 'catalog-widget-area' )
	 && (isset($bazien_theme_options['sidebar_style']))
	 && ($bazien_theme_options['sidebar_style'] == "1") 
)
{
	$shop_has_sidebar = true;
}

$bazien_theme_options['category_header_parallax'] = 1;

if ((isset($bazien_theme_options['category_header_parallax'])) && ($bazien_theme_options['category_header_parallax'] == "1"))
{
   $category_header_parallax_ratio = 'data-stellar-background-ratio="0.5"';
   $category_header_parallax_class = ' parallax';
   $category_header_has_parallax_background = ' has_parallax_background';
} else {
   $category_header_parallax_ratio = '';
   $category_header_parallax_class = '';
   $category_header_has_parallax_background = '';
}


 
?>
   	<div id="primary" class="content-area shop-page<?php echo $shop_has_sidebar ? ' shop-has-sidebar':'';?>">
		   
		<div  class="shop_header <?php if ($category_header_src != "") : ?>has_big_img<?php endif; ?> <?php echo $category_header_has_parallax_background; ?> page-header-style-1">
		 	
			<?php if ($category_header_src != "") : ?>
			
			   <div <?php echo $category_header_parallax_ratio; ?>
					 class="shop_header_image_background <?php echo $category_header_parallax_class; ?>" style="background-image:url(<?php echo esc_url($category_header_src); ?>)">
			   </div>
		 
			<?php endif ?>	
		 		 
            <div class="row">
                <div class="large-12 large-centered columns">
                    
                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                        <h1 class="page-title on-shop"><?php woocommerce_page_title(); ?></h1>
                    <?php endif; ?>
                   
                    <div class="row">
                        <div class="large-9 large-centered columns">
                            <?php do_action( 'woocommerce_archive_description' ); ?>
                        </div><!--.large-9-->
                    </div><!--.row-->
					<div class="site-breadcrumb large-12 large-centered">
						<?php do_action('woocommerce_before_main_content_breadcrumb'); ?>
					</div>
                    <?php 
                    // Find the category + category parent, if applicable
                    $term 			= get_queried_object();
                    $parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
                    $categories 	= get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));
                    ?>
                    
                    <?php
                
                    $show_categories = FALSE;
                
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = FALSE;
                    if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = TRUE;
                    
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = TRUE;
                
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = FALSE;
                    if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = TRUE;
                    
                    if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;
                    
                    //echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";                        
                    //echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
                    //echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";
                
                    ?>
                
                    <?php if ($show_categories == TRUE) : ?>
                        <?php if ($categories) : ?>
                        
                         <ul class="list_shop_categories list-categories-center">
                               
                               <?php $cat_counter = 0; ?>
                               
                               <?php foreach($categories as $category) : ?>
                                   
                                    <li class="category_item">
                                        <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item_link">
                                            <span class="category_name"><?php echo esc_html($category->name); ?></span>
                                        </a>
                                    </li>
                               
                               <?php endforeach; ?>
                               
                           </ul><!-- .list_shop_categories-->
                        
                        <?php endif; ?>
                    <?php endif; ?>
                   
                </div><!--.large-12-->
            </div><!-- .row-->

        </div><!--  .shop_header-->
      
                
        <div class="row">
			<div class="large-12 columns">
			   
			   <div class="before_main_content">
				   <?php do_action( 'woocommerce_before_main_content'); ?>
			   </div> 
                
                <div id="content" class="site-content" role="main">
                    <div class="row">
                       
					 <div class="large-12 columns">
					    <div class="catalog_top"> 
                        </div>
					</div>
					   
				  <?php if ( $shop_has_sidebar ) : ?>
					   
					   <div class="xlarge-10 large-9 xlarge-push-2 large-push-3  columns">
					   
				   <?php else : ?>
				   
					   <div class="large-12 columns">
					   
				   <?php endif; ?>
			        <div class="top_bar_shop">
			            <div class="row">
			                <div class="large-9 medium-6 small-6 columns text-left">
								<div class="catalog-ordering">
			                        <?php if ( have_posts() ) : ?>
			                            <?php do_action( 'woocommerce_before_shop_loop_catalog_ordering' ); ?>
			                            <?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
			                        <?php endif; ?>
			                    </div> <!--catalog-ordering-->				                
			                </div>
			                <div class="large-3 medium-6 small-6 columns text-right">
                                <?php if (class_exists('WC_List_Grid')):?>
                                    <?php echo nova_gridlist_toggle_button()?>
                                <?php endif; ?>
			                </div>
			            </div>
			        </div><!-- .top_bar_shop-->	                

						<?php
            
						$show_categories = FALSE;
		
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = TRUE;
						if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = FALSE;
						
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = TRUE;
						if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = FALSE;
		
						if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
						if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = TRUE;
						if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = FALSE;
						
						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;
						
						//echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";                        
						//echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
						//echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";
					
						?>
						
						<?php if (!is_paged()) : //show categories only on first page ?>
                    
                        <?php if ($show_categories == TRUE) : ?>

                            <?php if ($categories) : ?>
                            
                                <div class="row">
                                    <div class="categories_grid">
                                        
                                        <?php $cat_counter = 0; ?>
                                        
                                        <?php $cat_number = count($categories); ?>
                                        
                                        <?php foreach($categories as $category) : ?>
                                            
                                            <?php                        
                                                $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                                                $image = wp_get_attachment_url( $thumbnail_id );
                                                $cat_class = "";
                                            ?>
                                        
                                            <?php
                                        
                                                if (is_shop() && get_option('woocommerce_shop_page_display') == 'both') $cat_class = "original_grid";
                                                if (is_product_category() && get_option('woocommerce_category_archive_display') == 'both') $cat_class = "original_grid";
                                                
                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') $cat_class = "original_grid";
    
                                            ?>
                                            
                                            <?php 
                                                if($cat_class != "original_grid") 
                                                {
                                                    $cat_counter++;                                        
    
                                                    switch ($cat_number) {
                                                        case 1:
                                                            $cat_class = "one_cat_" . $cat_counter;
                                                            break;
                                                        case 2:
                                                            $cat_class = "two_cat_" . $cat_counter;
                                                            break;
                                                        case 3:
                                                            $cat_class = "three_cat_" . $cat_counter;
                                                            break;
                                                        case 4:
                                                            $cat_class = "four_cat_" . $cat_counter;
                                                            break;
                                                        case 5:
                                                            $cat_class = "five_cat_" . $cat_counter;
                                                            break;
                                                        default:
                                                            if ($cat_counter < 7) {
                                                                $cat_class = $cat_counter;
                                                            } else {
                                                                $cat_class = "more_than_6";
                                                            }
                                                    }
                                                    
                                                }
                                            ?>
                                            
                                            <div class="category_<?php echo $cat_class; ?>">
                                                <div class="category_grid_box">
                                                    <span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
                                                    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item">
                                                        <span class="category_name"><?php echo esc_html($category->name); ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        
                                        <?php endforeach; ?>
                                        
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>
                                
                                <?php endif; ?>
                            
                            <?php endif; ?>
                        
                        <?php endif; ?>                      
                        
                        <?php
                    
                        $show_products = TRUE;

                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_products = FALSE;
						
						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_products = TRUE;
                    
                        ?>
                        
                        <?php if ($show_products == TRUE) : ?>
                
							<?php if ( have_posts() ) : ?>
								
                                <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    
                                <div class="row">
                                    <div class="large-12 columns">
                        
                                        <?php woocommerce_product_loop_start(); ?>            
                                            <?php while ( have_posts() ) : the_post(); ?>                            
                                                <?php wc_get_template_part( 'content', 'product' ); ?>
                                            <?php endwhile; // end of the loop. ?>                            
                                        <?php woocommerce_product_loop_end(); ?>
                                        
                                    </div><!-- .columns -->
                                </div>

								<div class="woocommerce-after-shop-loop-wrapper">
									<?php do_action( 'woocommerce_after_shop_loop' ); ?>
								</div>
								
                            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
							
								<?php wc_get_template( 'loop/no-products-found.php' ); ?>
                    
                            <?php endif; ?>
                        
                        <?php endif; ?>
						
						<?php do_action('woocommerce_after_main_content'); ?>
					
						</div><!--.large-12-->

                        <?php if ( $shop_has_sidebar ) : ?>

                           <div class="xlarge-2 large-3 xlarge-pull-2 large-pull-9 columns">
                               <div class="shop_sidebar wpb_widgetised_column">
                                   <?php do_action('woocommerce_sidebar'); ?>
                               </div>
                           </div>
                        <?php endif;?>
					</div><!-- .row-->
				</div><!-- #content -->           
            
			</div><!-- .large-12 -->        
        </div><!-- .row -->
        
    </div><!-- #primary -->

<?php get_footer('shop'); ?>