<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );


//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'GenPro', 'genpro' ) );
define( 'CHILD_THEME_URL', 'http://shohag.me' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'genpro_load_scripts' );
function genpro_load_scripts() {

	wp_enqueue_script( 'genpro-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,700,300italic|Titillium+Web:600', array(), CHILD_THEME_VERSION );
	
}

//* Add new image sizes
add_image_size( 'featured-image', 358, 200, TRUE );
add_image_size( 'home-top', 750, 600, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 80,
	'width'           => 320,
) );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'genpro-black'	=> __( 'genpro Pro Black', 'genpro' ),
	'genpro-green'	=> __( 'genpro Pro Green', 'genpro' ),
	'genpro-orange'	=> __( 'genpro Pro Orange', 'genpro' ),
	'genpro-red'    => __( 'genpro Pro Red', 'genpro' ),
	'genpro-teal'	=> __( 'genpro Pro Teal', 'genpro' ),
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genpro_secondary_menu_args' );
function genpro_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'genpro_remove_comment_form_allowed_tags' );
function genpro_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
remove_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );


//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'genpro' ),
	'description' => __( 'This is the top section of the homepage.', 'genpro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'genpro' ),
	'description' => __( 'This is the bottom section of the homepage.', 'genpro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-left',
	'name'        => __( 'Home - Left', 'genpro' ),
	'description' => __( 'This is the Left section of the homepage.', 'genpro' ),
));

genesis_register_sidebar( array(
	'id'          => 'home-right',
	'name'        => __( 'Home - Right', 'genpro' ),
	'description' => __( 'This is the right section of the homepage.', 'genpro' ),
));

genesis_register_sidebar( array(
	'id'          => 'home-last',
	'name'        => __( 'Home - Last', 'genpro' ),
	'description' => __( 'This is the last section of the homepage.', 'genpro' ),
));

//* Adding Optin form under Header and before Footer

genesis_register_sidebar( array(
	'id'          => 'header-optin',
	'name'        => __( 'Header Optin box', 'genpro' ),
	'description' => __( 'This is the header Optinbox section ', 'genpro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'footer-optin',
	'name'        => __( 'Footer Optin box', 'genpro' ),
	'description' => __( 'This is the footer Optinbox section.', 'genpro' ),
) );

add_action( 'genesis_before_entry', 'genpro_add_header_optinbox' );
function genpro_add_header_optinbox() {
	if ( is_single() || is_page() )
		genesis_widget_area ('header-optin', array(
        'before' => '<div class="header-opt-in widget-area"><div class="wrap">',
        'after' => '</div></div>',
	) );
} 

add_action( 'genesis_after_entry', 'genpro_add_footer_optinbox' );
function genpro_add_footer_optinbox() {
	if ( is_single() || is_page() )
		genesis_widget_area ('footer-optin', array(
        'before' => '<div class="horizontal-opt-in widget-area"><div class="wrap">',
        'after' => '</div></div>',
	) );
}