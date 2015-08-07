<?php
function nova_button_shortcode($atts, $content = null) {
    global $qode_options_proya;

    $args = array(
        "size"                      => "",
        "text"                      => "",
        "style"                      => "default",
        "icon"                      => "",
        "icon_color"                => "",
        "align"                      => "",
        "link"                      => "",
        "target"                    => "_self",
        "color"                     => "",
        "hover_color"               => "",
        "background_color"			=> "",
        "hover_background_color"    => "",
        "border_color"              => "",
        "hover_border_color"        => "",
        "font_style"                => "",
        "font_weight"               => "",
        "text_align"                => "",
        "margin"					=> "",
        "border_radius"				=> ""
    );

    extract(shortcode_atts($args, $atts));

    if($target == ""){
        $target = "_self";
    }

    //init variables
    $html  = "";
    $button_classes = "nova-button ";
    $button_styles  = "";
    $add_icon       = "";
    $data_attr      = "";

    if($size != "") {
        $button_classes .= " {$size}";
    }

    if($text_align != "") {
        $button_classes .= " {$text_align}";
    }
    if($style) {
        $button_classes .= " {$style}";
    }
    if($color != ""){
        $button_styles .= 'color: '.$color.'; ';
    }

    if($border_color != ""){
        $button_styles .= 'border: 1px solid '.$border_color.'; ';
    }

    if($font_style != ""){
        $button_styles .= 'font-style: '.$font_style.'; ';
    }

    if($font_weight != ""){
        $button_styles .= 'font-weight: '.$font_weight.'; ';
    }
    if($align != ""){
        $button_styles .= 'text-align: '.$align.'; ';
    }

    if($icon != ""){
        $icon_style = "";
        if($icon_color != ""){
            $icon_style .= 'color: '.$icon_color.';';
        }
        $add_icon .= '<i class="fa fa-'.$icon.'" style="'.$icon_style.'"></i>';
    }

    if($margin != ""){
        $button_styles .= 'margin: '.$margin.'; ';
    }

	if($border_radius != ""){
		$button_styles .= 'border-radius: '.$border_radius.'px;-moz-border-radius: '.$border_radius.'px;-webkit-border-radius: '.$border_radius.'px; ';
	}

    if($background_color != "" ) {
        $button_styles .= "background-color: {$background_color};";
    }

    if($hover_background_color != "") {
        $data_attr .= "data-hover-background-color=".$hover_background_color." ";
    }

    if($hover_border_color != "") {
        $data_attr .= "data-hover-border-color=".$hover_border_color." ";
    }

    if($hover_color != "") {
        $data_attr .= "data-hover-color=".$hover_color;
    }

    $html .=  '<a href="'.esc_url($link).'" target="'.$target.'" '.$data_attr.' class="'.$button_classes.'" style="'.$button_styles.'">'.$add_icon." ".$text.'</a>';

    return $html;
}
add_shortcode('nova_button', 'nova_button_shortcode');