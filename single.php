<?php
define('NEWS_SECTION', true);
get_header();

if (have_posts()) {
	the_post();
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div id="sectiontitle">
					<strong>Our Blog</strong>
					<?php the_title('<h1>', '</h1>'); ?>
					<br><em>Posted: <?php the_time('jS F Y'); ?></em>
				</div>
				<?php
					$format = get_post_format();

					if ($format != 'video') {
						the_post_thumbnail('full', array('class' => 'aligncenter'));
					}

					the_content();

					if ($format == 'video') {
						$youtubeWebAddress = get_field('youtube_web_address');

						preg_match('/[^&]v=([^&]+)/', $youtubeWebAddress, $matches);

						if (isset($matches[1])) {
							echo '	<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $matches[1] . '?fs=1&modestbranding=1&rel=0&showsearch=0&showinfo=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>
									</div>';
						}
					}

					if (function_exists('sharing_display')) {
						sharing_display('', true);
					}

					echo '	<hr>
							<div id="postCats">
								<strong>Posted in:</strong>
								<div class="inner">';

					the_category(', ');

					echo '		</div>
							</div>';

					the_tags('<div id="postTags"><strong>Tags:</strong><br>', ' ', '</div>');
				?>
			</div>
			<div id="sidebar" class="col-xs-12 col-md-4">
				<?php dynamic_sidebar('Blog Sidebar'); ?>
			</div>
		</div>
	</div>
<?php
}
get_footer();