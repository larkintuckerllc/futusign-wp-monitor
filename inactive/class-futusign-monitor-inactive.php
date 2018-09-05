<?php
/**
 * The inactive functionality of the plugin.
 *
 * @link       https://bitbucket.org/futusign/futusign-wp-monitor
 * @since      0.1.0
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/inactive
 */
if ( ! defined( 'WPINC' ) ) {
	 die;
}
/**
 * The inactive functionality of the plugin.
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/inactive
 * @author     John Tucker <john@larkintuckerllc.com>
 */
class Futusign_Monitor_Inactive {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
	}
	/**
	 * Display missing plugin dependency notices.
	 *
	 * @since    0.1.0
	 */
	public function missing_plugins_notice() {
		if ( ! Futusign_Monitor::is_plugin_active( 'futusign' ) ) {
			include plugin_dir_path( __FILE__ ) . 'partials/futusign-monitor-missing-futusign.php';
		}
	}
}
