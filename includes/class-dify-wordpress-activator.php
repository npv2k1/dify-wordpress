<?php
/**
 * Fired during plugin activation.
 *
 * @package DifyWordPress
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 */
class Dify_WordPress_Activator {

	/**
	 * Activate the plugin.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
		// Set default options.
		if ( ! get_option( 'dify_wordpress_options' ) ) {
			$default_options = array(
				'api_key'     => '',
				'api_url'     => 'https://api.dify.ai/v1',
				'bot_id'      => '',
				'enable_chat' => false,
			);
			add_option( 'dify_wordpress_options', $default_options );
		}
	}
}
