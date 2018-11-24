<?php

function cw_menu_register()
{
	register_post_type(
		'cw-menu',
		array(
			'labels' => array(
				'name' => 'Menu'
			),
			'public' => true,
			'show_ui' => false,
			'rewrite' => array(
				'slug' => 'menu',
				'with_front' => false
			),
			'has_archive' => true
		)
	);
} add_action('init', 'cw_menu_register');
