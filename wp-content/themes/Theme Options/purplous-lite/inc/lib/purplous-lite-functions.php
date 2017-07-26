<?php
/**
 * Purplous Lite functions.
 *
 * @package purplous-lite
 */

if ( ! function_exists('purplous_lite_options') ) {
    function purplous_lite_options() {
        // Options API
            return wp_parse_args(
                get_option( 'purplous_lite', array() ),
                purplous_lite_default_settings()
            );

    }
}

if ( ! function_exists('purplous_lite_default_settings') ) {
    function purplous_lite_default_settings() {
        $purplous_lite_options = array(
            'sidebar_layout'           => 'right',
            'theme_layout'             => 'boxed',
            'featured_post'            => '',
            'email_id'                 => '',
            'phone_number'             => '',
            'twitter_link'             => '',
            'fb_link'                  => '',
            'linkedin_link'            => '',
            'tumblr'                   => '',
            'instagram'                => '',
            'gplus'                    => '',
            'pinterest'                => '',
            'social_checkbox_header'   => '1',
            'select_blog'              => 'latest-post',
            'select_blog_category'     => '',
            'select_author'            => '',
            'author_checkbox'          => '1',
            'pre_footer_checkbox'      => '1',
            'change_css'               => '',
            'theme_color'              => '',
            'css_change'               => '',
            'display_tagline'               => '1',
        );
       return apply_filters( 'purplous_lite_options', $purplous_lite_options );
    }
}

if ( ! function_exists('purplous_lite_social_icons') ) {
    function purplous_lite_social_icons() {

            $purplous_lite_theme_options = purplous_lite_options();

              $fb_link = $purplous_lite_theme_options['fb_link'];
              $twitter_link = $purplous_lite_theme_options['twitter_link'];
              $linkedin_link = $purplous_lite_theme_options['linkedin_link'];
              $tumblr = $purplous_lite_theme_options['tumblr'];
              $instagram = $purplous_lite_theme_options['instagram'];
              $gplus = $purplous_lite_theme_options['gplus'];
              $pinterest = $purplous_lite_theme_options['pinterest'];
              $email_id = $purplous_lite_theme_options['email_id'];
              $phone_number = $purplous_lite_theme_options['phone_number'];

              if ( $fb_link || $twitter_link || $linkedin_link || $tumblr || $instagram || $gplus || $pinterest || $email_id || $phone_number ) {

        ?>
             <div class="top-header">
                    <div class="container">
                        <div class="left-social-nav">
                            <ul class="social-nav">
                            <?php if (!empty($fb_link)) { ?>
                                <li><a href="<?php echo esc_url($fb_link);?>" title="<?php echo esc_attr__('Follow us on Facebook', 'purplous-lite');?>" class="fb-link"><span class="fa fa-facebook"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($gplus)) { ?>
                                <li><a href="<?php echo esc_url($gplus);?>" title="<?php echo esc_attr__('Follow us on Google Plus', 'purplous-lite');?>" class="gp-link"><span class="fa fa-google-plus"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($linkedin_link)) { ?>
                                <li><a href="<?php echo esc_url($linkedin_link);?>" title="<?php echo esc_attr__('Follow us on Linkedin', 'purplous-lite');?>" class="ln-link"><span class="fa fa-linkedin"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($twitter_link)) { ?>
                                <li><a href="<?php echo esc_url($twitter_link);?>" title="<?php echo esc_attr__('Follow us on Twitter', 'purplous-lite');?>" class="tw-link"><span class="fa fa-twitter"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($instagram)) { ?>
                                <li><a href="<?php echo esc_url($instagram);?>" title="<?php echo esc_attr__('Follow us on Instagram', 'purplous-lite');?>" class="in-link"><span class="fa fa-instagram"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($tumblr)) { ?>
                                <li><a href="<?php echo esc_url($tumblr);?>" title="<?php echo esc_attr__('Follow us on Tumblr', 'purplous-lite');?>" class="tu-link"><span class="fa fa-tumblr"></span></a></li>
                            <?php } ?>

                            <?php if (!empty($pinterest)) { ?>
                                <li><a href="<?php echo esc_url($pinterest);?>" title="<?php echo esc_attr__('Follow us on Pinterest', 'purplous-lite');?>" class="pt-link"><span class="fa fa-pinterest"></span></a></li>
                            <?php } ?>
                            <?php if ($email_id) { ?>
                                <li>
                                   <a href="mailto:<?php echo esc_attr(antispambot($email_id)); ?>"><span class="fa fa-envelope"></span></a>
                                </li>
                            <?php } ?>
                             <?php if ($phone_number) { ?>
                                <li>
                                    <a href="tel:<?php echo esc_attr($phone_number); ?>"><span class="fa fa-phone-square"></span></a>
                                </li>
                            <?php } ?>
                            </ul>

                        </div>
                    </div>
                </div>
        <?php }
    }
}

