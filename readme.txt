=== Dify for WordPress ===
Contributors: dify-wordpress-team
Tags: ai, chatbot, dify, artificial intelligence, chat
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Integrate Dify AI chatbot into your WordPress site with shortcodes and Gutenberg blocks.

== Description ==

Dify for WordPress allows you to easily integrate Dify AI chatbot functionality into your WordPress website. Dify is an LLM app development platform that enables you to create powerful AI applications.

**Features:**

* Easy integration with Dify API
* Shortcode support for embedding chat widgets anywhere
* Gutenberg block for visual editing
* Floating chat widget option for all pages
* Customizable chat widget appearance
* Secure API key management
* Conversation persistence

**Usage:**

1. Install and activate the plugin
2. Go to Settings > Dify WordPress
3. Enter your Dify API credentials
4. Use the `[dify_chat]` shortcode or Gutenberg block to add chat widgets
5. Optionally enable the floating chat widget for site-wide chat

**Shortcode:**

`[dify_chat height="500px" width="100%"]`

**About Dify:**

Dify is an open-source LLM app development platform. It combines AI workflows, RAG pipelines, agent capabilities, model management, and observability features. Learn more at https://dify.ai

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/dify-wordpress` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings > Dify WordPress screen to configure the plugin.
4. Enter your Dify API key and Bot ID.
5. Start using the shortcode or Gutenberg block to add chat widgets to your site.

== Frequently Asked Questions ==

= Where do I get my Dify API key? =

You can get your API key from your Dify account dashboard at https://cloud.dify.ai or your self-hosted Dify instance.

= Can I customize the chat widget appearance? =

Yes, you can customize the appearance using CSS. The plugin provides CSS classes that you can override in your theme.

= Does this plugin work with Gutenberg? =

Yes, the plugin includes a Gutenberg block called "Dify Chat" that you can use in the block editor.

= Can I use multiple chat widgets on the same page? =

Yes, you can use multiple shortcodes or blocks on the same page.

= Is my API key secure? =

The API key is stored in your WordPress database and is only accessible to site administrators.

== Screenshots ==

1. Admin settings page
2. Chat widget embedded in a page
3. Floating chat widget
4. Gutenberg block in the editor

== Changelog ==

= 1.0.0 =
* Initial release
* Shortcode support
* Gutenberg block support
* Floating chat widget
* Admin settings page
* API integration with Dify

== Upgrade Notice ==

= 1.0.0 =
Initial release of Dify for WordPress.

== Privacy Policy ==

This plugin connects to external Dify API services to provide chatbot functionality. When using this plugin:

* User messages are sent to the Dify API endpoint you configure
* Conversations may be stored on Dify servers according to their privacy policy
* No data is collected or stored by this plugin itself
* Please review Dify's privacy policy at https://dify.ai

== Support ==

For support, please visit the plugin's GitHub repository or contact the plugin author.
