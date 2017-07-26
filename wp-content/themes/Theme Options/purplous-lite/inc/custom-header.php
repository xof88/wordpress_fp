<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Charity Review
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses purplous_lite_header_style()
 * @uses purplous_lite_admin_header_style()
 * @uses purplous_lite_admin_header_image()
 */
if ( ! function_exists( 'purplous_lite_custom_header_setup' ) ) :
	function purplous_lite_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'purplous_lite_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'width'                  => 1170,
			'height'                 => 150,
			'flex-height'            => true,
			'wp-head-callback'       => 'purplous_lite_header_style',
			'admin-head-callback'    => 'purplous_lite_admin_header_style',
			'admin-preview-callback' => 'purplous_lite_admin_header_image',
		) ) );
	}
	add_action( 'after_setup_theme', 'purplous_lite_custom_header_setup' );
endif;

if ( ! function_exists( 'purplous_lite_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @see purplous_lite_custom_header_setup().
	 */
	function purplous_lite_header_style() {
		$header_text_color = get_header_textcolor();

		get_theme_support('custom-header', 'default-text-color' );

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == $header_text_color ) :
		?>
			/*.navbar-brand,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}*/
		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
			.navbar-brand a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif; // purplous_lite_header_style

if ( ! function_exists( 'purplous_lite_admin_header_style' ) ) :
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * @see purplous_lite_custom_header_setup().
	 */
	function purplous_lite_admin_header_style() {
	?>
		<style type="text/css">
			.appearance_page_custom-header #headimg {
				border: none;
			}
			#headimg h1,
			#desc {
			}
			#headimg h1 {
			}
			#headimg h1 a {
			}
			#desc {
			}
			#headimg img {
			}
		</style>
	<?php
	}
endif;

if ( ! function_exists( 'purplous_lite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see purplous_lite_custom_header_setup().
 */
function purplous_lite_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="<?php the_title();?>">
		<?php endif; ?>
	</div>
<?php
}
endif;

/**
 * Customize video play/pause button in the custom header.
 */

if ( ! function_exists( 'purplous_lite_admin_header_image' ) ) :
	function purplous_lite_video_controls( $settings ) {
		$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'purplous-lite' ) . '</span>' . purplous_lite_get_svg( array( 'icon' => 'play' ) );
		$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'purplous-lite' ) . '</span>' . purplous_lite_get_svg( array( 'icon' => 'pause' ) );
		return $settings;
	}
	add_filter( 'header_video_settings', 'purplous_lite_video_controls' );
endif;