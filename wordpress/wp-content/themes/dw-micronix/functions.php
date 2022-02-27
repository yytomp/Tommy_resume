<?php

//$content_width is required even though this is a variable-width theme
if ( ! isset( $dw_micronix_content_width ) ) {
	$dw_micronix_content_width = 400;
}

function dw_micronix_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

function dw_micronix_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true === $input ) ? true : false );
}

//makes replying look neat
if ( ! function_exists( 'dw_micronix_threaded_comments' ) ) :
	function dw_micronix_threaded_comments() {
		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'dw_micronix_threaded_comments' );
endif;

// displays "Comments are closed" instead of comment form when comments are closed.
if ( ! function_exists( 'dw_micronix_closed_comments' ) ) :
	function dw_micronix_closed_comments() {
		echo '<p>', esc_html__( 'Comments are closed.', 'dw-micronix' ), '</p>';
	}
	add_action( 'comment_form_comments_closed', 'dw_micronix_closed_comments' );
endif;

if ( ! function_exists( 'dw_micronix_setup' ) ) :
	function dw_micronix_setup() {
		load_theme_textdomain( 'dw-micronix', get_template_directory() . '/languages' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 150,
				'width'       => 500,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'customize-selective-remicronix-widgets' );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 );
		add_image_size( 'dw-micronix-single-post-thumbnail', 9999, 9999 );
		add_image_size( 'dw-micronix-homepage-featured', 350, 350 );
		add_theme_support(
			'starter-content', 
			array(
				'widgets' => array(
					'left-sidebar'  => array(
						array(
							'text',
							array(
								'title' => esc_html__( 'First Sidebar', 'dw-micronix' ),
								'text'  => _x( 'This is some text in the first sidebar.', 'Theme Starter Content', 'dw-micronix' ),
							),
						),
					),
					'right-sidebar' => array(
						array(
							'text',
							array(
								'title' => esc_html__( 'Second Sidebar', 'dw-micronix' ),
								'text'  => _x( 'This is some text in the second sidebar.', 'Theme Starter Content', 'dw-micronix' ),
							),
						),
					),
					'center-block'  => array(
						array(
							'text',
							array(
								'title' => esc_html__( 'Center Block', 'dw-micronix' ),
								'text'  => _x( 'This is some text in the center block.', 'Theme Starter Content', 'dw-micronix' ),
							),
						),
					),
				),
			)
		);
	}
	add_action( 'after_setup_theme', 'dw_micronix_setup' );
endif;

if ( ! function_exists( 'dw_micronix_register_menu' ) ) :
	function dw_micronix_register_menu() {
		register_nav_menus(
			array(
				'top_header_menu' => esc_html__( 'Top Header Menu', 'dw-micronix' ),
			)
		);
	}
	add_action( 'init', 'dw_micronix_register_menu' );
endif;

if ( ! function_exists( 'dw_micronix_stylesheet' ) ) :
	function dw_micronix_stylesheet() {
		wp_enqueue_style( 'dw-micronix-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->version );
	}
	add_action( 'wp_enqueue_scripts', 'dw_micronix_stylesheet' );
endif;

if ( ! function_exists( 'dw_micronix_sidebars' ) ) :
	// register the sidebars
	function dw_micronix_sidebars() {
		register_sidebar( 
			array(
				'name' => __( 'Left Sidebar 1', 'dw-micronix' ),
				'id'   => 'left-sidebar',
			)
		);
		register_sidebar(
			array(
				'name' => __( 'Right Sidebar 1', 'dw-micronix' ),
				'id'   => 'right-sidebar',
			)
		);
		register_sidebar(
			array(
				'name' => __( 'Center Block 1', 'dw-micronix' ),
				'id'   => 'center-block',
			)
		);
	}
	add_action( 'widgets_init', 'dw_micronix_sidebars' );
endif;

// display information about a post under the post title
if ( ! function_exists( 'dw_micronix_post_meta' ) ) :
	function dw_micronix_post_meta() {
		echo '<div class="meta">';
		if ( get_post_type() === 'page' ) :
			printf(
				/* translators: %s = author */
				esc_html__( 'Posted by %s', 'dw-micronix' ),
				get_the_author()
			);
		elseif ( has_category() ) :
			printf(
				/* translators: %1$s = date, %2$s = categories, %3$s = author */
				esc_html__( 'Posted on %1$s in %2$s by %3$s', 'dw-micronix' ),
				get_the_date(),
				wp_kses_post( get_the_category_list( ',' ) ),
				get_the_author()
			);
		else :
			printf(
				/* translators: %1$s = date, %2$s = author */
				esc_html__( 'Posted on %1$s by %2$s', 'dw-micronix' ),
				get_the_date(),
				get_the_author()
			);
		endif;
		edit_post_link( _x( 'Edit', 'verb', 'dw-micronix' ), ' | ' );
		if ( get_post_type() !== 'page' && has_tag() ) :
			echo '<br>';
			the_tags();
		endif;
		echo '</div>';
	}
endif;

// change the archive title to show the search query when showing the archive title on a search result page.
if ( ! function_exists( 'dw_micronix_search_title' ) ) :
	function dw_micronix_search_title( $title ) {
		if ( is_search() ) {
			/* translators: %s = search query */
			$title = sprintf( __( 'Search: %s', 'dw-micronix' ), get_search_query() );
		}
		return $title;
	}
	add_filter( 'get_the_archive_title', 'dw_micronix_search_title' );
endif;

function dw_micronix_google_fonts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Electrolize&display=swap', array(), wp_get_theme()->version );
}
add_action( 'wp_enqueue_scripts', 'dw_micronix_google_fonts' );

