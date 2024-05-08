<?php
function single_post(): void {
	header( 'Content-Type: application/json');
	$post_id = $_POST['post_id'];
	$post = get_post( $post_id );

	// Apply shortcodes to the post content if user is logged in
	if ( is_user_logged_in() ) {
		$post->post_content = $post->post_content . do_shortcode('[like_button post_id="' . $post_id . '"]');
	}

	echo json_encode( $post );
	wp_die();
}

add_action( 'wp_ajax_single_post', 'single_post' );
add_action( 'wp_ajax_nopriv_single_post', 'single_post' );