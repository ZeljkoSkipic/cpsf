<?php

$class = 'st_block st_gas_section st_past_grants space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<section id="report" class="<?php echo $class ?>">
	<div class="container st_gas_section_inner st_past_grants_inner">
		<div class="gas_section_left">
			<h2 class="title-3">Past Grants</h2>
		</div>
		<div class="gas_section_right">
            <?php
            // Query for grant-winner posts
            $grant_winner_query = new WP_Query(array(
                'post_type' => 'grant-winner',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            // Check if there are posts
            if ($grant_winner_query->have_posts()) : ?>
			<div class="grant_winners_grid">
				<div class="past_winners_head">
					<div class="left">
						<p class="prefix">Total Allocation</p>
						<div id="total-allocation-display">
							<strong>Loading...</strong>
						</div>
					</div>

					<div class="right">
						<p class="prefix">Year</p>
						<select id="year-selector" class="year-dropdown">
							<?php
							// Reset the query to get all years for dropdown
							$grant_winner_query->rewind_posts();
							$first_year = true;
							while ($grant_winner_query->have_posts()) : $grant_winner_query->the_post();
								$year = get_the_title();
								?>
								<option value="year-<?php echo esc_attr($year); ?>" <?php echo $first_year ? 'selected' : ''; ?>><?php echo esc_html($year); ?></option>
								<?php $first_year = false; ?>
							<?php endwhile; ?>
						</select>
					</div>

				</div>

                <?php
                // Reset the query before the main loop
                $grant_winner_query->rewind_posts();
                // Start the loop
                while ($grant_winner_query->have_posts()) : $grant_winner_query->the_post(); ?>

					<?php
					$current_post_id = get_the_ID(); // Get the current post ID

					if( have_rows('school', $current_post_id) ):
						// Calculate total allocation for this year
						$total_allocation = 0;
						while( have_rows('school', $current_post_id) ) : the_row();
							if( have_rows('school_grants') ):
								while( have_rows('school_grants') ) : the_row();
									$grant_value = get_sub_field('grant_value');
									// Extract numeric value from grant_value (remove currency symbols, commas, etc.)
									$numeric_value = preg_replace('/[^\d.]/', '', $grant_value);
									if (is_numeric($numeric_value)) {
										$total_allocation += floatval($numeric_value);
									}
								endwhile;
							endif;
						endwhile;
						?>
						<div class="grant_schools_wrapper" id="year-<?php the_title(); ?>" data-total-allocation="<?php echo number_format($total_allocation, 0); ?>">

							<?php while( have_rows('school', $current_post_id) ) : the_row(); ?>

								<div class="grant_school_item">
									<?php
									$term = get_sub_field('grant_school');
									if( $term ): ?>
										<p class="grant_school_name"><?php echo esc_html( $term->name ); ?></p>
									<?php endif; ?>

									<?php
									if( have_rows('school_grants') ): ?>
										<div class="school_grants_wrapper">
											<?php while( have_rows('school_grants') ) : the_row(); ?>
												<?php
												$grant_name = get_sub_field('grant_name');
												$grant_value = get_sub_field('grant_value');
												$grant_description = get_sub_field('grant_description');
												?>

												<div class="individual_grant">
													<?php if ($grant_name) : ?>
														<p class="grant_name"><?php echo esc_html($grant_name); ?>
														<?php if ($grant_value) : ?>
															<?php
															// Format the grant value with commas
															$numeric_value = preg_replace('/[^\d.]/', '', $grant_value);
															$formatted_value = is_numeric($numeric_value) ? number_format($numeric_value, 0) : $grant_value;
															?>
															<span class="grant_value"><strong> - </strong> $<?php echo esc_html($formatted_value); ?></span>
														<?php endif; ?>

														</p>
													<?php endif; ?>

													<?php if ($grant_description) : ?>
														<div class="grant_description">
															<?php echo wp_kses_post($grant_description); ?>
														</div>
													<?php endif; ?>
												</div>

											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
						</div>

					<?php endif; ?>

                <?php endwhile; ?>

                </div>

                <?php // Reset post data
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
	</div>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const yearSelector = document.getElementById('year-selector');
		const grantWrappers = document.querySelectorAll('.grant_schools_wrapper');
		const totalAllocationDisplay = document.getElementById('total-allocation-display');

		// Initially hide all grant sections
		grantWrappers.forEach(wrapper => {
			wrapper.style.display = 'none';
		});

		// Show first year by default and update total allocation
		if (grantWrappers.length > 0) {
			grantWrappers[0].style.display = 'block';
			yearSelector.value = grantWrappers[0].id;
			const firstYearTotal = grantWrappers[0].getAttribute('data-total-allocation');
			totalAllocationDisplay.innerHTML = '<strong>$' + firstYearTotal + '</strong>';
		}

		yearSelector.addEventListener('change', function() {
			const selectedYear = this.value;

			// Hide all grant sections
			grantWrappers.forEach(wrapper => {
				wrapper.style.display = 'none';
			});

			// Show selected year section and update total allocation
			const selectedWrapper = document.getElementById(selectedYear);
			if (selectedWrapper) {
				selectedWrapper.style.display = 'block';
				const yearTotal = selectedWrapper.getAttribute('data-total-allocation');
				totalAllocationDisplay.innerHTML = '<strong>$' + yearTotal + '</strong>';
			}
		});
	});
	</script>
</section>
