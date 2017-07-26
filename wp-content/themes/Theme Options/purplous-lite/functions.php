<?php
/**
 * purplous-lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package purplous-lite
 */

if ( ! function_exists( 'purplous_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function purplous_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on purplous-lite, use a find and replace
	 * to change 'purplous-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'purplous-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add customizer edit shortcodes
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'purplous-lite-large-post', 680, 450, true );
			add_image_size( 'purplous-lite-medium-post', 680, 260, true );
			add_image_size( 'purplous-lite-small-post', 350, 135, true );
			add_image_size( 'purplous-lite-top-article-post', 475, 530, true );
			add_image_size( 'purplous-lite-navigation-single-post', 90, 90, true );
			add_image_size( 'purplous-lite-archive-post', 268, 240, true );
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'purplous-lite' ),
	) );

	add_theme_support( 'custom-logo' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
		'status'
		) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'purplous_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-header' );

	add_editor_style( get_template_directory(). '/assets/css/editor-style.css' );
}
endif;
add_action( 'after_setup_theme', 'purplous_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if (! function_exists('purplous_lite_content_width')) :
	function purplous_lite_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'purplous_lite_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'purplous_lite_content_width', 0 );
endif;

//TGMPA plugin
get_template_part('plugin', 'activation');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/purplous-lite-breadcrumb.php';

/**
 * Nav Walker additions.
 */
require get_template_directory() . '/inc/purplous_lite_bootstrap_navwalker.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

require get_template_directory() . '/inc/customizer/customizer-footer.php';

require get_template_directory() . '/inc/customizer/customizer-layout.php';

require get_template_directory() . '/inc/customizer/customizer-control.php';

require get_template_directory() . '/inc/customizer/customizer-banner.php';

require get_template_directory() . '/inc/customizer/customizer-social.php';

require get_template_directory() . '/inc/customizer/customizer-blog.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/custom-header.php';

/**
 * purplous-lite functions additions.
 */
require get_template_directory() . '/inc/lib/purplous-lite-functions.php';

require get_template_directory() . '/inc/lib/register-sidebar.php';

require get_template_directory() . '/inc/lib/purplous-lite-tgmpa.php';

require get_template_directory() . '/inc/lib/purplous-lite-enqueue.php';

if ( function_exists( 'wp_update_custom_css_post' ) ) {
	$purplous_lite_theme_options = purplous_lite_options();
    $custom_css = ( $purplous_lite_theme_options['css_change']  ? $purplous_lite_theme_options['css_change'] : '');
    $core_css = wp_get_custom_css();
    if ( !empty($custom_css)  && empty($core_css) ) {
        $return = wp_update_custom_css_post( $core_css . $custom_css );
    }
}