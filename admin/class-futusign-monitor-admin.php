<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bitbucket.org/futusign/futusign-wp-monitor
 * @since      0.1.0
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/admin
 */
if ( ! defined( 'WPINC' ) ) {
	 die;
}
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/admin
 * @author     John Tucker <john@larkintuckerllc.com>
 */
class Futusign_Monitor_Admin {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
	}
	/**
	 * Define settings
	 *
	 * @since    0.1.0
	 */
	public function admin_init() {
		register_setting(
			'futusign_monitor_option_group',
			'futusign_monitor_option_name',
			array( $this, 'sanitize_callback')
		);
		add_settings_section(
			'futusign_monitor_firebase_config_section',
			'Firebase Config',
			array ( $this, 'firebase_config_section_callback'),
			'futusign_monitor_settings_page');
		add_settings_section(
			'futusign_monitor_firebase_cred_section',
			'Firebase Credentials',
			array ( $this, 'firebase_cred_section_callback'),
			'futusign_monitor_settings_page');
		add_settings_field(
			'api_key',
			'apiKey',
			array ( $this, 'api_key' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'auth_domain',
			'authDomain',
			array ( $this, 'auth_domain' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'database_url',
			'databaseURL',
			array ( $this, 'database_url' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'project_id',
			'projectId',
			array ( $this, 'project_id' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'storage_bucket',
			'storageBucket',
			array ( $this, 'storage_bucket' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'messaging_sender_id',
			'messagingSenderId',
			array ( $this, 'messaging_sender_id' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_config_section'
		);
		add_settings_field(
			'email',
			'email',
			array ( $this, 'email' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_cred_section'
		);
		add_settings_field(
			'password',
			'password',
			array ( $this, 'password' ),
			'futusign_monitor_settings_page',
			'futusign_monitor_firebase_cred_section'
		);
	}
	/**
	 * Sanitize inputs
	 *
	 * @since    0.1.0
	 * @param    array      $input     input
	 * @return   array      sanitized input
	 */
	public function sanitize_callback($input) {
		$newinput['api_key'] = trim($input['api_key']);
		$newinput['auth_domain'] = trim($input['auth_domain']);
		$newinput['database_url'] = trim($input['database_url']);
		$newinput['project_id'] = trim($input['project_id']);
		$newinput['storage_bucket'] = trim($input['storage_bucket']);
		$newinput['messaging_sender_id'] = trim($input['messaging_sender_id']);
		$newinput['email'] = trim($input['email']);
		$newinput['password'] = trim($input['password']);
		return $newinput;
	}
	// TODO: IMPLEMENT
	/**
	 * Firebase config section copy
	 *
	 * @since    0.1.0
	 */
	public function firebase_config_section_callback() {
		?>
		<p>Please follow these <a href="https://www.futusign.com/plugin-directory/#monitor">instructions</a> on obtaining the Firebase config settings.</p>
		<?php
	}
	// TODO: IMPLEMENT
	/**
	 * Firebase credentials section copy
	 *
	 * @since    0.1.0
	 */
	public function firebase_cred_section_callback() {
		?>
		<p>Please follow these <a href="https://www.futusign.com/plugin-directory/#monitor">instructions</a> on obtaining the Firebase credentials settings.</p>
		<?php
	}
	/**
	 * apiKey Input
	 *
	 * @since    0.1.0
	 */
	public function api_key() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='api_key' name='futusign_monitor_option_name[api_key]' size='40' type='text' value='{$options['api_key']}' />";
	}
	/**
	 * authDomain Input
	 *
	 * @since    0.1.0
	 */
	public function auth_domain() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='auth_domain' name='futusign_monitor_option_name[auth_domain]' size='40' type='text' value='{$options['auth_domain']}' />";
	}
	/**
	 * databaseURL Input
	 *
	 * @since    0.1.0
	 */
	public function database_url() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='database_url' name='futusign_monitor_option_name[database_url]' size='40' type='text' value='{$options['database_url']}' />";
	}
	/**
	 * projectId Input
	 *
	 * @since    0.1.0
	 */
	public function project_id() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='project_id' name='futusign_monitor_option_name[project_id]' size='40' type='text' value='{$options['project_id']}' />";
	}
	/**
	 * storageBucket Input
	 *
	 * @since    0.1.0
	 */
	public function storage_bucket() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='storage_bucket' name='futusign_monitor_option_name[storage_bucket]' size='40' type='text' value='{$options['storage_bucket']}' />";
	}
	/**
	 * messagingSenderId Input
	 *
	 * @since    0.1.0
	 */
	public function messaging_sender_id() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='messaging_sender_id' name='futusign_monitor_option_name[messaging_sender_id]' size='40' type='text' value='{$options['messaging_sender_id']}' />";
	}
	/**
	 * email Input
	 *
	 * @since    0.1.0
	 */
	public function email() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='email' name='futusign_monitor_option_name[email]' size='40' type='text' value='{$options['email']}' />";
	}
	/**
	 * password Input
	 *
	 * @since    0.1.0
	 */
	public function password() {
		$options = get_option('futusign_monitor_option_name');
		echo "<input id='password' name='futusign_monitor_option_name[password]' size='40' type='text' value='{$options['password']}' />";
	}
	/**
	 * Add admin menus
	 *
	 * @since    0.1.0
	 */
	public function admin_menu() {
		add_options_page(
			'futusign Monitor',
			'futusign Monitor',
			'manage_options',
			'futusign_monitor_options',
			array( $this, 'options_page' )
		);
		add_submenu_page(
			'tools.php',
			'futusign Monitor',
			'futusign Monitor',
			'manage_options',
			'futusign_monitor_tools',
			array( $this, 'tools_page' )
		);
	}
	/**
	 * Display settings page
	 *
	 * @since    0.1.0
	 */
	public function options_page() {
		?>
		<div class="wrap">
			<h1>futusign Monitor Settings</h1>
			<form action="options.php" method="post">
				<?php settings_fields('futusign_monitor_option_group'); ?>
				<?php do_settings_sections('futusign_monitor_settings_page'); ?>
				<input
					name="Submit"
					type="submit"
					value="<?php esc_attr_e('Save Changes', 'futusign_monitor'); ?>"
					class="button button-primary"
				/>
			</form>
		</div>
		<?php
	}
/**
 * Display tools page
 *
 * @since    0.1.0
 */
public function tools_page() {
	include 'partials/futusign-monitor-tools.php';
  }
}
