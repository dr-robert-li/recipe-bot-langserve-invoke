<?php

/**
 * Plugin Loader
 * 
 * @package recipe-bot
 */

class RBP_Init
{

	public $prefix = 'rb';

	public function __construct()
	{
		add_filter('rwmb_meta_boxes', [$this, 'blocks']);
	}

	public function blocks($meta_boxes)
	{
		$meta_boxes[] = [
			'title'           => __('Recipe Bot', 'recipe-bot'),
			'id'              => 'recipe-bot',
			'type'            => 'block',
			'icon'            => 'rest-api',
			'context'         => 'side',
			'enqueue_style'   => RBP_URL . 'assets/css/style.css',
			'enqueue_script'  => RBP_URL . 'assets/js/main.js',
			'render_template' => RBP_PATH . 'app/template.php',
			'fields'  => [
				// Request Settings
				[
					'type' => 'heading',
					'name' => esc_html__('Request Settings', 'recipe-bot'),
				],
				[
					'type' => 'text',
					'name' => esc_html__('Endpoint', 'recipe-bot'),
					'id'   => $this->prefix . '-endpoint',
					'placeholder' => 'ex: https://api.robs.kitchen',
					'std' => 'https://api.robs.kitchen'
				],
				[
					'type' => 'textarea',
					'name' => esc_html__('System Message', 'recipe-bot'),
					'id'   => $this->prefix . '-system_message',
					'placeholder' => 'Typing something...'
				],
				[
					'type' => 'textarea',
					'name' => esc_html__('Context', 'recipe-bot'),
					'id'   => $this->prefix . '-context',
					'placeholder' => 'Typing something...'
				],

				// Extra Settings
				[
					'type' => 'heading',
					'name' => esc_html__('Layout Settings', 'recipe-bot'),
				],
				[
					'type' => 'text',
					'name' => esc_html__('Input Placeholder', 'recipe-bot'),
					'id'   => $this->prefix . '-input-placeholder',
					'placeholder' => 'Typing something...'
				],
				[
					'type' => 'text',
					'name' => esc_html__('Button Text', 'recipe-bot'),
					'id'   => $this->prefix . '-button-text',
					'std'  => 'Confirm',
					'placeholder' => 'default: Confirm'
				]
			],
		];
		return $meta_boxes;
	}
}

new RBP_Init;
