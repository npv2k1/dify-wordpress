/**
 * Gutenberg Block for Dify Chat
 */

(function( wp ) {
	const { registerBlockType } = wp.blocks;
	const { InspectorControls } = wp.blockEditor || wp.editor;
	const { PanelBody, TextControl } = wp.components;
	const { createElement: el } = wp.element;
	const { __ } = wp.i18n;

	registerBlockType( 'dify-wordpress/chat', {
		title: __( 'Dify Chat', 'dify-wordpress' ),
		icon: 'format-chat',
		category: 'widgets',
		attributes: {
			height: {
				type: 'string',
				default: '500px'
			},
			width: {
				type: 'string',
				default: '100%'
			}
		},

		edit: function( props ) {
			const { attributes, setAttributes } = props;
			const { height, width } = attributes;

			return el(
				'div',
				{},
				el(
					InspectorControls,
					{},
					el(
						PanelBody,
						{ title: __( 'Chat Settings', 'dify-wordpress' ) },
						el( TextControl, {
							label: __( 'Height', 'dify-wordpress' ),
							value: height,
							onChange: function( value ) {
								setAttributes( { height: value } );
							}
						}),
						el( TextControl, {
							label: __( 'Width', 'dify-wordpress' ),
							value: width,
							onChange: function( value ) {
								setAttributes( { width: value } );
							}
						})
					)
				),
				el(
					'div',
					{
						className: 'dify-chat-container',
						style: {
							height: height,
							width: width,
							border: '1px dashed #ccc',
							display: 'flex',
							alignItems: 'center',
							justifyContent: 'center',
							background: '#f9f9f9'
						}
					},
					el(
						'p',
						{},
						__( 'Dify Chat Widget', 'dify-wordpress' ) + ' (' + height + ' × ' + width + ')'
					)
				)
			);
		},

		save: function() {
			// Server-side rendering
			return null;
		}
	});

})( window.wp );