/**
 * Search Function
 * Adds the search bar in header
 *
 */

if ( ! function_exists('purplous_lite_headsearch') ) {

    add_filter('wp_nav_menu_items','purplous_lite_headsearch', 10, 2);

    /** Add searchbar in header. */
    function purplous_lite_headsearch( $items, $args ) {
        if ( $args->theme_location == 'primary' ) {
            return $items .= "<li class='menu-header-search'><a href='#' id='header-search-toggle'><i class='fa fa-search'></i></a></li>"; }
        return $items;
    }
}

if ( ! function_exists('purplous_lite_featured_section_homepage') ) {
    function purplous_lite_featured_section_homepage() {
        $purplous_lite_theme_options = purplous_lite_options();
        $featured_post_id = $purplous_lite_theme_options['featured_post'];
            if ($featured_post_id != 'none') :
                $featured_post = get_post($featured_post_id);
                $post_format = get_post_format($featured_post->ID);
                echo '<section class="post-large-slider">';
                purplous_lite_post_formats_featured( $featured_post_id, $post_format);
                echo '</section>';
            endif;
    }
}

if (! function_exists('purplous_lite_featured_block')) {
    function purplous_lite_featured_block($featured_post_id) {
        $featured_post = get_post($featured_post_id);
        ?>
        <div class="container">
            <div class="slide-details-box">
                <?php  $category = purplous_lite_display_random_catname($featured_post_id, 'category'); ?>
                <span class="post-cat"><a href="<?php echo esc_url($category['link']); ?>" ><?php echo esc_html($category['name']); ?></a></span>
                <span class="article-full-date"><a href="<?php echo esc_url( purplous_lite_archive_link($featured_post) );?>"><?php echo esc_html(get_the_time('F d, Y', $featured_post_id)); ?></a></span>
                <h2><a href="<?php echo esc_url(get_the_permalink($featured_post_id)); ?>"><?php echo get_the_title($featured_post_id); ?></a></h2>
                <p><?php echo esc_html(purplous_lite_strip_url_content($featured_post_id, 27)); ?></p>
                <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink($featured_post_id)); ?>" ><?php echo esc_html__('Read More', 'purplous-lite'); ?></a>
            </div>
        </div>
        <?php
    }
}

if (! function_exists('purplous_lite_display_random_catname')) {
    //display category name randomly and links according to the category
    function purplous_lite_display_random_catname($post_id,$tax)
    {

        $taxonomy_names = wp_get_post_terms($post_id, $tax ,array("fields" => "all"));
        if (!empty($taxonomy_names)) {
            foreach ($taxonomy_names as $key => $name) {
                $random = rand(0, $key);
            }
            $test = $taxonomy_names[$random];

            $data = array(
                'name' => esc_attr( $test->name ),
                'link' => get_category_link( $test->term_id )
                );
            return $data;
        }
    }
}

if ( ! function_exists( 'purplous_lite_all_taxonomy_link' ) ) {
    function purplous_lite_all_taxonomy_link($post_id, $tax){
        $taxonomy_id = wp_get_post_terms( $post_id, $tax ,array("fields" => "ids"));
        return $taxonomy_id;
    }
}

 if ( ! function_exists( 'purplous_lite_tag_link' ) ) {
        function purplous_lite_tag_link( $tags, $tagid){
            foreach($tagid as $tid){
                $taglink = get_tag_link($tags->term_id);
            }
            ?>
                <a href="<?php echo esc_url( $taglink );?>" rel="tag"><?php echo esc_html( $tags->name );?></a>
            <?php
        }
}

