<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package purplous-lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'purplous_lite_body_classes' ) ) {
function purplous_lite_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter( 'body_class', 'purplous_lite_body_classes' );
}

if ( ! function_exists( 'purplous_lite_the_featured_video' ) ) {
    function purplous_lite_the_featured_video( $content ) {

        $ori_url = explode( "\n", esc_html( $content ) );
        $url = esc_url( $ori_url[0] );

        $w = get_option( 'embed_size_w' );
        if ( !is_single() )
            $url = str_replace( '448', $w, $url );

        if ( 0 === strpos( $url, 'https://' ) ) {
            $embed_url = wp_oembed_get( esc_url( $url ) );
            print_r($embed_url);
            $content = trim( str_replace( $url, '', esc_html( $content ) ) );
        }
        elseif ( preg_match ( '#^<(script|iframe|embed|object)#i', $url ) ) {
            $h = get_option( 'embed_size_h' );
            echo esc_url( $url );
            if ( !empty( $h ) ) {

                if ( $w === $h ) $h = ceil( $w * 0.75 );
                $url = preg_replace(
                    array( '#height="[0-9]+?"#i', '#height=[0-9]+?#i' ),
                    array( sprintf( 'height="%d"', $h ), sprintf( 'height=%d', $h ) ),
                    $url
                    );
                echo esc_url( $url );
            }

            $content = trim( str_replace( $url, '', $content ) );
        }
    }
}

if ( ! function_exists( 'purplous_lite_post_formats' ) ) {
    function purplous_lite_post_formats( $post_id, $image_size) {
        global $post;
        $post_format = get_post_format($post_id);
        if ( $post_format == 'video') {
            ?>
            <div class="post-video">
                <div class="post-video-holder">
                    <?php
                        $content = trim(  get_post_field('post_content', $post_id) );
                        $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                        if( $new_content){
                            echo do_shortcode( $matches[0][0] );
                        }
                        else{
                            echo esc_html( purplous_lite_the_featured_video( $content ) );
                        }
                    ?>
                </div>
                <div class="post-date">
                    <span><a href="<?php echo esc_url( purplous_lite_archive_link( $post ) ); ?>"><?php echo esc_html(get_the_date('M d ')); ?></a></span>
                </div>
                </div>
            <?php
        }
        else if ($post_format == 'gallery') {
            //Get the alt and title of the image
            $image_url = get_post_gallery_images( $post_id );
            $post_thumbnail_id = get_post_thumbnail_id( $post_id );
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
                    <div class="post-date">
                        <span><a href="<?php echo esc_url( purplous_lite_archive_link( $post ) ); ?>"><?php echo esc_html(get_the_date('M d ')); ?></a></span>
                    </div>

                <?php

            } else {
                echo '<div class="post-gallery"><div class="post-gallery-item"><div class="post-gallery-item-holder"></div></div></div>';
            }
        }
        else if ($post_format == 'audio'){
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
                                 print_r('<iframe src="'.$urls[0].'" frameborder="no" scrolling="no"></iframe>');
                            } elseif (0 === strpos( $content, 'https://' )) {
                                $embed_url = wp_oembed_get( esc_url( $ori_url[0] ) );
                                print_r($embed_url);
                            }
                        ?>
                    </div>
                     <div class="post-date">
                        <span><a href="<?php echo esc_url( purplous_lite_archive_link( $post ) ); ?>"><?php echo esc_html(get_the_date('M d ')); ?></a></span>
                    </div>
                </div>
            <?php
        }
        else {
                $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                $attachment = get_post( $post_thumbnail_id );
                $image_url = wp_get_attachment_image_src($post_thumbnail_id, $image_size);
                $image_url1 = $image_url[0];
            ?>
                 <?php if ($image_url1) : ?>
                            <div class="post-thumb" style="background-image:url(<?php echo esc_url($image_url1);?>)">
                                <div class="post-date">
                                    <span><a href="<?php echo esc_url( purplous_lite_archive_link( $post ) ); ?>"><?php echo esc_html(get_the_date('M d ')); ?></a></span>
                                </div>
                            </div>
                <?php else :
                        echo '<div class="post-thumb">
                            <a href="#" class="post-link"></a>
                        </div>';
                    endif;
        }

  }
}

