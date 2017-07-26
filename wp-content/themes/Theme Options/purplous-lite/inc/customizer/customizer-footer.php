<?php

/**
 * Purplous Lite Footer Customizer.
 *
 * @package purplous-lite
 */
if (! function_exists('purplous_lite_footer')) {
	function purplous_lite_footer( $wp_customize ) {
		$purplous_lite_theme_options = purplous_lite_options();

		 $wp_customize->add_section( 'footer_option', array(
            'title'       => esc_html__( 'Footer Options', 'purplous-lite' ),
            'priority'    => 6,
            'description' => esc_html__('Footer and Pre Footer Options', 'purplous-lite'),
            'panel'		  => 'purplous_lite_theme_option',
        ) );

		$wp_customize->add_setting('purplous_lite[pre_footer_checkbox]',
	        array(
	            'type'    => 'option',
	            'default' => $purplous_lite_theme_options['pre_footer_checkbox'],
	            'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
	            )
			);

		$wp_customize->add_control('purplous_lite[pre_footer_checkbox]',
	        array(
	            'type'    => 'checkbox',
	            'label'   => esc_html__('Show pre-footer block on Home Page ? ','purplous-lite'),
	            'section' => 'footer_option',
	            )
			);
	}
	add_action( 'customize_register', 'purplous_lite_footer' );
}