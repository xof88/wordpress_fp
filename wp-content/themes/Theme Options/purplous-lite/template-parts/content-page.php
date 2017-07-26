<?php
/**
* Template part for displaying page content in page.php.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package purplous-lite
*/

?>
<?php
	global $post;
	$post_id = $post->ID;
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$attachment = get_post( $post_thumbnail_id );
	$image_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
	$image_url1 = $image_url[0];
?>
<div class="post-pad bgwhite">
	<?php if ($image_url1) : ?>
	        <div class="post-content-wrap">
	            <div class="post-thumb-overlay">
	            	<?php the_post_thumbnail('full');?>
	            </div>
	        </div>
	<?php endif;?>
        <div class="post-content">
            <h2><?php the_title();?></h2>
            <div class="post-desc">
                 <p><?php the_content(); ?>
					</p>
            </div>
        </div>
</div>