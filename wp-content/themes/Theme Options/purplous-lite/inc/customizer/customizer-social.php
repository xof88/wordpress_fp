<?php

/**
 * Purplous Lite Social Media Customizer.
 *
 * @package purplous-lite
 */
if (! function_exists('purplous_lite_social_settings')) {
    function purplous_lite_social_settings( $wp_customize ) {

            $purplous_lite_theme_options = purplous_lite_options();

            /* Social options */

            $wp_customize->add_section(
                'social_section',array(
                    'title' => esc_html__('Social Options', 'purplous-lite'),
                    'panel' => 'purplous_lite_theme_option',
                    'capability' => 'edit_theme_options',
                    'priority' => 2,
            ));

            $wp_customize->add_setting('purplous_lite[social_checkbox_header]',
                array(
                    'type'    => 'option',
                    'default' => esc_attr($purplous_lite_theme_options['social_checkbox_header']),
                    'sanitize_callback' => 'purplous_lite_sanitize_checkbox',
                    )
                );

            $wp_customize->add_control('purplous_lite[social_checkbox_header]',
                array(
                    'type'    => 'checkbox',
                    'label'   => esc_html__('Show Social Media Icons In Header ? ','purplous-lite'),
                    'section' => 'social_section',
                    )
                );

             $wp_customize->add_setting(
            'purplous_lite[email_id]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['email_id']),
                'type' => 'option',
                'sanitize_callback' => 'esc_attr',
                'capability' => 'edit_theme_options',
                )
            );

            $wp_customize->add_control( 'email_id', array(
                'label'        => esc_html__('Email ID',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[email_id]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[phone_number]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['phone_number']),
                'type' => 'option',
                'sanitize_callback' => 'esc_attr',
                'capability' => 'edit_theme_options',
                )
            );

            $wp_customize->add_control( 'phone_number', array(
                'label'        => esc_html__( 'Phone Number',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[phone_number]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[twitter_link]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['twitter_link']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );

            $wp_customize->add_control( 'twitter_link', array(
                'label'        => esc_html__('Twitter',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[twitter_link]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[fb_link]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['fb_link']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );

            $wp_customize->add_control( 'fb_link', array(
                'label'        => esc_html__( 'Facebook',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[fb_link]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[linkedin_link]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['linkedin_link']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );

            $wp_customize->add_control( 'linkedin_link', array(
                'label'        => esc_html__( 'LinkedIn',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[linkedin_link]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[gplus]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['gplus']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );
                $wp_customize->add_control( 'gplus', array(
                'label'        => esc_html__( 'Google+',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[gplus]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[tumblr]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['tumblr']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );
                $wp_customize->add_control( 'tumblr', array(
                'label'        => esc_html__( 'Tumblr',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[tumblr]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[instagram]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['instagram']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );
                $wp_customize->add_control( 'instagram', array(
                'label'        => esc_html__( 'Instagram',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[instagram]',
            ) );

            $wp_customize->add_setting(
            'purplous_lite[pinterest]',
                array(
                'default' => esc_attr($purplous_lite_theme_options['pinterest']),
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw',
                'capability' => 'edit_theme_options',
                )
            );
                $wp_customize->add_control( 'pinterest', array(
                'label'        => esc_html__( 'Pinterest',  'purplous-lite' ),
                'section'    => 'social_section',
                'settings'   => 'purplous_lite[pinterest]',
            ) );
    }
    add_action( 'customize_register', 'purplous_lite_social_settings');
}