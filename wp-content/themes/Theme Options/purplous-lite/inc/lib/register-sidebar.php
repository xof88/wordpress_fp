<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @package purplous-lite
 * @since purplous-lite 1.0.0
 */

if ( ! function_exists('purplous_lite_widgets_init') ) {
    function purplous_lite_widgets_init() {

        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar','purplous-lite' ),
            'id'            => 'sidebar',
            'description'   => esc_html__( 'default sidebar','purplous-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
            ) );

    	 register_sidebar( array(
            'name'          =>esc_html__( 'Pre-Footer Widget 1','purplous-lite' ),
            'id'            => 'pre-footer-widget-1',
            'description'   => esc_html__( 'pre footer widget 1','purplous-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
            ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Pre-Footer Widget 2','purplous-lite' ),
            'id'            => 'pre-footer-widget-2',
            'description'   => esc_html__( 'pre footer widget 2','purplous-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
            ) );

	     register_sidebar( array(
	        'name'          => esc_html__( 'Pre-Footer Widget 3','purplous-lite' ),
	        'id'            => 'pre-footer-widget-3',
	        'description'   => esc_html__( 'pre footer widget 3','purplous-lite' ),
	        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</aside>',
	        'before_title'  => '<h1 class="widget-title">',
	        'after_title'   => '</h1>',
	        ) );
  	}
    add_action( 'widgets_init', 'purplous_lite_widgets_init' );
}