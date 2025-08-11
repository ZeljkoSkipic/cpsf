<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>

	<div class="single_grant_winner_content container space_1">

		<h1 class="title-1"><?php the_title(); ?></h1>
		<div class="single_grant_top">
		<div class="total_allocations_wrap">
			 <?php
				// Calculate total allocation for the current post
				$total_allocation = 0;
				$grant_count = 0;
				if( have_rows('school') ):
					while( have_rows('school') ) : the_row();
						if( have_rows('school_grants') ):
							while( have_rows('school_grants') ) : the_row();
								$grant_value = get_sub_field('grant_value');
								$grant_name = get_sub_field('grant_name');

								// Count grant names
								if (!empty($grant_name)) {
									$grant_count++;
								}

								// Extract numeric value from grant_value (remove currency symbols, commas, etc.)
								$numeric_value = preg_replace('/[^\d.]/', '', $grant_value);
								if (is_numeric($numeric_value)) {
									$total_allocation += floatval($numeric_value);
								}
							endwhile;
						endif;
					endwhile;
				endif;
				?>
				<div class="total_allocations">
					<p class="prefix">Total Allocation</p>
					<div class="total_allocations_inner">
					<?php if ($total_allocation > 0) : ?>
							$<?php echo number_format($total_allocation, 0); ?>
					<?php endif; ?>

					<?php if ($grant_count > 0) : ?>
						for <?php echo number_format($grant_count, 0); ?> Grants
					<?php endif; ?>
					</div>
				</div>
		</div>

		 <?php
			// Get the current post's grant_page relationship
			$current_grant_pages = get_field('grant_page');

			if ($current_grant_pages) {
				// Get the first grant page ID (assuming single selection or we want the first one)
				$current_grant_id = is_array($current_grant_pages) ? $current_grant_pages[0]->ID : $current_grant_pages->ID;

				// Query for other grant winners with the same grant_page
				$related_winners = new WP_Query(array(
					'post_type' => 'grant-winner',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'orderby' => 'title',
					'order' => 'ASC',
					'meta_query' => array(
						array(
							'key' => 'grant_page',
							'value' => '"' . $current_grant_id . '"',
							'compare' => 'LIKE'
						)
					)
				));

				if ($related_winners->have_posts() && $related_winners->found_posts > 1) : ?>
					<div class="grant_winner_selector">
						<select id="winner-dropdown" onchange="window.location.href = this.value;">
							<?php while ($related_winners->have_posts()) : $related_winners->the_post(); ?>
								<option value="<?php echo esc_url(get_permalink()); ?>" <?php echo (get_the_ID() == get_queried_object_id()) ? 'selected' : ''; ?>>
									<?php
									// Extract year from title like "2024-25 Imagine Grants"
									$title = get_the_title();
									preg_match('/(\d{4}(?:-\d{2,4})?)/', $title, $matches);
									$display_title = isset($matches[1]) ? $matches[1] : $title;
									echo esc_html($display_title);
									?>
								</option>
							<?php endwhile; ?>
						</select>
					</div>
					<?php wp_reset_postdata();
				endif;
			}
			?>
</div>

		<?php
		if( have_rows('school') ): ?>
			<div class="grant_schools_wrapper">
				<?php while( have_rows('school') ) : the_row(); ?>
					<div class="grant_school_item">
						<?php
							$term = get_sub_field('grant_school');
							if( $term ): ?>
								<h2 class="title-4"><?php echo esc_html( $term->name ); ?></h2>
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
											<h5 class="grant_name"><?php echo esc_html($grant_name); ?></h5>
										<?php endif; ?>

										<?php if ($grant_value) : ?>
										<?php
										// Extract numeric value from grant_value (remove currency symbols, commas, etc.)
										$numeric_value = preg_replace('/[^\d.]/', '', $grant_value);
										if (is_numeric($numeric_value)) {
											$formatted_value = number_format($numeric_value, 0);
										} else {
											$formatted_value = $grant_value; // Fallback to original value if not numeric
										}
										?>
										<p class="grant_value">$<?php echo esc_html($formatted_value); ?></p>
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
	</div>

<?php
get_footer();
