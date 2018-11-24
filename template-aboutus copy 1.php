<?php
/**
 * Template Name: About Us
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

the_content();

$qualities = get_field('qualities');

if (!empty($qualities)) {
	$qualitiesIconMap = array(
		'pen' => 'penpencil',
		'ribbon' => 'ribbon',
		'heart' => 'heart',
		'data' => 'data',
		'mobile' => 'mobile',
		'bulb' => 'bulb'
	);

	$qualitiesCount = count($qualities);
	$xsClearIndexes = array();
	$smClearIndexes = array();

	if ($qualitiesCount < 2) {
		$qualitiesColClasses = 'col-xs-12';
	} elseif ($qualitiesCount < 3) {
		$qualitiesColClasses = 'col-xs-6';
	} elseif ($qualitiesCount < 4) {
		$qualitiesColClasses = 'col-xs-12 col-sm-4';
	} elseif ($qualitiesCount < 5) {
		$qualitiesColClasses = 'col-xs-6 col-sm-3';
		$xsClearIndexes = array('3');
	} else {
		$qualitiesColClasses = 'col-xs-6 col-sm-4 col-md-2';
		$xsClearIndexes = array('3', '5');
		$smClearIndexes = array('4');
	}

	echo '				<ul id="qualities" class="row">';

	$x = 1;

	foreach ($qualities as $quality) {
		$qualitiesColClassesClear = null;

		if (in_array($x, $xsClearIndexes)) {
			$qualitiesColClassesClear .= ' col-xs-clear';
		}

		if (in_array($x, $smClearIndexes)) {
			$qualitiesColClassesClear .= ' col-sm-clear';
		}

		$x++;

		if (!empty($quality['quality']) && !empty($quality['icon']) && !empty($quality['description'])) {
			$qualitiesIconMapIndex = $quality['icon'];

			echo '			<li class="' . $qualitiesColClasses . $qualitiesColClassesClear . '">
								<div class="quality">
									<span class="thwicon thwicon-' . $qualitiesIconMap[$qualitiesIconMapIndex] . '"></span>
									<strong>' . $quality['quality'] . '</strong>
									<div class="description">
										' . $quality['description'] . '
									</div>
								</div>
							</li>';
		}
	}

	echo '				</ul>';
}

echo '				</div>
				</div>
			</div>
		</div>';

get_footer();
