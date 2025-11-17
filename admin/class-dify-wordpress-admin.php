<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package DifyWordPress
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for enqueuing admin styles and scripts.
 */
class Dify_WordPress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @var string
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Initialize the class.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_name,
			DIFY_WORDPRESS_PLUGIN_URL . 'assets/css/dify-wordpress-admin.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			$this->plugin_name,
			DIFY_WORDPRESS_PLUGIN_URL . 'assets/js/dify-wordpress-admin.js',
			array( 'jquery' ),
			$this->version,
			false
		);
	}

	/**
	 * Add options page to the admin menu.
	 */
	public function add_plugin_admin_menu() {
		add_options_page(
			'Dify WordPress Settings',
			'Dify WordPress',
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_plugin_admin_page' )
		);
	}

	/**
	 * Render the options page for plugin.
	 */
	public function display_plugin_admin_page() {
		include_once DIFY_WORDPRESS_PLUGIN_DIR . 'admin/partials/dify-wordpress-admin-display.php';
	}

	/**
	 * Register settings.
	 */
	public function register_settings() {
		register_setting(
			'dify_wordpress_options_group',
			'dify_wordpress_options',
			array( $this, 'sanitize_options' )
		);

		add_settings_section(
			'dify_wordpress_api_section',
			'Dify API Settings',
			array( $this, 'api_section_callback' ),
			$this->plugin_name
		);

		add_settings_field(
			'api_key',
			'API Key',
			array( $this, 'api_key_callback' ),
			$this->plugin_name,
			'dify_wordpress_api_section'
		);

		add_settings_field(
			'api_url',
			'API URL',
			array( $this, 'api_url_callback' ),
			$this->plugin_name,
			'dify_wordpress_api_section'
		);

		add_settings_field(
			'bot_id',
			'Bot ID',
			array( $this, 'bot_id_callback' ),
			$this->plugin_name,
			'dify_wordpress_api_section'
		);

		add_settings_field(
			'enable_chat',
			'Enable Chat Widget',
			array( $this, 'enable_chat_callback' ),
			$this->plugin_name,
			'dify_wordpress_api_section'
		);
	}

	/**
	 * Sanitize options.
	 *
	 * @param array $input Options to sanitize.
	 * @return array Sanitized options.
	 */
	public function sanitize_options( $input ) {
		$sanitized = array();

		if ( isset( $input['api_key'] ) ) {
			$sanitized['api_key'] = sanitize_text_field( $input['api_key'] );
		}

		if ( isset( $input['api_url'] ) ) {
			$sanitized['api_url'] = esc_url_raw( $input['api_url'] );
		}

		if ( isset( $input['bot_id'] ) ) {
			$sanitized['bot_id'] = sanitize_text_field( $input['bot_id'] );
		}

		if ( isset( $input['enable_chat'] ) ) {
			$sanitized['enable_chat'] = (bool) $input['enable_chat'];
		} else {
			$sanitized['enable_chat'] = false;
		}

		return $sanitized;
	}

	/**
	 * API section callback.
	 */
	public function api_section_callback() {
		echo '<p>Configure your Dify API settings below.</p>';
	}

	/**
	 * API key field callback.
	 */
	public function api_key_callback() {
		$options = get_option( 'dify_wordpress_options' );
		$value   = isset( $options['api_key'] ) ? $options['api_key'] : '';
		?>
		<input type="text" id="api_key" name="dify_wordpress_options[api_key]" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
		<p class="description">Enter your Dify API key.</p>
		<?php
	}

	/**
	 * API URL field callback.
	 */
	public function api_url_callback() {
		$options = get_option( 'dify_wordpress_options' );
		$value   = isset( $options['api_url'] ) ? $options['api_url'] : 'https://api.dify.ai/v1';
		?>
		<input type="url" id="api_url" name="dify_wordpress_options[api_url]" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
		<p class="description">Enter your Dify API URL (default: https://api.dify.ai/v1).</p>
		<?php
	}

	/**
	 * Bot ID field callback.
	 */
	public function bot_id_callback() {
		$options = get_option( 'dify_wordpress_options' );
		$value   = isset( $options['bot_id'] ) ? $options['bot_id'] : '';
		?>
		<input type="text" id="bot_id" name="dify_wordpress_options[bot_id]" value="<?php echo esc_attr( $value ); ?>" class="regular-text" />
		<p class="description">Enter your Dify Bot ID.</p>
		<?php
	}

	/**
	 * Enable chat field callback.
	 */
	public function enable_chat_callback() {
		$options = get_option( 'dify_wordpress_options' );
		$checked = isset( $options['enable_chat'] ) && $options['enable_chat'] ? 'checked' : '';
		?>
		<input type="checkbox" id="enable_chat" name="dify_wordpress_options[enable_chat]" value="1" <?php echo esc_attr( $checked ); ?> />
		<label for="enable_chat">Enable chat widget on all pages</label>
		<?php
	}
}
