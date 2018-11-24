<?php
/**
 * Template Name: Events
*/

get_header();

echo '	<div class="container">
			<div class="row">
				<div class="col-xs-12">';

$titleBack = get_field('title_with_background');

if (!empty($titleBack[0]) && !empty($titleBack[0]['pages_title_background_image']['url'])) {


	echo '			<div id="mainTitleWithBack" style="background-image:url(\'' . esc_url($titleBack[0]['pages_title_background_image']['url']) . '\')">
						<div class="row">
							<div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">';

	$iconHtml = null;

	if (!empty($titleBack[0]['pages_title_icon'])) {
		$iconMap = array(
			'target' => 'marketconsult',
			'dots' => 'socialconsult',
			'personddots' => 'socialmanage',
			'bulb' => 'socialtrain',
			'speaker' => 'speaking',
			'success' => 'admanage',
			'cogs' => 'cogs',
			'speech' => 'speech',
			'logo' => 'logo',
			'cookie' => 'cookie'
		);

		$iconMapIndex = $titleBack[0]['pages_title_icon'];

		$iconHtml = '<span class="thwicon thwicon-' . $iconMap[$iconMapIndex] . '"></span>';
	}

	the_title('<h1>' . $iconHtml, '</h1>');

	if (!empty($titleBack[0]['pages_title_description'])) {
		echo '<p>' . $titleBack[0]['pages_title_description'] . '</p>';
	}

	echo '					</div>
						</div>
					</div>';
} else {
	the_title('<h1>', '</h1>');
}

echo '			</div>
			</div>
			<div class="mainContent">
				<div class="row">
					<div class="col-xs-12">';

global $post;
$uriPosition = strpos($wp->request, $post->post_name);
$currentEventsUrl = home_url(substr($wp->request, 0, $uriPosition) . $post->post_name . '/');
$pastEventsUrl = $currentEventsUrl . '?past';

$dateToday = date('Ymd');

if (isset($_GET['past'])) {
	echo '				<h2>Past Events</h2>';

	$pageNumber = get_query_var('paged');

	$events = new WP_Query(array(
		'post_type' => 'thw-events',
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => '10',
		'paged' => $pageNumber,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'start_date',
				'value' => $dateToday,
				'compare' => '<'
			),
			array(
				'relation' => 'OR',
				array(
					'key' => 'end_date',
					'value' => '',
					'compare' => '='
				),
				array(
					'key' => 'end_date',
					'value' => $dateToday,
					'compare' => '<'
				)
			)
		)
	));

	if ($pageNumber > 1) {
		if ($events->have_posts()) {
			echo '		<p>
							<small><em>Page: ' . $pageNumber . '</em></small>
						</p>';
		} else {
			echo '		<p>
							No additional past events found - <a href="' . $pastEventsUrl . '">Back to Page 1</a>
						</p>
						<script>window.location="' . $pastEventsUrl . '";</script>';
		}
	}

	echo '				<hr>';
} else {
	the_content();

	$content = trim(strip_tags(get_the_content()));

	if (!empty($content)) {
		echo '			<hr>';
	}

	echo '				<h2>Upcoming Events</h2>
						<hr>';

	$events = new WP_Query(array(
		'post_type' => 'thw-events',
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => '-1',
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'start_date',
				'value' => $dateToday,
				'compare' => '>='
			),
			array(
				'key' => 'start_date',
				'value' => '',
				'compare' => '='
			),
			array(
				'key' => 'end_date',
				'value' => $dateToday,
				'compare' => '>='
			)
		)
	));
}

