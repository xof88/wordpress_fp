<?php

/**
 * Purplous Lite Banner Customizer.
 *
 * @package purplous-lite
 */

if (! function_exists('purplous_lite_layout_options')) {
	function purplous_lite_layout_options( $wp_customize ) {

		$purplous_lite_theme_options = purplous_lite_options();

			$wp_customize->add_section( 'purplous_lite_layout' , array(
					'title'      => esc_html__('General Options','purplous-lite'),
					'panel' => 'purplous_lite_theme_option',
					'priority'   => 1,
				) );

			$wp_customize->add_setting(
				'purplous_lite[theme_layout]',
				array(
					'type'    => 'option',
					'default' => $purplous_lite_theme_options['theme_layout'],
					'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
					'capability'        => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( 'purplous_lite[theme_layout]', array(
				'label'        => esc_html__( 'Choose Layout', 'purplous-lite' ),
				'type' => 'radio',
				'section'    => 'purplous_lite_layout',
				'settings'   => 'purplous_lite[theme_layout]',
				'choices'    => array(
		            'full'      => esc_attr( __('Full Width', 'purplous-lite') ),
		            'boxed'      => esc_attr( __('Boxed', 'purplous-lite') ),
	        		),
			) );

			$wp_customize->add_setting(
				'purplous_lite[sidebar_layout]',
				array(
					'type'    => 'option',
					'default' => $purplous_lite_theme_options['sidebar_layout'],
					'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
					'capability'        => 'edit_theme_options',
				)
			);

			$wp_customize->add_control( 'purplous_lite[sidebar_layout]', array(
				'label'        => esc_html__( 'Sidebar Options', 'purplous-lite' ),
				'description'  => esc_html__('Home, singe and archive pages', 'purplous-lite'),
				'type' => 'radio',
				'section'    => 'purplous_lite_layout',
				'settings'   => 'purplous_lite[sidebar_layout]',
				'choices'    => array(
		            'left'      => esc_attr( __('Left Sidebar', 'purplous-lite') ),
		            'right'      => esc_attr( __('Right Sidebar', 'purplous-lite') ),
		            'no'      => esc_attr( __('No Sidebar', 'purplous-lite') ),
	        		),
			) );
	}
	add_action( 'customize_register', 'purplous_lite_layout_options');
}