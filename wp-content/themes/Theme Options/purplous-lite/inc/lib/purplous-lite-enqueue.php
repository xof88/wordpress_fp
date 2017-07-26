<?php

/**
 * Enqueue scripts and styles.
 */
if (! function_exists('purplous_lite_scripts')) {
	function purplous_lite_scripts() {

		//styles
		wp_enqueue_style( 'purplous-lite-style', get_stylesheet_uri() );


		wp_enqueue_style( 'purplous-lite-purplous-theme', get_template_directory_uri() . '/assets/css/purplous-theme.css' );

		wp_enqueue_style( 'purplous-lite-css', get_template_directory_uri() . '/assets/css/purplous-lite-style.css' );


		//scripts


		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery', 'masonry' ), '20151215',true );

		wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery', 'masonry' ), '20151215',true );

		wp_enqueue_script( 'purplous-lite-app', get_template_directory_uri() . '/assets/js/app.js', array( 'jquery', 'masonry' ), '20151215',true );

		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/fitvids.min.js', array( 'jquery', 'masonry' ), '20151215',true );

		wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array( 'jquery', 'masonry' ), '20151215',true );

		wp_enqueue_script( 'purplous-lite-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '20151215',true );

		// Load the html5 shiv.
		wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );

		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		//Customizer
		$purplous_lite_theme_options = purplous_lite_options();
		$version_wp = get_bloginfo('version');
        if($version_wp < 4.7){
            $purplous_lite_custom_css = $purplous_lite_theme_options['css_change'];
        }
        else{
            $purplous_lite_custom_css = "";
        }
		$purplous_lite_theme_color 	 = $purplous_lite_theme_options['theme_color'];
		$header_textcolor			 = get_theme_mod('header_textcolor');
		$custom_css = "
						.site-header .nav-wrapper .navbar .navbar-brand a {
							color: #$header_textcolor !important;
						}
						.slick-next:hover, .slick-prev:hover {
						  background: $purplous_lite_theme_color !important;
						}
						.post-content-wrap .slick-next {
						  color: $purplous_lite_theme_color;
						}
						.post-content-wrap .slick-prev {
						  color: $purplous_lite_theme_color;
						}
						.post-content-wrap .slick-prev:hover, .post-content-wrap .slick-next:hover {
						  background: $purplous_lite_theme_color !important;
						}

						.nav-links .page-numbers {
						  color: $purplous_lite_theme_color;
						  border: 1px solid $purplous_lite_theme_color;
						}
						.nav-links .page-numbers:hover {
						  background: $purplous_lite_theme_color;
						}

						.nav-links .page-numbers.current {
						  background: $purplous_lite_theme_color;
						}
						a {
						  color: $purplous_lite_theme_color;
						}

						a:hover, a:focus {
						  color: $purplous_lite_theme_color;
						}

						a:visited {
						  color: $purplous_lite_theme_color;
						}
						.btn-default, .comment-respond .comment-form .btn-default {
						  background: $purplous_lite_theme_color;
						  border: 2px solid $purplous_lite_theme_color !important;
						}
						.btn-default:hover, .comment-respond .comment-form .btn-default:hover, .btn-default:focus, .comment-respond .comment-form .btn-default:focus {
						  background: $purplous_lite_theme_color;
						}
						.search-form label .search-field:focus {
						  border: 1px solid $purplous_lite_theme_color;
						}
						.search-form .search-submit {
						  background: $purplous_lite_theme_color;
						}
						blockquote {
						  border-left: 5px solid $purplous_lite_theme_color;
						}

						.continue-read a:hover i {
						  color: $purplous_lite_theme_color !important;
						}
						section.footer-sec .widget .widget-title:after {
						  background-color: $purplous_lite_theme_color;
						}
						.sec-title span {
						  background: $purplous_lite_theme_color;
						}
						.post-cat a {
						  background: $purplous_lite_theme_color;
						}
						span.post-love:hover i, span.post-comment:hover i {
						  color: $purplous_lite_theme_color;
						}
						.navbar-default .navbar-nav > li > a:hover {
						  color: $purplous_lite_theme_color !important;
						}
						.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
						  background: $purplous_lite_theme_color !important;
						  border-bottom: 1px solid $purplous_lite_theme_color !important;
						}

						.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
						  color: $purplous_lite_theme_color;
						}
						section.post-large-slider .slide-details-box h2 a:hover, section.post-large-slider .slide-details-box h2 a:focus {
						  color: $purplous_lite_theme_color;
						}
						.post-large-style .postbox .post-thumb .post-date {
						  background: $purplous_lite_theme_color;
						}
						.postbox .post-content h2 a:hover {
						  color: $purplous_lite_theme_color;
						}
						.post-large-slider .slick-next {
						  color: $purplous_lite_theme_color;
						}
						.post-large-slider .slick-prev {
						  color: $purplous_lite_theme_color;
						}
						.post-med-style .postbox .post-thumb .post-date {
						  background: $purplous_lite_theme_color;
						}
						.postbox.post-small .post-content .continue-read i {
						  background: $purplous_lite_theme_color;
						  border: 2px solid $purplous_lite_theme_color;
						}
						.postbox.post-small .post-thumb .post-date {
						  background: $purplous_lite_theme_color;
						}
						.postbox.post-small .postbox .continue-read a:hover i {
						  color: $purplous_lite_theme_color;
						}
						.top-article-item .top-article-content-wrap .top-article-content h2.article-title a:hover {
						  color: $purplous_lite_theme_color;
						}
						.top-article-item .top-article-content-wrap .top-article-content .btn-default {
						  background: $purplous_lite_theme_color;
						}
						.postbox .post-footer .continue-read i {
						  background: $purplous_lite_theme_color;
						  border: 2px solid $purplous_lite_theme_color;
						}
						.post-date {
						  background: $purplous_lite_theme_color;
						}
						.postbox .continue-read a:hover i {
						  color: $purplous_lite_theme_color !important;
						}
						.blog-post-wrapper .post-content-wrap .metabar-wrap .article-full-date i:hover, .blog-post-wrapper .post-content-wrap .metabar-wrap .article-full-date i:focus, .blog-post-wrapper .post-content-wrap .metabar-wrap .post-like-count i:hover, .blog-post-wrapper .post-content-wrap .metabar-wrap .post-like-count i:focus, .blog-post-wrapper .post-content-wrap .metabar-wrap post-like-count i:hover, .blog-post-wrapper .post-content-wrap .metabar-wrap post-like-count i:focus {
						  color: $purplous_lite_theme_color;
						}
						.blog-post-wrapper .post-content-wrap .post-content h2 a:hover, .blog-post-wrapper .post-content-wrap .post-content h2 a:focus {
						  color: $purplous_lite_theme_color;
						}
						.related-posts .related-item .post-content-wrap .post-content h2 a:hover, .related-posts .related-item .post-content-wrap .post-content h2 a:focus {
						  color: $purplous_lite_theme_color;
						}
						.related-posts .related-item .post-content-wrap .post-content .continue-read i {
						  background: $purplous_lite_theme_color;
						  border: 2px solid $purplous_lite_theme_color;
						}
						.related-posts .related-item .post-content-wrap .post-date {
						  background: $purplous_lite_theme_color;
						}
						.related-posts .slick-prev {
						  background: $purplous_lite_theme_color;
						}
						.related-posts .slick-next {
						  background: $purplous_lite_theme_color;
						}
						.related-posts .related-item:hover .slick-next:before, .related-posts .related-item:hover .slick-prev:before {
						  color: $purplous_lite_theme_color;
						}

						.content-list .post-content .metabar-wrap .article-full-date i:hover, .content-list .post-content .metabar-wrap .article-full-date i:focus, .content-list .post-content .metabar-wrap .post-like-count i:hover, .content-list .post-content .metabar-wrap .post-like-count i:focus, .content-list .post-content .metabar-wrap post-like-count i:hover, .content-list .post-content .metabar-wrap post-like-count i:focus {
						  color: $purplous_lite_theme_color;
						}
						.content-list .post-content .continue-read i {
						  background: $purplous_lite_theme_color;
						  border: 2px solid $purplous_lite_theme_color;
						}
						.widget ul li a:hover {
						  color: $purplous_lite_theme_color;
						}
						.widget ul li a:focus {
						  color: $purplous_lite_theme_color;
						}
						.about-me .about-me-wrap .about-me-footer .about-me-btn-wrap .btn {
						  background: $purplous_lite_theme_color;
						}
						.about-me .about-me-wrap .about-me-footer .about-me-btn-wrap .btn:before {
						  border-color: transparent transparent $purplous_lite_theme_color transparent;
						}
						.calendar_wrap table caption {
						  background: $purplous_lite_theme_color;
						}
						.jetpack_subscription_widget #subscribe-submit input {
						  background: $purplous_lite_theme_color;
						  border: 1px solid $purplous_lite_theme_color;
						}
						.widget_mc4wp_form_widget .mc4wp-form-fields input[type='submit'] {
						  background: $purplous_lite_theme_color;
						  border: 1px solid $purplous_lite_theme_color;
						}
						.tagcloud a:hover {
						  background: $purplous_lite_theme_color;
						  border: 1px solid $purplous_lite_theme_color;
						}
						#header-search-wrap .search-form label .close {
						    border: 1px solid $purplous_lite_theme_color;
						    color: $purplous_lite_theme_color;
						}

			$purplous_lite_custom_css
		";
		wp_add_inline_style( 'purplous-lite-css', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'purplous_lite_scripts' );
}
