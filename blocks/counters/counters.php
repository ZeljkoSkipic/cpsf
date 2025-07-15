<?php

$padding = get_field_object('padding');

$class = 'st_block st_counters';
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
		<div class="st_counters_inner">
			<?php

			if( have_rows('counter_group') ): ?>

				<?php while( have_rows('counter_group') ) : the_row(); ?>

					<div class="st_counter">
						<?php
						$icon = get_sub_field('icon');
						$size = 'full';
						if( $icon ) {
							echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) );
						} ?>

						<p class="counter">
							<?php echo wp_kses_post( get_sub_field('counter') ); ?>
						</p>

						<p class="counter_text">
							<?php echo wp_kses_post( get_sub_field('counter_text') ); ?>
						</p>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>

		<?php
		$counters_button = get_field('counters_button');
		if( $counters_button ): ?>
		<div class="counters_button_wrap">
			<?php
			$counters_button_url = $counters_button['url'];
			$counters_button_title = $counters_button['title'];
			$counters_button_target = $counters_button['target'] ? $counters_button['target'] : '_self';
			?>
			<a class="btn-3" href="<?php echo esc_url( $counters_button_url ); ?>" target="<?php echo esc_attr( $counters_button_target ); ?>"><?php echo esc_html( $counters_button_title ); ?></a>
		</div>
		<?php endif; ?>
	</div>
</section>
