<?php
/**
 * Define the internationalization functionality
 *
 * @link       https://bitbucket.org/futusign/futusign-wp-monitor
 * @since      0.1.0
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/includes
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Define the internationalization functionality.
 *
 * @since      0.1.0
 * @package    futusign_monitor
 * @subpackage futusign_monitor/includes
 * @author     John Tucker <john@larkintuckerllc.com>
 */
class Futusign_Monitor_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'futusign_monitor',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
