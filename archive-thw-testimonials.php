<?php

get_header();

echo '	<div id="testimonials" class="container">
			<div class="row">
				<div class="col-xs-12">';

$titleBack = get_field('testimonials_title_with_background', 'options');

if (!empty($titleBack[0]) && !empty($titleBack[0]['testimonials_title_background_image']['url'])) {


	echo '			<div id="mainTitleWithBack" style="background-image:url(\'' . esc_url($titleBack[0]['testimonials_title_background_image']['url']) . '\')">
						<div class="row">
							<div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">';

	$iconHtml = null;

	if (!empty($titleBack[0]['testimonials_title_icon'])) {
		$iconMap = array(
			'cogs' => 'cogs'
		);

		$iconMapIndex = $titleBack[0]['testimonials_title_icon'];

		$iconHtml = '<span class="thwicon thwicon-' . $iconMap[$iconMapIndex] . '"></span>';
	}

	echo '<h1>' . $iconHtml . 'Testimonials</h1>';

	if (!empty($titleBack[0]['testimonials_title_description'])) {
		echo '<p>' . $titleBack[0]['testimonials_title_description'] . '</p>';
	}

	echo '					</div>
						</div>
					</div>';
} else {
	echo '<h1>Testimonials</h1>';
}

echo '			</div>
			</div>
			<div class="row">
				<div class="col-xs-12">';

if (have_posts()) {
	while (have_posts()) {
		the_post();

		$link = get_permalink();

		echo '		<blockquote>
						&ldquo;' . get_field('testimonial') . '&rdquo;
					</blockquote>
					<strong>' . get_the_title() . '</strong>';
	}

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}
} else {
	echo '			<p>
						<em>We are currently updating this section.</em>
					</p>';
}

echo '			</div>
			</div>
		</div>';

get_footer();
