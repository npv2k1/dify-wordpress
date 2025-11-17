<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package DifyWordPress
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for enqueuing public styles and scripts.
 */
class Dify_WordPress_Public {

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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_name,
			DIFY_WORDPRESS_PLUGIN_URL . 'assets/css/dify-wordpress-public.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {
		$options = get_option( 'dify_wordpress_options' );

		wp_enqueue_script(
			$this->plugin_name,
			DIFY_WORDPRESS_PLUGIN_URL . 'assets/js/dify-wordpress-public.js',
			array( 'jquery' ),
			$this->version,
			true
		);

		// Pass settings to JavaScript.
		wp_localize_script(
			$this->plugin_name,
			'difyWordPress',
			array(
				'apiUrl'     => isset( $options['api_url'] ) ? $options['api_url'] : '',
				'apiKey'     => isset( $options['api_key'] ) ? $options['api_key'] : '',
				'botId'      => isset( $options['bot_id'] ) ? $options['bot_id'] : '',
				'enableChat' => isset( $options['enable_chat'] ) ? $options['enable_chat'] : false,
			)
		);
	}

	/**
	 * Register shortcodes.
	 */
	public function register_shortcodes() {
		add_shortcode( 'dify_chat', array( $this, 'render_chat_shortcode' ) );
	}

	/**
	 * Render chat shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string HTML output.
	 */
	public function render_chat_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'height' => '500px',
				'width'  => '100%',
			),
			$atts,
			'dify_chat'
		);

		$options = get_option( 'dify_wordpress_options' );

		if ( empty( $options['api_key'] ) || empty( $options['bot_id'] ) ) {
			return '<p class="dify-error">Please configure Dify API settings in the admin panel.</p>';
		}

		$height = esc_attr( $atts['height'] );
		$width  = esc_attr( $atts['width'] );

		ob_start();
		?>
		<div class="dify-chat-container" style="height: <?php echo $height; ?>; width: <?php echo $width; ?>;">
			<div id="dify-chatbot-widget" class="dify-chatbot-widget"></div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Register Gutenberg blocks.
	 */
	public function register_blocks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		wp_register_script(
			'dify-wordpress-block',
			DIFY_WORDPRESS_PLUGIN_URL . 'assets/js/dify-wordpress-block.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
			$this->version,
			true
		);

		register_block_type(
			'dify-wordpress/chat',
			array(
				'editor_script'   => 'dify-wordpress-block',
				'render_callback' => array( $this, 'render_chat_block' ),
				'attributes'      => array(
					'height' => array(
						'type'    => 'string',
						'default' => '500px',
					),
					'width'  => array(
						'type'    => 'string',
						'default' => '100%',
					),
				),
			)
		);
	}

	/**
	 * Render chat block.
	 *
	 * @param array $attributes Block attributes.
	 * @return string HTML output.
	 */
	public function render_chat_block( $attributes ) {
		$height = isset( $attributes['height'] ) ? $attributes['height'] : '500px';
		$width  = isset( $attributes['width'] ) ? $attributes['width'] : '100%';

		return $this->render_chat_shortcode(
			array(
				'height' => $height,
				'width'  => $width,
			)
		);
	}
}
