<?php
get_header();

if (have_posts()) {
	the_post();
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="sectiontitle">
					<strong>Case Study</strong>
					<?php the_title('<h1>', '</h1>'); ?>
				</div>
				<?php
					$topImage = get_field('top_image');

					if (!empty($topImage['url'])) {
						echo '<img src="' . $topImage['url'] . '"' . (empty($topImage['alt']) ? '' : ' alt="' . $topImage['alt'] . '"') . '>';
					}

					$statistics = get_field('statistics');

					if (!empty($statistics)) {
						$statisticsCount = count($statistics);

						if ($statisticsCount < 2) {
							$statisticsColClasses = 'col-xs-12';
						} elseif ($statisticsCount < 3) {
							$statisticsColClasses = 'col-xs-6';
						} elseif ($statisticsCount < 4) {
							$statisticsColClasses = 'col-xs-12 col-sm-4';
						} elseif ($statisticsCount < 5) {
							$statisticsColClasses = 'col-xs-6 col-sm-3';
						} else {
							$statisticsColClasses = 'col-xs-6 col-sm-4 col-md-2';
						}

						echo '	<div class="row rowNoMargin">
									<div id="statistics">';

						$statisticsIconMap = array(
							'graph' => 'admanage',
							'plus' => 'plus',
							'video' => 'videoplayer',
							'people' => 'people',
							'pound' => 'pound'
						);

						$x = 1;

						foreach ($statistics as $statistic) {
							if (!empty($statistic['icon']) && !empty($statistic['value']) && !empty($statistic['description'])) {


								$statistic['value'] = str_replace('%', '<span class="percent">%</span>', $statistic['value']);

								$statisticClass = 'statistic' . $x;
								$x++;

								$iconIndex = $statistic['icon'];

								echo '	<div class="' . $statisticsColClasses . ' statistic ' . $statisticClass . '">
											<div class="value">
												<span class="thwicon thwicon-' . $statisticsIconMap[$iconIndex] . '"></span>' . $statistic['value'] . '
											</div>
											<div class="description">
												' . $statistic['description'];

								if (!empty($statistic['small_print'])) {
									echo '<br><small>(' . $statistic['small_print'] . ')</small>';
								}

								echo '		</div>
										</div>';
							}
						}

						echo '		</div>
								</div>';
					}

					$quote = get_field('quote');

					if (!empty($quote[0]['quote_text']) && !empty($quote[0]['quote_from'])) {
						echo '	<blockquote id="casestudyQuote">
									<span class="quoteStart"></span>' . $quote[0]['quote_text'] . '<span class="quoteEnd"></span>
									<footer>
										<cite>
											' . $quote[0]['quote_from'] . '
										</cite>
									</footer>
								</blockquote>';
					}
				?>
			</div>
		</div>
		<div class="mainContent">
			<div class="row">
				<?php
					$achieved = get_field('what_we_acheived');

					if (empty($achieved)) {
						echo '	<div class="mainContent">
									<div class="col-xs-12">';
						the_content();
						echo '		</div>
								</div>';
					} else {
						echo '	<div class="mainContent">
									<div class="col-xs-12 col-md-7">';
						the_content();
						echo '		</div>
									<div class="col-xs-12 col-md-5 col-lg-4 col-lg-offset-1">
										<h2>What we achieved&hellip;</h2>
										<ul id="achieved">';

						foreach ($achieved as $achievement) {
							if (!empty($achievement['icon']) && !empty($achievement['achievement'])) {
								$achievedIconMap = array(
									'graph' => 'admanage',
									'facebook' => 'fbbox',
									'megaphone' => 'megaphone',
									'people' => 'people',
									'beacon' => 'beacon',
									'dots' => 'socialconsult'
								);

								$achievedIconIndex = $achievement['icon'];

								echo '		<li>
												<span class="thwicon thwicon-' . $achievedIconMap[$achievedIconIndex] . '"></span>
												<div class="achievement">
													' . $achievement['achievement'] . '
												</div>
											</li>';
							}
						}

						echo '			</ul>
									</div>
								</div>';
					}
				?>
			</div>
			<?php
				$servicesUsed = get_field('services_used');

				if (!empty($servicesUsed)) {
					echo '	<div id="servicesUsed" class="row">
								<div class="col-xs-12">
									<h2>Services used&hellip;</h2>
									<ul>';

					$servicesMap = array(
						'marketconsult' => array(
							'icon' => 'marketconsult',
							'title' => 'Marketing<br>Consultancy',
							'link' => home_url('services/marketing-consultancy/')
						),
						'socialconsult' => array(
							'icon' => 'socialconsult',
							'title' => 'Social Media<br>Consultancy',
							'link' => home_url('services/social-media-consultancy/')
						),
						'socialmanage' => array(
							'icon' => 'socialmanage',
							'title' => 'Social Media<br>Management',
							'link' => home_url('services/social-media-management/')
						),
						'socialtrain' => array(
							'icon' => 'socialtrain',
							'title' => 'Social Media<br>Training',
							'link' => home_url('services/social-media-training/')
						),
						'speaking' => array(
							'icon' => 'speaking',
							'title' => 'Public<br>Speaking',
							'link' => home_url('services/public-speaking/')
						),
						'admanage' => array(
							'icon' => 'admanage',
							'title' => 'Advertising<br>Management',
							'link' => home_url('services/advertising-management/')
						)
					);

					foreach ($servicesUsed as $serviceUsed) {
						if (!empty($servicesMap[$serviceUsed])) {
							echo '		<li>
											<a href="' . $servicesMap[$serviceUsed]['link'] . '">
												<span class="thwicon thwicon-' . $servicesMap[$serviceUsed]['icon'] . '"></span>
												<div class="service service-' . $serviceUsed . '">
													' . $servicesMap[$serviceUsed]['title'] . '
												</div>
											</a>
										</li>';
						}
					}

					echo '			</ul>
								</div>
							</div>';
				}
			?>
		</div>
	</div>
<?php
}

get_footer();