<?php

// [top_rated_block]
function shortcode_top_rated_block($atts, $content = null) {
	global $woocommerce;
	extract(shortcode_atts(array(
		'title' => 'On Sale',
		'number'  => '5',
        'orderby' => 'date',
        'order' => 'desc',
		'hide_free' => '1'
	), $atts));
	ob_start();
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = $woocommerce->query->get_meta_query();

		$top_rated_posts = new WP_Query( $query_args );
		if ($top_rated_posts->have_posts()) :
			echo '<div class="list_product_mini_shortcode top_rated_block">';
			if ( $title ) {
				echo '<h3>' . $title . '</h3>';
			}
			echo '<ul class="product_list_block product">';
		
			while ($top_rated_posts->have_posts()) : $top_rated_posts->the_post(); global $product;

                echo '<li>
                    <div class="mini_product_thumb">
					<a href="' . get_permalink() . '">' . ( has_post_thumbnail() ? get_the_post_thumbnail( $product->id, 'mini_list_thumbnail' ) : wc_placeholder_img( 'mini_list_thumbnail' ) ) . '</a>
					</div>
					<div class="mini_product_desc">
					<a class="product_title" href="' . get_permalink() . '">' . get_the_title() . '</a>
					<div>' . $product->get_price_html() . '</div>
					'.nova_add_compare_link($product->id).'
					'.nova_wishlist_button($product->id).'
					</div>
				</li>';
			
			endwhile;
			
			echo '</ul>';		
			echo '</div>';	
		endif;

        wp_reset_postdata();
		remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	}
	
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("top_rated_block", "shortcode_top_rated_block");

// [onsale_block]
function shortcode_onsale_block($atts, $content = null) {
	global $wp_query, $woocommerce;
	extract(shortcode_atts(array(
		'title' => 'On Sale',
		'number'  => '5',
        'orderby' => 'date',
        'order' => 'desc',
		'hide_free' => '1'
	), $atts));
	ob_start();
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Get products on sale
		$product_ids_on_sale = wc_get_product_ids_on_sale();
		$product_ids_on_sale[] = 0;

		$meta_query = $woocommerce->query->get_meta_query();

    	$query_args = array(
    		'posts_per_page' 	=> $number,
    		'no_found_rows' => 1,
    		'post_status' 	=> 'publish',
    		'post_type' 	=> 'product',
    		'orderby' 		=> 'date',
    		'order' 		=> 'ASC',
    		'meta_query' 	=> $meta_query,
    		'post__in'		=> $product_ids_on_sale
    	);

		$r = new WP_Query($query_args);
		if ( $r->have_posts() ) {
			echo '<div class="list_product_mini_shortcode onsale_block">';
			if ( $title ) {
				echo '<h3>' . $title . '</h3>';
			}
			echo '<ul class="product_list_block product">';

			while ( $r->have_posts()) {
				$r->the_post();
				global $product;

				echo '<li>
                    <div class="mini_product_thumb">
					<a href="' . get_permalink() . '">' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ) : wc_placeholder_img( 'shop_thumbnail' ) ) . '</a>
					</div>
					<div class="mini_product_desc">
					<a class="product_title" href="' . get_permalink() . '">' . get_the_title() . '</a>
					<div>' . $product->get_price_html() . '</div>
					'.nova_add_compare_link().'
					</div>
				</li>';
			}

			echo '</ul>';		
			echo '</div>';		
		}
		wp_reset_postdata();
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;	
}
add_shortcode("onsale_block", "shortcode_onsale_block");

// [latest_products_block]
function shortcode_latest_products_block($atts, $content = null) {
	global $woocommerce;
	extract(shortcode_atts(array(
		'title' => 'Latest Products',
		'number'  => '5',
        'orderby' => 'date',
        'order' => 'desc',
		'hide_free' => '1'
	), $atts));
	ob_start();
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product');
		$query_args['meta_query'] = array();
		$query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
		$query_args['parent'] = '0';
	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		$r = new WP_Query($query_args);
		if ( $r->have_posts() ) {
			echo '<div class="list_product_mini_shortcode latest_products_block">';
			if ( $title ) {
				echo '<h3>' . $title . '</h3>';
			}
			echo '<ul class="product_list_block product">';

			while ( $r->have_posts()) {
				$r->the_post();
				global $product;

				echo '<li>
					<a class="product_thumb" href="' . get_permalink() . '">' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ) : wc_placeholder_img( 'shop_thumbnail' ) ) . '</a>
					<a class="product_title" href="' . get_permalink() . '">' . get_the_title() . '</a> <div>' . $product->get_price_html() . '</div>

				</li>';
			}

			echo '</ul>';		
			echo '</div>';
		}
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;	
}
add_shortcode("latest_products_block", "shortcode_latest_products_block");

// [best_sellers_block]
function shortcode_best_sellers_block($atts, $content = null) {
	global $woocommerce;
	extract(shortcode_atts(array(
		'title' => 'Best Sellers',
		'number'  => '5',
        'orderby' => 'date',
        'order' => 'desc',
		'hide_free' => '1'
	), $atts));
	ob_start();
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'meta_key' 		 => 'total_sales',
    		'orderby' 		 => 'meta_value_num',
    		'no_found_rows'  => 1,
    	);

    	$query_args['meta_query'] = $woocommerce->query->get_meta_query();
    	if ( isset( $hide_free ) && 1 == $hide_free ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}		
		$r = new WP_Query($query_args);
		
		if ( $r->have_posts() ) {
			echo '<div class="list_product_mini_shortcode best_sellers_block">';
			if ( $title ) {
				echo '<h3>' . $title . '</h3>';
			}

			echo '<ul class="product_list_block">';

			while ( $r->have_posts()) {
				$r->the_post();
				global $product;

				echo '<li>
					<a class="product_thumb" href="' . get_permalink() . '">' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ) : wc_placeholder_img( 'shop_thumbnail' ) ) . '</a>
					<a class="product_title" href="' . get_permalink() . '">' . get_the_title() . '</a> <div>' . $product->get_price_html() . '</div>
				</li>';
			}

			echo '</ul>';
			echo '</div>';

		}

		wp_reset_postdata();
	
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;	
}
add_shortcode("best_sellers_block", "shortcode_best_sellers_block");