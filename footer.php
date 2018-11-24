</main>
<footer id="footer">
	<div class="container">
		<?php
			if (!is_front_page()) {
				get_template_part('_area-blocks');
			}

			$leftBlock = get_field('footer_block_left', 'options');
			$rightBlock = get_field('footer_block_right', 'options');

			if (!empty($leftBlock[0]) && !empty($leftBlock[0]['title']) && !empty($leftBlock[0]['description']) && !empty($leftBlock[0]['link_text']) && !empty($leftBlock[0]['link_page']) && !empty($rightBlock[0]) && !empty($rightBlock[0]['title']) && !empty($rightBlock[0]['description']) && !empty($rightBlock[0]['image']['url']) && !empty($rightBlock[0]['link_text']) && !empty($rightBlock[0]['link_page'])) {
				echo '	<div class="row">
							<div class="col-xs-12">
<div class="row">
								<div id="footerBlocks">
									<div id="footerBlockLeftOuter" class="col-xs-12 col-md-7 col-lg-8">
										<div id="footerBlockLeft">
											<h3>' . esc_html($leftBlock[0]['title']) . '</h3>
											<p>
												' . esc_html($leftBlock[0]['description']) . '
											</p>
											<a href="' . esc_url($leftBlock[0]['link_page']) . '">' . esc_html($leftBlock[0]['link_text']) . '</a>
										</div>
									</div>
									<div id="footerBlockRightOuter" class="col-xs-12 col-md-5 col-lg-4">
										<div id="getBook" class="clearfix">
											<a href="' . esc_url($rightBlock[0]['link_page']) . '">
												<img src="' . esc_url($rightBlock[0]['image']['url']) . '" alt="' . esc_attr($rightBlock[0]['image']['alt']) . '">
											</a>
											<h3>' . esc_html($rightBlock[0]['title']) . '</h3>
											<p>
												' . esc_html($rightBlock[0]['description']) . '
											</p>
											<a href="' . esc_url($rightBlock[0]['link_page']) . '">' . esc_html($rightBlock[0]['link_text']) . '</a>
										</div>
									</div>
								</div>
</div>
							</div>
						</div>';
			}
		?>
		<div class="row">
			<div class="col-xs-12">
				<div id="footerOuter">
					<div class="row">
						<div class="col-xs-3 col-sm-2">
							<img id="footerLogo" src="<?php echo get_template_directory_uri(); ?>/images/logo-white.png" alt="THW Marketing">
						</div>
						<div class="col-xs-9 col-sm-10">
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-2">
									<?php
										require_once(get_template_directory() . '/includes/footer_walker_nav_menu.php');

										wp_nav_menu(array(
											'theme_location' => 'main',
											'depth' => '1',
											'walker' => new CW_Footer_Walker_Nav_Menu()
										));
									?>
								</div>
								<div class="col-xs-12 col-sm-5 col-md-4">
									<?php
										wp_nav_menu(array(
											'menu_id' => 'footerServices',
											'theme_location' => 'main',
											'walker' => new CW_Footer_Walker_Nav_Menu()
										));
									?>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3">
									<div id="footerContact">
										<?php
											$phone = get_field('phone', 'options');

											if (!empty($phone[0]['display_number']) && !empty($phone[0]['international_call_number'])) {
												echo '	<p>
															<a href="tel:' . $phone[0]['international_call_number'] . '" rel="nofollow" target="_blank"><span class="thwicon thwicon-phone"></span>' . $phone[0]['display_number'] . '</a>
														</p>';
											}

											$contactPage = get_field('contact_page', 'options');

											if (!empty($contactPage)) {
												echo '	<p>
															<a href="' . $contactPage . '"><span class="thwicon thwicon-email"></span>Email us</a>
														</p>';
											}
										?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3">
									<?php
										$socialHtml = null;

										$socialLinks = array(
											'twitter' => array(
												'icon' => 'twitter',
												'title' => 'Twitter'
											),
											'facebook' => array(
												'icon' => 'facebook',
												'title' => 'Facebook'
											),
											'instagram' => array(
												'icon' => 'instagram',
												'title' => 'Instagram'
											),
											'linkedin' => array(
												'icon' => 'linkedin',
												'title' => 'LinkedIn'
											),
											'pinterest' => array(
												'icon' => 'pinterest',
												'title' => 'Pinterest'
											),
											'youtube' => array(
												'icon' => 'youtube',
												'title' => 'YouTube'
											)
										);

										foreach ($socialLinks as $socialLinkName => $socialLinkValues) {
											$link = get_field($socialLinkName, 'options');

											if (!empty($link)) {
												$socialHtml .= '<li>
																	<a href="' . $link . '" target="_blank" title="' . $socialLinkValues['title'] . '"><span class="thwicon thwicon-' . $socialLinkValues['icon'] . '"></span></a>
																</li>';
											}
										}

										if (!empty($socialHtml)) {
											echo '	<ul id="footerSocial">
														' . $socialHtml . '
													</ul>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
						$cookiesPage = get_field('cookies_privacy_page', 'options');

						$legalInfo = get_field('footer_legal_information', 'options');

						if (!empty($cookiesPage) || !empty($legalInfo)) {
							echo '	<div id="footerLegal" class="row">
										<div class="col-xs-12">
											<small>';

							if (!empty($cookiesPage)) {
								echo '<a href="' . esc_url($cookiesPage) . '">Cookies / Privacy</a>';
							}

							if (!empty($legalInfo)) {
								foreach ($legalInfo as $info) {
									echo '		<div class="legalInfo">
													' . esc_html($info['information']) . '
												</div>';
								}
							}

							echo '			</small>
										</div>
									</div>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</footer>
<div id="toTop"></div>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<!-- newer -->
</body>
</html>