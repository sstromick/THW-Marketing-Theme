<?php

require_once(get_template_directory() . '/includes/plugins/_load.php');

add_editor_style('style-editor-v1.css');

/*
require_once(get_template_directory() . '/includes/plugins/_load.php');*/

function theme_enqueue_scripts() {
	wp_enqueue_script('jquery');

	wp_enqueue_script(
		'onload',
		get_template_directory_uri() . '/js/onload.min.js',
		array('jquery'),
		null,
		true
	);
} add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

add_theme_support('menus');

register_nav_menus(array(
	'main' => 'Main Menu',
	'footer' => 'Footer Menu'
));


add_image_size('medium-2', 600, 600);

add_image_size('image-boxes', 356, 356, true);


register_sidebar(array(
	'name'=> 'Blog Sidebar',
	'id' => 'blog_sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'name'=> 'Twitter Widget Box',
	'id' => 'twitter_widgetbox',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => ''
));



add_theme_support('post-thumbnails');

add_theme_support('post-formats', array('video'));

/**
 * Prevent images from being inserted with a link.
 * User must specify if they really want to link to the attachment page
 */
update_option('image_default_link_type', 'file');




// Custom login logo
function custom_login_logo()
{
	$width = '75px';
	$height = '47px';
	$logoName = 'logo.png';

	echo '<style type="text/css">.login h1 a {background-image:url("' . get_bloginfo('template_directory') . '/images/' . $logoName . '") !important; width:' . $width . ' !important; height:' . $height . ' !important; background-size:' . $width . ' ' . $height . ' !important; }</style>';
} add_action('login_head', 'custom_login_logo');


function wpseo_use_page_analysis_remove()
{
	return false;
} add_filter('wpseo_use_page_analysis', 'wpseo_use_page_analysis_remove');


define('DISALLOW_FILE_EDIT', true);


// Amend youtube embed html
function youtube_amends($code)
{
	if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
		$code = str_replace(
			array(
				'<iframe',
				'feature=oembed'
			),
			array(
				'<iframe class="embed-responsive-item"',
				'fs=1&modestbranding=1&rel=0&showsearch=0&showinfo=0&wmode=opaque'
			),
			$code
		);

		return '<div class="embed-responsive embed-responsive-16by9">' . $code . '</div>';
	}

	return $code;
} add_filter('embed_handler_html', 'youtube_amends'); add_filter('embed_oembed_html', 'youtube_amends');


/* Stop empty searches going to home page */
function search_filter($query)
{
    if (isset($_GET['s']) && $query->is_main_query()) {
    	if (empty($_GET['s'])) {
	        $query->is_search = true;
	        $query->is_home = false;
	    } else {
	    	$query->set('posts_per_page', 10);
	    }
    }

    return $query;
} add_filter('pre_get_posts','search_filter');


function yoast_metabox_tobottom()
{
	return 'low';
} add_filter('wpseo_metabox_prio', 'yoast_metabox_tobottom');

function filter_sharing_meta_box_show($true, $post) {
    return false;
} add_filter( 'sharing_meta_box_show', 'filter_sharing_meta_box_show', 10, 2);


function editor_show_all_buttons($init)
{
    $init['wordpress_adv_hidden'] = false;
    return $init;
} add_filter('tiny_mce_before_init', 'editor_show_all_buttons');


function editor_buttons_row_1($buttons)
{
	$buttons = array('bold', 'italic', 'underline', 'bullist', 'numlist', 'strikethrough', 'blockquote', 'hr', 'subscript', 'superscript', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'spellchecker', 'dfw');

	return $buttons;
} add_filter('mce_buttons', 'editor_buttons_row_1');

function editor_buttons_row_2($buttons)
{
	$buttons = array('styleselect', 'formatselect', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent', 'undo', 'redo', 'wp_help');

	return $buttons;
} add_filter('mce_buttons_2', 'editor_buttons_row_2');


function my_mce_before_init_insert_formats($init_array)
{
	$style_formats = array(
		array(
			'title' => 'Link Button',
			'selector' => 'a',
			'classes' => 'btn btn-primary'
		),
		array(
			'title' => 'Sign Font',
			'selector' => 'p',
			'classes' => 'signFont'
		)
	);

	$init_array['style_formats'] = json_encode($style_formats);

	return $init_array;
}  add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');



if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Global Settings',
		'menu_title' => 'Global Settings',
		'menu_slug' => 'global-settings',
		'capability'=> 'edit_posts',
		'redirect'=> true
	));
}

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Case Studies Main Page',
		'menu_title' => 'Main Page (CS)',
		'menu_slug' => 'main-page-cs',
		'parent_slug' => 'edit.php?post_type=thw-casestudies',
		'capability'=> 'edit_posts',
		'redirect'=> true
	));
}