if ($events->have_posts()) {
	if (!empty($events->found_posts) && !empty($events->query_vars['posts_per_page']) && $events->found_posts > $events->query_vars['posts_per_page']) {
		$hasPages = true;
	} else {
		$hasPages = false;
		$numberOfHR = $events->post_count - 1;
	}

	echo '				<div id="events">';

	while ($events->have_posts()) {
		$events->the_post();

		$startDate = get_field('start_date');
		$dateStr = null;
		$timeStr = null;

		if (!empty($startDate)) {
			$endDate = get_field('end_date');

			if (empty($endDate) || $startDate == $endDate) {
				$startDateObj = DateTime::createFromFormat('Ymd', $startDate);
				$dateStr = $startDateObj->format('D jS F, Y');
			} else {
				$startDateObj = DateTime::createFromFormat('Ymd', $startDate);
				$endDateObj = DateTime::createFromFormat('Ymd', $endDate);

				if (substr($startDate, 0, 6) == substr($endDate, 0, 6)) {
					$dateStr = $startDateObj->format('D jS') . ' - ' . $endDateObj->format('D jS F, Y');
				} elseif (substr($startDate, 0, 4) == substr($endDate, 0, 4)) {
					$dateStr = $startDateObj->format('D jS F') . ' - ' . $endDateObj->format('D jS F, Y');
				} else {
					$dateStr = $startDateObj->format('D jS F, Y') . ' - ' . $endDateObj->format('D jS F, Y');
				}
			}

			$startTime = get_field('start_time');

			if (!empty($startTime)) {
				$timeStr = $startTime;
				$endTime = get_field('end_time');

				if (!empty($endTime)) {
					$timeStr .= ' - ' . $endTime;
				}
			}
		}



/*

	CURRENT EVENTS = ONES WITH NO DATES OR ONES WHERE THE EITHER THE START OR END DATE IS BEFORE OR EQUAL TO TODAY
	ORDER ALL - INCLUDING IN ADMIN BY START DATE, THEN END DATE (DESC) -- in admin override title ???


*/
		$contents = null;

		if (!empty($dateStr)) {
			$contents .= '<p><strong>Date:</strong> '.$dateStr.'</p>';
		}

		if (!empty($timeStr)) {
			$contents .= '<p><strong>Time:</strong> '.$timeStr.'</p>';
		}

		$venue = get_field('venue');

		if (!empty($venue)) {
			$contents .= '<p><strong>Venue:</strong> '.$venue.'</p>';
		}

		$description = get_field('description');

		if (!empty($description)) {
			$contents .= $description;
		}

		if (!isset($_GET['past'])) {
			$bookInfoLink = get_field('book_info_link');

			if (!empty($bookInfoLink[0]['link']) && !empty($bookInfoLink[0]['link_text'])) {
				$contents .= '<a class="btn btn-sm btn-primary" href="' . $bookInfoLink[0]['link'] . '" target="_blank" rel="nofollow">' . $bookInfoLink[0]['link_text'] . '</a>';
			}
		}

		echo '<h3>' . get_the_title() . '</h3>';

		if (has_post_thumbnail()) {
			echo '			<div class="row">
								<div class="col-xs-12 col-md-3">';

			the_post_thumbnail('medium', array('class' => 'alignleft'));

			echo '				</div>
								<div class="col-xs-12 col-md-9">
									' . $contents . '
								</div>
							</div>';
		} else {
			echo $contents;
		}

		if ($hasPages || $events->current_post < $numberOfHR) {
			echo '			<hr>';
		}
	}

	echo '				</div>';

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi(array('query' => $events));
	}

	if (isset($_GET['past'])) {
		echo '			<br>
						<a class="btn btn-info" href="' . $currentEventsUrl . '">View Our Upcoming Events</a>';
	} else {
		$pastEvents = new WP_Query(array(
			'post_type' => 'thw-events',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => '1',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'start_date',
					'value' => $dateToday,
					'compare' => '<'
				),
				array(
					'relation' => 'OR',
					array(
						'key' => 'end_date',
						'value' => '',
						'compare' => '='
					),
					array(
						'key' => 'end_date',
						'value' => $dateToday,
						'compare' => '<'
					)
				)
			)
		));

		if ($events->have_posts()) {
			echo '		<br>
						<a class="btn btn-info" href="' . $pastEventsUrl . '">View Our Past Events</a>';
		}
	}
} else {
	echo '				<p>
							Our events are currently being updated.
						</p>';
}

echo '				</div>
				</div>
			</div>
		</div>';

get_footer();
