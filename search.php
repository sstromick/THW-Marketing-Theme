<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Search Results</h1>
			<?php get_search_form(); ?><br>
			<?php
				if (strlen(trim(get_search_query())) != 0 && have_posts()) {
					if (!empty($wp_query->found_posts) && !empty($wp_query->query_vars['posts_per_page']) && $wp_query->found_posts > $wp_query->query_vars['posts_per_page']) {
						$hasPages = true;
					} else {
						$hasPages = false;
						$numberOfHR = $wp_query->post_count - 1;
					}

					while (have_posts()) {
						the_post();

						echo '<a href="' . get_permalink() . '" class="headerLink"><h2>' . get_the_title() . '</h2></a>';

						$excerpt = get_the_excerpt();
						$excerpt = trim(str_replace('&nbsp;', ' ', $excerpt));

						if (!empty($excerpt)) {
							echo '<div class="excerpt">' . $excerpt . '</div>';
						}

						echo '	<a href="' . get_permalink() . '" class="btn btn-primary btn-sm">View more</a>';

						if ($hasPages || $wp_query->current_post < $numberOfHR) {
							echo '<hr>';
						}
					}

					if (function_exists('wp_pagenavi')) {
						wp_pagenavi();
					}
				} else {
					echo '<p>No matches were found</p>';
				}
			?>
		</div>
	</div>
</div>
<?php
get_footer();




















