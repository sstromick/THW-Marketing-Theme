<?php

class CW_Main_Walker_Nav_Menu extends Walker_Nav_Menu
{
	private $newsPage, $casestudyPage;

	function __construct()
	{
		$newsUrl = get_permalink(get_option('page_for_posts'));
		$currentUrl = home_url($_SERVER["REQUEST_URI"]);
		$currentUrlLen = strlen($currentUrl);

		if (!empty($newsUrl)) {
			$newsUrlLen = strlen($newsUrl);

			if ($currentUrlLen > $newsUrlLen && substr($currentUrl, 0, $newsUrlLen) == $newsUrl) {
				$this->newsPage = $newsUrl;
			}
		}

		if (empty($this->newsPage)) {
			$casestudyUrl = home_url('case-studies/');
			$casestudyUrlLen = strlen($casestudyUrl);

			if ($currentUrlLen > $casestudyUrlLen && substr($currentUrl, 0, $casestudyUrlLen) == $casestudyUrl) {
				$this->casestudyPage = $casestudyUrl;
			}
		}
	}

	function start_el(&$output, $item, $depth, $args)
	{
		if ($item->menu_item_parent == 0) {
			if (!empty($this->newsPage) && $item->url == $this->newsPage) {
				$item->classes = empty($item->classes) ? array() : (array) $item->classes;
				$item->classes[] = 'current-menu-ancestor';
			} elseif(!empty($this->casestudyPage) && $item->url == $this->casestudyPage) {
				$item->classes = empty($item->classes) ? array() : (array) $item->classes;
				$item->classes[] = 'current-menu-ancestor';
			}
		}

		parent::start_el($output, $item, $depth = 0, $args, $id = 0);
	}
}