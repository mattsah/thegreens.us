<?php
/**
 * Widget API: AwyeAdWidget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Text widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class AwyeAdWidget extends WP_Widget {

	/**
	 * Sets up a new Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML.', 'awie'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('text', __('Awye: Ad Widget', 'awie'), $widget_ops, $control_ops);
	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 */
	public function widget( $args, $instance ) {

		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 * @since 4.4.0 Added the `$this` parameter.
		 *
		 * @param string         $widget_text The widget content.
		 * @param array          $instance    Array of settings for the current widget.
		 * @param AwyeAdWidget $this        Current Text widget instance.
		 */
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		echo $args['before_widget']; ?>
			<div class="textwidget wide_banner"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
		$instance['filter'] = ! empty( $new_instance['filter'] );
		return $instance;
	}

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		?>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'awie' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'awie'); ?></label></p>
		<?php
	}
}
