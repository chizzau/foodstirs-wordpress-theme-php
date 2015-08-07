<?php

// [bazien_page_title]
function bazien_page_title($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
	), $params));
	
	$content = do_shortcode($content);
	
	$text = '<div class="large-10 large-centered columns">
        
                                                
                        <h1 class="page-title">'.$title.'</h1>
                                                
                                                
                    </div>
			';
	
	return $text;
}

add_shortcode('bazien_page_title', 'bazien_page_title');