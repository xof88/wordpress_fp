<?php

/**
 * Purplous Lite Blog Customizer.
 *
 * @package purplous-lite
 */

if (! function_exists('purplous_lite_blog')) {
  function purplous_lite_blog( $wp_customize ) {

  	$purplous_lite_theme_options = purplous_lite_options();


  	$wp_customize->add_section( 'purplous_lite_blog' , array(
          'title'      => esc_html__('Blog Posts Options','purplous-lite'),
          'panel' => 'purplous_lite_theme_option',
          'priority'   => 5,
        ) );

      $wp_customize->add_setting(
        'purplous_lite[select_blog]',
        array(
          'type'    => 'option',
          'default' => $purplous_lite_theme_options['select_blog'],
          'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
          'capability'        => 'edit_theme_options',
        )
      );

      $wp_customize->add_control( new Purplous_Lite_Blog_Customize_Radio_Control( $wp_customize, 'purplous_lite[select_blog]', array(
        'type' => 'radio',
        'section'    => 'purplous_lite_blog',
        'settings'   => 'purplous_lite[select_blog]',

      ) ) );

      $wp_customize->add_setting(
        'purplous_lite[select_blog_category]',
        array(
          'type'    => 'option',
          'default' => $purplous_lite_theme_options['select_blog_category'],
          'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
          'capability'        => 'edit_theme_options',
        )
      );

      $wp_customize->add_control( new Purplous_Lite_Category_dropdown_control( $wp_customize, 'purplous_lite[select_blog_category]', array(
        'label'        => esc_html__( 'Choose Category', 'purplous-lite' ),
        'section'    => 'purplous_lite_blog',
        'settings'   => 'purplous_lite[select_blog_category]',

      ) ) );
  }
  add_action( 'customize_register', 'purplous_lite_blog');
}