if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Blog Main Page',
		'menu_title' => 'Main Page (Blog)',
		'menu_slug' => 'main-page-blog',
		'parent_slug' => 'edit.php',
		'capability'=> 'edit_posts',
		'redirect'=> true
	));
}

function admin_menu_removeitems()
{
	if (!current_user_can('administrator')) {
		remove_menu_page('edit-comments.php');
		remove_submenu_page('tools.php', 'tools.php');
		remove_submenu_page('tools.php', 'import.php');
		remove_submenu_page('tools.php', 'export.php');
		remove_menu_page('profile.php');

		remove_menu_page('jetpack');
		remove_submenu_page('themes.php', 'themes.php');
		remove_submenu_page('themes.php', 'customize.php?return=%2Fwp-admin%2F');
		remove_submenu_page('themes.php', 'customize.php?return=%2Fwp-admin%2Fnav-menus.php');
		remove_submenu_page('themes.php', 'widgets.php');
		remove_menu_page('options-general.php');
		remove_menu_page('edit.php?post_type=acf-field-group');
		remove_menu_page('wpseo_dashboard');
		remove_menu_page('yst_ga_dashboard');
		remove_menu_page('recent-tweets');
	}

} add_action('admin_menu', 'admin_menu_removeitems', 999);

function srm_restrict_to_capability_custom($redirect_capability)
{
	return 'edit_pages';
} add_filter('srm_restrict_to_capability', 'srm_restrict_to_capability_custom');

function wp_before_admin_bar_render_function()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wpseo-menu');
    $wp_admin_bar->remove_menu('search');
	$wp_admin_bar->remove_menu('user-info');

	$user_id = get_current_user_id();
	$avatar = get_avatar($user_id, 16);
	$wp_admin_bar->add_menu(array(
		'id' => 'my-account',
		'title' => $avatar
	));

} add_action('wp_before_admin_bar_render', 'wp_before_admin_bar_render_function');




function cw_page_template_column_title($columns)
{
	$columns['page_template'] = 'Template';
	return $columns;
} add_filter('manage_edit-page_columns', 'cw_page_template_column_title');

function cw_page_template_column_values($column)
{
	if($column == 'page_template') {
		global $post, $templateNamesFound;

		if (!is_array($templateNamesFound)) {
			$templateNamesFound = array();
		}

		$templateFile = get_page_template_slug($post->ID);

		if (!empty($templateNamesFound[$templateFile])) {
			echo $templateNamesFound[$templateFile];
		} elseif (!empty($templateFile)) {
			$templateFilePath = get_stylesheet_directory() . '/' . $templateFile;

			if (file_exists($templateFilePath)) {
				$templateFileContents = implode('', file($templateFilePath));

				if (preg_match('|Template( )Name:(.*)$|mi', $templateFileContents, $templateFileName)) {
					$templateName = _cleanup_header_comment($templateFileName[2]);
					$templateNamesFound[$templateFile] = $templateName;
					echo $templateName;
				}
			}
		}
	}

} add_action('manage_page_posts_custom_column', 'cw_page_template_column_values');


function acf_load_formidable_forms($field)
{
	ob_start();
	FrmFormsHelper::forms_dropdown('frm_add_form_id');
	$forms = ob_get_contents();
	ob_end_clean();

	preg_match_all('/<option\svalue="([^"]*)" >([^>]*)<\/option>/', $forms, $matches);

	if (!empty($matches[1]) && !empty($matches[2])) {
		$field['choices'] = array('' => '');

		foreach ($matches[1] as $matchId => $formId) {
			$formName = $matches[2][$matchId];
			$field['choices'][$formId] = $formName;
		}
	}

    return $field;
}
add_filter('acf/load_field/key=field_57a4af7c96fab', 'acf_load_formidable_forms');
add_filter('acf/load_field/key=field_57a8c4ccae559', 'acf_load_formidable_forms');


remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);


function remove_sharing_display()
{
    remove_filter('the_content', 'sharing_display', 19);
} add_action('loop_start', 'remove_sharing_display');


function newsletter_signup_send_to_drip($entryId, $formId)
{
	if ($formId == 5 && !empty($_POST['item_meta'][69]) && !empty($_POST['item_meta'][64]) && filter_var($_POST['item_meta'][64], FILTER_VALIDATE_EMAIL) !== false) {
		$subscriberArray = array(
			'account_id' => '1475113',
			'email' => $_POST['item_meta'][64],
			'custom_fields' => array('first_name' => $_POST['item_meta'][69]),
			'tags' => array('Website')
		);

		require_once(get_template_directory() . '/includes/drip/Drip_API.class.php');
		$dripApi = new Drip_API('yxzionhvibpteotozjoi');

		try {
			$apiResult = $dripApi->create_or_update_subscriber($subscriberArray);
		} catch (Exception $e) {}
	}
} add_action('frm_after_create_entry', 'newsletter_signup_send_to_drip', 30, 2);



