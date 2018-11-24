<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="sectiontitleSingle" class="col-xs-12">
			<h1>Case Studies</h1>
		</div>
	</div>
	<?php
		if (have_posts()) {
			echo '	<div id="caseStudies">
						<span id="xsJsTest"></span>';

			$x = 0;

			while (have_posts()) {
				the_post();

				$x++;
				$link = get_permalink();

				$image = get_field('list_image');
				$imageStyle = empty($image['url']) ? '' : ' style="background-image:url(\'' . $image['url'] . '\')"';

				echo '	<div class="casestudy casestudy' . $x . ' col-xs-12 col-sm-6"' . $imageStyle . '>
							<a href="' . $link . '" title="' . $moreStr . '">
								<div class="inner">
									<div class="innerPad">
										<strong>
											<span class="thwicon thwicon-casestudies"></span>Case Study
										</strong>
										<h2>' . get_the_title() . '</h2>
									</div>
								</div>
							</a>
						</div>';
			}

			echo '	</div>';

			if (function_exists('wp_pagenavi')) {
				echo '	<div class="row">
							<div class="col-xs-12">';

				wp_pagenavi();

				echo '		</div>
						</div>';
			}
		} else {
			echo '	<div class="row">
						<div class="col-xs-12">
							<p>
								<em>We are currently updating this section, please check back soon.</em>
							</p>
						</div>
					</div>';
		}

		$columns = get_field('casestudies_content_columns', 'options');

		if (!empty($columns)) {
			$columnClasses = 'col-xs-12';

			if (count($columns) > 1) {
				$columnClasses .= ' col-md-6';
			}

			echo '	<div class="underColumns">
						<div class="row">';

			foreach ($columns as $column) {
				echo '		<div class="' . $columnClasses . '">
								<div class="underColumn">
									' . $column['column'] . '
								</div>
							</div>';
			}

			echo '		</div>
					</div>';
		}
	?>
</div>
<?php
get_footer();