/**
 * Enqueue scripts
 */
function dw_micronix_enqueue_scripts() {
	wp_enqueue_script( 'dw-micronix-header-clock', get_template_directory_uri() . '/js/dw-micronix-header-clock.js', array(), wp_get_theme()->version, true );
	wp_enqueue_script( 'dw-micronix-top-button', get_template_directory_uri() . '/js/dw-micronix-top-button.js', array(), wp_get_theme()->version, true );
	wp_enqueue_script( 'dw-micronix-navigation', get_template_directory_uri() . '/js/dw-micronix-navigation.js', array( 'jquery' ), '20141205', true );
	wp_enqueue_script( 'dw-micronix-hue-selector', get_template_directory_uri() . '/js/dw-micronix-hue-selector.js', array(), wp_get_theme()->version, true );
}
add_action( 'wp_enqueue_scripts', 'dw_micronix_enqueue_scripts' );

// Add Footer Text Box section to customize
function dw_micronix_fcontent( $wp_customize ) {
	$wp_customize->add_section(
		'dw-micronix-fcontent-section', 
		array(
			'title' => __( 'Footer Text Box', 'dw-micronix' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-fcontent-text-control', 
			array(
				'type'        => 'button',
				'settings'    => array(),
				'label'       => __( 'Get this feature with premium!', 'dw-micronix' ),
				'priority'    => 10,
				'section'     => 'dw-micronix-fcontent-section',
				'input_attrs' => array(
					'value'   => __( 'Click Here!', 'dw-micronix' ),
					'class'   => 'button-secondary',
					'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
				),
			)
		)
	);
}

add_action( 'customize_register', 'dw_micronix_fcontent' );

// Premium Upgrade Section
function dw_micronix_procontent( 
	$wp_customize ) {
	$wp_customize->add_section(
		'pro_sec', 
		array(
			'title'       => __( 'GET PREMIUM VERSION', 'dw-micronix' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
		'button_id',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'BUY PREMIUM VERSION', 'dw-micronix' ),
				'class'   => 'button-primary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);

	$wp_customize->add_control(
		'label',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Premium Features:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( '12 More Widget Blocks', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'label1',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'Footer HTML/Text Content Area', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'label2',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'Top Header and Bottom Footer Length Widget Area', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'label3',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'bbPress Matching Forum Style', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'label4',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'And More!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'label5',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'FOR MORE DW THEMES:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'pro_sec',
			'input_attrs' => array(
				'value'   => __( 'CLICK HERE!', 'dw-micronix' ),
				'class'   => 'button-primary',
				'onclick' => "window.open('https://www.designwicked.com/wordpress-themes', '_blank')",
			),
		)
	);
	
}
	
	add_action( 'customize_register', 'dw_micronix_procontent' );

// Header Nav
function dw_micronix_hnav( $wp_customize ) {
	$wp_customize->add_section(
		'dw-micronix-hnav-section',
		array(
			'title' => esc_html__( 'Header Navigation', 'dw-micronix' ),
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-linkname1',
		array(
			'default'           => esc_html__( 'Link 1', 'dw-micronix' ),
			'sanitize_callback' => 'dw_micronix_sanitize_html',
		)
	);


	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-linkname1',
			array(
				'label'       => esc_html__( 'Link 1 Name:', 'dw-micronix' ),
				'section'     => 'dw-micronix-hnav-section',
				'description' => esc_html__( 'The visible name of the link on the button.', 'dw-micronix' ),
				'settings'    => 'dw-micronix-hnav-linkname1',
				'type'        => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-link1',
		array(
			'default'           => esc_html__( 'http://', 'dw-micronix' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);


	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-link1',
			array(
				'label'       => esc_html__( 'Link 1 Address:', 'dw-micronix' ),
				'section'     => 'dw-micronix-hnav-section',
				'description' => esc_html__( 'You can use /address to point to a directory, or just put a full link including http://', 'dw-micronix' ),
				'settings'    => 'dw-micronix-hnav-link1',
				'type'        => 'url',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-linkname2',
		array(
			'default'           => esc_html__( 'Link 2', 'dw-micronix' ),
			'sanitize_callback' => 'dw_micronix_sanitize_html',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-linkname2',
			array(
				'label'    => esc_html__( 'Link 2 Name:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-linkname2',
				'type'     => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-link2',
		array(
			'default'           => esc_html__( 'http://', 'dw-micronix' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-link2',
			array(
				'label'    => esc_html__( 'Link 2 Address:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-link2',
				'type'     => 'url',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-linkname3',
		array(
			'default'           => esc_html__( 'Link 3', 'dw-micronix' ),
			'sanitize_callback' => 'dw_micronix_sanitize_html',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-linkname3',
			array(
				'label'    => esc_html__( 'Link 3 Name:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-linkname3',
				'type'     => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-link3',
		array(
			'default'           => esc_html__( 'http://', 'dw-micronix' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-link3',
			array(
				'label'    => esc_html__( 'Link 3 Address:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-link3',
				'type'     => 'url',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-linkname4',
		array(
			'default'           => esc_html__( 'Link 4', 'dw-micronix' ),
			'sanitize_callback' => 'dw_micronix_sanitize_html',
		)
	);


	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-linkname4',
			array(
				'label'    => esc_html__( 'Link 4 Name:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-linkname4',
				'type'     => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-link4',
		array(
			'default'           => esc_html__( 'http://', 'dw-micronix' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-link4',
			array(
				'label'    => esc_html__( 'Link 4 Address:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-link4',
				'type'     => 'url',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-linkname5',
		array(
			'default'           => esc_html__( 'Link 5', 'dw-micronix' ),
			'sanitize_callback' => 'dw_micronix_sanitize_html',
		)
	);


	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-linkname5',
			array(
				'label'    => esc_html__( 'Link 5 Name:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-linkname5',
				'type'     => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'dw-micronix-hnav-link5',
		array(
			'default'           => esc_html__( 'http://', 'dw-micronix' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'dw-micronix-hnav-control-link5',
			array(
				'label'    => esc_html__( 'Link 5 Address:', 'dw-micronix' ),
				'section'  => 'dw-micronix-hnav-section',
				'settings' => 'dw-micronix-hnav-link5',
				'type'     => 'url',
			)
		)
	);
}
add_action( 'customize_register', 'dw_micronix_hnav' );

//Social Bar
function dw_micronix_socialbar( $wp_customize ) {
	$wp_customize->add_section(
		'dw_micronix_socialbar_section',
		array(
			'title'       => esc_html__( 'Social Bar', 'dw-micronix' ),
			'description' => esc_html__( 'Add Social Bar Content', 'dw-micronix' ),
			'priority'    => null,
		)
	);
	
	//Social Icons
	$wp_customize->add_setting(
		'dw_micronix_facebook_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'dw_micronix_facebook_url',
		array(
			'label'       => esc_html__( 'Facebook Link:', 'dw-micronix' ),
			'description' => esc_html__( '--Fill in address to make icons appear.', 'dw-micronix' ),
			'section'     => 'dw_micronix_socialbar_section',
			'setting'     => 'dw_micronix_facebook_url',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'dw_micronix_gplus_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'dw_micronix_gplus_url',
		array(
			'label'   => esc_html__( 'Google+ Link:', 'dw-micronix' ),
			'section' => 'dw_micronix_socialbar_section',
			'setting' => 'dw_micronix_gplus_url',
			'type'    => 'url',
		)
	);
	
	$wp_customize->add_control(
		'labels',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Twitter Link:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'dw_micronix_socialbar_section',
			'input_attrs' => array(
				'value'   => __( 'Get pro for this feature!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'labels1',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Linkedin Link:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'dw_micronix_socialbar_section',
			'input_attrs' => array(
				'value'   => __( 'Get pro for this feature!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'labels2',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Instagram Link:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'dw_micronix_socialbar_section',
			'input_attrs' => array(
				'value'   => __( 'Get pro for this feature!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'labels3',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Youtube Link:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'dw_micronix_socialbar_section',
			'input_attrs' => array(
				'value'   => __( 'Get pro for this feature!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);
	
	$wp_customize->add_control(
		'labels4',
		array(
			'type'        => 'button',
			'settings'    => array(),
			'label'       => __( 'Discord Link:', 'dw-micronix' ),
			'priority'    => 10,
			'section'     => 'dw_micronix_socialbar_section',
			'input_attrs' => array(
				'value'   => __( 'Get pro for this feature!', 'dw-micronix' ),
				'class'   => 'button-secondary',
				'onclick' => "window.open('https://www.designwicked.com/premium-micronixwp', '_blank')",
			),
		)
	);
	
}
	add_action( 'customize_register', 'dw_micronix_socialbar' );
