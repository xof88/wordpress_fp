<?php

/**
 * Purplous Lite Banner Customizer.
 *
 * @package purplous-lite
 */
if (! function_exists('purplous_lite_banner')) {
    function purplous_lite_banner( $wp_customize ) {

    	$purplous_lite_theme_options = purplous_lite_options();

        	$wp_customize->add_section( 'featured_post_banner', array(
                    'title'       => esc_html__( 'Featured Banner Options','purplous-lite' ),
                    'description' => esc_html__( 'Select featured post.','purplous-lite' ),
                    'panel'       => 'purplous_lite_theme_option',
                    'priority'    => 4,
            ) );

            $wp_customize->add_setting( 'purplous_lite[featured_post]', array(
            		'type'    => 'option',
                    'default'           => $purplous_lite_theme_options['featured_post'],
                    'sanitize_callback' => 'purplous_lite_text_sanitize',
                    'capability' => 'edit_theme_options',
            ) );

            $wp_customize->add_control( new Purplous_Lite_Post_Dropdown_control( $wp_customize, 'purplous_lite[featured_post]', array(
                    'title'       => esc_html__( 'Featured Banner Options','purplous-lite' ),
                    'description' => esc_html__( 'Select a Post for featured banner.','purplous-lite' ),
                    'section'     => 'featured_post_banner',
                    'priority'    => 1,
            ) ) );
    }
    add_action( 'customize_register', 'purplous_lite_banner');
}