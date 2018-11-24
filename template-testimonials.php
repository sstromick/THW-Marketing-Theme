<?php
/**
 * Template Name: Testimonials
*/

get_header();

echo '	<div id="testimonials" class="container">
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
			'heart' => 'heart'
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

$testimonial = new WP_Query(array(
	'post_type' => 'thw-testimonials',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => '-1'
));

if ($testimonial->have_posts()) {
	if (!empty($wp_query->found_posts) && !empty($wp_query->query_vars['posts_per_page']) && $wp_query->found_posts > $wp_query->query_vars['posts_per_page']) {
		$hasPages = true;
	} else {
		$hasPages = false;
		$numberOfHR = $testimonial->post_count - 1;
	}

	echo '				<div id="testimonials">';

	while ($testimonial->have_posts()) {
		$testimonial->the_post();

		$link = get_permalink();

		echo '				<blockquote>
								<span class="quoteStart"></span>' . get_field('testimonial') . '<span class="quoteEnd"></span>
								<footer>
									<cite>
										' . get_the_title() . '
									</cite>
								</footer>
							</blockquote>';

		if ($hasPages || $testimonial->current_post < $numberOfHR) {
			echo '<hr>';
		}
	}

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}
} else {
	echo '					<p>
								<em>We are currently updating this section.</em>
							</p>';
}

echo '					</div>
					</div>
				</div>
			</div>
		</div>';

get_footer();
