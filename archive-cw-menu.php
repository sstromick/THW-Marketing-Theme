<?php
header("X-Robots-Tag: noindex, nofollow", true);
get_header();
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Menu</h1>
				<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'depth' => 1
					));
				?>
			</div>
		</div>
	</div>
<?php
get_footer();