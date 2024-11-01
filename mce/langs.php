<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '_WP_Editors' ) ) {
	require ABSPATH . WPINC . '/class-wp-editor.php';
}

function tradays_mce_plugin_translation() {
	$strings    = array(
		'langs.pageLang'    => __( 'Page Language', 'tradays' ),
		'labels.width'      => __( 'Width', 'tradays' ),
		'labels.height'     => __( 'Height', 'tradays' ),
		'modes.currDay'     => __( 'Current Day', 'tradays' ),
		'modes.currWeek'    => __( 'Current Week', 'tradays' ),
		'labels.autosize'   => __( 'Auto Size', 'tradays' ),
		'button.title'      => __( 'Insert Tradays calendar', 'tradays' ),
		'modal.title'       => __( 'Tradays Settings', 'tradays' ),
		'labels.mode'       => __( 'Mode', 'tradays' ),
		'labels.language'   => __( 'Language', 'tradays' ),
		'labels.dateformat' => __( 'Date Format', 'tradays' ),
	);
	$locale     = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.tradaysEconomicCalendar", ' . wp_json_encode( $strings ) . ");\n";

	return $translated;
}

$strings = tradays_mce_plugin_translation();
