<?php

function thw_testimonials_register()
{
	register_post_type(
		'thw-testimonials',
		array(
			'labels' => array(
				'name' => 'Testimonials',
				'singular_name' => 'Testimonial',
				'add_new_item' => 'Add New Testimonial',
				'edit_item' => 'Edit Testimonial',
				'new_item' => 'New Testimonial',
				'view' => 'View Testimonials',
				'view_item' => 'View Testimonial',
				'search_items' => 'Search Testimonials',
				'not_found' => 'No Testimonials found',
				'not_found_in_trash' => 'No Testimonials Found in Trash'
			),
			'public' => true,
			'publicly_queryable' => false,
			'supports' => array(
				'title'
			)
		)
	);
} add_action('init', 'thw_testimonials_register');
