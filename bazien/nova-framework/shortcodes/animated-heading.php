<?php
function bazien_animated_heading ($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'text' => '',
		'animated_text' => '',
		'heading_animation' =>'',
		'heading_tag' => '',
		'heading_align' => '',
		'heading_font_size' => '',
		'heading_line_height' => '',
		'heading_letter_space' => '',
		'heading_color' => '',
		'el_class' => '',
	), $params));
	$output = '';
	wp_register_style( 'animated_heading_style', get_template_directory_uri() . '/css/animated-heading.css', array(),'', 'screen' );
	wp_register_script( 'animated_heading_script', get_template_directory_uri() . '/js/animated-heading.js', array(),'');
	wp_enqueue_style('animated_heading_style');
	wp_enqueue_script('animated_heading_script');
	$heading_align_style = '';
	if($heading_align) {
		$heading_align_style = 'text-align: '.$heading_align.'; ';
	}
	$heading_font_size_style = '';
	if($heading_font_size) {
		$heading_font_size_style = 'font-size: '.$heading_font_size.'; ';
	}
	$heading_line_height_style = '';
	if($heading_line_height) {
		$heading_line_height_style = 'line-height: '.$heading_line_height.'; ';
	}
	$heading_letter_space_style = '';
	if($heading_letter_space) {
		$heading_letter_space_style = 'letter-spacing: '.$heading_letter_space.'; ';
	}	
	$heading_color_style = '';
	if($heading_color) {
		$heading_color_style = 'color: '.$heading_color.'; ';
	}	
	$animated_text_array = explode(';',$animated_text);
	$output .= '<'.$heading_tag.' class="cd-headline '.$heading_animation.' '.$el_class.'" style="'.$heading_align_style.$heading_font_size_style.$heading_line_height_style.$heading_letter_space_style.$heading_color_style.'">
			<span style="'.$heading_align_style.$heading_font_size_style.$heading_line_height_style.$heading_letter_space_style.$heading_color_style.'">'.$text.'</span>
			<span class="cd-words-wrapper" style="'.$heading_font_size_style.$heading_line_height_style.$heading_letter_space_style.$heading_color_style.'">';
	$i = 1;
	foreach($animated_text_array as $a_text) {
		if($i == 1) {
			$output .= '<b class="is-visible">'.$a_text.'</b>';
		}else{
			$output .= '<b>'.$a_text.'</b>';
		}
		$i++;
	}				
	$output .= '</span>
		</'.$heading_tag.'>';
	return $output;
}
add_shortcode('animated-heading', 'bazien_animated_heading');