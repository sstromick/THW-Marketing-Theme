<?php

function thw_casestudies_register()
{
	register_post_type(
		'thw-casestudies',
		array(
			'labels' => array(
				'name' => 'Case Studies',
				'singular_name' => 'Case Study',
				'add_new_item' => 'Add New Case Study',
				'edit_item' => 'Edit Case Study',
				'new_item' => 'New Case Study',
				'view' => 'View Case Studies',
				'view_item' => 'View Case Study',
				'search_items' => 'Search Case Studies',
				'not_found' => 'No Case Studies found',
				'not_found_in_trash' => 'No Case Studies Found in Trash'
			),
			'public' => true,
			'rewrite' => array(
				'slug' => 'case-studies',
				'with_front' => false
			),
			'has_archive' => true,
			'supports' => array(
				'title',
				'editor'
			)
		)
	);
} add_action('init', 'thw_casestudies_register');

function thw_casestudies_display($query)
{
	if(!is_admin() && $query->is_main_query() && $query->is_post_type_archive('thw-casestudies')) {
		$query->set('posts_per_page', '6');
	}
} add_action('pre_get_posts', 'thw_casestudies_display');
