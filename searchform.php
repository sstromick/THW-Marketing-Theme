<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="screen-reader-text" for="s">Search:</label><br>
	<input type="text" value="<?php echo defined('REQUESTED_PAGE_STR') ? constant('REQUESTED_PAGE_STR') : get_search_query(); ?>" name="s" id="s" value="<?php echo defined('REQUESTED_PAGE_STR') ? constant('REQUESTED_PAGE_STR') : ''; ?>">
	<input type="submit" id="searchsubmit" class="btn btn-primary btn-sm" value="Search">
</form>