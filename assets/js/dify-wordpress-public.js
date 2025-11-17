/**
 * Public JavaScript for Dify WordPress plugin
 */

(function( $ ) {
	'use strict';

	/**
	 * Dify Chat Widget Class
	 */
	class DifyChatWidget {
		constructor( container, options ) {
			this.container = container;
			this.options = options;
			this.conversationId = null;
			this.init();
		}

		init() {
			this.createChatUI();
			this.attachEventListeners();
		}

		createChatUI() {
			const html = `
				<div class="dify-chat-messages" id="dify-chat-messages"></div>
				<div class="dify-chat-input-container">
					<input type="text" class="dify-chat-input" id="dify-chat-input" placeholder="Type your message...">
				</div>
			`;
			this.container.innerHTML = html;
		}

		attachEventListeners() {
			const input = document.getElementById('dify-chat-input');
			if (input) {
				input.addEventListener('keypress', (e) => {
					if (e.key === 'Enter') {
						this.sendMessage(input.value);
						input.value = '';
					}
				});
			}
		}

		addMessage(message, isUser) {
			const messagesContainer = document.getElementById('dify-chat-messages');
			if (!messagesContainer) return;

			const messageDiv = document.createElement('div');
			messageDiv.className = `dify-chat-message ${isUser ? 'user' : 'bot'}`;
			
			const bubble = document.createElement('div');
			bubble.className = 'dify-chat-bubble';
			bubble.textContent = message;
			
			messageDiv.appendChild(bubble);
			messagesContainer.appendChild(messageDiv);
			messagesContainer.scrollTop = messagesContainer.scrollHeight;
		}

		async sendMessage(message) {
			if (!message.trim()) return;

			this.addMessage(message, true);

			// Check if API is configured
			if (!this.options.apiKey || !this.options.botId) {
				this.addMessage('Please configure Dify API settings in the admin panel.', false);
				return;
			}

			try {
				const response = await this.callDifyAPI(message);
				if (response && response.answer) {
					this.addMessage(response.answer, false);
					if (response.conversation_id) {
						this.conversationId = response.conversation_id;
					}
				} else {
					this.addMessage('Sorry, I could not get a response. Please try again.', false);
				}
			} catch (error) {
				console.error('Dify API Error:', error);
				this.addMessage('An error occurred. Please check your API settings.', false);
			}
		}

		async callDifyAPI(query) {
			const url = `${this.options.apiUrl}/chat-messages`;
			
			const body = {
				inputs: {},
				query: query,
				response_mode: 'blocking',
				user: 'wordpress-user',
			};

			if (this.conversationId) {
				body.conversation_id = this.conversationId;
			}

			const response = await fetch(url, {
				method: 'POST',
				headers: {
					'Authorization': `Bearer ${this.options.apiKey}`,
					'Content-Type': 'application/json',
				},
				body: JSON.stringify(body),
			});

			if (!response.ok) {
				throw new Error(`API request failed: ${response.status}`);
			}

			return await response.json();
		}
	}

	/**
	 * Initialize chat widgets
	 */
	$(function() {
		// Initialize embedded chat widgets
		$('.dify-chatbot-widget').each(function() {
			if (typeof difyWordPress !== 'undefined') {
				new DifyChatWidget(this, difyWordPress);
			}
		});

		// Initialize floating chat widget if enabled
		if (typeof difyWordPress !== 'undefined' && difyWordPress.enableChat) {
			createFloatingWidget();
		}
	});

	/**
	 * Create floating chat widget
	 */
	function createFloatingWidget() {
		const widgetHtml = `
			<div class="dify-chat-container dify-chat-widget-floating" id="dify-floating-widget">
				<div class="dify-chat-header" id="dify-chat-header">
					<h3>Chat with us</h3>
					<button class="dify-chat-toggle" id="dify-chat-toggle">−</button>
				</div>
				<div id="dify-floating-chatbot" class="dify-chatbot-widget"></div>
			</div>
		`;

		$('body').append(widgetHtml);

		const chatWidget = document.getElementById('dify-floating-chatbot');
		if (chatWidget && typeof difyWordPress !== 'undefined') {
			new DifyChatWidget(chatWidget, difyWordPress);
		}

		// Toggle minimize/maximize
		$('#dify-chat-toggle, #dify-chat-header').on('click', function() {
			const widget = $('#dify-floating-widget');
			const toggle = $('#dify-chat-toggle');
			
			widget.toggleClass('minimized');
			
			if (widget.hasClass('minimized')) {
				toggle.text('+');
				$('#dify-floating-chatbot').hide();
			} else {
				toggle.text('−');
				$('#dify-floating-chatbot').show();
			}
		});
	}

})( jQuery );
