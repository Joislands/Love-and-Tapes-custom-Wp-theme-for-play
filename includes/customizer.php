<?php
/**************************************************************************
Customizer include file
Includes all functions for the customizer with this theme
**************************************************************************/

/**************************************************************************
Add theme customizer controls, settings etc.
**************************************************************************/
function playjo_customize_register( $wp_customize ) {
	
	/*******************************************
	Sections
	********************************************/
	
	// contact details section
	$wp_customize->add_section( 'playjo_contact' , array(
		'title' => __( 'Contact Details', 'playjo')
	) );
	
	// section for colors 
	$wp_customize->add_section( 'playjo_colors', array(
		'title' => __( 'Color Scheme', 'playjo' )
	));
	
	/********************
	Define generic controls
	*********************/
	
	// create class to define textarea controls in Customizer
	class playjo_Customize_Textarea_Control extends WP_Customize_Control {
		
		public $type = 'textarea';
		public function render_content() {
			
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
				echo '<textarea rows="2" style ="width: 100%;"';
				$this->link();
				echo '>' . esc_textarea( $this->value() ) . '</textarea>';
			echo '</label>';
			
		}
	}	
	
	/*******************************************
	Contact details in header
	********************************************/
	
	//settings
	// address
	$wp_customize->add_setting( 'playjo_address_setting', array (
		'default' => __( 'Your address', 'playjo' )
	) );
	$wp_customize->add_control( new playjo_Customize_Textarea_Control(
		$wp_customize,
		'playjo_address_setting',
		array( 
			'label' => __( 'Address', 'playjo' ),
			'section' => 'playjo_contact',
			'settings' => 'playjo_address_setting'
	)));
	
	// phone number
	$wp_customize->add_setting( 'playjo_telephone_setting', array (
		'default' => __( 'Your telephone number', 'playjo' )
	) );
	$wp_customize->add_control( new playjo_Customize_Textarea_Control(
		$wp_customize,
		'playjo_telephone_setting',
		array( 
			'label' => __( 'Telephone Number', 'playjo' ),
			'section' => 'playjo_contact',
			'settings' => 'playjo_telephone_setting'
	)));
	
	// email
	$wp_customize->add_setting( 'playjo_email_setting', array (
		'default' => __( 'Your email address', 'playjo' )
	) );
	$wp_customize->add_control( new playjo_Customize_Textarea_Control(
		$wp_customize,
		'playjo_email_setting',
		array( 
			'label' => __( 'Email', 'playjo' ),
			'section' => 'playjo_contact',
			'settings' => 'playjo_email_setting'
	)));
	
	
	/*******************************************
	Color scheme
	********************************************/
	
	// main color - site title, h1, h2, h4, widget headings, nav links, footer background
	$textcolors[] = array(
		'slug' => 'playjo_color1',
		'default' => '#3394bf',
		'label' => __( 'Main color', 'playjo' )
	);
	
	// secondary color - navigation background
	$textcolors[] = array(
		'slug' => 'playjo_color2',
		'default' => '#183c5b',
		'label' => __( 'Secondary color', 'playjo' )
	);
	
	// link color
	$textcolors[] = array(
		'slug' => 'playjo_links_color1',
		'default' => '#3394bf',
		'label' => __( 'Links color', 'playjo' )
	);
	
	// link color on hover
	$textcolors[] = array(
		'slug' => 'playjo_links_color2',
		'default' => '#666',
		'label' => __( 'Links color (on hover)', 'playjo' )
	);
	
	// add settings and controls for each color
	foreach ( $textcolors as $textcolor ) {
		
		// settings
		$wp_customize->add_setting(
			$textcolor[ 'slug' ], array (
				'default' => $textcolor[ 'default' ],
				'type' => 'option'
			)
		);
		// controls
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			$textcolor[ 'slug' ],
			array (
				'label' => $textcolor[ 'label' ],
				'section' => 'playjo_colors',
				'settings' => $textcolor[ 'slug' ]
			)
		));
	}
	
}
add_action( 'customize_register', 'playjo_customize_register' );

/**********************************************************************
Add controls / content to theme
**********************************************************************/

function playjo_display_contact_details_in_header() { ?>
	
	<address>
		
		<p class="address">
			<?php echo get_theme_mod( 'playjo_address_setting', 'Your address' ); ?>
		</p>
		
		<p class="tel">
			<?php echo get_theme_mod( 'playjo_telephone_setting', 'Your telephone number' ); ?>
		</p>
		
		<?php $email = get_theme_mod( 'playjo_email_setting', 'Your email address' ); ?>
		<p class="email">
			<a href="<?php echo $email; ?>">
				<?php echo $email; ?>
			</a>
		</p>
	
	</address>
	
<?php }
add_action( 'playjo_in_header', 'playjo_display_contact_details_in_header' );


/*******************************************************************************
 add styling to theme - attaches to the wp_head hook
 ********************************************************************************/
function playjo_add_color_scheme() {
	
	/****************
	define text colors
	****************/
	$color_scheme1 = get_option( 'playjo_color1' );
	$color_scheme2 = get_option( 'playjo_color2' );
	$link_color1 = get_option( 'playjo_links_color1' );
	$link_color2 = get_option ( 'playjo_links_color2' );
	
	/**************
	add classes
	**************/
	?>
	
	<style>
	
		/* main color */
		.site-title a:link,
		.site-title a:visited,
		.site-description,
		h1,
		h2,
		h2.page-title,
		h2.post-title,
		h2 a:link,
		h2 a:visited,
		nav.main a:link,
		nav.main a:visited {
			color: <?php echo $color_scheme1; ?>;
		}
		footer {
			background: <?php echo $color_scheme1; ?>;
		}
		
		/* secondary color */
		nav.main,
		nav.main a {
			background: <?php echo $color_scheme2; ?>;
		}
		
		/* links color */
		a:link,
		a:visited,
		.sidebar a:link,
		.sidebar a:visited {
			color: <?php echo $link_color1; ?>;
		}
		
		/* links hover color */
		a:hover,
		a:active,
		.sidebar a:hover,
		.sidebar a:active {
			color: <?php echo $link_color2; ?>;
		}
	
	</style>
	
<?php }
add_action( 'wp_head', 'playjo_add_color_scheme' );
