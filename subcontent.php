<?php
/*
Plugin Name: Subcontent
Plugin URI: http://nskw-style.com/2013/wordpress/plugin-downloads/subcontent.html ‎
Description: This plugin adds another editor to your post/page/customposttype edit page.
Author: Shinichi Nishikawa
Version: 0.2
Author URI: http://en.nskw-style.com
*/

class SubContentEditor {

public $meta_key   = 'subcontent';
public $meta_label = 'Subcontent';
public $post_type  = array( 'page' );
public $wpautop    = true;
public $shortcode  = true;

// add actions
function __construct()
{
	add_action( 'edit_form_after_editor', array( &$this, 'edit_form_after_editor' ) );
	add_action( 'save_post',              array( &$this, 'save_post' ) );
	add_action( 'init',                   array( &$this, 'init' ) );
}

public function init() {
	$this->meta_key   = apply_filters( 'nskw-sce-meta_key',   $this->meta_key );
	$this->post_type  = apply_filters( 'nskw-sce-post_type',  $this->post_type );
	$this->meta_label = apply_filters( 'nskw-sce-meta_label', $this->meta_label );
	$this->wpautop    = apply_filters( 'nskw-sce-wpautop',    $this->wpautop );
	$this->shortcode  = apply_filters( 'nskw-sce-shortcode',  $this->shortcode );
}

// display the editor
public function edit_form_after_editor()
{
	// return if not admin panel
	if ( !is_admin() ) {
		return;
	}
	// return if post type is in the deny array
	if ( in_array( get_post_type( $GLOBALS['post'] ), $this->post_type ) ) {
		return;
	}

	$value = $this->get_the_subcontent();
	
	$sc_arg = array(
		'textarea_rows' => apply_filters( 'nskw-sce-row', 10 ),
		'wpautop'       => $this->wpautop,
		'media_buttons' => apply_filters( 'nskw-sce-media_buttons', true ),
		'tinymce'       => apply_filters( 'nskw-sce-tinymce', true ),
	);
	
	echo '<h3 class="subcontentLabel" style="margin-top:15px;">' . $this->meta_label . '</h3>';
	wp_editor( $value, 'subcontent', $sc_arg );
	
}

// save the value
public function save_post( $post_id )
{
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
    
    if ( isset ( $_POST[ $this->meta_key ] ) ) {
    	return update_post_meta( $post_id, $this->meta_key, $_POST[ $this->meta_key ] );
    }
    delete_post_meta( $post_id, $this->meta_key );

}

public function get_the_subcontent() {
	global $post;
	$subcontent = get_post_meta( $post->ID, $this->meta_key, true );

	if ( $this->wpautop == true ) {
		$subcontent = wpautop( $subcontent );
	}

	if ( true == $this->shortcode ) {
		$subcontent = do_shortcode( $subcontent );
	}

	return $subcontent;
	
}

}// class
$nskwSCE = new SubContentEditor();

function get_the_subcontent() {
	global $nskwSCE;
	return $nskwSCE->get_the_subcontent();
}

function the_subcontent() {
	echo get_the_subcontent();
}
