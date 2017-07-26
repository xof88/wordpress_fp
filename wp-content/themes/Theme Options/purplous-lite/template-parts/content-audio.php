<?php
/**
 * Template part for displaying post for Audio post format.
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
    <div class="post-audio">
    	<div class="post-audio-holder">
    		<?php
    			$content = trim(  get_post_field('post_content', $post->ID) );
                  $ori_url = explode( "\n", esc_html( $content ) );
                $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                if( $new_content){
                    echo do_shortcode( $matches[0][0] );
                }
                elseif (preg_match ( '#^<(script|iframe|embed|object)#i', $content )) {
                    $regex = '/https?\:\/\/[^\" ]+/i';
                    preg_match_all($regex, $ori_url[0], $matches);
                    $urls = ($matches[0]);
                     print_r('<iframe src="'.$urls[0].'" width="100%" height="240" frameborder="no" scrolling="no"></iframe>');
                } elseif (0 === strpos( $content, 'https://' )) {
                    $embed_url = wp_oembed_get( esc_url( $ori_url[0] ) );
                    print_r($embed_url);
                }
    		?>
    	</div>
    </div>
<?php } ?>