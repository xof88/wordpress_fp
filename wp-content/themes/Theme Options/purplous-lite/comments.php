<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'purplous-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'purplous-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'purplous-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>


			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback'        => 'purplous_lite_format_comment',
				) );
			?>
<!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'purplous-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'purplous-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'purplous-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'purplous-lite' ); ?></p>
	<?php
	endif;

	$holded_comment = purplous_lite_hold_comments($post->ID);
	$comment_number = get_comments_number();
    if (($comment_number != 0 || $holded_comment != 0 ) ){ echo '</div>'; }
  ?>
	<div class="bgwhite post-pad">
	<?php

		$fields =  array(

			'author' => '<div class="input-field comment-field-author"">'. '<label for="first_name">' .esc_html__( 'First Name', 'purplous-lite'  )  .'<span class="required">'.'*'.'</span>' . '</label> ' .'<input placeholder=" " id="author" name="author" type="text" class="validate"  value="' . esc_attr( $commenter['comment_author'] ) . '" >' .
			'</div>',


			'email'  => '<div class="input-field comment-field-email">'.'<label for="first_name">' . esc_html__( 'Email', 'purplous-lite'  )  . '<span class="required">'.'*'.'</span>'. '</label> ' . ' <input placeholder=" " id="email" name="email" type="text" class="validate" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" >' .
			'</div>',

			'website' => '<div class="input-field">'.'<label for="first_na48me">'. esc_html__('Website', 'purplous-lite' ) .'</label>'.'<input placeholder=" " id="url" name="url" type="text" class="validate">'.'</div>'

			);

		$comments_args = array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields )

			);

 comment_form($comments_args); ?>
 </div>
<!-- #comments -->