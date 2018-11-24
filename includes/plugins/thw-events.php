<?php

function thw_events_register()
{
	register_post_type(
		'thw-events',
		array(
			'labels' => array(
				'name' => 'Events',
				'singular_name' => 'Event',
				'add_new_item' => 'Add New Event',
				'edit_item' => 'Edit Event',
				'new_item' => 'New Event',
				'view' => 'View Events',
				'view_item' => 'View Event',
				'search_items' => 'Search Events',
				'not_found' => 'No Events found',
				'not_found_in_trash' => 'No Events Found in Trash'
			),
			'public' => true,
			'publicly_queryable' => false,
			'supports' => array(
				'title',
				'thumbnail'
			)
		)
	);
} add_action('init', 'thw_events_register');

function thw_events_remove_filters()
{
	global $typenow;

    if ($typenow == 'thw-events') {
        add_filter('months_dropdown_results', '__return_empty_array');
    }
} add_action('admin_head', 'thw_events_remove_filters');

function thw_events_disable_sorting($columns)
{
	return array();
} add_filter('manage_edit-thw-events_sortable_columns', 'thw_events_disable_sorting');

function thw_events_remove_date_field()
{
	remove_post_type_support('thw-events', 'date');
} add_action('admin_init', 'thw_events_remove_date_field');








function thw_events_post_columns($columns, $postType)
{
	if ($postType == 'thw-events') {
		unset($columns['date']);
		$columns['venue'] = 'Venue';
		$columns['start_date'] = 'Start Date';
		$columns['end_date'] = 'End Date';
		$columns['start_time'] = 'Start Time';
		$columns['end_time'] = 'End Time';
	}

	return $columns;
} add_filter('manage_posts_columns', 'thw_events_post_columns', 10, 2);



function thw_events_post_columns_contents($column, $postId)
{
	$field = get_field($column, $postId);

	if (in_array($column, array('start_date', 'end_date'))) {
		$fileDateObj = DateTime::createFromFormat('Ymd', $field);

		if ($fileDateObj === false) {
			$field = null;
		} else {
			$field = $fileDateObj->format('D jS F, Y');
		}
	}

	echo $field;
} add_action('manage_thw-events_posts_custom_column', 'thw_events_post_columns_contents', 10, 2);

function thw_events_sort($query)
{
	if (isset($query->query['post_type']) && $query->query['post_type'] == 'thw-events') {
		$query->set('orderby', 'meta_value_num');
		$query->set('meta_key', 'start_date');
      
      	if (isset($_GET['past'])) {
			$query->set('order', 'DESC');
		} else {
			$query->set('order', 'ASC');
		}
	}
} add_action('pre_get_posts', 'thw_events_sort');