if ( ! function_exists( 'purplous_lite_post_formats_featured' ) ) {
    function purplous_lite_post_formats_featured( $post_id, $post_format) {

        if ( $post_format == 'video') {
                $content = trim(  get_post_field('post_content', $post_id) );
                $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                $ori_url = explode( "\n", esc_html( $content ) );
                $video_url = $ori_url[0];

                $video_thumb = purplous_lite_video_url($post_id);
            ?>
            <div class="post-video">
                    <div class="post-video-holder featured-video" style="background-image:url(<?php echo esc_url($video_thumb); ?>)">
                        <?php purplous_lite_featured_block($post_id); ?>
                    </div>
            </div>
            <?php
        }
        else if ($post_format == 'gallery') {
            //Get the alt and title of the image
            $image_url = get_post_gallery_images( $post_id );
            $post_thumbnail_id = get_post_thumbnail_id( $post_id );
            $attachment =  get_post($post_thumbnail_id);

            // If the post is not single
            if( $image_url ) {
                ?>
                    <div class="post-gallery">
                        <?php foreach ( $image_url as $key => $images ) { ?>
                            <div class="post-gallery-item">
                                <div class="post-gallery-item-holder" style="background-image: url('<?php echo esc_url( $images); ?>');" alt= "<?php echo esc_attr( $attachment->post_excerpt );?>">
                                <?php purplous_lite_featured_block($post_id); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php

            }
        }
        else {
                $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                $attachment = get_post( $post_thumbnail_id );
                $image_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                $image_url1 = $image_url[0];
            ?>
                 <?php if ($image_url1) : ?>
                            <div class="post-thumb" style="background-image:url('<?php echo esc_url($image_url1); ?>')">
                                <?php purplous_lite_featured_block($post_id); ?>
                            </div>
                <?php endif;
        }

  }
}

if ( ! function_exists( 'purplous_lite_post_class' ) ) {
    function purplous_lite_post_class($count){
        if ($count%5 == 0 ) {
            $post_class = 'large';
        }
        if ($count%5 == 1 ) {
            $post_class = 'med';
        }
        if ($count%5 == 2 ) {
            $post_class = 'med';
        }
        if ($count%5 == 3 ) {
            $post_class = 'small';
        }
        if ($count%5 == 4 ) {
            $post_class = 'small';
        }
        return $post_class;
    }
}

if ( ! function_exists( 'purplous_lite_navigation_page' ) ) {
    function purplous_lite_navigation_page(){
        ?>
        <div class="clearfix">
            <div class="left card pagination">
            <?php previous_posts_link( '<i class="fa fa-angle-left"></i>&nbsp;&nbsp;&nbsp;'. esc_html__('Previous Posts','purplous-lite' )); ?></div>
            <div class="right card pagination">
                <?php next_posts_link( esc_html__('Next Posts','purplous-lite').'&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i>'. ''  ); ?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'purplous_lite_single_navigation' ) ) {
    function purplous_lite_single_navigation($post_id) {
        global $post;
        ?>
            <div class="bgwhite post-pad">
                <nav class="navigation post-navigation" role="navigation">
                    <h2 class="screen-reader-text"><?php echo esc_html__('Post navigation', 'purplous-lite'); ?></h2>
                    <div class="nav-links">
                    <?php $next_post = get_adjacent_post(false, '', false);
                        if(!empty($next_post)) :
                            $post_thumbnail_id = get_post_thumbnail_id( $next_post->ID );
                            $attachment = get_post( $post_thumbnail_id );
                            $image_url = wp_get_attachment_image_src($post_thumbnail_id, 'purplous-lite-navigation-single-post');
                            $image_url1 = $image_url[0];
                         ?>
                        <div class="nav-previous">
                            <?php if ($image_url1) : ?>
                                <div class="nav-post-thumb"><img src="<?php echo esc_url($image_url1); ?>"></div>
                            <?php else: ?>
                                <div class="nav-post-thumb"></div>
                            <?php endif; ?>
                            <div class="post-nav-content">
                            <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" rel="prev"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><?php echo esc_html__('&nbsp;Prev Post', 'purplous-lite'); ?><br><h4><?php echo get_the_title($next_post->ID); ?></h4></a></div>
                        </div>
                    <?php endif; ?>

                    <?php $prev_post = get_adjacent_post(false, '', true);
                        if(!empty($prev_post)) :
                            $post_thumbnail_id = get_post_thumbnail_id( $prev_post->ID );
                            $attachment = get_post( $post_thumbnail_id );
                            $image_url = wp_get_attachment_image_src($post_thumbnail_id, 'purplous-lite-navigation-single-post');
                            $image_url1 = $image_url[0];
                         ?>
                        <div class="nav-next">
                            <?php if ($image_url1) : ?>
                                <div class="nav-post-thumb"><img src="<?php echo esc_url($image_url1); ?>"></div>
                            <?php else: ?>
                                <div class="nav-post-thumb"></div>
                            <?php endif; ?>
                            <div class="post-nav-content">
                                <a href="<?php echo esc_url( get_permalink($prev_post->ID) );?>" rel="next"><?php echo esc_html__('Next Post&nbsp;', 'purplous-lite'); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i><br><h4><?php echo get_the_title($prev_post->ID); ?></h4></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                </nav>
            </div>
        <?php
    }
}

if ( ! function_exists( 'purplous_lite_single_related_post' ) ) {
    function purplous_lite_single_related_post($post_id) {
        $post_id = esc_attr($post_id);
        $cat = get_the_category($post_id);
        if ($cat) {
            $first_cat = esc_attr($cat[0]->term_id);
            $related_args=array(
                'post_type' => 'post',
                'category__in' => array($first_cat),
                'post__not_in' => array($post_id),
                'showposts' => -1,
                );
            $related_query = new WP_Query($related_args);

            if( $related_query->have_posts() ):
            ?>
                <div class="bgwhite post-pad">
                    <div id="related-posts">
                        <h2><?php echo esc_html__('Related Posts', 'purplous-lite'); ?></h2>
                        <div class="related-posts">
                            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                                    <div class="related-item">
                                        <div class="post-content-wrap">
                                            <?php purplous_lite_post_formats( $related_query->ID, 'purplous-lite-small-post' ); ?>
                                            <div class="post-content">
                                                <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                                                <div class="metabar-wrap">
                                                    <span class="post-comment"><a href="<?php echo esc_url(get_comments_link($post_id)); ?>"><i class="fa fa-comments" aria-hidden="true"></i><?php echo esc_html(get_comments_number($post_id)); ?></a></span>
                                                </div>
                                                <div class="continue-read"><a href="<?php the_permalink(); ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
        <?php
            endif;
        }
    }
}

if ( ! function_exists( 'purplous_lite_single_author' ) ) {
    function purplous_lite_single_author($post_id) {
        $author_name = get_the_author_meta( 'display_name' );
        $author_firstname = get_the_author_meta( 'first_name' );
        $author_lastname = get_the_author_meta( 'last_name' );
        $author_id = get_the_author_meta( 'ID' );
        $author_description = get_the_author_meta('description', $author_id);
        $author_image = get_avatar($author_id);
        if ( function_exists( 'wpsabox_author_box' ) ) {
            $author_facebook = get_user_meta($author_id, 'facebook', true);
            $author_googleplus = get_user_meta($author_id, 'googleplus', true);
            $author_linkedin = get_user_meta($author_id, 'linkedin', true);
            $author_instagram = get_user_meta($author_id, 'instagram', true);
            $author_twitter = get_user_meta($author_id, 'twitter', true);
            $author_tumblr = get_user_meta($author_id, 'tumblr', true);
        }
        ?>
            <div class="bgwhite post-pad">
                <div class="author-bio">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="author-image">
                                <?php echo $author_image; ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="author-desc">
                                <span class="author-name"><a href="<?php echo esc_attr(get_author_posts_url( $author_id));?>"><?php if ( $author_firstname && $author_lastname ) { ?><?php echo esc_html($author_firstname). ' ' . esc_html( $author_lastname); ?><?php } else { echo esc_html($author_name);}?></a></span>
                                <?php if ( function_exists( 'wpsabox_author_box' ) ) { ?>
                                    <?php if ($author_facebook || $author_googleplus || $author_linkedin || $author_instagram || $author_twitter || $author_tumblr ) { ?>
                                        <ul class="author-social-link left">
                                            <?php if ($author_facebook) { ?>
                                                <li><a href="<?php echo esc_url($author_facebook);?>" target="_blank" title="<?php echo esc_attr__('Follow us on Facebook', 'purplous-lite');?>" class="fb-link"><span class="fa fa-facebook"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_facebook) { ?>
                                                <li><a href="<?php echo esc_url($author_facebook);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Google Plus', 'purplous-lite');?>" class="gp-link"><span class="fa fa-google-plus"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_linkedin) { ?>
                                                <li><a href="<?php echo esc_url($author_linkedin);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Linkedin', 'purplous-lite');?>" class="ln-link"><span class="fa fa-linkedin"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_twitter) { ?>
                                                <li><a href="<?php echo esc_url($author_twitter);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Twitter', 'purplous-lite');?>" class="tw-link"><span class="fa fa-twitter"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_instagram) { ?>
                                                <li><a href="<?php echo esc_url($author_instagram);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Instagram', 'purplous-lite');?>" class="in-link"><span class="fa fa-instagram"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_tumblr) { ?>
                                                <li><a href="<?php echo esc_url($author_tumblr);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Tumblr', 'purplous-lite');?>" class="ln-link"><span class="fa fa-tumblr"></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($author_description) { ?>
                                    <p><?php echo esc_html($author_description); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}

if ( ! function_exists( 'purplous_lite_author' ) ) {
    function purplous_lite_author($author_id) {
        $author_description = get_the_author_meta('description', $author_id);
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_firstname = get_the_author_meta( 'first_name' );
        $author_lastname = get_the_author_meta( 'last_name' );
        $author_image = get_avatar($author_id);
        if ( function_exists( 'wpsabox_author_box' ) ) {
            $author_facebook = get_user_meta($author_id, 'facebook', true);
            $author_googleplus = get_user_meta($author_id, 'googleplus', true);
            $author_linkedin = get_user_meta($author_id, 'linkedin', true);
            $author_instagram = get_user_meta($author_id, 'instagram', true);
            $author_twitter = get_user_meta($author_id, 'twitter', true);
            $author_tumblr = get_user_meta($author_id, 'tumblr', true);
        }
        ?>
            <div class="bgwhite post-pad">
                <div class="author-bio">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="author-image">
                                <?php echo $author_image; ?>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="author-desc">
                                <span class="author-name"><a href="<?php echo esc_attr(get_author_posts_url( $author_id));?>"><?php echo esc_html($author_firstname). ' ' . esc_html( $author_lastname); ?></a></span>
                                <?php if ( function_exists( 'wpsabox_author_box' ) ) { ?>
                                    <?php if ($author_facebook || $author_googleplus || $author_linkedin || $author_instagram || $author_twitter || $author_tumblr ) { ?>
                                        <ul class="author-social-link left">
                                            <?php if ($author_facebook) { ?>
                                                <li><a href="<?php echo esc_url($author_facebook);?>" target="_blank" title="<?php echo esc_attr__('Follow us on Facebook', 'purplous-lite');?>" class="fb-link"><span class="fa fa-facebook"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_facebook) { ?>
                                                <li><a href="<?php echo esc_url($author_facebook);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Google Plus', 'purplous-lite');?>" class="gp-link"><span class="fa fa-google-plus"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_linkedin) { ?>
                                                <li><a href="<?php echo esc_url($author_linkedin);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Linkedin', 'purplous-lite');?>" class="ln-link"><span class="fa fa-linkedin"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_twitter) { ?>
                                                <li><a href="<?php echo esc_url($author_twitter);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Twitter', 'purplous-lite');?>" class="tw-link"><span class="fa fa-twitter"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_instagram) { ?>
                                                <li><a href="<?php echo esc_url($author_instagram);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Instagram', 'purplous-lite');?>" class="in-link"><span class="fa fa-instagram"></span></a></li>
                                            <?php } ?>
                                            <?php if ($author_tumblr) { ?>
                                                <li><a href="<?php echo esc_url($author_tumblr);?>" target="_blank" title="<?php echo esc_attr__('Follow me on Tumblr', 'purplous-lite');?>" class="ln-link"><span class="fa fa-tumblr"></span></a></li>
                                            <?php } ?>
                                        </ul>

                                    <?php } ?>
                                <?php } ?>
                                <?php if ($author_description) { ?>
                                    <p><?php echo esc_html($author_description); ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}

//Remove comment notes after in commnet form
if ( ! function_exists( 'purplous_lite_remove_comment_form_allowed_tags' ) ) {
 add_filter( 'comment_form_defaults', 'purplous_lite_remove_comment_form_allowed_tags' );
     function purplous_lite_remove_comment_form_allowed_tags( $defaults ) {

        $defaults['comment_notes_after'] = '';
        $defaults['comment_notes_before'] =   '<p class="comment-notes"><span id="email-notes">' .
        esc_html__( 'Your email address will not be published.', 'purplous-lite' ) .'</span>'.esc_html__( ' Required fields are marked * ', 'purplous-lite' ).
        '</p>';
        return $defaults;

    }
}
//Modify text area of comment form
if ( ! function_exists( 'purplous_lite_wpsites_modify_comment_form_text_area' ) ) {
    add_filter('comment_form_defaults', 'purplous_lite_wpsites_modify_comment_form_text_area');
    function purplous_lite_wpsites_modify_comment_form_text_area($arg) {
        $arg['comment_field'] = '<div class="input-field">'.'<label for="textarea1">'.esc_html__( 'Comments', 'purplous-lite' ).'<span class="required">'.'*'.'</span>' .'</label>'.'<textarea placeholder=" " id="comment" name="comment" class="materialize-textarea">'.'</textarea>'.'</div>';
        $arg['class_submit'] = 'btn btn-default';
        $arg['title_reply'] ='<h3 class="reply-title">'.esc_attr( __('Leave a comment', 'purplous-lite' ) ).'</h3>';
        return $arg;
    }
}

if ( ! function_exists( 'purplous_lite_move_comment_field' ) ) {
    add_filter( 'comment_form_fields', 'purplous_lite_move_comment_field' );
    function purplous_lite_move_comment_field( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
}

if ( ! function_exists( 'purplous_lite_hold_comments' ) ) {
    function purplous_lite_hold_comments($post_id) {

        $count = get_comments( array(
            'post_id' => $post_id,
            'status' => 'hold',
            'count' => true
        ) );

        return $count;
    }
}