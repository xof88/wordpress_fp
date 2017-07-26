<?php
/**
 * Template part for displaying post for Video post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purplous-lite
 */
global $post;

if ( is_single ()) {
    $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
    $attachment = get_post( $post_thumbnail_id );
    $image_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
    $image_url1 = $image_url[0];
    if ($image_url) :
    ?>
                <!-- if the post has thumbnail -->
        <div class="image-post" style="background-image:url(<?php echo esc_url($image_url1);?>)">
        </div>
    <?php
    endif;
}
else { //if not single
?>
    <div class="post-video">
    	<div class="post-video-holder">
    		<?php
                $content = trim(  get_post_field('post_content', $post->ID) );
                $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                if( $new_content){
                    echo do_shortcode( $matches[0][0] );
                }
                else{
                    echo esc_html( purplous_lite_the_featured_video( $content ) );
                }
            ?>
    	</div>
    </div>
<?php } ?>