<?php
/*
Plugin Name: Tradays Economic Calendar
Plugin URI: https://wordpress.org/plugins/tradays-economic-calendar
Description: Tradays economic calendar plugin for WordPress websites
Version: 1.0
Author: MQL5 Ltd.
Author URI: https://www.mql5.com
License: GPLv2 (or later)
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: tradays
Domain Path: /languages
*/

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' ); }

require_once plugin_dir_path( __FILE__ ) . 'inc/class.tradays.php';

register_activation_hook( __FILE__, array( 'Tradays_Economic_Calendar_Include', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Tradays_Economic_Calendar_Include', 'deactivate' ) );

$tradays                  = new Tradays_Economic_Calendar_Include();
$tradays->plugin_url      = plugin_dir_path( __FILE__ );
$tradays->plugin_dir_url  = plugin_dir_url( __FILE__ );
$tradays->plugin_dir_path = plugin_dir_path( __FILE__ );
$tradays->plugin_dir      = basename( dirname( __FILE__ ) );
$tradays->plugin_info     = get_file_data(
	__FILE__,
	array(
		'version' => 'Version',
	),
	false
);
$tradays->run_tradays();
