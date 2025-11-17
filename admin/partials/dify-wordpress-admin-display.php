<?php
/**
 * Provide a admin area view for the plugin
 *
 * @package DifyWordPress
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<form method="post" action="options.php">
		<?php
		settings_fields( 'dify_wordpress_options_group' );
		do_settings_sections( 'dify-wordpress' );
		submit_button();
		?>
	</form>

	<div class="dify-usage-instructions">
		<h2>How to Use</h2>
		<h3>Shortcode</h3>
		<p>Use the following shortcode to embed a Dify chatbot anywhere in your content:</p>
		<code>[dify_chat]</code>

		<h3>Gutenberg Block</h3>
		<p>In the block editor, search for "Dify Chat" to add a chat widget block.</p>

		<h3>Widget</h3>
		<p>Enable the "Enable Chat Widget" option above to show the chat widget on all pages.</p>
	</div>
</div>
