<?php

$class = 'st_block st_gas_hero space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$gi_title = get_field('gh_title');
$description = get_field('gh_description');
$deadline = get_field('deadline');
$grant_not_active = get_field('grant_not_active');


if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container st_gas_hero_inner">
		<div class="left">
			<h1 class="gas_title page-title">
				<?php if($gi_title) {
					echo $gi_title;
				} else {
					the_title();
				} ?>
			</h1>

			<?php if ($deadline && $grant_not_active && strtotime($deadline) < time()) : ?>
				<strong><?php echo $grant_not_active; ?></strong><br><br>
			<?php endif; ?>


			<?php if ($description) : ?>
			<div class="gas_description">
				<?php echo wp_kses_post($description); ?>
			</div>
			<?php endif; ?>

			<?php if ($deadline && strtotime($deadline) > time()) : ?>
			<div class="gas_deadline">
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

			<div class="gas_button">
				<?php
				$gh_button = get_field('gh_button');
				if( $gh_button ):
					$link_url = $gh_button['url'];
					$link_title = $gh_button['title'];
					$link_target = $gh_button['target'] ? $gh_button['target'] : '_self';
					?>
					<a class="gh_button btn-3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>

		</div>
		<div class="right">
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
</section>
