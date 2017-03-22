<?php
/**
 * Simpel functions and definitions
 *
 * @package Simpel
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'simpel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simpel_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Simpel, use a find and replace
	 * to change 'simpel' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'simpel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'featured-thumb', 800,600, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simpel' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	
	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	
	add_theme_support('custom-header');
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simpel_custom_background_args', array(
		'default-color' => '#ffffff',
		'default-image' => '',
	) ) );
}
endif; // simpel_setup
add_action( 'after_setup_theme', 'simpel_setup' );


/* 
 *  Adding title tag
*/

add_theme_support( 'title-tag' );

/*
 *  Enqueuing Google fonts
*/

function simpel_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Hammersmith One, translate this to 'off'. Do not translate
    * into your own language.
    */
    $hammersmith_one = _x( 'on', 'Hammersmith One font: on or off', 'simpel' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'simpel' );
 
    if ( 'off' !== $hammersmith_one || 'off' !== $merriweather_sans ) {
        $font_families = array();
 
        if ( 'off' !== $hammersmith_one ) {
            $font_families[] = 'Hammersmith One';
        }
 
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function simpel_scripts_styles() {
    wp_enqueue_style( 'simpel-fonts', simpel_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'simpel_scripts_styles' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function simpel_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'simpel' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'simpel' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'simpel' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'simpel' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'simpel' ),
		'id'            => 'sidebar-5',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'simpel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simpel_scripts() {
	wp_enqueue_style( 'simpel-style', get_stylesheet_uri() );

	wp_enqueue_style('simpel-bootstrap-style',get_template_directory_uri()."/assets/bootstrap/bootstrap.min.css", array('simpel-style'));
	
	wp_enqueue_style('simpel-main-skin',get_template_directory_uri()."/assets/skins/main.css", array('simpel-bootstrap-style'));
	
	 wp_enqueue_style('simpel-font-awesome', get_template_directory_uri()."/assets/font-awesome/css/font-awesome.min.css", array('simpel-main-skin')); 
	
	$pl = get_theme_mod('page_layout');	
		switch($pl) {
			case 'left':
				wp_enqueue_style('simpel-layout', get_template_directory_uri()."/layouts/sidebar-content.css");
				break;
			case 'right':
				wp_enqueue_style('simpel-layout', get_template_directory_uri()."/layouts/content-sidebar.css");
				break;
		}
		
	wp_enqueue_script("jquery");
		
	wp_enqueue_script( 'simpel-menu-js', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array(), true );
	
	wp_enqueue_script( 'simpel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'simpel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simpel_scripts' );

function simpel_initialize_header() {

	echo "<script>"; ?>
	
	jQuery(function(){
		jQuery('.nav-menu').slicknav({
		});
	});
		
	<?php
	echo "</script>";
}

add_action('wp_head', 'simpel_initialize_header');

/**
 *	All the custom CSS codes get loaded from here.
**/
function simpel_custom_css() {
	
	$desc	=	esc_attr( get_theme_mod('simpel-title-color') );
	
	$css1	=	".site-title a {
					color: " . $desc . ";	
				}";
				
	$desc2	=	esc_attr( get_theme_mod('header_textcolor') );
	
	$css2	=	".site-description {
					color: #" . $desc2 . ";
				}";
				
				
	wp_add_inline_style('simpel-main-skin', $css1 . $css2 );
}

add_action('wp_enqueue_scripts','simpel_custom_css');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
