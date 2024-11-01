<?php

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	 die( 'You are not allowed to call this page directly.' );
}

if ( ! class_exists( 'Tradays_Economic_Calendar_Shortcode' ) ) {

	class Tradays_Economic_Calendar_Shortcode {
		public $plugin_url;

		public function __construct() {
			return true;
		}

		public function run_shortcode( $options ) {
			if ( empty( $options ) ) {
				$options = array();
			}

			include $this->plugin_url . 'views/widget.php';

			$script = new Tradays_Economic_Calendar_Widget_View( $options );

			return $script->output();
		}
	}
}
