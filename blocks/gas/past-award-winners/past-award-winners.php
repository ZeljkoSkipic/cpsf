<?php

$class = 'st_block st_past_award_winners container space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}


if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

$vimeo_video_link = get_field('vimeo_video_link');

 ?>
<section id="past_winners" class="<?php echo $class ?>">
	<div class="st_gas_section_inner">
		<div class="gas_section_left">
			<h2 class="title-3"><?php echo wp_kses_post( get_field('title') ); ?></h2>
		</div>
		<div class="gas_section_right">
			<?php if($vimeo_video_link) { ?>
			<div class="paw_video embed-container">
				<?php echo $vimeo_video_link ?>
			</div>
			<?php } ?>
			<?php

			if( have_rows('award_year') ): ?>

				<?php while( have_rows('award_year') ) : the_row(); ?>
					<div class="paw_winners_year">
					<h3 class="paw_year"><?php echo wp_kses_post( get_sub_field('award_year') ); ?></h3>

					<?php

					if( have_rows('award_winner') ): ?>
						<div class="paw_grid">
						<?php while( have_rows('award_winner') ) : the_row(); ?>
							<div class="paw_winner">
								<?php
								$winner_image = get_sub_field('winner_image');
								$size = 'full';
								if( $winner_image ) {
									echo wp_get_attachment_image( $winner_image, $size, "", array( "class" => "winner_image" ) );
								} ?>
								<p class="paw_name">
									<?php echo wp_kses_post( get_sub_field('winner_name') ); ?>
								</p>
							</div>

						<?php endwhile; ?>
						</div>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>

			<?php endif; // Past Winners ?>

			<?php

			if( have_rows('award_year_simple') ): ?>
				<div class="paw_simple">

				<?php while( have_rows('award_year_simple') ) : the_row(); ?>
					<div class="paw_simple_year">
						<h3 class="paw_year"><?php echo wp_kses_post( get_sub_field('award_year') ); ?></h3>
						<div class="paw_simple_winners">
							<?php echo wp_kses_post( get_sub_field('award_winners') ); ?>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			<?php endif; // Past Winners Simple?>
		</div>
	</div>
</section>
