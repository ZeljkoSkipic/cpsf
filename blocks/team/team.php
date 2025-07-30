<?php

$padding = get_field_object('padding');

$class = 'st_block st_team';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
		<div class="st_team_inner">
			<?php

			if( have_rows('team_section') ): ?>

				<?php while( have_rows('team_section') ) : the_row(); ?>

					<div class="team_section">
						<h3 class="team_section_title">
							<?php echo wp_kses_post( get_sub_field('section_title') ); ?>
						</h3>
						<?php

						if( have_rows('team_member') ): ?>
							<div class="team_section_inner">
								<?php while( have_rows('team_member') ) : the_row(); ?>

									<?php
									$member_name = get_sub_field('member_name');
									$member_position = get_sub_field('member_position'); ?>
									<div class="team_member">
										<?php
										$member_image = get_sub_field('member_image');
										$size = 'full';
										if( $member_image ) {
											echo wp_get_attachment_image( $member_image, $size, "", array( "class" => "member_image" ) );
										} ?>
										<p class="member_name">
											<?php echo $member_name; ?>
										</p>
										<?php if($member_position) { ?>
											<p class="member_position">
												<?php echo $member_position; ?>
											</p>
										<?php } ?>
									</div>

								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>
	</div>
</section>
