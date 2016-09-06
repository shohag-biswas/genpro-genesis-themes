<?php
/**
 * This file adds the Home Page to the genpro Pro Theme.
 *
 * @author StudioPress
 * @package genpro Pro
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'genpro_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function genpro_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-bottom' ) || is_active_sidebar('home-left') || is_active_sidebar('home-right') ){

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Add genpro-pro-home body class
		add_filter( 'body_class', 'genpro_body_class' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add home top widgets
		add_action( 'genesis_after_header', 'genpro_home_top_widgets' );
		
		//* Add home bottom widgets
		add_action( 'genesis_loop', 'genpro_home_bottom_widgets' );
		
		//* Add home left widgets
		add_action('genesis_loop','genpro_home_left_widgets');
		
		//*Add home right widgets
		add_action('genesis_loop', 'genpro_home_right_widgets');
		
		//*Add home last section widgets
		add_action('genesis_loop', 'genpro_home_last_widgets');

	}
}

function genpro_body_class( $classes ) {

		$classes[] = 'genpro-home';
		return $classes;
		
}

function genpro_home_top_widgets() {

	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}

function genpro_home_bottom_widgets() {
	
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="home-bottom widget-area">',
		'after'  => '</div>',
	) );

}

function genpro_home_left_widgets(){
	genesis_widget_area( 'home-left', array(
		'before' => '<div class="home-left widget-area">',
		'after'  => '</div>',
	));
}

function genpro_home_right_widgets(){
	genesis_widget_area( 'home-right', array(
		'before' => '<div class="home-right widget-area">',
		'after'  => '</div>',
	));
}

function genpro_home_last_widgets(){
	genesis_widget_area( 'home-last', array(
		'before' => '<div class="home-last widget-area">',
		'after'  => '</div>',
	));
}

remove_action( 'genesis_before_entry', 'genpro_add_header_optinbox' );
remove_action( 'genesis_after_entry', 'genpro_add_footer_optinbox' );

genesis();
