<?php
/*
Plugin Name: Add Extra Comment Fields
Plugin URI: http://pmg.co/category/wordpress
Description: An example of how to add, save and edit extra comment fields in WordPress
Version: n/a
Author: Christopher Davis
Author URI: http://pmg.co/people/chris
License: MIT
*/
/**
 * Add our field to the comment form
 */
add_action( 'comment_form_logged_in_after', 'pmg_comment_tut_fields' );
add_action( 'comment_form_after_fields', 'pmg_comment_tut_fields' );
function pmg_comment_tut_fields()
{
    ?>
    <p class="comment-form-title">
        <label for="pmg_comment_title"><?php _e( 'Title' ); ?></label>
        <input type="text" name="pmg_comment_title" id="pmg_comment_title" />
    </p>
    <?php
}
/**
 * Cheating.  Get everything to be styled nicely in Twenty Elevent
 */
add_action( 'wp_head', 'pmg_comment_tut_style_cheater' );
function pmg_comment_tut_style_cheater()
{
    ?>
    <style type="text/css">
        #respond .comment-form-title {
            position: relative;
        }
        #respond .comment-form-title label {
            background: #EEE;
            -webkit-box-shadow: 1px 2px 2px rgba(204,204,204,0.8);
            -moz-box-shadow: 1px 2px 2px rgba(204,204,204,0.8);
            box-shadow: 1px 2px 2px rgba(204,204,204,0.8);
            color: #555;
            display: inline-block;
            font-size: 13px;
            left: 4px;
            min-width: 60px;
            padding: 4px 10px;
            position: relative;
            top: 40px;
            z-index:1;
        }
    </style>
    <?php
}
/**
 * Add the title to our admin area, for editing, etc
 */
add_action( 'add_meta_boxes_comment', 'pmg_comment_tut_add_meta_box' );
function pmg_comment_tut_add_meta_box()
{
    add_meta_box( 'pmg-comment-title', __( 'Comment Title' ), 'pmg_comment_tut_meta_box_cb', 'comment', 'normal', 'high' );
}
function pmg_comment_tut_meta_box_cb( $comment )
{
    $title = get_comment_meta( $comment->comment_ID, 'pmg_comment_title', true );
    wp_nonce_field( 'pmg_comment_update', 'pmg_comment_update', false );
    ?>
    <p>
        <label for="pmg_comment_title"><?php _e( 'Comment Title' ); ?></label>
        <input type="text" name="pmg_comment_title" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
    </p>
    <?php
}
/**
 * Save our comment (from the admin area)
 */
add_action( 'edit_comment', 'pmg_comment_tut_edit_comment' );
function pmg_comment_tut_edit_comment( $comment_id )
{
    if( ! isset( $_POST['pmg_comment_update'] ) || ! wp_verify_nonce( $_POST['pmg_comment_update'], 'pmg_comment_update' ) ) return;
    if( isset( $_POST['pmg_comment_title'] ) )
        update_comment_meta( $comment_id, 'pmg_comment_title', esc_attr( $_POST['pmg_comment_title'] ) );
}
/**
 * Save our title (from the front end)
 */
add_action( 'comment_post', 'pmg_comment_tut_insert_comment', 10, 1 );
function pmg_comment_tut_insert_comment( $comment_id )
{
    if( isset( $_POST['pmg_comment_title'] ) )
        update_comment_meta( $comment_id, 'pmg_comment_title', esc_attr( $_POST['pmg_comment_title'] ) );
}
/**
 * add our headline to the comment text
 * Hook in way late to avoid colliding with default
 * WordPress comment text filters
 */
add_filter( 'comment_text', 'pmg_comment_tut_add_title_to_text', 99, 2 );
function pmg_comment_tut_add_title_to_text( $text, $comment )
{
    if( is_admin() ) return $text;
    if( $title = get_comment_meta( $comment->comment_ID, 'pmg_comment_title', true ) )
    {
        $title = '<h3>' . esc_attr( $title ) . '</h3>';
        $text = $title . $text;
    }
    return $text;
}
// update 2012-09-12 to show how to put the title in the comments list table
add_action('load-edit-comments.php', 'wpse64973_load');
function wpse64973_load()
{
    $screen = get_current_screen();
    add_filter("manage_{$screen->id}_columns", 'wpse64973_add_columns');
}
function wpse64973_add_columns($cols)
{
    $cols['title'] = __('Comment Title', 'wpse64973');
    return $cols;
}
add_action('manage_comments_custom_column', 'wpse64973_column_cb', 10, 2);
function wpse64973_column_cb($col, $comment_id)
{
    // you could expand the switch to take care of other custom columns
    switch($col)
    {
        case 'title':
            if($t = get_comment_meta($comment_id, 'pmg_comment_title', true))
            {
                echo esc_html($t);
            }
            else
            {
                esc_html_e('No Title', 'wpse64973');
            }
            break;
    }
}