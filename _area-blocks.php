<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!is_page_template('template-contact.php')) {
	$phoneLink = null;
	$phone = get_field('phone', 'options');

	if (!empty($phone[0]['display_number']) && !empty($phone[0]['international_call_number'])) {
		$phoneLink = '<a href="tel:' . $phone[0]['international_call_number'] . '" rel="nofollow" target="_blank">' . $phone[0]['display_number'] . '</a>';
	}

	$contactPage = get_field('contact_page', 'options');
	$contactHtml = null;

	if (!empty($phoneLink) && !empty($contactPage)) {
		$contactHtml = 'Call ' . $phoneLink . ' or <a class="email" href="' . $contactPage . '">email</a>';
	} elseif (!empty($phoneLink)) {
		$contactHtml = 'Call ' . $phoneLink;
	} elseif (!empty($contactPage)) {
		$contactHtml = '<a class="email" href="' . $contactPage . '">Email</a>';
	}

	if (!empty($contactHtml)) {
		echo '		<div class="row">
						<div class="col-xs-12">
							<div id="contact">
								<div class="inner">' . $contactHtml . ' to see how we can boost your business</div>
							</div>
						</div>
					</div>';
	}
}

echo '		<div class="row">
				<div class="col-xs-12">
					<div id="boxes">';

$caseStudy = new WP_Query(array(
	'post_type' => 'thw-casestudies',
	'orderby' => 'rand',
	'posts_per_page' => '1'
));

if ($caseStudy->have_posts()) {
	$caseStudy->the_post();

	$image = get_field('list_image');

	if (empty($image['url'])) {
		echo '			<div class="box box1 col-xs-12 col-md-6">
							<div class="boxInner">
								<h2><span class="thwicon thwicon-casestudies"></span>Case Study</h2>
								<a href="' . get_permalink() . '">' . get_the_title() . '</a>
							</div>
						</div>';
	} else {
		echo '			<div class="box box1 col-xs-6 col-md-3">
							<div class="boxInner">
								<h2><span class="thwicon thwicon-casestudies"></span>Case Study</h2>
								<a href="' . get_permalink() . '">' . get_the_title() . '</a>
							</div>
						</div>
						<div class="box box2 col-xs-6 col-md-3" style="background-image:url(\'' .  $image['url'] . '\');">
							<div class="arrow"></div>
							<a class="imageLink" href="' . get_permalink() . '" title="View Case Study"></a>
						</div>';
	}
} else {
	echo '				<div class="box box1 col-xs-12 col-md-6">
							<div class="boxInner">
								<h2><span class="thwicon thwicon-casestudies"></span>Case Study</h2>
								<p>
									<em>We are currently updating this section</em>
								</p>
							</div>
						</div>';
}

echo '					<div class="box box3 col-xs-6 col-md-3">
							<div class="boxInner">
								<h2><span class="thwicon thwicon-blog"></span>Blog</h2>';

$blog = new WP_Query(array(
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => '1'
));

if ($blog->have_posts()) {
	$blog->the_post();
	echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
} else {
	echo '	<p>
				<em>We are currently updating this section</em>
			</p>';
}

echo '						</div>
						</div>
						<div class="box box4 col-xs-6 col-md-3">
							<div class="boxInner">
								<h2 class="lessMargin"><span class="thwicon thwicon-twitter"></span>Twitter</h2>';

dynamic_sidebar('Twitter Widget Box');

echo '						</div>
						</div>
						<div class="box box5 col-xs-6 col-md-3">
							<div class="boxInner">
								<h2 class="lessMargin"><span class="thwicon thwicon-testimonials"></span>Testimonials</h2>
								<div class="testimonial">';

$testimonial = new WP_Query(array(
	'post_type' => 'thw-testimonials',
	'orderby' => 'rand',
	'posts_per_page' => '1'
));

if ($testimonial->have_posts()) {
	$testimonial->the_post();

	echo '	<blockquote>
				<span class="quoteStart"></span>' . get_field('testimonial') . '<span class="quoteEnd"></span>
				<footer>
					<cite>
						' . get_the_title() . '
					</cite>
				</footer>
			</blockquote>
			<a class="more" href="' . home_url('testimonials/') . '">View more</a>';
} else {
	echo '	<p>
				<em>We are currently updating this section</em>
			</p>';
}

echo '							</div>
							</div>
						</div>
						<div class="box box6 col-xs-6 col-md-3">
							<div class="boxInner">
								<h2><span class="thwicon thwicon-newsletter"></span>Newsletter</h2>';

$formHtml = null;
$newsletterForm = get_field('newsletter_form', 'options');

if (!empty($newsletterForm)) {
	$form = FrmForm::getOne($newsletterForm);

	if (!empty($form) && empty($form->parent_form_id)) {
		$formHtml = FrmFormsController::get_form_shortcode(array(
			'id' => $newsletterForm,
			'title' => false,
			'description' => false
		));
	}
}

if (empty($formHtml)) {
	echo '	<p>
				<em>We are currently updating this section</em>
			</p>';
} else {
	echo '	<p>
				Subscribe to our newsletter
			</p>
			' . $formHtml;
}

echo '						</div>
						</div>';

$featuredVideo = get_field('featured_video', 'options');
$videoOk = false;

if (!empty($featuredVideo[0]) && !empty($featuredVideo[0]['title']) && !empty($featuredVideo[0]['image']['url']) && !empty($featuredVideo[0]['youtube_web_address'])) {
	preg_match('/[^&]v=([^&]+)/', $featuredVideo[0]['youtube_web_address'], $matches);

	if (isset($matches[1])) {
		$videoOk = true;

		echo '	<div class="box box7 col-xs-6 col-md-3">
					<div class="boxInner">
						<h2><span class="thwicon thwicon-video"></span>Video</h2>
						<a href="https://www.youtube.com/watch?v=' . $matches[1] . '&autoplay=1&modestbranding=1&rel=0&showsearch=0&showinfo=0" target="_blank">
							' . $featuredVideo[0]['title'] . '
						</a>
					</div>
				</div>
				<div class="box box8 col-xs-6 col-md-3" style="background-image:url(\'' .  $featuredVideo[0]['image']['url'] . '\');">
					<div class="arrow"></div>
					<a class="imageLink" href="https://www.youtube.com/watch?v=' . $matches[1] . '&autoplay=1&modestbranding=1&rel=0&showsearch=0&showinfo=0" target="_blank" title="Play Video">
						<img class="play" src="' . get_template_directory_uri() . '/images/play.png" alt="Play Video">
					</a>
				</div>';
	}
}

if (!$videoOk) {
	echo '					<div class="box box7 col-xs-12 col-md-6">
								<div class="boxInner">
									<h2><span class="thwicon thwicon-video"></span>Video</h2>
									<p>
										<em>We are currently updating this section</em>
									</p>
								</div>
							</div>';
}

echo '				</div>
				</div>
			</div>';

wp_reset_query();
