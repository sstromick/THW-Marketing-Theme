<?php
/**
 * Template Name: Service Page
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
			'success' => 'admanage'
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
				<div class="row">';

$serviceImage = get_field('service_image');


$serviceTestimonialMap = array(
	'30' => 'Marketing Consultancy',
	'32' => 'Social Media Consultancy',
	'34' => 'Social Media Management',
	'36' => 'Social Media Training',
	'38' => 'Public Speaking',
	'156' => 'Advertising Management'
);

$pageId = get_the_ID();
$noTestimonial = true;

if (!empty($serviceTestimonialMap[$pageId])) {
	$testimonial = new WP_Query(array(
		'post_type' => 'thw-testimonials',
		'orderby' => 'rand',
		'posts_per_page' => '1',
		'meta_key' => 'relevant_services',
		'meta_compare' => 'LIKE',
		'meta_value' => '"' . $serviceTestimonialMap[$pageId] . '"'
	));

	if (!empty($serviceImage['url']) || $testimonial->have_posts()) {
		$noTestimonial = false;

		echo '			<div class="col-xs-12 col-md-8">';
		the_content();
		echo '			</div>
						<div id="sidebar" class="col-xs-12 col-md-4">';

		if (!empty($serviceImage['url'])) {
			echo '			<a href="' . $serviceImage['url'] . '" target="_blank">
								' . wp_get_attachment_image($serviceImage['ID'], 'full') . '
							</a>';
		}

		if ($testimonial->have_posts()) {
			$testimonial->the_post();

			echo '			<blockquote>
								<span class="quoteStart"></span>' . get_field('testimonial') . '<span class="quoteEnd"></span>
								<footer>
									<cite>
										' . get_the_title() . '
									</cite>
								</footer>
							</blockquote>';
		}

		echo '			</div>';
	}
}

if ($noTestimonial) {
	echo '			<div class="col-xs-12">';
	the_content();
	echo '			</div>';
}

wp_reset_query();

echo '			</div>
			</div>';

$services = get_field('services', 'options');

if (!empty($services)) {
	$iconMap = array(
		'target' => 'marketconsult',
		'dots' => 'socialconsult',
		'persondots' => 'socialmanage',
		'bulbon' => 'socialtrain',
		'speaker' => 'speaking',
		'chart' => 'admanage'
	);

	echo '		<div id="serviceBoxes" class="clearfix">
					<span id="xsJsTest"></span>';
	$x = 0;

	foreach ($services as $service) {
		$iconMapIndex = $service['icon'];
		$icon = $iconMap[$iconMapIndex];
		$x++;

		$active = $service['page_link'] == home_url($_SERVER['REQUEST_URI']);

		echo '		<div class="serviceOuter col-xs-6 col-sm-4 col-md-2">
						<div class="service service' . $x . ($active ? ' active' : '') . '">
							<a href="' . $service['page_link'] . '">
								<span class="thwicon thwicon-' . $icon . '"></span>
								' . $service['name'] . '
							</a>
							<span class="arrow"></span>
						</div>
					</div>';
	}

	echo '		</div>';
}

echo '		</div>
		</div>';

get_footer();
