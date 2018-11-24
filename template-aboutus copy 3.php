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

$employees = get_field('employees');

	$employeesCount = count($employees);
	$xsClearIndexes = array();
	$smClearIndexes = array();

	if ($employeesCount < 2) {
		$employeesColClasses = 'col-xs-12';
	} elseif ($employeesCount < 3) {
		$employeesColClasses = 'col-xs-6';
	} elseif ($employeesCount < 4) {
		$employeesColClasses = 'col-xs-12 col-sm-4';
	} elseif ($employeesCount < 5) {
		$employeesColClasses = 'col-xs-6 col-sm-3';
		$xsClearIndexes = array('3');
	} else {
		$employeesColClasses = 'col-xs-6 col-sm-4 col-md-2';
		$xsClearIndexes = array('3', '5');
		$smClearIndexes = array('4');
	}

	echo '				<div id="employees">';

	$x = 1;

	foreach ($employees as $employee) {
		$x++;

		if (!empty($employee['name']) && !empty($employee['description'])) {
			echo '				<div class="employee">
									<div class="employee-img">
										<img src="' . $employee['employee_image_mono'] . '" />
									</div>
									<div class="employee-name"><strong>' . $employee['name'] . '</strong>
                                    </div>
									<div class="position">
										' . $employee['position'] . '
									</div>
									<div class="description">
										' . $employee['description'] . '
									</div>
								</div>';
		}
	}

	echo '				</div>';

echo '				</div>
				</div>
			</div>
		</div>';

get_footer();
