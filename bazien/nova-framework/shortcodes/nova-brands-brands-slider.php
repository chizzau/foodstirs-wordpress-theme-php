<?php
// [nova_brands_slider]
function nova_brands_slider_shortcode($params = array(), $content = null){
	extract(shortcode_atts(array(
		'columns' => '6'
	), $params));
	$randomid = rand();
	$content = do_shortcode($content);
	$content = str_replace("<br>","",$content);
	$content = str_replace("<br/>","",$content);
	$content = str_replace("<br />","",$content);
	$our_brand = '<div class="nova-brands-slider-shortcode nova-wp-items-slider-'.$randomid.'">
                <div id="clients-slider-'.$randomid.'" class="owl-carousel">
                '.$content.'
                </div>
        	</div>
    <script>
    jQuery(document).ready(function($) {
      $("#clients-slider-'.$randomid.'").owlCarousel({

	      items : '.$columns.', //10 items above 1000px browser width
	      itemsDesktop : [1000,5], //5 items between 1000px and 901px
	      itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
	      itemsTablet: [600,2], //2 items between 600 and 0;
	      itemsMobile : [320,1],
	      navigation : false,
	      navigationText : ["<i class=\"fa fa-angle-left\"></i>","<i class=\"fa fa-angle-right\"></i>"],
	      pagination : true,
	      slideSpeed : 300
      });

    });

  </script>';
	return $our_brand;	
}
function nova_brand_item_shortcode($params = array(), $content = null){
	extract(shortcode_atts(array(
			'title' => 'Name',
			'image_url' => '',
			'link' => ''
	), $params));
	$image_url_file = $image_url;
	$our_brand_item = '<div class="client-item"><a href="'.$link.'"><img src="'.$image_url_file.'" alt="'.$title.'"></a></div>';
	return $our_brand_item;
}
add_shortcode( 'nova_brands_slider', 'nova_brands_slider_shortcode' );
add_shortcode( 'nova_brand_item', 'nova_brand_item_shortcode' );