if(!function_exists('purplous_lite_strip_url_content')){
    function purplous_lite_strip_url_content($post_id, $content_length){
        $content = get_post($post_id);
        $strip = explode( ' ' , strip_shortcodes(wp_trim_words( $content->post_content, $content_length )) );
        foreach($strip as $key => $single){
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        return implode( ' ', $strip );
    }
}

if(!function_exists('purplous_lite_blog_post')){
    function purplous_lite_blog_post() {

        global $post;
        global $wp_query;
        global $query_string;

        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        }
        elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        }
        else {
           $paged = 1;
        }

        $purplous_lite_theme_options = purplous_lite_options();
        $post_or_cat = $purplous_lite_theme_options['select_blog'];
        $select_blog_category = $purplous_lite_theme_options['select_blog_category'];
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $count = 0;

        $sticky = get_option( 'sticky_posts' );

        $blog_post_count = 5;

        if(!empty($sticky) && $paged == 1 ){
            $sticky_count = count($sticky);
            if(!empty($sticky_count) && $sticky_count > $blog_post_count):
                $blog_post_count = 0;
            elseif (!empty($sticky_count) && $blog_post_count >$sticky_count):
                $blog_post_count = $blog_post_count - $sticky_count;
            endif;
        }

        if ( $post_or_cat == 'latest-post' || $select_blog_category == 'none') {
            $blog_large_args = array(
                'post_type' => 'post',
                'posts_per_page' => $blog_post_count,
                'paged' => $paged,
                );
        } elseif ( $post_or_cat == 'latest-post-category' && $select_blog_category != 'none') {
            $blog_large_args = array(
                'post_type' => 'post',
                'orderby' => 'date',
                'order'   => 'DESC',
                'posts_per_page' => $blog_post_count,
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => $select_blog_category,
                        ),
                    ),
                );
        }

        $blog_large_post = new WP_Query($blog_large_args);
        if ( $blog_large_post->have_posts() ) :
            echo '<div class="blog-post-list">';
            while ( $blog_large_post->have_posts() ) :
                $blog_large_post->the_post();
                $post_class = purplous_lite_post_class($count);
                if ($post_class == 'large') {
                    $image_class = 'purplous-lite-large-post';
                    $post_small = '';
                    $wrapper = 'post-pad';
                }
                if ($post_class == 'med') {
                    $image_class = 'purplous-lite-medium-post';
                    $post_small = '';
                    $wrapper = 'post-pad';
                }
                if ($post_class == 'small') {
                    $image_class = 'purplous-lite-small-post';
                    $post_small = 'post-small';
                    $wrapper = '';
                }
                $count++;
                    $post_id = $post->ID;
                    ?>
                    <div class="post-<?php echo esc_attr($post_class);?>-style postbox-wrap">
                        <div class="postbox <?php echo esc_attr($post_small);?> bgwhite">
                            <div class="post-content-wrap <?php echo esc_attr($wrapper);?>">
                                <?php purplous_lite_post_formats( $post_id, $image_class); ?>
                                    <?php if ($post_class == 'small') {purplous_lite_small_post($post_id);} ?>
                                    <?php if ($post_class == 'large' || $post_class == 'med') {purplous_lite_medlarge_post($post_id);} ?>
                            </div>
                            <?php if ($post_class != 'small') { ?>
                                <div class="post-footer">
                                 <?php if ( is_plugin_active('jetpack/jetpack.php') && Jetpack::is_module_active( 'sharedaddy' )) { echo sharing_display(); }  ?>
                                    <div class="continue-read"><a href="<?php echo esc_url(get_the_permalink($post_id)); ?>"><span><?php echo esc_html__('Continue Reading', 'purplous-lite'); ?></span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

        <?php
            endwhile;
            echo '</div>';

              $GLOBALS['wp_query']->max_num_pages = $blog_large_post->max_num_pages;
                the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => esc_html__( 'Previous', 'purplous-lite' ),
                    'next_text' => esc_html__( 'Next', 'purplous-lite' ),
                ) );

        endif; wp_reset_query();
    }
}

if(!function_exists('purplous_lite_small_post')){
    function purplous_lite_small_post($post_id){
        ?>
        <div class="post-content">
            <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
            <div class="metabar-wrap">
                <span class="post-comment"><a href="<?php echo esc_url(get_comments_link($post_id)); ?>"><i class="fa fa-comments" aria-hidden="true"></i><?php echo esc_html(get_comments_number($post_id)); ?></a></span>
            </div>
            <div class="continue-read"><a href="<?php echo esc_url(get_the_permalink($post_id)); ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
        </div>
        <?php
    }
}

