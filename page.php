<?php

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

the_content();

echo '				</div>
				</div>
			</div>
		</div>';

get_footer();
