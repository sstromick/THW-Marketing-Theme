<?php
/**
 * Template Name: Homepage
*/

get_header();

echo '	<div class="container">';

$mainImages = get_field('main_image_title');

if (!empty($mainImages[0]) && !empty($mainImages[0]['background_image']['url']) && !empty($mainImages[0]['icon_image']['url']) && !empty($mainImages[0]['title']) && !empty($mainImages[0]['description']) && !empty($mainImages[0]['link_text']) && !empty($mainImages[0]['link_page'])) {
	$iconStyle = null;

	if (!empty($mainImages[0]['icon_image']['height'])) {
		$iconStyle = ' style="max-height:' . ($mainImages[0]['icon_image']['height'] / 2) . 'px"';
	}

	echo '	<div class="row">
				<div class="col-xs-12">
					<div id="homeMain" style="background-image:url(\'' . esc_url($mainImages[0]['background_image']['url']) . '\')">
						<div class="row">
							<div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">
								<div class="row">
									<div class="col-xs-3">
										<img src="' . esc_url($mainImages[0]['icon_image']['url']) . '" alt=""' . $iconStyle . '>
									</div>
									<div class="col-xs-9">
										<h1>' . esc_html($mainImages[0]['title']) . '</h1>
										<p>
											' . esc_html($mainImages[0]['description']) . '
										</p>
										<a href="' . esc_url($mainImages[0]['link_page']) . '">' . esc_html($mainImages[0]['link_text']) . '</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
}

get_template_part('_area-blocks');

$serviceAreas = get_field('service_areas');

if (!empty($serviceAreas)) {
	$serviceAreasCount = count($serviceAreas);

	if ($serviceAreasCount < 2) {
		$serviceAreasColClasses = 'col-xs-12';
	} elseif ($serviceAreasCount < 3) {
		$serviceAreasColClasses = 'col-xs-12 col-sm-6';
	} elseif ($serviceAreasCount < 4) {
		$serviceAreasColClasses = 'col-xs-12 col-md-4';
	} elseif ($serviceAreasCount < 5) {
		$serviceAreasColClasses = 'col-xs-12 col-sm-6';
	} else {
		$serviceAreasColClasses = 'col-xs-12 col-sm-6 col-md-4';
	}

	$serviceAreaIconMap = array(
		'target' => 'marketconsult',
		'dots' => 'socialmanage',
		'bulb' => 'socialtrain'
	);

	echo '	<div id="serviceAreas" class="row">';

	$x = 1;

	foreach ($serviceAreas as $serviceArea) {
		$classes = array();

		if ($serviceAreasCount > 3) {
			if ($serviceAreasCount == 4) {
				if ($x % 2 == 1) {
					$classes[] = 'col-sm-clear col-md-clear col-lg-clear';
				}
			} else {
				if ($x % 2 == 1) {
					$classes[] = 'col-sm-clear';
				}

				if ($x % 3 == 1) {
					$classes[] = 'col-md-clear';
					$classes[] = 'col-lg-clear';
				}
			}

			$x++;
		}

		$serviceAreaIconMapIndex = $serviceArea['icon'];

		echo '	<div class="serviceArea ' . $serviceAreasColClasses . (empty($classes) ? '' : ' ' . implode(' ', $classes)) . '">
					<span class="thwicon thwicon-' . $serviceAreaIconMap[$serviceAreaIconMapIndex] . '"></span>
					<h2>' . $serviceArea['title'] . '</h2>
					<p>
						' . $serviceArea['description'] . '
					</p>
					<a href="' . $serviceArea['link_page'] . '">' . $serviceArea['link_text'] . '</a>
				</div>';
	}

	echo '	</div>';
}



/*


SERVICES ARE HARDCODED HERE - GET FROM PAGE TEMPLATE VARS

	Service Boxes


*/




$imageServiceBoxes = get_field('image_service_boxes');

if (!empty($imageServiceBoxes[0]) && !empty($imageServiceBoxes[0]['image_boxes']) && count($imageServiceBoxes[0]['image_boxes']) == 6 && !empty($imageServiceBoxes[0]['service_boxes']) && count($imageServiceBoxes[0]['service_boxes']) == 6) {
	$imageBoxes = $imageServiceBoxes[0]['image_boxes'];
	$serviceBoxes = $imageServiceBoxes[0]['service_boxes'];

	echo '	<div id="imageBlocks" class="row">
				<span id="xsJsTest"></span>
				<div class="imageBlock imageBlock1 col-xs-6 col-sm-4 col-md-3 col-lg-2">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[0]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[0]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[0]['image']['alt'] . '">
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock2 col-xs-6 col-sm-4 col-md-3 col-lg-2">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/marketing-consultancy/') . '">
							<span class="thwicon thwicon-marketconsult"></span>
							Marketing Consultancy
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock3 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xs-push-6 col-sm-push-0">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[1]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[1]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[1]['image']['alt'] . '">
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock4 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xs-pull-6 col-sm-pull-0">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/social-media-consultancy/') . '">
							<span class="thwicon thwicon-socialconsult"></span>
							Social Media Consultancy
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock5 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-md-push-3 col-lg-push-0">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[2]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[2]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[2]['image']['alt'] . '">
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock6 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-md-pull-3 col-lg-pull-0">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/social-media-management/') . '">
							<span class="thwicon thwicon-socialmanage"></span>
							Social Media Management
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock7 col-xs-6 col-sm-4 col-md-3 col-lg-2">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/social-media-training/') . '">
							<span class="thwicon thwicon-socialtrain"></span>
							Social Media Training
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock8 col-xs-6 col-sm-4 col-md-3 col-lg-2">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[3]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[3]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[3]['image']['alt'] . '">
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock9 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xs-push-6 col-sm-push-0 col-md-push-3 col-lg-push-0">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/public-speaking/') . '">
							<span class="thwicon thwicon-speaking"></span>
							Public Speaking
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock10 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xs-pull-6 col-sm-pull-0 col-md-pull-3 col-lg-pull-0">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[4]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[4]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[4]['image']['alt'] . '">
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock11 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-md-push-3 col-lg-push-0">
					<div class="imageBlockInner text">
						<a href="' . home_url('services/advertising-management/') . '">
							<span class="thwicon thwicon-admanage"></span>
							Advertising Management
						</a>
					</div>
				</div>
				<div class="imageBlock imageBlock12 last col-xs-6 col-sm-4 col-md-3 col-lg-2 col-md-pull-3 col-lg-pull-0">
					<div class="imageBlockInner">
						<a href="' . $imageBoxes[5]['image']['url'] . '" target="_blank">
							<img src="' . $imageBoxes[5]['image']['sizes']['image-boxes'] . '" alt="' . $imageBoxes[5]['image']['alt'] . '">
						</a>
					</div>
				</div>
			</div>';
}

echo '	</div>';

get_footer();
