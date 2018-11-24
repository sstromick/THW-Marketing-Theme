<?php

define('NEWS_SECTION', true);
get_header();

echo '	<div class="container">
			<div class="row">
				<div class="col-xs-12">';

$titleBack = get_field('posts_title_with_background', 'options');

if (!empty($titleBack[0]) && !empty($titleBack[0]['posts_title_background_image']['url'])) {
	echo '			<div id="mainTitleWithBack" style="background-image:url(\'' . esc_url($titleBack[0]['posts_title_background_image']['url']) . '\')">
						<div class="row">
							<div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">';

	$iconHtml = null;

	if (!empty($titleBack[0]['posts_title_icon'])) {
		$iconMap = array(
			'megaphone' => 'megaphone'
		);

		$iconMapIndex = $titleBack[0]['posts_title_icon'];

		$iconHtml = '<span class="thwicon thwicon-' . $iconMap[$iconMapIndex] . '"></span>';
	}

	echo '<h1>' . $iconHtml . 'Our Blog</h1>';

	if (!empty($titleBack[0]['posts_title_description'])) {
		echo '<p>' . $titleBack[0]['posts_title_description'] . '</p>';
	}

	echo '					</div>
						</div>
					</div>';
} else {
	echo '<h1>Our Blog</h1>';
}

echo '			</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<div class="mainContent">';

if (defined('CATEGORY_TITLE')) {
	echo '				<strong>Category: ' . constant('CATEGORY_TITLE') . '</strong>';
}

echo category_description();

if (have_posts()) {
	if (!empty($wp_query->found_posts) && !empty($wp_query->query_vars['posts_per_page']) && $wp_query->found_posts > $wp_query->query_vars['posts_per_page']) {
		$hasPages = true;
	} else {
		$hasPages = false;
		$numberOfHR = $wp_query->post_count - 1;
	}

	echo '				<div id="newsItems">';

	while (have_posts()) {
		the_post();

		$link = get_permalink();

		echo '				<aside class="clearfix">
								<a href="' . $link . '">
									<h2>' . get_the_title() . '</h2>
								</a>
								<em class="posted">Posted: ' . get_the_time('jS F Y') . '</em>';

		$isVideo = false;

		$format = get_post_format();

		if ($format == 'video') {
			$youtubeWebAddress = get_field('youtube_web_address');

			preg_match('/[^&]v=([^&]+)/', $youtubeWebAddress, $matches);

			if (isset($matches[1])) {
				$isVideo = true;

				echo '			<a class="videoImg" href="' . $link . '">
									<img class="alignright" src="http://img.youtube.com/vi/' . $matches[1] . '/sddefault.jpg" alt="Video">
								</a>';




/*
<img width="600" height="343" sizes="(max-width: 600px) 100vw, 600px" srcset="http://thw/wp-content/uploads/2016/05/The-Importance-of-an-Integrated-Offline-Online-Marketing-Strategy-600x343.jpg 600w, http://thw/wp-content/uploads/2016/05/The-Importance-of-an-Integrated-Offline-Online-Marketing-Strategy-200x114.jpg 200w, http://thw/wp-content/uploads/2016/05/The-Importance-of-an-Integrated-Offline-Online-Marketing-Strategy-300x171.jpg 300w, http://thw/wp-content/uploads/2016/05/The-Importance-of-an-Integrated-Offline-Online-Marketing-Strategy.jpg 700w" alt="" class="alignright wp-post-image" src="http://thw/wp-content/uploads/2016/05/The-Importance-of-an-Integrated-Offline-Online-Marketing-Strategy-600x343.jpg">
*/



			}
		}

		if (!$isVideo) {
			if (has_post_thumbnail()) {
				echo '			<a href="' . $link . '">';
				the_post_thumbnail('medium-2', array('class' => 'alignright'));
				echo '			</a>';
			}
		}

		$excerpt = get_the_excerpt();

		if (!empty($excerpt)) {
			echo '				<div class="excerpt">' . $excerpt . '</div>';
		}

		echo '					<a class="btn btn-sm btn-primary" href="' . $link . '">Read more</a>';

		echo '				</aside>';

		if ($hasPages || $wp_query->current_post < $numberOfHR) {
			echo '<hr>';
		}
	}

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}

	echo '				</div>';
} else {
	echo '				<p>
							<em>We are currently updating this section.</em>
						</p>';
}

echo '				</div>
				</div>
				<div id="sidebar" class="col-xs-12 col-md-4">';

dynamic_sidebar('Blog Sidebar');

echo '			</div>
			</div>
		</div>';

get_footer();
