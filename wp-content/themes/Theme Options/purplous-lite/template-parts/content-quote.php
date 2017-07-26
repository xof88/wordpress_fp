<?php
/**
 * Template part for displaying post for Quote post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */

?>
<?php
	$post_id = $post->ID;
	if (is_single()){
		$image_class = 'full';
	} else {
		$image_class = 'purplous-lite-archive-post';
	}
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$attachment = get_post( $post_thumbnail_id );
	$image_url = wp_get_attachment_image_src($post_thumbnail_id, $image_class);
	$image_url1 = $image_url[0];

	if ($image_url) :
?>

<!-- if the post has thumbnail -->
<div class="image-post" style="background-image:url(<?php echo esc_url($image_url1);?>)">
</div>

<?php else: ?>

<!-- If the post has no thumbnail -->
<div class="no-image">
	<?php
		wp_link_pages( array(
		            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_attr( __( 'Pages:', 'purplous-lite' ) ) . '</span>',
		            'after'       => '</div>',
		            'link_before' => '<span>',
		            'link_after'  => '</span>',
		        ) );
	?>
	<a href="#" class="post-link"></a>
</div>

<?php endif; ?>