<?php

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' );
}
if ( ! defined( 'TRADAYS_ECONOMIC_CALENDAR_TRACK_INSTALL_URL' ) ) {
	define( 'TRADAYS_ECONOMIC_CALENDAR_TRACK_INSTALL_URL', 'https://content.mql5.com/tr?event=Plugin%2BWordPress%2BActivate&id=xgtwjihqxpekdivhyasdmymldwnqaolegh&ref=https%3A%2F%2Fcalendar.mql5.com%2F' );
}
if ( ! defined( 'TRADAYS_ECONOMIC_CALENDAR_TRACK_UNINSTALL_URL' ) ) {
	define( 'TRADAYS_ECONOMIC_CALENDAR_TRACK_UNINSTALL_URL', 'https://content.mql5.com/tr?event=Plugin%2BWordPress%2BDeactivate&id=xgtwjihqxpekdivhyasdmymldwnqaolegh&ref=https%3A%2F%2Fcalendar.mql5.com%2F' );
}
if ( ! class_exists( 'Tradays_Economic_Calendar_Include' ) ) {
	class Tradays_Economic_Calendar_Include {
		public $plugin_url;
		public $plugin_dir;
		public $plugin_dir_path;
		public $plugin_dir_url;
		public $plugin_info;

		public function __construct() {
			require_once plugin_dir_path( __FILE__ ) . 'class.shortcode.php';
			require_once plugin_dir_path( __FILE__ ) . 'class.widget.php';
		}

		public function tradays_init() {
			load_plugin_textdomain( 'tradays', false, $this->plugin_dir . '/languages/' );
		}

		public static function activate() {
			wp_remote_get(
				TRADAYS_ECONOMIC_CALENDAR_TRACK_INSTALL_URL,
				array(
					'headers' => array(
						'user-agent' => self::user_agent(),
					),
				)
			);
			return true;
		}

		public static function deactivate() {
			wp_remote_get(
				TRADAYS_ECONOMIC_CALENDAR_TRACK_UNINSTALL_URL,
				array(
					'headers' => array(
						'user-agent' => self::user_agent(),
					),
				)
			);
			return true;
		}

		public static function user_agent() {
			return 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' );
		}

		public function tradays_main_script() {
			wp_enqueue_script( 'tradays-widget', 'https://c.mql5.com/js/widgets/calendar/widget.js?6', false, null);
		}

		public function tradays_shortcode( $atts ) {
			$this->shortcode  = new Tradays_Economic_Calendar_Shortcode();
			$this->shortcode->plugin_url = $this->plugin_url;

			return $this->shortcode->run_shortcode( $atts );
		}

		public function tradays_widget() {
			$this->widget     = new Tradays_Economic_Calendar_Widget();
			$this->widget->plugin_url = $this->plugin_url;
			register_widget( $this->widget );
		}

		public function tradays_block_assets() {
			wp_enqueue_style(
				'tradays-block-style-css',
				plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ),
				array( 'wp-editor' ),
				$this->plugin_info['version']
			);
		}

		public function tradays_block_editor_assets() {
			wp_enqueue_script(
				'tradays-block-js',
				plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
				array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
				true
			);

			wp_enqueue_style(
				'tradays-block-editor-css',
				plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ),
				array( 'wp-edit-blocks' ),
				$this->plugin_info['version']
			);

			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations(
					'tradays-block-js',
					'tradays',
					$this->plugin_url . 'languages'
				);
			}
		}

		public function tradays_head() {
			echo "<meta http-equiv='x-dns-prefetch-control' content='on' />\n";
		}

		public function tradays_register_buttons_editor( $buttons ) {
			array_push( $buttons, 'tradaysEconomicCalendar.insertShortcode' );
			return $buttons;
		}

		public function tradays_enqueue_mce_scripts( $plugin_array ) {
			$plugin_array['tradays'] = $this->plugin_dir_url . 'mce/plugin.js';
			return $plugin_array;
		}

		public function tradays_load_mce_languages( $locales ) {
			$locales['tradays'] = $this->plugin_dir_path . 'mce/langs.php';
			return $locales;
		}

		public function tradays_add_mce_custom_locale() {
			?>
			<script type='text/javascript'>
				tinyMCE.addI18n('<?php echo esc_html( explode( '_', get_user_locale() )[0] ); ?>.tradaysEconomicCalendar',
					{
						'langs.pageLang'   : '<?php echo esc_html__( 'Page Language', 'tradays' ); ?>',
						'labels.width'     : '<?php echo esc_html__( 'Width', 'tradays' ); ?>',
						'labels.height'    : '<?php echo esc_html__( 'Height', 'tradays' ); ?>',
						'modes.currDay'    : '<?php echo esc_html__( 'Current Day', 'tradays' ); ?>',
						'modes.currWeek'   : '<?php echo esc_html__( 'Current Week', 'tradays' ); ?>',
						'labels.autosize'  : '<?php echo esc_html__( 'Auto Size', 'tradays' ); ?>',
						'button.title'     : '<?php echo esc_html__( 'Insert Tradays calendar', 'tradays' ); ?>',
						'modal.title'      : '<?php echo esc_html__( 'Tradays Settings', 'tradays' ); ?>',
						'labels.mode'      : '<?php echo esc_html__( 'Mode', 'tradays' ); ?>',
						'labels.language'  : '<?php echo esc_html__( 'Language', 'tradays' ); ?>',
						'labels.dateformat': '<?php echo esc_html__( 'Date Format', 'tradays' ); ?>',
					});
			</script>
			<?php
		}

		public function run_tradays() {
			add_action( 'plugins_loaded', array( &$this, 'tradays_init' ) );
			add_action( 'wp_head', array( &$this, 'tradays_head' ) );
			add_action( 'widgets_init', array( &$this, 'tradays_widget' ) );
			add_action( 'wp_enqueue_scripts', array( &$this, 'tradays_main_script' ) );
			add_shortcode( 'tradays', array( &$this, 'tradays_shortcode' ) );
			add_action( 'enqueue_block_assets', array( &$this, 'tradays_block_assets' ) );
			add_action( 'enqueue_block_editor_assets', array( &$this, 'tradays_block_editor_assets' ) );
			add_filter( 'mce_buttons', array( &$this, 'tradays_register_buttons_editor' ) );
			add_filter( 'mce_external_plugins', array( &$this, 'tradays_enqueue_mce_scripts' ) );
			add_filter( 'mce_external_languages', array( &$this, 'tradays_load_mce_languages' ) );

			if ( version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
				add_action( 'print_default_editor_scripts', array( &$this, 'tradays_add_mce_custom_locale' ) );
			}
		}
	}
}
