<?php

// [bazien_block_title]
function bazien_block_title($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'subtitle' => 'Subtitle'
	), $params));
	
	$content = do_shortcode($content);
	
	$text = '<div class="bazien_block_title">
				<h2 class="title">'.$title.'</h2>
				<p class=""></p>
			</div>
			<div class="bazien_block_sub_title">
				<h2 class="title">'.$subtitle.'</h2>
			</div>
			';
	
	return $text;
}

add_shortcode('bazien_block_title', 'bazien_block_title');