<?php
if ( ! class_exists( 'Tradays_Economic_Calendar_Widget_View' ) ) {
	class Tradays_Economic_Calendar_Widget_View {
		public static $id = 1;
		public function __construct( $config = array() ) {
			self::$id ++;

			$this->widget_id = 'economicCalendarWidget-' . self::$id;

			$options  = array_intersect_key(
				$config,
				array_flip(
					array(
						'width',
						'height',
						'mode',
						'lang',
						'dateformat',
					)
				)
			);

			$this->config = array_merge(
				array(
					'id'     => $this->widget_id,
					'width'  => '100%',
					'height' => '300px',
					'mode'   => '2',
				),
				$options
			);

			foreach ( $config as $key => $val ) {
				if ( empty( $val ) ) {
					unset( $this->config[ $key ] );
				}
			}

			if ( isset( $config['autosize'] ) && $config['autosize'] === '1' ) {
				$this->config['width']  = '100%';
				$this->config['height'] = '100%';
			}

			if ( isset( $config['lang'] ) && $config['lang'] === 'def' ) {
					unset( $this->config['lang'] );
			}

			return true;
		}
		public function output() {
			$options = wp_json_encode( $this->config, 0, 1 );
			$html    = '<div id="$id" class="shortcode"></div>' .
					   '<script type="text/javascript">new economicCalendar($options)</script>';
			$html    = str_replace( '$options', $options, $html );
            $html    = str_replace( '$id', $this->widget_id, $html );
			return $html;
		}
	}
}
