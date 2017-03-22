<?php
add_action('wp_enqueue_scripts', 'wl_removeScripts' , 20);
function wl_removeScripts() {
//De-Queuing Styles sheet 
wp_dequeue_style( 'default',get_template_directory_uri() .'/css/default.css'); 
//EN-Queing Style sheet 
wp_enqueue_style('lite-brown', get_stylesheet_directory_uri() . '/green.css');
}?>
<?php
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );
if ( ! function_exists( 'wl_render_title' ) ) :
	function wl_render_title() {
	?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }
	add_action( 'wp_head', 'wl_render_title' );
endif;
?>