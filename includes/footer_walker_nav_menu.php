<?php

class CW_Footer_Walker_Nav_Menu  extends Walker_Nav_Menu
{
	function walk($elements, $max_depth)
	{
		if ($max_depth == 1) {
			foreach ($elements as $k => $v) {
				if (is_array($v->classes) && in_array('footerExtend', $v->classes)) {
					unset($elements[$k]);
				}
			}
		} else {
			$footerExtendParent = null;

			foreach ($elements as $k => $v) {
				if ($v->menu_item_parent == 0) {
					if (is_array($v->classes)) {
						if (in_array('footerExtend', $v->classes)) {
							$footerExtendParent = $v->ID;
						} else {
							unset($elements[$k]);
						}
					}
				} elseif (empty($footerExtendParent) || $footerExtendParent != $v->menu_item_parent) {
					unset($elements[$k]);
				}
			}
		}

		return parent::walk($elements, $max_depth);
	}
}
