<?php
/**
 * The plugin bootstrap file
 *
 * @link             https://bitbucket.org/futusign/futusign-wp-monitor
 * @since            0.1.0
 * @package          futusign_monitor
 * @wordpress-plugin
 * Plugin Name:      futusign Monitor
 * Plugin URI:       https://www.futusign.com
 * Description:      Add futusign Monitors feature
 * Version:          0.2.1
 * Author:           John Tucker
 * Author URI:       https://github.com/larkintuckerllc
 * License:          Custom
 * License URI:      https://www.futusign.com/license
 * Text Domain:      futusign-monitor
 * Domain Path:      /languages
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
//Use version 3.1 of the update checker.
require 'plugin-update-checker/plugin-update-checker.php';
new PluginUpdateChecker_3_1 (
	'http://futusign-wordpress.s3-website-us-east-1.amazonaws.com/futusignz-monitor.json',
	__FILE__
);
function activate_futusign_monitor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-futusign-monitor-activator.php';
	Futusign_Monitor_Activator::activate();
}
function deactivate_futusign_monitor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-futusign-monitor-deactivator.php';
	Futusign_Monitor_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_futusign_monitor' );
register_deactivation_hook( __FILE__, 'deactivate_futusign_monitor' );
require_once plugin_dir_path( __FILE__ ) . 'includes/class-futusign-monitor.php';
/**
 * Begins execution of the plugin.
 *
 * @since    0.1.0
 */
function run_futusign_monitor() {
	$plugin = new Futusign_Monitor();
	$plugin->run();
}
run_futusign_monitor();
