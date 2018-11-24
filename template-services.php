<?php
/**
 * Template Name: Services Main Page
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
			'cogs' => 'cogs'
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
					<div class="col-xs-12 col-md-6">
						' . get_field('column_1') . '
					</div>
					<div class="col-xs-12 col-md-6">
						' . get_field('column_2') . '
					</div>
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

	echo '		<div id="serviceBoxesInfo" class="clearfix">
					<span id="xsJsTest"></span>';
	$x = 0;

	foreach ($services as $service) {
		$iconMapIndex = $service['icon'];
		$icon = $iconMap[$iconMapIndex];
		$x++;

		echo '		<div class="serviceOuter col-xs-6 col-sm-4 col-md-2">
						<div class="service service' . $x . '">
							<a href="' . $service['page_link'] . '">
								<span class="thwicon thwicon-' . $icon . '"></span>
								' . $service['name'] . '
							</a>
						</div>
						<p>
							' . $service['description'] . '
						</p>
						<a class="moreLink" href="' . $service['page_link'] . '">More &gt;</a>
					</div>';
	}

	echo '		</div>';
}

echo '		</div>
		</div>';

get_footer();