if(!function_exists('purplous_lite_medlarge_post')){
    function purplous_lite_medlarge_post($post_id){
        ?>
            <div class="post-content">
                <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    <?php  purplous_lite_post_meta_wrap($post_id); ?>
                <div class="post-desc">
                    <p><?php echo esc_html(purplous_lite_strip_url_content($post_id, 90)); ?>
                    </p>
                </div>
            </div>
        <?php
    }
}

if(!function_exists('purplous_lite_post_meta_wrap')){
    function purplous_lite_post_meta_wrap($post_id) {
        $purplous_lite_theme_options = purplous_lite_options();
        $post_or_cat = $purplous_lite_theme_options['select_blog'];
        $select_blog_category = $purplous_lite_theme_options['select_blog_category'];
        ?>
            <div class="metabar-wrap">
            <?php if ( $post_or_cat == 'latest-post-category' && $select_blog_category != 'none') { ?>

                <span class="post-cat"><a href="<?php echo esc_url(get_category_link($select_blog_category)); ?>"><?php echo esc_html(get_cat_name($select_blog_category)); ?></a></span>

            <?php } elseif ( $post_or_cat == 'latest-post' || $select_blog_category == 'none') {
                        $category = purplous_lite_display_random_catname($post_id, 'category');  ?>
                            <span class="post-cat"><a href="<?php echo esc_url($category['link']); ?>" ><?php echo esc_attr($category['name']); ?></a></span>
            <?php } ?>

                <span class="post-comment"><a href="<?php echo esc_url(get_comments_link($post_id)); ?>"><i class="fa fa-comments" aria-hidden="true"></i><?php echo esc_html(get_comments_number($post_id)); ?></a></span>
            </div>
        <?php

    }
}

if(!function_exists('purplous_lite_sidebar_positon')){
    function purplous_lite_sidebar_positon() {
        $purplous_lite_theme_options = purplous_lite_options();
        $sidebar_layout = $purplous_lite_theme_options['sidebar_layout'];
        if ($sidebar_layout == 'right') {
            $sidebar_class = 'right-sidebar';
        } elseif ($sidebar_layout == 'left') {
            $sidebar_class = 'left-sidebar';
        } elseif ($sidebar_layout == 'no') {
            $sidebar_class = 'fullwidth';
        }
        return $sidebar_class;
    }
}

if(!function_exists('purplous_lite_sidebar_wrapper')){
    function purplous_lite_sidebar_wrapper() {
        $sidebar_class = purplous_lite_sidebar_positon();

        if ($sidebar_class == 'fullwidth'){
            $wrapper_class = 'col-md-12';
        } elseif($sidebar_class == 'left-sidebar') {
            $wrapper_class = 'col-md-8 right';
        }  elseif($sidebar_class == 'right-sidebar') {
            $wrapper_class = 'col-md-8';
        }

        return $wrapper_class;
   }
}

if(!function_exists('purplous_lite_theme_layout')){
    function purplous_lite_theme_layout(){
        $purplous_lite_theme_options = purplous_lite_options();
        $theme_layout = $purplous_lite_theme_options['theme_layout'];
        if ($theme_layout == 'boxed') {
            $layout_class = 'container boxed-layout';
        } elseif ($theme_layout == 'full') {
            $layout_class = 'fullwidth-layout';
        }
        return $layout_class;
    }
}

if(!function_exists('purplous_lite_format_comment')){
    function purplous_lite_format_comment($comment, $args, $depth ){
        ?>
        <div class="comments-wrap">
            <ol>
                <li>
                    <article class="comment-body">
                        <div class="comment-img round-img">
                            <?php echo get_avatar( $comment ); ?>
                        </div>
                        <div class="comment-content-wrap">
                            <div class="comment-meta-wrap">
                                <h2><a href="<?php echo esc_url(get_comment_author_link()); ?>"><?php comment_author(); ?></a></h2>
                                <div class="comment-metadata">
                                    <a href="<?php echo esc_url( htmlspecialchars ( get_comment_link( $comment->comment_ID ) ) ); ?>">
                                        <time><?php echo esc_html(get_comment_date()); ?></time>
                                    </a>
                                </div>
                            </div>
                             <div class="comment-content">
                                 <?php if ($comment->comment_approved == '0') : ?>
                                    <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'purplous-lite' ); ?></em><br />
                                <?php endif; ?>
                                <p><?php comment_text(); ?></p>
                            </div>
                            <div class="reply">
                                <a href="#">
                                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                                </a>
                            </div>
                        </div>
                    </article>
                </li>
            </ol>
        </div>
        <?php
    }
}