<?php

function bazien_product_mod($atts, $content = null) {	
	global $bazien_theme_options;
	extract(shortcode_atts(array(
		"id" => ''
	), $atts));
    ob_start();
    
	echo '<div class="shortcode_single_product">'.do_shortcode('[product id="'.$id.'"]').'</div>';
	
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("product_mod", "bazien_product_mod");