<?php

// [bazien_page_title]

vc_map(array(
   "name"			=> "Page Title",
   "category"		=> 'Content',
   "description"	=> "Block Title",
   "base"			=> "bazien_page_title",
   "class"			=> "",
   "icon"			=> "bazien_page_title",

   
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
   )
   
));