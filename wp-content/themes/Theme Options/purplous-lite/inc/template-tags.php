<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package purplous-lite
 */

if ( ! function_exists( 'purplous_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function purplous_lite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'purplous-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'purplous-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'purplous_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function purplous_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'purplous-lite' ) );
		if ( $categories_list && purplous_lite_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'purplous-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'purplous-lite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'purplous-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'purplous-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'purplous-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'purplous_lite_categorized_blog' ) ) {
	function purplous_lite_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'purplous_lite_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'purplous_lite_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so purplous_lite_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so purplous_lite_categorized_blog should return false.
			return false;
		}
	}
}

/**
 * Flush out the transients used in purplous_lite_categorized_blog.
 */
if ( ! function_exists( 'purplous_lite_category_transient_flusher' ) ) {
	function purplous_lite_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'purplous_lite_categories' );
	}
	add_action( 'edit_category', 'purplous_lite_category_transient_flusher' );
	add_action( 'save_post',     'purplous_lite_category_transient_flusher' );
}

if ( ! function_exists( 'purplous_lite_archive_link' ) ) {
    function purplous_lite_archive_link( $post ){
        $year = date('Y',strtotime($post->post_date));
        $month = date('m',strtotime($post->post_date));
        $day = date('d',strtotime($post->post_date));
        $link = site_url('') . '/' . $year . '/' . $month . '?day=' . $day;
        return $link;
    }
}

if (! function_exists('purplous_lite_video_type')) {
    function purplous_lite_video_type($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'youtu.be') > 0) {
            return 'youtube';
        }
        elseif (strpos($url, 'youtu\.be') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } elseif (strpos($url, 'videopress') > 0) {
            return 'videopress';
        }
    }
}

if (! function_exists('purplous_lite_parse_yturl')) {
    function purplous_lite_parse_yturl($url)
    {
        $pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
        preg_match($pattern, $url, $matches);
        return (isset($matches[1])) ? $matches[1] : false;
    }
}

if (! function_exists('purplous_lite_parse_vimeourl')) {
    function purplous_lite_parse_vimeourl($url) {

        $pattern = "/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/";
        preg_match($pattern, $url, $matches);
        return (isset($matches[3])) ? $matches[3] : false;
    }
}

if (! function_exists('purplous_lite_parse_videopress')) {
	function purplous_lite_parse_videopress($url) {
		$pattern = "";
	}
}

if (! function_exists('purplous_lite_video_url')) {

    function purplous_lite_video_url($post_id) {
        $content = trim(get_post_field('post_content', $post_id));
        $ori_url = explode("\n", esc_html($content));
        $url = esc_url( $ori_url[0] );
        $video_type = purplous_lite_video_type($url);
        $video_thumb = '';
        if ($video_type == 'youtube') {
          $link = $url;
          $parsed_url = purplous_lite_parse_yturl($link);

          $video_thumb = 'http://img.youtube.com/vi/'.$parsed_url.'/maxresdefault.jpg';

        }
        else if ($video_type == 'vimeo') {
          $link = $url;
          $parsed_url = purplous_lite_parse_vimeourl($link);
          $hash = wp_remote_get("https://vimeo.com/api/v2/video/$parsed_url.php");
          $hash_body = wp_remote_retrieve_body($hash);
          $unserialized_hash = unserialize($hash_body);
          $video_thumb = $unserialized_hash[0]['thumbnail_large'];
        }
        else if ($video_type == 'videopress') {

          		$link = $url;
	            $video_id = explode("v/", $link);
	            $video_id = $video_id[1];
	            $options  = array (
	              'http' =>
	              array (
	                'ignore_errors' => true,
	              ),
	            );

		        $context  = stream_context_create( $options );
		        $hash = wp_remote_get('https://public-api.wordpress.com/rest/v1.1/videos/'.$video_id.'');
		        $response = wp_remote_retrieve_body(
		            $hash,
		            false,
		            $context
		        );
		        $response = json_decode( $response );
		            $video_thumb = $response->poster;
        }

        return $video_thumb;
    }

}