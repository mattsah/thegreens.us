<?php
/**
 * Simpel Theme Customizer
 *
 * @package Simpel
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function simpel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->sanitize_callback	=	'sanitize_hex_color';
	$wp_customize->get_control( 'header_textcolor' )->label		= __('Site Description Color', 'simpel');
	
	//---- Color Settings ----//
	
	$wp_customize-> add_setting(
		'simpel-title-color',
		array(
			'default'	=> 'ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'	=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'simpel-title-color',
	        array(
	            'label' => __('Site Title Color','simpel'),
	            'section' => 'colors',
	            'settings' => 'simpel-title-color',
	            'priority'	=> 2,
	        )
	    )
	);
	
	$wp_customize-> add_section(
	'layout_section',
	array(
		'title'	=> 'Layout Settings',
		'priority' => 1,
		)
	);
	
	$wp_customize-> add_setting(
	'page_layout',
	array(
		'default'	=> 'right',
		'transport' => 'refresh',
		'sanitize_callback'	=> 'simpel_sanitize_radio',
		)
	);
	
	$wp_customize->add_control(
    'page_layout',
    array(
        'type' => 'radio',
        'label' => 'Sidebar Layout',
        'section' => 'layout_section',
        'choices' => array(
            'left' => 'Left Sidebar',
            'right' => 'Right Sidebar',
             ),
         )
    );
    
    $wp_customize->add_setting(
	    'simpel-featured',
	    array(
		    'default'	=> true,
			'sanitize_callback'	=> 'simpel_sanitize_checkbox'
	    )
    );
    
    $wp_customize->add_control(
	    'simpel-featured',
	    array(
		    'type'	=> 'checkbox',
		    'label'	=> __('Show the Featured Image on Posts','simpel'),
		    'section'	=> 'layout_section'
	    )
    );


	$wp_customize-> add_setting('logo');
    
    $wp_customize-> add_control(
	new WP_Customize_Image_Control(
        $wp_customize,
        'logo',
        array(
            'label' => __('OR Logo Upload', 'simpel'),
            'section' => 'title_tagline',
            'settings' => 'logo'
            )
        )
    );
    
	$wp_customize-> add_section(
    'simpel_social',
    array(
    	'title'			=> __('Social Settings','simpel'),
    	'description'	=> __('Manage the Social Icon Setings of your site.','simpel'),
    	'priority'		=> 3,
    	)
    );
    
    $wp_customize-> add_setting(
    'social',
    array(
    	'priority'	=> 'simpel_sanitize_checkbox',
    	)
    );
    
    $wp_customize-> add_control(
    'social',
    array(
    	'type'		=> 'checkbox',
    	'label'		=> __('Enable Social Icons','simpel'),
    	'section'	=> 'simpel_social',
    	'priority'	=> 1,
    	)
    );

    $wp_customize-> add_setting(
    'facebook',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'facebook',
    array(
    	'label'		=> __('Facebook URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'twitter',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'twitter',
    array(
    	'label'		=> __('Twitter URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'google-plus',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'google-plus',
    array(
    	'label'		=> __('Google Plus URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'instagram',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'instagram',
    array(
    	'label'		=> __('Instagram URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'pinterest-p',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'pinterest-p',
    array(
    	'label'		=> __('Pinterest URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'youtube',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'youtube',
    array(
    	'label'		=> __('Youtube URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'vimeo-square',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'vimeo-square',
    array(
    	'label'		=> __('Vimeo URL','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'envelope',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'envelope',
    array(
    	'label'		=> __('Your E-Mail Info','simpel'),
    	'section'	=> 'simpel_social',
    	'type'		=> 'text',
    	)
    );
     
     function simpel_sanitize_checkbox( $i ) {
    if ( $i == 1 ) {
        return 1;
    } else {
        return '';
    }
}

	function simpel_sanitize_radio($a) {
		$valid = array(
			'left' => 'Left Sidebar',
	        'right' => 'Right Sidebar',
	        );
	        
	        if (array_key_exists($a, $valid)) {
		        return $a;
		        } 
		        else {
		        return '';
		        }
	    }
	
	if ( $wp_customize->is_preview() ) {
	    add_action( 'wp_footer', 'simpel_customize_preview', 21);
	}
	
	function simpel_customize_preview() {
	    ?>
	    <script type="text/javascript">
	        ( function( jQuery ) {
	            wp.customize('simpel-title-color',function( value ) {
	                value.bind(function(to) {
	                    jQuery('.site-title a').css('color', to );
	                });
	            });
	            wp.customize('header_textcolor',function( value ) {
	                value.bind(function(to) {
	                    jQuery('.site-description').css('color', to );
	                });
	            });
	        } )( jQuery )
	    </script>
	    <?php
	}  // End function simpel_customize_preview()
}
add_action( 'customize_register', 'simpel_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function simpel_customize_preview_js() {
	wp_enqueue_script( 'simpel_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'simpel_customize_preview_js' );
