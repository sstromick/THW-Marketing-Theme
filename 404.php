<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Page Not Found</h1>
			<p>
				We could not find the page you were looking for. This may be because it was removed or renamed.
			</p>
			<p>
				You can try searching for the page below, or please <a href="<?php echo home_url('contact/'); ?>">get in touch</a> if you have any questions.
			</p><br>
			<?php
				define('REQUESTED_PAGE_STR', trim(str_replace(array('"','-','/'), array('&quot;',' ',' '), urldecode(stripslashes(substr($_SERVER['REQUEST_URI'], 1))))));

				get_search_form();
			?>
		</div>
	</div>
</div>
<?php get_footer();