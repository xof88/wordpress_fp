<?php
/**
 * Template part for displaying post for Gallery post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */

?>
<?php
	//Get the alt and title of the image
    $image_url = get_post_gallery_images( $post->ID );
    $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
    $attachment =  get_post($post_thumbnail_id);

     // If the post is not single
        if( $image_url ) {
?>

			<div class="post-gallery">
				<?php foreach ( $image_url as $key => $images ) { ?>
					<div class="post-gallery-item">
						<div class="post-gallery-item-holder" style="background-image: url('<?php echo esc_url( $images); ?>');" alt= "<?php echo esc_attr( $attachment->post_excerpt );?>">
						</div>
					</div>
				<?php } ?>
			</div>
<?php   } else { ?>

			<!-- If the post has no thumbnail -->
			<div class="no-image">
				<a href="#" class="post-link"></a>
			</div>
<?php } ?>