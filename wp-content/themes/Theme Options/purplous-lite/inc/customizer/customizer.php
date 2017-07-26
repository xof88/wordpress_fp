<?php
/**
 * purplous-lite Theme Customizer.
 *
 * @package purplous-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (! function_exists('purplous_lite_customize_register')) {
	function purplous_lite_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'header_textcolor',
			array(
				'label'  		=> esc_html__('Header Text Color', 'purplous-lite'),
				'description'   => esc_html__( 'Applies only for site title and tagline', 'purplous-lite' ),
				'section'    	=> 'colors',
				'settings'   	=> 'header_textcolor',
			)
		));

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
		    'selector' => '.navbar-brand a',
		    'render_callback' => 'purplous_lite_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		    'selector' => '.site-description',
		    'render_callback' => 'purplous_lite_customize_partial_blogdescription',
		) );
	}
	add_action( 'customize_register', 'purplous_lite_customize_register' );
}



//enqueue customzier js and css
if (! function_exists('purplous_lite_enqueue_customizer_scripts')){
	function purplous_lite_enqueue_customizer_scripts() {
		wp_enqueue_style( 'purplous-lite-customizer-css', get_template_directory_uri(). '/inc/customizer/assets/customizer.css');
	    wp_enqueue_script( 'purplous-lite-customizer-banner-js', get_template_directory_uri() . '/inc/customizer/assets/customizer-banner.js', array(), '', true);
	}
	add_action( 'customize_controls_enqueue_scripts', 'purplous_lite_enqueue_customizer_scripts' );
}


/**
 * Render the site title for the selective refresh partial.
 */
if (! function_exists('purplous_lite_customize_partial_blogname')){
	function purplous_lite_customize_partial_blogname() {
		bloginfo( 'name' );
	}
}

/**
 * Render the site tagline for the selective refresh partial.
 */
if (! function_exists('purplous_lite_customize_partial_blogdescription')){
	function purplous_lite_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (! function_exists('purplous_lite_customize_preview_js')){
	function purplous_lite_customize_preview_js() {
		wp_enqueue_script( 'purplous_lite_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	}
	add_action( 'customize_preview_init', 'purplous_lite_customize_preview_js' );
}

if ( ! function_exists( 'purplous_lite_add_customizer' ) ) {
	function purplous_lite_add_customizer( $wp_customize ) {

			$purplous_lite_theme_options = purplous_lite_options();

			/*----------------------------
				Theme Option Panel
			-----------------------------*/
				$wp_customize->add_panel( 'purplous_lite_theme_option', array(
				    'title' => esc_html__( 'Theme Options','purplous-lite' ),
				    'priority' => 46, // Mixed with top-level-section hierarchy.
				) );

			$version_wp = get_bloginfo('version');
            if($version_wp < 4.7){
				 $wp_customize->add_section( 'change_css', array(
			            'title'       => esc_html__( 'Custom CSS', 'purplous-lite' ),
			            'priority'    => 7,
			            'description' => __('Here you can customize Your theme\'s CSS', 'purplous-lite'),
			            'panel'		  => 'purplous_lite_theme_option',
			        ) );

			    $wp_customize->add_setting(
		        'purplous_lite[css_change]',
			        array(
			            'default' => $purplous_lite_theme_options['css_change'],
			            'type'              => 'option',
			            'sanitize_callback' => 'esc_html',
			            'capability'        => 'edit_theme_options',
			        )
		   		 );

			    $wp_customize->add_control( 'purplous_lite_css_change', array(
			        'label'        => esc_html__( 'Add CSS', 'purplous-lite' ),
			        'type' => 'textarea',
			        'section'    => 'change_css',
			        'settings'   => 'purplous_lite[css_change]',
			    ) );
			}

				//theme color

			    $wp_customize->add_setting( 'purplous_lite[theme_color]', array(
					'default'           => '#ddbe86',
					'type'              => 'option',
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'purplous_lite_text_sanitize',
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'purplous_lite_theme_color', array(
					'label'    => esc_html__( 'Theme Color', 'purplous-lite' ),
					'section'  => 'colors',
					'settings' => 'purplous_lite[theme_color]',
					'priority' => 1,
				) ) );

	}
}
add_action( 'customize_register', 'purplous_lite_add_customizer' );

if( !function_exists( 'purplous_lite_text_sanitize' ) ) :
    function purplous_lite_text_sanitize( $value ) {
        if(is_array($value)){
            return array_map('strip_tags', $value);

        } else{
            return wp_strip_all_tags( $value );
        }

    }
endif;

if( !function_exists( 'purplous_lite_sanitize_checkbox' ) ) :
	function purplous_lite_sanitize_checkbox( $input ) {
	    return $input;
	}
endif;