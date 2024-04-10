<?php

/*
Plugin Name: Like Button
Description: Adds a like button to posts
Version: 1.0
Author: ILE
*/

// Create table

function create_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'likes';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
        user_id mediumint(9) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_table' );

// Add like button
function like_button() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'likes';

	$post_id = get_the_ID();

	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_id = $post_id" );

	$likes = count( $results );


	$output = '<form id="like-form" method="post" action="'. admin_url( 'admin-post.php' ) .'">';
	$output .= '<input type="hidden" name="action" value="add_like">';
	$output .= '<input type="hidden" name="post_id" value="' . $post_id . '">';
	$output .= '<button id="like-button"><ion-icon name="thumbs-up"></ion-icon></button>';
	$output .= '<span id="like-count">' . $likes . '</span>';
	$output .= '</form>';

	return $output;
}

add_shortcode( 'like_button', 'like_button' );