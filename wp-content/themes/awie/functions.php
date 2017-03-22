<?php

// Require widgets
require get_stylesheet_directory() . "/widgets/recent-posts-a.php";
require get_stylesheet_directory() . "/widgets/recent-posts-f.php";
require get_stylesheet_directory() . "/widgets/ad.php";

/**
 *	Theme Setup function
 * 
 * @return void
 */
function awye_theme_setup() {

	// Load language files
	load_theme_textdomain( 'awie', get_template_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'awye_theme_setup' );

/**
 * Remove the parent top theme
 */
add_filter('theme_mod_latest_news_display', function() {
	return null;
});

/**
 *	Customier default values overwrite
 * 
 * @return void
 */
function awye_customizer_overwrite($wp_customize) {

	// Set default fonts
	$wp_customize->get_setting( 'body_font_name' )->default = 'Source+Sans+Pro:400,300,400italic,600,700,700italic';
	$wp_customize->get_setting( 'body_font_family' )->default = '\'Source Sans Pro\', sans-serif';

	$wp_customize->get_setting( 'headings_font_name' )->default = 'Source+Sans+Pro:400,700';
	$wp_customize->get_setting( 'headings_font_family' )->default = '\'Source Sans Pro\', sans-serif';

}
add_action( 'customize_register', 'awye_customizer_overwrite', 2000 );

/**
 *	Customier remove values
 * 
 * @return void
 */
function awye_customizer_remove($wp_customize) {

	$wp_customize->remove_section('flymag_latest_news');

}
add_action( 'customize_register', 'awye_customizer_remove', 2100 );

/**
 *	WP Enqueue Styles
 */
function awye_enqueue_styles() {
    wp_enqueue_style( 'awye-style', get_template_directory_uri() . '/style.css' );

	//Slider scripts
	wp_enqueue_script( 'awye-slider-init', get_stylesheet_directory_uri() .  '/js/slider-init.js', array(), true );	
	if ( ! get_theme_mod('carousel_speed') ) {
		$slideshowspeed = 4000;
	} else {
		$slideshowspeed = intval(get_theme_mod('carousel_speed'));
	}			
	$slider_options = array(
		'slideshowspeed' => $slideshowspeed,
	);			
	wp_localize_script('awye-slider-init', 'sliderOptions', $slider_options);						

    // Fonts styles
    if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
	} else {
	    wp_enqueue_style( 'flymag-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,600,700,700italic');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
	} else {
	    wp_enqueue_style( 'flymag-headings-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');
	}
}
add_action( 'wp_enqueue_scripts', 'awye_enqueue_styles' );

/**
 *	Remove unnecessary scripts
 */
function awye_dequeue_scripts() {
    wp_dequeue_script( 'flymag-slider-init' );
}
add_action( 'wp_enqueue_scripts', 'awye_dequeue_scripts', 100 );

/**
 *	Rewrite flymag_slider_template from parent theme
 */
function flymag_slider_template() {
	       
   	//Get the user choices
    $number     = get_theme_mod('carousel_number');
    $cat        = get_theme_mod('carousel_cat');
    $number     = ( ! empty( $number ) ) ? intval( $number ) : 6;
    $cat        = ( ! empty( $cat ) ) ? intval( $cat ) : '';

	$args = array(
		'posts_per_page'		=> $number,
		'post_status'   		=> 'publish',
        'cat'                   => $cat,
        'ignore_sticky_posts'   => true			
	);
	$query = new WP_Query( $args );	
	if ( $query->have_posts() ) {
	?>
	<div class="fly-slider slider-loader">
		<div class="featured-inner clearfix">
			<div class="slider-inner">
			<?php while ( $query->have_posts() ) : $query->the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'carousel-thumb' );

				if($image) {
					$image = $image[0];
				} else {
					$image = get_stylesheet_directory_uri() . '/images/placeholder.png';
				}
			?>
				<div class="slide" style="background-image: url(<?php echo esc_url($image) ?>);">
					<span class="carousel-overlay"></span>
					<?php echo '<h1 class="slide-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">'.__('Read More', 'awie').'</a></h1>'; ?>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php }
	wp_reset_postdata();
}

