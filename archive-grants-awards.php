<?php
/**
 * The template for Grants & Awards archive page
 */

get_header();

$title = get_field('ga_archive_title', 'option');
// Get the archive title and remove the prefix
$archive_title = get_the_archive_title();
// Remove "Archives:" or other prefixes
$archive_title = preg_replace('/^.*:\s*/', '', $archive_title);
$description = get_field('ga_archive_description', 'option');
?>

	<main id="primary" class="site-main">
		<article>
			<div class="grants_hero space_2 container">
				<div class="left">
					<h1>
						<?php if($title) {
							echo $title;
						} else {
							echo $archive_title;
						} ?>
					</h1>
				</div>
				<div class="right">
					<?php echo $description; ?>
					<a class="btn-3" href="#opportunities">Explore All Opportunities</a>
				</div>
				<div class="bottom">
					<?php
					$ga_archive_image = get_field('ga_archive_image', 'option');
					$size = 'full';
					if( $ga_archive_image ) {
						echo wp_get_attachment_image( $ga_archive_image, $size, "", array( "class" => "ga_archive_image" ) );
					} ?>
				</div>
			</div>

			<div class="grants_grid container space_2" id="opportunities">
				<?php
				// Query for grants-awards posts
				$grants_query = new WP_Query(array(
					'post_type' => 'grants-awards',
					'posts_per_page' => -1, // Show all posts
					'orderby' => 'date',
					'order' => 'DESC'
				));

				// Check if there are posts
				if ($grants_query->have_posts()) :
					// Start the loop
					while ($grants_query->have_posts()) : $grants_query->the_post();

						// Get ACF fields
						$gi_title = get_field('gh_title');
						$description = get_field('gh_description');
						$deadline = get_field('deadline');
						$grant_not_active = get_field('grant_not_active');
						?>

						<div class="grants_item">
							<div class="grants_item_content">
								<h3 class="grants_item_title title-3">
									<?php if($gi_title) {
										echo $gi_title;
									} else {
										the_title();
									} ?>
								</h3>

								<?php if ($deadline && $grant_not_active && strtotime($deadline) < time()) : ?>
									<strong><?php echo $grant_not_active; ?></strong><br><br>
								<?php endif; ?>

								<?php if ($description) : ?>
								<div class="grants_item_description">
									<?php echo wp_kses_post($description); ?>
								</div>
								<?php endif; ?>

								<?php if ($deadline && strtotime($deadline) > time()) : ?>
								<div class="grants_item_deadline">
									<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 0C6.26522 0 6.51957 0.105357 6.70711 0.292893C6.89464 0.480429 7 0.734784 7 1V3H19V1C19 0.734784 19.1054 0.480429 19.2929 0.292893C19.4804 0.105357 19.7348 0 20 0C20.2652 0 20.5196 0.105357 20.7071 0.292893C20.8946 0.480429 21 0.734784 21 1V3H22C23.0609 3 24.0783 3.42143 24.8284 4.17157C25.5786 4.92172 26 5.93913 26 7V22C26 23.0609 25.5786 24.0783 24.8284 24.8284C24.0783 25.5786 23.0609 26 22 26H4C2.93913 26 1.92172 25.5786 1.17157 24.8284C0.421427 24.0783 0 23.0609 0 22V7C0 5.93913 0.421427 4.92172 1.17157 4.17157C1.92172 3.42143 2.93913 3 4 3H5V1C5 0.734784 5.10536 0.480429 5.29289 0.292893C5.48043 0.105357 5.73478 0 6 0ZM24 12C24 11.4696 23.7893 10.9609 23.4142 10.5858C23.0391 10.2107 22.5304 10 22 10H4C3.46957 10 2.96086 10.2107 2.58579 10.5858C2.21071 10.9609 2 11.4696 2 12V22C2 22.5304 2.21071 23.0391 2.58579 23.4142C2.96086 23.7893 3.46957 24 4 24H22C22.5304 24 23.0391 23.7893 23.4142 23.4142C23.7893 23.0391 24 22.5304 24 22V12Z" fill="#F26522"/></svg>
									<div class="deadline_content">
										<strong class="prefix">Deadline:</strong>
										<span class="deadline_date">
											<?php
											// Display the date in month/day/year format with ordinal suffixes
											// Parse the date using strtotime
											$date_timestamp = strtotime($deadline);
											if ($date_timestamp) {
												// Get month and year
												$month = date('F', $date_timestamp);
												$day = date('j', $date_timestamp);
												$year = date('Y', $date_timestamp);

												// Add ordinal suffix to day
												if ($day % 10 == 1 && $day != 11) {
													$day .= 'st';
												} elseif ($day % 10 == 2 && $day != 12) {
													$day .= 'nd';
												} elseif ($day % 10 == 3 && $day != 13) {
													$day .= 'rd';
												} else {
													$day .= 'th';
												}

												// Output the formatted date
												echo esc_html("$month $day, $year");
											} else {
												// If we can't parse it, just output the raw value
												echo esc_html($deadline);
											}
											?>
										</span>
									</div>
								</div>
								<?php endif; ?>

								<div class="grants_item_button">
									<a href="<?php the_permalink(); ?>" class="btn-3">Learn More</a>
								</div>
							</div>

							<div class="grants_item_image">
								<?php
								if (has_post_thumbnail()) {
									the_post_thumbnail();
								} else {
									// Display a default image if no featured image is set
									echo '<img src="' . get_template_directory_uri() . '/assets/images/default-grant-award-image.jpg" alt="Default Grant Image">';
								}
								?>
							</div>
						</div>

					<?php endwhile;

					// Reset post data
					wp_reset_postdata();

				else : ?>
					<div class="no-grants-found">
						<p>No grants or awards are currently available. Please check back later.</p>
					</div>
				<?php endif; ?>
			</div>
		</article>

	</main><!-- #main -->

<?php
get_footer();
