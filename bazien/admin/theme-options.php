<?php

    if ( ! class_exists( 'Novaworks_Theme_Options' ) ) {

        class Novaworks_Theme_Options {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'bazien' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'bazien' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'bazien' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_html($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'bazien' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'bazien' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'bazien' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo esc_html($this->theme->display( 'Description' )); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'bazien' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'bazien' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
				
                $this->sections[] = array(
                    'icon'   => 'fa fa-tachometer',
					'title'  => __( 'General', 'bazien' ),
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                        array (
							'title' => __('Favicon', 'bazien'),
							'subtitle' => __('<em>Upload your custom Favicon image. <br>.ico or .png file required.</em>', 'bazien'),
							'id' => 'favicon',
							'type' => 'media',
							'default' => array (
								'url' => get_template_directory_uri() . '/favicon.png',
							),
						),
						
                    ),
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-arrow-circle-up',
                    'title'  => __( 'Header', 'bazien' ),
                    'fields' => array(
						
						array(
                            'id'       => 'main_header_layout',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => __( 'Header Layout', 'bazien' ),
                            'subtitle' => __( '<em>Select the Layout style for the Header.</em>', 'bazien' ),
                            'options'  => array(
                                '1' => array(
                                    'alt' => 'Layout 1',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_1.png'
                                ),
                                '2' => array(
                                    'alt' => 'Layout 2',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_2.png'
                                ),
                                '3' => array(
                                    'alt' => 'Layout 3',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_3.png'
                                ),
                                '4' => array(
	                                'alt' => 'Layout 4',
	                                'img' => get_template_directory_uri() . '/images/theme_options/icons/header_4.png'
                                ),
                            ),
                            'default'  => '1'
                        ),
                        array (
                            'title' => __('Promotion Text', 'bazien'),
                            'subtitle' => __('<em>Enter promotion text in header 2.</em>', 'bazien'),
                            'id' => 'promotion_text',
                            'type' => 'textarea',
                            'default' => '<h2>FREESHIPPING ALL ODER</h2><p>(+91) 0123 456 789</p>',
                            'required' => array('main_header_layout','=','2')
                        ),


                        array (
							'id' => 'main_nav_font_options',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-font"></i> Font Settings</h3>',
						),
						
						array(
							'title' => __('Main Header Font Size', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the Main Header Font Size.</em>', 'bazien'),
							'id' => 'main_header_font_size',
							'type' => 'slider',
							"default" => 14,
							"min" => 11,
							"step" => 1,
							"max" => 16,
							'display_value' => 'text'
						),
						
						array (
							'title' => __('Main Header Font Color', 'bazien'),
							'subtitle' => __('<em>The Main Header Font Color.</em>', 'bazien'),
							'id' => 'main_header_font_color',
							'type' => 'color',
							'default' => '#202020',
							'transparent' => false
						),
						
						array (
							'id' => 'header_size_spacing',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-sliders"></i> Spacing and Size</h3>',
						),
						
						array(
							'title' => __('Spacing Above the Logo', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the Spacing Above the Logo.</em>', 'bazien'),
							'id' => 'spacing_above_logo',
							'type' => 'slider',
							"default" => 30,
							"min" => 0,
							"step" => 1,
							"max" => 200,
							'display_value' => 'text'
						),
						
						array(
							'title' => __('Spacing Below the Logo', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the Spacing Below the Logo.</em>', 'bazien'),
							'id' => 'spacing_below_logo',
							'type' => 'slider',
							"default" => 30,
							"min" => 0,
							"step" => 1,
							"max" => 200,
							'display_value' => 'text'
						),						
						
						array (
							'id' => 'header_bg_options',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-eyedropper"></i> Header Background</h3>',
						),
						
						array(
                            'id'       		=> 'main_header_background',
                            'type'     		=> 'background',
                            'title'    		=> "Header Background Color",
                            'subtitle' 		=> "<em>The Main Header background.</em>",
                            'default'  => array(
								'background-color' => '#ffffff',
							),
							'transparent' 	=> false,
                        ),						

                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Header Elements', 'bazien' ),
                    'subsection' => true,
                    'fields'     => array(
						
						array (
							'id' => 'bag_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-shopping-cart"></i> Shopping Cart Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Shopping Bag', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Shopping Bag in the Header.</em>', 'bazien'),
							'id' => 'main_header_shopping_bag',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'id' => 'search_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-search"></i> Search Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Search bar', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Search Bar in the Header.</em>', 'bazien'),
							'id' => 'main_header_search_bar',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),


                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Logo', 'bazien' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Your Logo', 'bazien'),
							'subtitle' => __('<em>Upload your logo image.</em>', 'bazien'),
							'id' => 'site_logo',
							'type' => 'media',
						),
						
						array (
							'title' => __('Alternative Logo', 'bazien'),
							'subtitle' => __('<em>The Alternative Logo is used on the <strong>Sticky Header</strong> and <strong>Mobile Devices</strong>.</em>', 'bazien'),
							'id' => 'sticky_header_logo',
							'type' => 'media'
						),
						
						array(
							'title' => __('Logo Container Min Width', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the logo container min width.</em>', 'bazien'),
							'id' => 'logo_min_height',
							'type' => 'slider',
							"default" => 300,
							"min" => 0,
							"step" => 1,
							"max" => 600,
							'display_value' => 'text',
							'required' => array( 'main_header_layout', 'equals', array( '2' ) ),
						),
						
						array(
							'title' => __('Logo Height', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the logo height <br/>(ignored if there\'s no uploaded logo).</em>', 'bazien'),
							'id' => 'logo_height',
							'type' => 'slider',
							"default" => 33,
							"min" => 0,
							"step" => 1,
							"max" => 300,
							'display_value' => 'text',
						),
                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Header Transparency', 'bazien' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Header Transparency (Global)', 'bazien'),
							'subtitle' => __('<em>When enabled, it sets the header to be transparent on all aplicable pages.</em>', 'bazien'),
							'id' => 'main_header_transparency',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 0,
						),
						
						array(
							'id'       => 'main_header_transparency_scheme',
							'type'     => 'button_set',
							'title'    => __( 'Default Color Scheme (Global)', 'bazien' ),
							'subtitle' => __( '<em>Set a default color scheme for the transparent header to be inherited by all the pages. The color scheme refers to the elements in the header (navigation, icons, etc.). </em>', 'bazien' ),
							'options'  => array(
								'header_transparent_light_present'	=> '<i class="fa fa-circle-o"></i> Light',
								'header_transparent_dark_present' 	=> '<i class="fa fa-circle"></i> Dark',
							),
							'default'  => 'header_transparent_light_present',
						),
						
						array (
							'id' => 'light_scheme',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-circle-o"></i> Light Color Scheme</h3>',
						),						
						
						array (
							'title' => __('Transparent Header Light Color', 'bazien'),
							'subtitle' => __('<em>The Transparent Header Light Color.</em>', 'bazien'),
							'id' => 'main_header_transparent_light_color',
							'type' => 'color',
							'default' => '#fff',
							'transparent' => false
						),
						
						array (
							'title' => __('Logo for Light Transparent Header', 'bazien'),
							'subtitle' => __('<em>Upload your Logo for Light Transparent Header.</em>', 'bazien'),
							'id' => 'light_transparent_header_logo',
							'type' => 'media'
						),

						array (
							'id' => 'dark_scheme',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-circle"></i> Dark Color Scheme</h3>',
						),	
						
						array (
							'title' => __('Transparent Header Dark Color', 'bazien'),
							'subtitle' => __('<em>The Transparent Header Dark Color.</em>', 'bazien'),
							'id' => 'main_header_transparent_dark_color',
							'type' => 'color',
							'default' => '#000',
							'transparent' => false
						),
						
						array (
							'title' => __('Logo for Dark Transparent Header', 'bazien'),
							'subtitle' => __('<em>Upload your Logo for Dark Transparent Header.</em>', 'bazien'),
							'id' => 'dark_transparent_header_logo',
							'type' => 'media'
						),						
                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Top Bar', 'bazien' ),
                    'subsection' => true,
                    'fields'     => array(
					
					array (
						'title' => __('Top Bar', 'bazien'),
						'subtitle' => __('<em>Enable / Disable the Top Bar.</em>', 'bazien'),
						'id' => 'top_bar_switch',
						'on' => __('Enabled', 'bazien'),
						'off' => __('Disabled', 'bazien'),
						'type' => 'switch',
						'default' => 1,
					),
					
					array (
						'title' => __('Top Bar Background Color', 'bazien'),
						'subtitle' => __('<em>The Top Bar background color.</em>', 'bazien'),
						'id' => 'top_bar_background_color',
						'type' => 'color',
						'default' => '#FFFFFF',
						'required' => array('top_bar_switch','=','1')
					),
					
					array (
						'title' => __('Top Bar Text Color', 'bazien'),
						'subtitle' => __('<em>Specify the Top Bar Typography.</em>', 'bazien'),
						'id' => 'top_bar_typography',
						'type' => 'color',
						'default' => '#202020',
						'transparent' => false,
						'required' => array('top_bar_switch','=','1')
					),
					
					array (
						'title' => __('Top Bar Text', 'bazien'),
						'subtitle' => __('<em>Type in your Top Bar info here.</em>', 'bazien'),
						'id' => 'top_bar_text',
						'type' => 'text',
						'default' => 'Free Shipping on All Orders Over $75!',
						'required' => array('top_bar_switch','=','1')
					),
					
					
                        
                    )
                );

				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Sticky Header', 'bazien' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Sticky Header', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Sticky Header.</em>', 'bazien'),
							'id' => 'sticky_header',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Sticky Header Background Color', 'bazien'),
							'subtitle' => __('<em>The Sticky Header background Color.</em>', 'bazien'),
							'id' => 'sticky_header_background_color',
							'type' => 'color',
							'default' => '#FFFFFF',
							'transparent' => false,
							'required' => array('sticky_header','=','1')
						),
						
						array (
							'title' => __('Sticky Header Color', 'bazien'),
							'subtitle' => __('<em>The Sticky Header Color.</em>', 'bazien'),
							'id' => 'sticky_header_color',
							'type' => 'color',
							'default' => '#202020',
							'transparent' => false,
							'required' => array('sticky_header','=','1')
						),
                        
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'fa fa-arrow-circle-down',
                    'title'   => __( 'Footer', 'bazien' ),
                    'fields'  => array(
                        
						array (
							'title' => __('Footer Background Color', 'bazien'),
							'subtitle' => __('<em>The Top Bar background color.</em>', 'bazien'),
							'id' => 'footer_background_color',
							'type' => 'color',
							'default' => '#353535',
						),
						
						array (
							'title' => __('Footer Text', 'bazien'),
							'subtitle' => __('<em>Specify the Footer Text Color.</em>', 'bazien'),
							'id' => 'footer_texts_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#b6b6b6',
						),
						
						array (
							'title' => __('Footer Links', 'bazien'),
							'subtitle' => __('<em>Specify the Footer Links Color.</em>', 'bazien'),
							'id' => 'footer_links_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#7b7b7b',
						),
						array (
							'title' => __('Footer Heading', 'bazien'),
							'subtitle' => __('<em>Specify the Footer Heading Color.</em>', 'bazien'),
							'id' => 'footer_heading_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#ffffff',
						),
												
						array (
							'title' => __('Social Icons', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Social Icons.</em>', 'bazien'),
							'id' => 'footer_social_icons',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Footer Copyright Text', 'bazien'),
							'subtitle' => __('<em>Enter your copyright information here.</em>', 'bazien'),
							'id' => 'footer_copyright_text',
							'type' => 'text',
							'default' => '&copy; 2015 Woocommerce Bazien Store. All Rights Reserved. Powered by <a href="http://www.themes4.net">Themes4</a>',
						),
						array (
							'title' => __('Footer Copyright Right Text', 'bazien'),
							'subtitle' => __('<em>Enter your copyright right information here.</em>', 'bazien'),
							'id' => 'footer_copyright_right_text',
							'type' => 'textarea',
							'default' => '
							    	<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_paypal.png">
</a>
<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_visa.png">
</a>
<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_mastercard.png">
</a>
<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_maestro.png">
</a>
<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_discover.png">
</a>
<a target="_blank" href="#">
<img title="PayPal" alt="PayPal" src="http://bazien.magentodemo.net/media/wysiwyg/bazien/payment_image_moneybookers.png">
</a>							',
						),						
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-list-alt',
                    'title'  => __( 'Blog', 'bazien' ),
                    'fields' => array(
                        
						array (
							'title' => __('Blog with Sidebar', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Sidebar on Blog.<em>', 'bazien'),
							'id' => 'sidebar_blog_listing',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-shopping-cart',
                    'title'  => __( 'Shop', 'bazien' ),
                    'fields' => array(
                        
						array (
							'title' => __('Catalog Mode', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Catalog Mode.</em>', 'bazien'),
							'desc' => __('<em>When enabled, the feature Turns Off the shopping functionality of WooCommerce.</em>', 'bazien'),
							'id' => 'catalog_mode',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
						),
						
						array (
							'title' => __('Breadcrumbs', 'bazien'),
							'subtitle' => __('<em>Enable / Disable the Breadcrumbs.</em>', 'bazien'),
							'id' => 'breadcrumbs',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Number of Products per Column', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the number of products per column <br />to be listed on the shop page and catalog pages.</em>', 'bazien'),
							'id' => 'products_per_column',
							'min' => '2',
							'step' => '1',
							'max' => '6',
							'type' => 'slider',
							'default' => '6',
						),
						
						array (
							'title' => __('Number of Products per Page', 'bazien'),
							'subtitle' => __('<em>Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.</em>', 'bazien'),
							'id' => 'products_per_page',
							'min' => '1',
							'step' => '1',
							'max' => '48',
							'type' => 'slider',
							'edit' => '1',
							'default' => '18',
						),
						
						array (
							'title' => __('Sidebar Style', 'bazien'),
							'subtitle' => __('<em>Choose the Shop Sidebar Style.<em>', 'bazien'),
							'id' => 'sidebar_style',
							'on' => __('On', 'bazien'),
							'off' => __('Off', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),

						
						array (
							'title' => __('Ratings on Catalog Page', 'bazien'),
							'subtitle' => __('<em>Enable / Disable Ratings on Catalog Page.</em>', 'bazien'),
							'id' => 'ratings_catalog_page',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-archive',
                    'title'  => __( 'Product Page', 'bazien' ),
                    'fields' => array(
                        
						array (
							'title' => __('Product Gallery Zoom', 'bazien'),
							'subtitle' => __('<em>Enable / Disable Product Gallery Zoom.<em>', 'bazien'),
							'id' => 'product_gallery_zoom',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Related Products', 'bazien'),
							'subtitle' => __('<em>Enable / Disable Related Products.<em>', 'bazien'),
							'id' => 'related_products',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Sharing Options', 'bazien'),
							'subtitle' => __('<em>Enable / Disable Sharing Options.<em>', 'bazien'),
							'id' => 'sharing_options',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Review Tab', 'bazien'),
							'subtitle' => __('<em>Enable / Disable Review Tab.<em>', 'bazien'),
							'id' => 'review_tab',
							'on' => __('Enabled', 'bazien'),
							'off' => __('Disabled', 'bazien'),
							'type' => 'switch',
							'default' => 1,
						),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-paint-brush',
                    'title'  => __( 'Styling', 'bazien' ),
                    'fields' => array(
                        
						array (
							'title' => __('Body Texts Color', 'bazien'),
							'subtitle' => __('<em>Body Texts Color of the site.</em>', 'bazien'),
							'id' => 'body_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#9b9b9b',
						),
						
						array (
							'title' => __('Headings Color', 'bazien'),
							'subtitle' => __('<em>Headings Color of the site.</em>', 'bazien'),
							'id' => 'headings_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#000000',
						),
						
						array (
							'title' => __('Main Theme Color', 'bazien'),
							'subtitle' => __('<em>The main color of the site.</em>', 'bazien'),
							'id' => 'main_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#eeb013',
						),
						array (
							'title' => __('Secondary Theme Color', 'bazien'),
							'subtitle' => __('<em>The secondary color of the site.</em>', 'bazien'),
							'id' => 'second_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#202020',
						),						
						array(
                            'id'       		=> 'main_background',
                            'type'     		=> 'background',
                            'title'    		=> "Body Background",
                            'subtitle' 		=> "<em>Body background with image, color, etc.</em>",
                            'default'  => array(
								'background-color' => '#fff',
							),
							'transparent' 	=> false,
                        ),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-font',
                    'title'  => __( 'Typography', 'bazien' ),
                    'fields' => array(
                        
						array (
							'id' => 'source_fonts_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Font Sources</h3>', 'bazien'),
						),
						
						array(
							'title'    => __('Font Source', 'bazien'),
							'subtitle' => __('<em>Choose the Font Source</em>', 'bazien'),
							'id'       => 'font_source',
							'type'     => 'radio',
							'options'  => array(
								'1' => 'Standard + Google Webfonts',
								'2' => 'Google Custom',
								'3' => 'Adobe Typekit'
							),
							'default' => '1'
						),
						
						// Google Code
						array(
							'id'=>'font_google_code',
							'type' => 'text',
							'title' => __('Google Code', 'bazien'), 
							'subtitle' => __('<em>Paste the provided Google Code</em>', 'bazien'),
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Typekit ID
						array(
							'id'=>'font_typekit_kit_id',
							'type' => 'text',
							'title' => __('Typekit Kit ID', 'bazien'), 
							'subtitle' => __('<em>Paste the provided Typekit Kit ID.</em>', 'bazien'),
							'default' => '',
							'required' => array('font_source','=','3')
						),
						
						array (
							'id' => 'main_font_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Main Font</h3>', 'bazien'),
						),
						
						// Standard + Google Webfonts
						array (
							'title' => __('Font Face', 'bazien'),
							'subtitle' => __('<em>Pick the Main Font for your site.</em>', 'bazien'),
							'id' => 'main_font',
							'type' => 'typography',
							'line-height' => false,
							'text-align' => false,
							'font-style' => false,
							'font-weight' => false,
							'all_styles'=> true,
							'font-size' => false,
							'color' => false,
							'default' => array (
								'font-family' => 'Lato',
								'subsets' => '',
							),
							'required' => array('font_source','=','1')
						),
						
						// Google Custom						
						array (
							'title' => __('Google Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Main Typography</em>', 'bazien'),
							'desc' => __('e.g.: open sans', 'bazien'),
							'id' => 'main_google_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Adobe Typekit						
						array (
							'title' => __('Typekit Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Main Typography</em>', 'bazien'),
							'desc' => __('e.g.: futura-pt', 'bazien'),
							'id' => 'main_typekit_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','3')
						),				
						
						
						array (
							'id' => 'secondary_font_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Secondary Font</h3>', 'bazien'),
						),
						
						// Standard + Google Webfonts
						array (
							'title' => __('Font Face', 'bazien'),
							'subtitle' => __('<em>Pick the Secondary Font for your site.</em>', 'bazien'),
							'id' => 'secondary_font',
							'type' => 'typography',
							'line-height' => false,
							'text-align' => false,
							'font-style' => false,
							'font-weight' => false,
							'all_styles'=> true,
							'font-size' => false,
							'color' => false,
							'default' => array (
								'font-family' => 'Lato',
								'subsets' => '',
							),
							'required' => array('font_source','=','1')
							
						),
						
						// Google Custom						
						array (
							'title' => __('Google Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Secondary Typography</em>', 'bazien'),
							'desc' => __('e.g.: open sans', 'bazien'),
							'id' => 'secondary_google_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Adobe Typekit						
						array (
							'title' => __('Typekit Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Secondary Typography</em>', 'bazien'),
							'desc' => __('e.g.: futura-pt', 'bazien'),
							'id' => 'secondary_typekit_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','3')
						),
						
						array (
							'id' => 'subtitle_font_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Sub Title Font</h3>', 'bazien'),
						),
						
						// Standard + Google Webfonts
						array (
							'title' => __('Font Face', 'bazien'),
							'subtitle' => __('<em>Pick the Sub Title Font for your site.</em>', 'bazien'),
							'id' => 'subtitle_font',
							'type' => 'typography',
							'line-height' => false,
							'text-align' => false,
							'font-style' => false,
							'font-weight' => false,
							'all_styles'=> true,
							'font-size' => false,
							'color' => false,
							'default' => array (
								'font-family' => 'Playfair Display',
								'subsets' => '',
							),
							'required' => array('font_source','=','1')
							
						),
						
						// Google Custom						
						array (
							'title' => __('Google Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Sub Title Typography</em>', 'bazien'),
							'desc' => __('e.g.: open sans', 'bazien'),
							'id' => 'subtitle_google_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Adobe Typekit						
						array (
							'title' => __('Typekit Font Face', 'bazien'),
							'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Sub Title Typography</em>', 'bazien'),
							'desc' => __('e.g.: futura-pt', 'bazien'),
							'id' => 'subtitle_typekit_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','3')
						),

						
						
                    )
                );
                // Social
                $this->sections[] = array(
                    'icon'      => ' fa fa-share-alt-square',
                    'title'     => __('Social Share', 'bazien'),
                    'fields'    => array(
                        array(
                            'id'        => 'social-share-facebook',
                            'type'      => 'switch',
                            'title'     => __('Facebook', 'bazien'),
                            'default'   => 1,
                            'on'        => 'Enabled',
                            'off'       => 'Disabled',
                        ),
                        array(
                            'id'        => 'social-share-twitter',
                            'type'      => 'switch',
                            'title'     => __('Twitter', 'bazien'),
                            'default'   => 1,
                            'on'        => 'Enabled',
                            'off'       => 'Disabled',
                        ),
                        array(
                            'id'        => 'social-share-email',
                            'type'      => 'switch',
                            'title'     => __('Email', 'bazien'),
                            'default'   => 1,
                            'on'        => 'Enabled',
                            'off'       => 'Disabled',
                        ),
                        array(
                            'id'        => 'social-share-pinterest',
                            'type'      => 'switch',
                            'title'     => __('Pinterest', 'bazien'),
                            'default'   => 1,
                            'on'        => 'Enabled',
                            'off'       => 'Disabled',
                        ),
                        array(
                            'id'        => 'social-share-google-plus',
                            'type'      => 'switch',
                            'title'     => __('Google Plus', 'bazien'),
                            'default'   => 1,
                            'on'        => 'Enabled',
                            'off'       => 'Disabled',
                        ),

                    ),
                );
                //End
				$this->sections[] = array(
                    'icon'   => 'el-icon-network',
                    'title'  => __( 'Social Media', 'bazien' ),
                    'fields' => array(

						array (
							'title' => __('<i class="fa fa-facebook"></i> Facebook', 'bazien'),
							'subtitle' => __('<em>Type your Facebook profile URL here.</em>', 'bazien'),
							'id' => 'facebook_link',
							'type' => 'text',
							'default' => 'https://www.facebook.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-twitter"></i> Twitter', 'bazien'),
							'subtitle' => __('<em>Type your Twitter profile URL here.</em>', 'bazien'),
							'id' => 'twitter_link',
							'type' => 'text',
							'default' => 'http://twitter.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-pinterest"></i> Pinterest', 'bazien'),
							'subtitle' => __('<em>Type your Pinterest profile URL here.</em>', 'bazien'),
							'id' => 'pinterest_link',
							'type' => 'text',
							'default' => 'http://www.pinterest.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-linkedin"></i> LinkedIn', 'bazien'),
							'subtitle' => __('<em>Type your LinkedIn profile URL here.</em>', 'bazien'),
							'id' => 'linkedin_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-google-plus"></i> Google+', 'bazien'),
							'subtitle' => __('<em>Type your Google+ profile URL here.</em>', 'bazien'),
							'id' => 'googleplus_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-rss"></i> RSS', 'bazien'),
							'subtitle' => __('<em>Type your RSS Feed URL here.</em>', 'bazien'),
							'id' => 'rss_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-tumblr"></i> Tumblr', 'bazien'),
							'subtitle' => __('<em>Type your Tumblr URL here.</em>', 'bazien'),
							'id' => 'tumblr_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-instagram"></i> Instagram', 'bazien'),
							'subtitle' => __('<em>Type your Instagram profile URL here.</em>', 'bazien'),
							'id' => 'instagram_link',
							'type' => 'text',
							'default' => 'http://instagram.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-youtube-play"></i> Youtube', 'bazien'),
							'subtitle' => __('<em>Type your Youtube profile URL here.</em>', 'bazien'),
							'id' => 'youtube_link',
							'type' => 'text',
							'default' => 'https://www.youtube.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-vimeo-square"></i> Vimeo', 'bazien'),
							'subtitle' => __('<em>Type your Vimeo profile URL here.</em>', 'bazien'),
							'id' => 'vimeo_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-behance"></i> Behance', 'bazien'),
							'subtitle' => __('<em>Type your Behance profile URL here.</em>', 'bazien'),
							'id' => 'behance_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-dribbble"></i> Dribble', 'bazien'),
							'subtitle' => __('<em>Type your Dribble profile URL here.</em>', 'bazien'),
							'id' => 'dribble_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-flickr"></i> Flickr', 'bazien'),
							'subtitle' => __('<em>Type your Flickr profile URL here.</em>', 'bazien'),
							'id' => 'flickr_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-git"></i> Git', 'bazien'),
							'subtitle' => __('<em>Type your Git profile URL here.</em>', 'bazien'),
							'id' => 'git_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-skype"></i> Skype', 'bazien'),
							'subtitle' => __('<em>Type your Skype profile URL here.</em>', 'bazien'),
							'id' => 'skype_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-weibo"></i> Weibo', 'bazien'),
							'subtitle' => __('<em>Type your Weibo profile URL here.</em>', 'bazien'),
							'id' => 'weibo_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-foursquare"></i> Foursquare', 'bazien'),
							'subtitle' => __('<em>Type your Foursquare profile URL here.</em>', 'bazien'),
							'id' => 'foursquare_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-soundcloud"></i> Soundcloud', 'bazien'),
							'subtitle' => __('<em>Type your Soundcloud profile URL here.</em>', 'bazien'),
							'id' => 'soundcloud_link',
							'type' => 'text',
						),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-code',
                    'title'  => __( 'Custom Code', 'bazien' ),
                    'fields' => array(
                        
						array (
							'title' => __('Custom CSS', 'bazien'),
							'subtitle' => __('<em>Paste your custom CSS code here.</em>', 'bazien'),
							'id' => 'custom_css',
							'type' => 'ace_editor',
							'mode' => 'css',
						),
						
						array (
							'title' => __('Header JavaScript Code', 'bazien'),
							'subtitle' => __('<em>Paste your custom JS code here. The code will be added to the header of your site.</em>', 'bazien'),
							'id' => 'header_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),
						
						array (
							'title' => __('Footer JavaScript Code', 'bazien'),
							'subtitle' => __('<em>Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.</em>', 'bazien'),
							'id' => 'footer_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),
						
                    )
                );

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'bazien' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'bazien' ),
                    'icon'   => 'fa fa-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                /*$this->sections[] = array(
                    'type' => 'divide',
                );*/
				
				$theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'bazien' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'bazien' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'bazien' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'bazien' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'bazien_theme_options',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Theme Options', 'bazien' ),
                    'page_title'           => __( 'Theme Options', 'bazien' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => 'AIzaSyBFsuyEGSV3caEJFrKaShHtDjWNrO6ako4',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => 3,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'theme_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    'footer_credit'     => '&nbsp;',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );



                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = "";
                } else {
                    $this->args['intro_text'] = "";
                }

                // Add content after the form.
                $this->args['footer_text'] = "";
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Novaworks_Theme_Options();
    } else {
        echo "The class named Novaworks_Theme_Options has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
