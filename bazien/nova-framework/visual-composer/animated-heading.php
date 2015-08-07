<?php
/* Animated Heading element
----------------------------------------------------------- */
vc_map( array(
    'name' => __( 'Animated Heading', 'js_composer' ),
    'base' => 'animated-heading',
    'icon' => 'icon-wpb-ui-custom_heading',
    'show_settings_on_create' => true,
    'category' => __( 'Content', 'js_composer' ),
    'description' => __( 'Add custom heading text with google fonts', 'js_composer' ),
    'params' => array(
        array(
            'type' => 'textarea',
            'heading' => __( 'Text', 'js_composer' ),
            'param_name' => 'text',
            'admin_label' => true,
            'value'=> __( 'This is animated heading element', 'bazien' ),
            'description' => __( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
        ),
        array(
            'type' => 'textarea',
            'heading' => __( 'Animated Text', 'js_composer' ),
            'param_name' => 'animated_text',
            'admin_label' => true,
            'value'=> __( 'Option 1;Option 2;Option 3', 'js_composer' ),
            'description' => __( 'Each option is distinguished by ";".', 'js_composer' ),
        ), 
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Heading Animation",
			"param_name"	=> "heading_animation",
			"value"			=> array(
				"Rotate 1"	=> "rotate-1",
				"Type"	=> "type",
				"Rotate 2"	=> "rotate-2",
				"Loading Bar"	=> "loading-bar",
				"Slide"	=> "slide",
				"Clip"	=> "clip",
				"Zoom"	=> "zoom",
				"Rotate-3"	=> "rotate-3",
				"Scale"	=> "scale",
				"Push"	=> "push"
			),
			"std"			=> "rotate-1",
		), 
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Heading Tag",
			"param_name"	=> "heading_tag",
			"value"			=> array(
				"h1"	=> "h1",
				"h2"	=> "h2",
				"h3"	=> "h3",
				"h4"	=> "h4",
				"h5"	=> "h5",
				"h6"	=> "h6",
				"p"	=> "p",
				"div"	=> "div"
			),
			"std"			=> "h1",
		), 
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Heading Align",
			"param_name"	=> "heading_align",
			"value"			=> array(
				"Left"	=> "left",
				"Center"	=> "center",
				"Right"	=> "right"
			),
			"std"			=> "left",
		),  
        array(
            'type' => 'textfield',
            'heading' => 'Heading Font Size',
            'param_name' => 'heading_font_size',
        ),	
        array(
            'type' => 'textfield',
            'heading' => 'Heading Line Height',
            'param_name' => 'heading_line_height',
        ),	 
         array(
            'type' => 'textfield',
            'heading' => 'Heading Letter Space',
            'param_name' => 'heading_letter_space',
        ),	
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Heading Color",
			"param_name"	=> "heading_color",
			"value"			=> ""
		),                      	             
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        )
    ),
    
));