<?php

$includes_path = STYLESHEETPATH . '/inc/';
require_once $includes_path . 'theme-parts.php';

/**
 * Setup the theme:
 *
 * - Load the textdomain.
 * - Register the navigation menus.
 */
function wpcampus_2018_setup_theme() {

	// Load the textdomain.
	load_theme_textdomain( 'wpcampus-2018', get_stylesheet_directory() . '/languages' );

	// Register the nav menus.
	// TODO: Do we need this?
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wpcampus-2018' ),
	));

	/*
	 * Register actions for theme parts.
	 */
	if ( function_exists( 'wpcampus_print_code_of_conduct_message' ) ) {
		add_action( 'wpc_add_after_main', 'wpcampus_print_code_of_conduct_message' );
	}
}
add_action( 'after_setup_theme', 'wpcampus_2018_setup_theme', 10 );

/**
 * Make sure the Open Sans
 * font weights we need are added.
 *
 * They're loaded in the parent theme.
 *
 * TODO: What fonts do we need?
 */
function wpcampus_2018_load_open_sans_weights( $weights ) {
	return array_merge( $weights, array( 300, 400, 600 ) );
}
//add_filter( 'wpcampus_open_sans_font_weights', 'wpcampus_2018_load_open_sans_weights' );

/**
 * Setup/enqueue styles and scripts for theme.
 *
 * TODO: Setup
 */
function wpcampus_2018_enqueue_theme() {

	// Set the directories.
	//$wpcampus_dir     = trailingslashit( get_stylesheet_directory_uri() );
	//$wpcampus_dir_css = $wpcampus_dir . 'assets/css/';
	//$wpcampus_dir_js  = $wpcampus_dir . 'assets/js/';

	// Enqueue the base styles and script.
	//wp_enqueue_style( 'wpcampus-2018', $wpcampus_dir_css . 'styles.min.css', array( 'wpcampus-parent' ), null );
	//wp_enqueue_script( 'wpcampus-2018', $wpcampus_dir_js . 'wpc-2018.min.js', array( 'jquery' ), null );

}
add_action( 'wp_enqueue_scripts', 'wpcampus_2018_enqueue_theme', 10 );
