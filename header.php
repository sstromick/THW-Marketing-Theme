<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php wp_title(''); ?></title>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/shiv-respond.min.js"></script><![endif]-->
<?php wp_head(); ?>
<meta name="format-detection" content="telephone=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Pacifico" rel="stylesheet">
<?php
if (!is_user_logged_in()) {
	$facebookPixelId = get_field('facebook_pixel_id_number', 'options');

	if (!empty($facebookPixelId)) {
		echo '<!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");fbq("init","' . $facebookPixelId . '");fbq("track","PageView");</script><noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=' . $facebookPixelId . '&ev=PageView&noscript=1"></noscript><!-- End Facebook Pixel Code -->';
	}
}
?>
</head>
<body <?php body_class(); ?>>
<header>
	<div class="container main">
		<div class="row">
			<div class="col-xs-7 col-md-2">
				<a id="logo" href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></a>
			</div>
			<div class="col-xs-5 visible-xs-block visible-sm-block">
				<a id="mainNavLink" href="<?php echo home_url('menu'); ?>">Menu<span class="thwicon thwicon-arrow"></span></a>
			</div>
			<div id="mainNavOuter" class="col-xs-12 col-md-10">
				<nav id="mainNav">
				<?php
					require_once(get_template_directory() . '/includes/main_walker_nav_menu.php');

					wp_nav_menu(array(
						'theme_location' => 'main',
						'depth' => 2,
						'walker' => new CW_Main_Walker_Nav_Menu()
					));
				?>
				</nav>
			</div>
		</div>
	</div>
</header>
<main>
