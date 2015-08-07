<?php

// [bazien_block_title]

vc_map(array(
   "name"			=> "Block Title",
   "category"		=> 'Content',
   "description"	=> "Block Title",
   "base"			=> "bazien_block_title",
   "class"			=> "",
   "icon"			=> "bazien_block_title",

   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "title",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle",
			"param_name"	=> "subtitle",
			"admin_label"	=> FALSE,
			"value"			=> "",
		),
		
   )
   
));