/**
 *	Handle all modifications to widgets by child theme, including new widgets or rewriting parent widgets. Also it sets a new sidebar area.
 * 
 * @return void
 */
function awye_widgets_init() {

	// Unregister the parent widget
	unregister_widget( 'Flymag_Recent_A' );

	// Register the child widget with changes made
	register_widget( 'Awye_Recent_A' );

	// Register new widgets
	register_widget( 'Awye_Recent_F' );
	register_widget( 'AwyeAdWidget' );

	// Register new footer sidebar
	register_sidebar( array(
		'name'          => __( 'Footer last', 'awie' ),
		'id'            => 'sidebar-7',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'awye_widgets_init', 11 );

/**
 *	Overwrite sidebar name
 * 
 * @return void
 */
function awye_change_first_sidebar_name($sidebar) {
	global $wp_registered_sidebars;

    if ( 'Footer left' !== $sidebar[ 'name' ] )
        return;

	$id = $sidebar[ 'id' ];
    $sidebar[ 'name' ] = 'Footer first';

    $wp_registered_sidebars[ $id ] = $sidebar;
}
add_action( 'register_sidebar', 'awye_change_first_sidebar_name');

/**
 *	Overwrite sidebar name
 * 
 * @return void
 */
function awye_change_center_sidebar_name($sidebar) {
	global $wp_registered_sidebars;

    if ( 'Footer center' !== $sidebar[ 'name' ] )
        return;

	$id = $sidebar[ 'id' ];
    $sidebar[ 'name' ] = 'Footer center 1';

    $wp_registered_sidebars[ $id ] = $sidebar;
}
add_action( 'register_sidebar', 'awye_change_center_sidebar_name');

/**
 *	Overwrite sidebar name
 * 
 * @return void
 */
function awye_change_right_sidebar_name($sidebar) {
	global $wp_registered_sidebars;

    if ( 'Footer right' !== $sidebar[ 'name' ] )
        return;

	$id = $sidebar[ 'id' ];
    $sidebar[ 'name' ] = 'Footer center 2';

    $wp_registered_sidebars[ $id ] = $sidebar;
}
add_action( 'register_sidebar', 'awye_change_right_sidebar_name');


/**
 *	Create edits for calendar widget. Ads span for year in caption area. Changes week days from capitals to abbreviations.
 * 
 * @return void
 */
add_filter('get_calendar', function($calendar_output) {

	// Add br and span before year
	$calendar_output = str_replace(' ' . date('Y') . '</caption>', '</br><span>' . date('Y') . '</span>' . '</caption>', $calendar_output);
	
	// Replace days that does not repeat
	$calendar_output = str_replace('M</th>', __('MON', 'awie') . '</th>', $calendar_output);
	$calendar_output = str_replace('W</th>', __('WED', 'awie') . '</th>', $calendar_output);
	$calendar_output = str_replace('F</th>', __('FRI', 'awie') . '</th>', $calendar_output);

	// Replace TUE that repeats
	$ts = array(__('TUE', 'awie') . '</th>', __('THU', 'awie') . '</th>' );
	$calendar_output = str_replace(array('%', 'T</th>'), array('%%', '%s'), $calendar_output);
	$calendar_output = vsprintf($calendar_output, $ts);

	// Replace SAT that repeats
	$ss = array(__('SAT', 'awie') . '</th>', __('SUN', 'awie') . '</th>' );
	$calendar_output = str_replace(array('%', 'S</th>'), array('%%', '%s'), $calendar_output);
	$calendar_output = vsprintf($calendar_output, $ss);
	
	return $calendar_output;
});


/**
 * Keep Lite and Pro customizer settings up to date
 */
if(!function_exists('awie_keep_customizer_settings')) {
	add_action("after_switch_theme", "awie_keep_customizer_settings");

	function awie_keep_customizer_settings() {
		$theme = wp_get_theme();
		$lite_settings = get_option('theme_mods_flymag');

		if( 'flymag' == $theme->get('Template')  ) {
			if( !empty($lite_settings) ):
				foreach($lite_settings as $lite_mod_k => $lite_mod_v):
					set_theme_mod( $lite_mod_k, $lite_mod_v );
				endforeach;
			endif;
		}
	}
}