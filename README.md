# Dify for WordPress

A WordPress plugin that integrates Dify AI chatbot functionality into your WordPress site.

## Description

Dify for WordPress allows you to easily integrate Dify AI chatbot functionality into your WordPress website. Dify is an LLM app development platform that enables you to create powerful AI applications.

## Features

- 🤖 Easy integration with Dify API
- 📝 Shortcode support for embedding chat widgets anywhere
- 🎨 Gutenberg block for visual editing
- 💬 Floating chat widget option for all pages
- 🎭 Customizable chat widget appearance
- 🔐 Secure API key management
- 💾 Conversation persistence

## Installation

1. Upload the plugin files to the `/wp-content/plugins/dify-wordpress` directory
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Settings > Dify WordPress to configure the plugin
4. Enter your Dify API credentials (API Key and Bot ID)

## Configuration

1. Navigate to **Settings > Dify WordPress** in your WordPress admin panel
2. Enter the following information:
   - **API Key**: Your Dify API key
   - **API URL**: Your Dify API endpoint (default: https://api.dify.ai/v1)
   - **Bot ID**: Your Dify bot identifier
   - **Enable Chat Widget**: Toggle to enable/disable the floating chat widget

## Usage

### Shortcode

Use the `[dify_chat]` shortcode to embed a chat widget anywhere in your content:

```
[dify_chat]
```

With custom dimensions:

```
[dify_chat height="600px" width="100%"]
```

### Gutenberg Block

1. In the block editor, click the '+' button to add a new block
2. Search for "Dify Chat"
3. Add the block to your content
4. Customize the height and width in the block settings panel

### Floating Chat Widget

Enable the floating chat widget in the plugin settings to show a chat button on all pages of your site.

## Getting Your Dify Credentials

1. Sign up for a Dify account at https://cloud.dify.ai or set up your own Dify instance
2. Create a new AI application or chatbot
3. Navigate to your application's API settings
4. Copy your API key and Bot ID
5. Paste them into the plugin settings in WordPress

## Development

### File Structure

```
dify-wordpress/
├── admin/
│   ├── class-dify-wordpress-admin.php
│   └── partials/
│       └── dify-wordpress-admin-display.php
├── assets/
│   ├── css/
│   │   ├── dify-wordpress-admin.css
│   │   └── dify-wordpress-public.css
│   └── js/
│       ├── dify-wordpress-admin.js
│       ├── dify-wordpress-block.js
│       └── dify-wordpress-public.js
├── includes/
│   ├── class-dify-wordpress-activator.php
│   ├── class-dify-wordpress-deactivator.php
│   ├── class-dify-wordpress-loader.php
│   └── class-dify-wordpress.php
├── public/
│   └── class-dify-wordpress-public.php
├── dify-wordpress.php
├── readme.txt
└── README.md
```

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher
- Active Dify account with API access

## Security

- API keys are stored securely in the WordPress database
- All user inputs are sanitized and validated
- API communications use secure HTTPS connections

## Privacy

This plugin connects to external Dify API services. When using this plugin:
- User messages are sent to the Dify API endpoint you configure
- Conversations may be stored on Dify servers according to their privacy policy
- No data is collected or stored by this plugin itself

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/npv2k1/dify-wordpress).

## License

This plugin is licensed under the GPL v2 or later.

## Credits

Developed for integration with [Dify](https://dify.ai), an open-source LLM app development platform.
