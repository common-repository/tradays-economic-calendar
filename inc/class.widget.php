<?php

class Tradays_Economic_Calendar_Widget extends WP_Widget {
	public $plugin_url;

	public function __construct() {
		parent::__construct(
			'tradays_widget',
			__( 'Tradays Economic Calendar', 'tradays' ),
			array( 'description' => __( 'Display news releases and indicators relating to the world\'s largest economies', 'tradays' ) )
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		include $this->plugin_url . 'views/widget.php';
		$script = new Tradays_Economic_Calendar_Widget_View( $instance );
		$title  = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo $script->output();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title      = isset( $instance['title'] ) ? $instance['title'] : '';
		$width      = isset( $instance['width'] ) ? $instance['width'] : '100%';
		$height     = isset( $instance['height'] ) ? $instance['height'] : '100%';
		$autosize   = isset( $instance['autosize'] ) ? $instance['autosize'] : '0';
		$mode       = isset( $instance['mode'] ) ? $instance['mode'] : '2';
		$lang       = isset( $instance['lang'] ) ? $instance['lang'] : '';
		$dateformat = isset( $instance['dateformat'] ) ? $instance['dateformat'] : '';

		$options = json_decode(
			file_get_contents( $this->plugin_url . 'src/options.json' ),
			true
		);

		include $this->plugin_url . 'views/widget-settings.php';
	}


	public function update( $new_instance, $old_instance ) {
		$instance               = array();
		$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['width']      = ( ! empty( $new_instance['width'] ) ) ? wp_strip_all_tags( $new_instance['width'] ) : $old_instance['width'];
		$instance['height']     = ( ! empty( $new_instance['height'] ) ) ? wp_strip_all_tags( $new_instance['height'] ) : $old_instance['height'];
		$instance['mode']       = ( ! empty( $new_instance['mode'] ) ) ? wp_strip_all_tags( $new_instance['mode'] ) : '';
		$instance['lang']       = ( ! empty( $new_instance['lang'] ) ) ? wp_strip_all_tags( $new_instance['lang'] ) : '';
		$instance['dateformat'] = ( ! empty( $new_instance['dateformat'] ) ) ? wp_strip_all_tags( $new_instance['dateformat'] ) : '';
		$instance['autosize']   = ( ! empty( $new_instance['autosize'] ) ) ? wp_strip_all_tags( $new_instance['autosize'] ) : '';

		return $instance;
	}

}
