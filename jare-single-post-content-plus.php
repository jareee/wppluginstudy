<?php
/**
* Plugin Name:	JaRe Single Post Content Plus
* Description:	Adds a sidebar widget aka to singe posts
* Version:	0.1
* Autor:	Jare
* Autor URI:	https://github.com/jareee
* Text Domain:	jaresingle
* License:	GPL-2.0+
* Github Plugin URI: https://github.com/cdils/single-post-content-plus
*/

// prevent direct access
// if this file is called directly; abort
if ( !defined('ABSPATH') ) {
	die;
}

/**
* Load stylesheet
*/

function jaresingle_stylesheet() {
	// load styles with filter, default is true
	if ( apply_filters( 'jaresingle_load_styles', true ) ) {
		wp_enqueue_style( 'jaresingle_custom_stylesheet', plugin_dir_url(__FILE__) . 'jaresingle-styles.css') ;
	}
}

// Optional. Turn off custom stylesheet, with uncommenting this line
// add_filter( 'jaresingle_load_styles', '__return_false' );


add_action( 'wp_enqueue_scripts', 'jaresingle_stylesheet');


/**
* Registers sidebar called Jare Post Content Plus
*/

function jaresingle_register_sidebar() {
	register_sidebar( array(
			'name' 			=> __( 'JaRe Post Content Plus', 'jaresingle' ),
			'id'			=> 'jaresingle_sidebar',
			'description' 		=> __( 'Wigets in this area display on single posts', 'jaresingle'),
			'before_widget' 	=> '<div class="widget jaresingle-sidebar">',
			'after_widget' 		=> '</div>',
			'before_title'		=> '<h2 class="widgettitle jaresingle-title">',
			'after_title'		=> '</h2>',
		)

	);
}

add_action( 'widgets_init', 'jaresingle_register_sidebar');


/**
* Displays sidebar called Jare Post Content Plus
*/


add_filter( 'the_content', 'jaresingle_display_sidebars');

function jaresingle_display_sidebars( $content ) {

	if (is_single() && is_active_sidebar( 'jaresingle_sidebar') && is_main_query() ) {
		dynamic_sidebar( 'jaresingle_sidebar' );
	}
	return $content;
}
