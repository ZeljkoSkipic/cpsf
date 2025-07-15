<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s-tier
 */

$phone = get_field('phone_number', 'option');
$tax = get_field('tax_id', 'option');
$office = get_field('office_location', 'option');
$address = get_field('mailing_address', 'option');
$newsletter = get_field('newsletter_code', 'option');

?>

	<footer id="colophon" class="site-footer">
		<div class="footer_inner container">
			<div class="footer_contact space_1_3">
				<div class="col">
					<?php if($phone) : ?>
					<div class="footer_phone">
						<div class="footer_icon">
							<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 3.5C0.5 2.70435 0.816071 1.94129 1.37868 1.37868C1.94129 0.816071 2.70435 0.5 3.5 0.5H4.872C5.732 0.5 6.482 1.086 6.691 1.92L7.796 6.343C7.88554 6.701 7.86746 7.07746 7.74401 7.42522C7.62055 7.77299 7.39723 8.07659 7.102 8.298L5.809 9.268C5.674 9.369 5.645 9.517 5.683 9.62C6.24738 11.1549 7.1386 12.5487 8.29495 13.7051C9.4513 14.8614 10.8451 15.7526 12.38 16.317C12.483 16.355 12.63 16.326 12.732 16.191L13.702 14.898C13.9234 14.6028 14.227 14.3794 14.5748 14.256C14.9225 14.1325 15.299 14.1145 15.657 14.204L20.08 15.309C20.914 15.518 21.5 16.268 21.5 17.129V18.5C21.5 19.2956 21.1839 20.0587 20.6213 20.6213C20.0587 21.1839 19.2956 21.5 18.5 21.5H16.25C7.552 21.5 0.5 14.448 0.5 5.75V3.5Z" fill="#F26522"/></svg>
						</div>
						<div class="footer_item_content">
							<strong>Phone Number</strong>
							<a href="tel:<?php echo wp_kses_post( $phone ); ?>"><?php echo wp_kses_post( $phone ); ?></a>
						</div>
					</div>
					<?php endif; ?>

					<?php if($tax) : ?>
					<div class="footer_tax">
						<div class="footer_icon">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 10C0.25 4.615 4.615 0.25 10 0.25C15.385 0.25 19.75 4.615 19.75 10C19.75 15.385 15.385 19.75 10 19.75C4.615 19.75 0.25 15.385 0.25 10ZM8.956 8.558C10.102 7.985 11.393 9.021 11.082 10.264L10.373 13.1L10.415 13.08C10.5912 13.0025 10.7905 12.9958 10.9715 13.0612C11.1526 13.1265 11.3016 13.259 11.3877 13.4312C11.4737 13.6033 11.4903 13.802 11.434 13.9861C11.3777 14.1702 11.2527 14.3255 11.085 14.42L11.045 14.442C9.898 15.015 8.607 13.979 8.918 12.736L9.628 9.9L9.586 9.92C9.49754 9.96916 9.40004 9.99991 9.29938 10.0104C9.19872 10.0209 9.09697 10.0109 9.00028 9.98102C8.90358 9.95114 8.81393 9.90201 8.73673 9.83657C8.65952 9.77113 8.59636 9.69074 8.55105 9.60025C8.50573 9.50975 8.4792 9.41102 8.47305 9.31001C8.4669 9.20899 8.48126 9.10777 8.51527 9.01244C8.54927 8.91712 8.60222 8.82967 8.67092 8.75535C8.73961 8.68103 8.82264 8.62138 8.915 8.58L8.956 8.558ZM10 7C10.1989 7 10.3897 6.92098 10.5303 6.78033C10.671 6.63968 10.75 6.44891 10.75 6.25C10.75 6.05109 10.671 5.86032 10.5303 5.71967C10.3897 5.57902 10.1989 5.5 10 5.5C9.80109 5.5 9.61032 5.57902 9.46967 5.71967C9.32902 5.86032 9.25 6.05109 9.25 6.25C9.25 6.44891 9.32902 6.63968 9.46967 6.78033C9.61032 6.92098 9.80109 7 10 7Z" fill="#F26522"/></svg>
						</div>
						<div class="footer_item_content">
							<strong>Tax ID Number</strong>
							<?php echo wp_kses_post( $tax ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php if($office) : ?>
					<div class="footer_office">
						<div class="footer_icon">
							<svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.54 20.351L8.61 20.391L8.638 20.407C8.74903 20.467 8.87327 20.4985 8.9995 20.4985C9.12573 20.4985 9.24997 20.467 9.361 20.407L9.389 20.392L9.46 20.351C9.85112 20.1191 10.2328 19.8716 10.604 19.609C11.5651 18.9305 12.463 18.1667 13.287 17.327C15.231 15.337 17.25 12.347 17.25 8.5C17.25 6.31196 16.3808 4.21354 14.8336 2.66637C13.2865 1.11919 11.188 0.25 9 0.25C6.81196 0.25 4.71354 1.11919 3.16637 2.66637C1.61919 4.21354 0.75 6.31196 0.75 8.5C0.75 12.346 2.77 15.337 4.713 17.327C5.53664 18.1667 6.43427 18.9304 7.395 19.609C7.76657 19.8716 8.14854 20.1191 8.54 20.351ZM9 11.5C9.79565 11.5 10.5587 11.1839 11.1213 10.6213C11.6839 10.0587 12 9.29565 12 8.5C12 7.70435 11.6839 6.94129 11.1213 6.37868C10.5587 5.81607 9.79565 5.5 9 5.5C8.20435 5.5 7.44129 5.81607 6.87868 6.37868C6.31607 6.94129 6 7.70435 6 8.5C6 9.29565 6.31607 10.0587 6.87868 10.6213C7.44129 11.1839 8.20435 11.5 9 11.5Z" fill="#F26522"/></svg>
						</div>
						<div class="footer_item_content">
							<strong>Office Location</strong>
							<?php echo wp_kses_post( $office ); ?>
						</div>

					</div>
					<?php endif; ?>
					<?php if($address) : ?>
					<div class="footer_address">
						<div class="footer_icon">
							<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5.67188V14.2519C0.5 15.0475 0.816071 15.8106 1.37868 16.3732C1.94129 16.9358 2.70435 17.2519 3.5 17.2519H18.5C19.2956 17.2519 20.0587 16.9358 20.6213 16.3732C21.1839 15.8106 21.5 15.0475 21.5 14.2519V5.67188L12.572 11.1649C12.0992 11.4557 11.5551 11.6097 11 11.6097C10.4449 11.6097 9.90076 11.4557 9.428 11.1649L0.5 5.67188Z" fill="#F26522"/><path d="M21.5 3.908V3.75C21.5 2.95435 21.1839 2.19129 20.6213 1.62868C20.0587 1.06607 19.2956 0.75 18.5 0.75H3.5C2.70435 0.75 1.94129 1.06607 1.37868 1.62868C0.816071 2.19129 0.5 2.95435 0.5 3.75V3.908L10.214 9.886C10.4504 10.0314 10.7225 10.1084 11 10.1084C11.2775 10.1084 11.5496 10.0314 11.786 9.886L21.5 3.908Z" fill="#F26522"/></svg>
						</div>
						<div class="footer_item_content">
							<strong>Mailing Address</strong>
							<?php echo wp_kses_post( $address ); ?>
						</div>

					</div>
					<?php endif; ?>
				</div>

				<div class="col">
					<?php if($newsletter) : ?>
					<div class="footer_newsletter">
						<strong><?php echo wp_kses_post( get_field('newsletter_title', 'option') ); ?></strong>
						<p><?php echo wp_kses_post( get_field('newsletter_text', 'option') ); ?></p>
						<?php echo wp_kses_post( $newsletter ); ?>
					</div>
					<?php endif; ?>

				</div>
			</div>

			<div class="footer_main space_2">
				<div class="footer_menu">
					<p class="footer_menu_title">
						Contribute
					</p>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'contribute',
						'menu_class'     => 'contribute-menu',
						'container'      => false,
					) );
					?>
				</div>
				<div class="footer_menu">
					<p class="footer_menu_title">
						Grants & Scholarships
					</p>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'grants',
						'menu_class'     => 'grants-menu',
						'container'      => false,
					) );
					?>
				</div>
				<div class="footer_menu">
					<p class="footer_menu_title">
						Other
					</p>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'other',
						'menu_class'     => 'other-menu',
						'container'      => false,
					) );
					?>
				</div>
				<div class="footer_menu">
					<p class="footer_menu_title">
						Forms
					</p>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'forms',
						'menu_class'     => 'forms-menu',
						'container'      => false,
					) );
					?>
				</div>
				<div class="footer_menu">
					<p class="footer_menu_title">
						Follow Us
					</p>
					<?php

					if( have_rows('socials', 'option') ): ?>

						<?php while( have_rows('socials', 'option') ) : the_row(); ?>

							<div class="footer_social">
								<?php
								$social = get_sub_field('link_and_text', 'option');
								if( $social ):
									$link_url = $social['url'];
									$link_title = $social['title'];
									$link_target = $social['target'] ? $social['target'] : '_self';
									?>
									<a class="social" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
										<?php
										$icon = get_sub_field('social_icon');
										$size = 'full';
										if( $icon ) { ?>
										<figure>
											<?php echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) ); ?>
										</figure>
										<?php } ?>
										<?php echo esc_html( $link_title ); ?>
									</a>
								<?php endif; ?>

							</div>

						<?php endwhile; ?>

					<?php endif; ?>
				</div>
			</div>

			<div class="footer_bottom">
				<div class="copy">
					© <?php echo date('Y'); ?> <?php bloginfo(); ?> <?php echo wp_kses_post( get_field('additional_copyright_text', 'option') ); ?>
				</div>
				<div class="footer_logo">
					<?php the_custom_logo(); ?>
				</div>
				<div class="tos_menu">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'tos',
						'menu_class'     => 'tos-menu',
						'container'      => false,
					) );
					?>
				</div>
			</div>

		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<!--
	         (__)
     `\------(oo)
       ||    (__) <(What are you looking for?)
       ||w--||
-->
<?php echo get_field('body_bottom_script', 'option'); ?> <!-- Body Bottom External Code -->
</body>
</html>
