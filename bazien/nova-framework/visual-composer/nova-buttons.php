<?php
// [nova_button]
vc_map(
	array(
		"name"						=> __( "Button", "bazien" ),
		"base"						=> "nova_button",
		"category"					=> 'Content',
		"icon"						=> "icon-wpb-button",
		"allowed_container_element"	=> 'vc_row',
		"params"					=> array(
			array(
				"type"				=> "dropdown",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Size", "bazien" ),
				"param_name"		=> "size",
				"value"				=> array(
					"Default"		=> "",
                    "Small"			=> "small",
					"Medium"		=> "medium",	
					"Large"			=> "large",
				)
			),
			array(
				"type"				=> "textfield",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Text", "bazien" ),
				"param_name"		=> "text"
			),
			array(
				"type"				=> "dropdown",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Style", "bazien" ),
				"param_name"		=> "style",
				"value"				=> array(
					"Default"			=> "default",
                    "Icon Only"			=> "icon-only",
					"Icon With Text"	=> "icon-text",
					"Stroke"			=>	"stroke",
					"Larger"			=>	"larger"
				)
			),
			array(
				"type"				=> "icon",
				"class"				=> "",
				"heading"			=> __( "Select Icon:", "bazien" ),
				"param_name"		=> "icon",
				"admin_label"		=> true,
				"value"				=> "",
				"description"		=> __( "Select the icon from the list.", "bazien" ),
		        "dependency"		=> array(
					'element'		=> 'icon_type',
					'value'			=> array('font')
				),
			),
			array(
				"type"				=> "textfield",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Link", "bazien" ),
				"param_name"		=> "link"
			),
			array(
				"type"				=> "dropdown",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Link Target", "bazien" ),
				"param_name"		=> "target",
				"value"				=> array(
					"Self"			=> "_self",
					"Blank"			=> "_blank",	
					"Parent"		=> "_parent",
					"Top"			=> "_top"	
				)
			),
            array(
                "type"				=> "dropdown",
                "holder"			=> "div",
                "class"				=> "",
                "heading"			=> __( "Align", "bazien" ),
                "param_name"		=> "align",
                "value"				=> array(
                    "Inherit"			=> "",
                    "Left"			=> "left",
                    "Center"		=> "center",
                    "Right"			=> "right"
                )
            ),
			array(
				"type"				=> "colorpicker",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Color", "bazien" ),
				"param_name"		=> "color"
			),
            array(
                "type"				=> "colorpicker",
                "holder"			=> "div",
                "class"				=> "",
                "heading"			=> __( "Hover Color", "bazien" ),
                "param_name"		=> "hover_color"
            ),
            array(
                "type"				=> "colorpicker",
                "holder"			=> "div",
                "class"				=> "",
                "heading"			=> __( "Background Color", "bazien" ),
                "param_name"		=> "background_color"
            ),
            array(
                "type"				=> "colorpicker",
                "holder"			=> "div",
                "class"				=> "",
                "heading"			=> __( "Hover Background Color", "bazien" ),
                "param_name"		=> "hover_background_color"
            ),
			array(
				"type"				=> "colorpicker",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Border Color", "bazien" ),
				"param_name"		=> "border_color"
			),
            array(
                "type"				=> "colorpicker",
                "holder"			=> "div",
                "class"				=> "",
                "heading"			=> __( "Hover Border Color", "bazien" ),
                "param_name"		=> "hover_border_color"
            ),
			array(
				"type"				=> "textfield",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> "Margin",
				"param_name"		=> "margin",
				"description"		=> __( "Please insert margin in format: 0px 0px 1px 0px", 'bazien' )
			),
			array(
				"type"				=> "textfield",
				"holder"			=> "div",
				"class"				=> "",
				"heading"			=> __( "Border radius", "bazien" ),
				"param_name"		=> "border_radius",
				"description"		=> __( "Please insert border radius(Rounded corners) in px. For example: 4 ", 'bazien' )
			)
		)
	)
);