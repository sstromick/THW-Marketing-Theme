<?php
/**
 * Template Name: Contact
*/

get_header();

echo '	<div class="container">
			<div class="row">
				<div class="col-xs-12">';

$titleBack = get_field('title_with_background');

if (!empty($titleBack[0]) && !empty($titleBack[0]['pages_title_background_image']['url'])) {


	echo '			<div id="mainTitleWithBack" style="background-image:url(\'' . esc_url($titleBack[0]['pages_title_background_image']['url']) . '\')">
						<div class="row">
							<div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">';

	$iconHtml = null;

	if (!empty($titleBack[0]['pages_title_icon'])) {
		$iconMap = array(
			'target' => 'marketconsult',
			'dots' => 'socialconsult',
			'personddots' => 'socialmanage',
			'bulb' => 'socialtrain',
			'speaker' => 'speaking',
			'success' => 'admanage',
			'cogs' => 'cogs',
			'speech' => 'speech',
			'logo' => 'logo',
			'cookie' => 'cookie'
		);

		$iconMapIndex = $titleBack[0]['pages_title_icon'];

		$iconHtml = '<span class="thwicon thwicon-' . $iconMap[$iconMapIndex] . '"></span>';
	}

	the_title('<h1>' . $iconHtml, '</h1>');

	if (!empty($titleBack[0]['pages_title_description'])) {
		echo '<p>' . $titleBack[0]['pages_title_description'] . '</p>';
	}

	echo '					</div>
						</div>
					</div>';
} else {
	the_title('<h1>', '</h1>');
}

echo '			</div>
			</div>
			<div class="mainContent">
				<div class="row">';

$formHtml = null;
$contactFormId = get_field('contact_form');

if (!empty($contactFormId)) {
	$form = FrmForm::getOne($contactFormId);

	if (!empty($form) && empty($form->parent_form_id)) {
		$formHtml = FrmFormsController::get_form_shortcode(array(
			'id' => $contactFormId,
			'title' => false,
			'description' => false
		));
	}
}

$detailsHtml = null;

$phone = get_field('phone', 'options');

if (!empty($phone[0]['display_number']) && !empty($phone[0]['international_call_number'])) {
	$detailsHtml .= '<p><strong>Phone: </strong><span itemprop="telephone"><a href="tel:' . $phone[0]['international_call_number'] . '" rel="nofollow" target="_blank">' . $phone[0]['display_number'] . '</a></span></p>';
}

$email = get_field('email_address');

if (!empty($email)) {
	$detailsHtml .= '<p><strong>Email: </strong><a href="mailto:' . $email . '" target="_blank" itemprop="email">' . $email . '</a></p>';
}

$addressHtml = null;

$addressLine1 = get_field('address_line_1');

if (!empty($addressLine1)) {
	$addressHtml .= '<span itemprop="streetAddress">' . $addressLine1 . '</span>';
}

$addressLine2 = get_field('address_line_2');

if (!empty($addressLine2)) {
	if (!empty($addressHtml)) {
		$addressHtml .= '<br>';
	}

	$addressHtml .= $addressLine2;
}

$townCity = get_field('town_city');

if (!empty($townCity)) {
	if (!empty($addressHtml)) {
		$addressHtml .= '<br>';
	}

	$addressHtml .= '<span itemprop="addressLocality">' . $townCity . '</span>';
}

$county = get_field('county');

if (!empty($county)) {
	if (!empty($addressHtml)) {
		$addressHtml .= '<br>';
	}

	$addressHtml .= '<span itemprop="addressRegion">' . $county . '</span>';
}

$postcode = get_field('postcode');

if (!empty($postcode)) {
	if (!empty($addressHtml)) {
		$addressHtml .= '<br>';
	}

	$addressHtml .= '<span itemprop="postalCode">' . $postcode . '</span>';
}

if (!empty($addressHtml)) {
	$addressHtml .= '	<br>
						<span class="schemaNoShow" itemprop="addressCountry">United Kingdom
						</span>';
}

if (!empty($addressHtml)) {
	$detailsHtml .= '	<p>
							<strong>Address: </strong><br>
							<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								' . $addressHtml . '
							</span>
						</p>';
}

$googleMapUrl = get_field('google_map_embed_web_address');

if (!empty($googleMapUrl)) {
	$detailsHtml .= '<iframe src="' . esc_url($googleMapUrl) . '" width="100%" height="340" frameborder="0" style="border:0" allowfullscreen></iframe>';
}

if (empty($formHtml) && empty($detailsHtml)) {
	echo '			<div class="col-xs-12">
						<p>We are currently updating this section.</p>
					</div>';
} elseif (empty($formHtml)) {
	echo '			<div class="col-xs-12">
						<h2>Contact Details</h2>
						' . $detailsHtml . '
					</div>';
} elseif (empty($detailsHtml)) {
	echo '			<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div id="contactForm">
									<h2>Send us a message online</h2>
									' . $formHtml . '
								</div>
							</div>
						</div>
					</div>';
} else {
	echo '			<div class="col-xs-12 col-md-6">
						<div id="contactForm">
							<h2>Send us a message online</h2>
							' . $formHtml . '
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div itemscope itemtype="http://schema.org/ProfessionalService">
							<h2>Contact Details</h2>
							<div id="contactDetails">
								' . $detailsHtml . '
							</div>
						</div>
					</div>';
}

echo '			</div>
			</div>
		</div>';

get_footer();
