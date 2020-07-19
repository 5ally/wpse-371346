<?php

/*

 * Plugin Name: My Plugin

 * Version: 1.0

 */

add_shortcode( 'my-plugin', function () {

    	return

    	'<b>No files will be added to your media library.</b> :)' .

    	'<form id="my-form">' .

    	    	'<input name="foo" placeholder="Type something">' .

    	    	'<input type="file" name="file">' .

    	    	'<input type="submit">' .

    	'</form>' .

    	'<div id="my-div">AJAX result here</div>';

} );

add_action( 'wp_enqueue_scripts', function () {

    	wp_enqueue_script( 'my-plugin',

    	    	plugins_url( 'my-plugin.js', __FILE__ ),

    	    	[ 'jquery' ] );

    	wp_localize_script( 'my-plugin', 'MY_PLUGIN', [

    	    	'root'  => esc_url_raw( get_rest_url() ),

    	    	'nonce' => wp_create_nonce( 'wp_rest' ),

    	] );

} );

add_action( 'rest_api_init', function () {

	register_rest_route( 'my-plugin/v1', '/foo', [

    	    	'methods'  => [ 'POST' ],

    	    	'callback' => function ( $request ) {

    	    	    	// Get the uploaded file's data.

    	    	    	$file = $_FILES['file'] ?? null;

    	    	    	return [

    	    	    	    	'foo'  => $request->get_param( 'foo' ),

    	    	    	    	'file' => $file ? $file['name'] : 'NA',

    	    	    	];

    	    	},

    	] );

} );

