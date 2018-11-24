<?php

class thw_blogtags_widget extends WP_Widget
{
	function __construct()
	{
		parent::__construct(
			'thw_blogtags_widget',
			'Blog Tags with Count',
			array('description' => 'Widget for displaying blog tags with post count')
		);
	}

	function widget($args, $instance)
	{
		echo $args['before_widget'];

		$title = apply_filters('widget_title', $instance['title']);

		if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
		}



		$tags = get_tags(array(
			'orderby' => 'count',
			'order' => 'DESC'
		));

		foreach ($tags as $tag) {
			echo '	<a href="'. get_tag_link($tag->term_id) .'">
						<span class="name">' . $tag->name . '</span>
						<span class="count">' . $tag->count . '</span>
					</a>';
		}

		echo $args['after_widget'];
	}

	function form($instance)
	{
		$title = empty($instance['title']) ? null : $instance['title'];

		echo '	<p>
					<label for="' . $this->get_field_id('title') . '">Title:</label>
					<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '">
				</p>';
	}

	function update($new_instance, $old_instance)
	{
		$instance = array(
			'title' => empty($new_instance['title']) ? '' : strip_tags($new_instance['title'])
		);

		return $instance;
	}
}

function thw_blogtags_widget_load()
{
	register_widget('thw_blogtags_widget');
} add_action('widgets_init', 'thw_blogtags_widget_load');
