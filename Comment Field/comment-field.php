<?php
/*
Plugin Name: Extend Comment
Version: 1.0
Plugin URI: http://smartwebworker.com
Description: A plugin to add fields to the comment form.
Author: Specky Geek
Author URI: http://www.speckygeek.com
*/

add_filter('comment_form_default_fields', 'custom_fields');
function custom_fields($fields) {

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields[ 'author' ] = '<p class="comment-form-author">'.
      '<label for="author">' . __( 'Name' ) . '</label>'.
      ( $req ? '<span class="required">*</span>' : '' ).
      '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
      '" size="30" tabindex="1"' . $aria_req . ' /></p>';

    $fields[ 'email' ] = '<p class="comment-form-email">'.
      '<label for="email">' . __( 'Email' ) . '</label>'.
      '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
      '" size="30"  tabindex="2" /></p>';

    $fields[ 'url' ] = '<p class="comment-form-url">'.
      '<label for="url">' . __( 'Website' ) . '</label>'.
      '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .
      '" size="30"  tabindex="2" /></p>';

  return $fields;
}

// Add fields after default fields above the comment box, always visible

add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields () {
  echo '<p class="comment-form-location">'.
  '<label for="location">' . __( 'Location' ) . '</label>'.
  '<input id="location" name="location" type="text" size="30"  tabindex="5" /></p>';

  echo '<p class="comment-form-favorite-place">'.
  '<label for="favorite-place">'. __('Favorite Place Visited') .'</label>'.
  '<input id="favorite-place" name="favorite-place" type="text" size="30"  tabindex="5" /></p>';
}

// Save the comment meta data along with comment

add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {

  if ( ( isset( $_POST['location'] ) ) && ( $_POST['location'] != '') )
  $location = wp_filter_nohtml_kses($_POST['location']);
  add_comment_meta( $comment_id, 'location', $location );

  if ( ( isset( $_POST['favorite-place'] ) ) && ( $_POST['favorite-place'] != '') )
  $favorite = wp_filter_nohtml_kses($_POST['favorite-place']);
  add_comment_meta( $comment_id, 'favorite-place', $favorite);
}

// Add the comment meta (saved earlier) to the comment text
// You can also output the comment meta values directly to the comments template  

add_filter( 'comment_text', 'modify_comment');
function modify_comment( $text ){

  $plugin_url_path = WP_PLUGIN_URL;

  if( $location = get_comment_meta( get_comment_ID(), 'location', true ) ) {
    $location = '<strong>' . esc_attr( $location ) . '</strong><br/>';
    $text = $location . $text;
  } 

  if( $favorite = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
    $favorite = '<strong>' . esc_attr( $favorite ) . '</strong><br/>';
    $text = $favorite . $text;
    return $text;
  } 
  else {
    return $text;
  }
}

// Add an edit option to comment editing screen  

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'title', __( 'Comment Metadata - Extend Comment' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}

function extend_comment_meta_box ( $comment ) {
    $location = get_comment_meta( $comment->comment_ID, 'location', true );
    $favorite = get_comment_meta( $comment->comment_ID, 'favorite-place', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <p>
        <label for="location"><?php _e( 'Location' ); ?></label>
        <input type="text" name="location" value="<?php echo esc_attr( $location ); ?>" class="widefat" />
    </p>
    <p>
        <label for="favorite-place"><?php _e( 'Favorite Place Visited' ); ?></label>
        <input type="text" name="favorite-place" value="<?php echo esc_attr( $favorite ); ?>" class="widefat" />
    </p>
    <?php
}

// Update comment meta data from comment editing screen 

add_action( 'edit_comment', 'extend_comment_edit_metafields' );

function extend_comment_edit_metafields( $comment_id ) {
  if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

  if ( ( isset( $_POST['location'] ) ) && ( $_POST['location'] != '') ):
  $title = wp_filter_nohtml_kses($_POST['location']);
  update_comment_meta( $comment_id, 'location', $location );
  else :
  delete_comment_meta( $comment_id, 'location');
  endif;

  if ( ( isset( $_POST['favorite-place'] ) ) && ( $_POST['favorite-place'] != '') ):
  $rating = wp_filter_nohtml_kses($_POST['favorite-place']);
  update_comment_meta( $comment_id, 'favorite-place', $favorite );
  else :
  delete_comment_meta( $comment_id, 'favorite-place');
  endif;
}

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();
$comments = get_comments();
  foreach($comments as $comment) {
    delete_comment_meta($comment->comment_ID, 'location');
    delete_comment_meta($comment->comment_ID, 'favorite-place');
  }
  
