<?php

// [from_the_blog]

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false
);

$categories = get_categories($args);

$output_categories = array();

$output_categories["All"] = "";

foreach($categories as $category) { 
	$output_categories[htmlspecialchars_decode($category->name)] = $category->slug;
}

vc_map(array(
   "name"			=> "Posts Slider",
   "category"		=> "Content",
   "description"	=> "Display the latest posts in the blog",
   "base"			=> "from_the_blog",
   "class"			=> "",
   "icon"			=> "from_the_blog",

   
   "params" 	=> array(
      
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Number of Posts",
			"param_name" => "posts",
			"value" => "8",
			"description" => "Number of posts to be displayed in the slider."
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Colums of Posts",
			"param_name" => "columns",
			"value" => "2",
			"description" => "Number of columns for posts to be displayed in the slider."
		),	
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Colums for Desktop",
			"param_name" => "columns_2",
			"value" => "2",
			"description" => "Number of columns for posts to be displayed in desktop."
		),	
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Colums for Small Desktop",
			"param_name" => "columns_3",
			"value" => "2",
			"description" => "Number of columns for posts to be displayed in small desktop."
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Colums for Tablet",
			"param_name" => "columns_4",
			"value" => "1",
			"description" => "Number of columns for posts to be displayed in Tablet."
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Colums for Mobile",
			"param_name" => "columns_5",
			"value" => "1",
			"description" => "Number of columns for posts to be displayed in Mobile."
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "hide_in_vc_editor",
			"admin_label" => true,
			"heading" => "Category",
			"param_name" => "category",
			"value" => $output_categories
		),
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Show Reamore Button?",
			"param_name"	=> "show_readmore",
			"value"			=> array(
				"Yes"	=> "yes",
				"No"	=> "no"
			),
			"std"			=> "yes"
		),
   )
   
));