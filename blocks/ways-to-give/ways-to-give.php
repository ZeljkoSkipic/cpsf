<?php

$padding = get_field_object('padding');

$class = 'st_block st_ways_to_give';
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
	<div class="container st_ways_to_give_inner">
		<div class="left">
			<?php get_template_part('components/intro'); ?>
		</div>
		<div class="right">
			<?php

			if( have_rows('ways_to_give') ): ?>

				<?php while( have_rows('ways_to_give') ) : the_row(); ?>

					<?php
					$title = get_sub_field('title');
					$description = get_sub_field('description'); ?>
					<div class="way_to_give">
						<p class="wtg_title">
							<?php echo $title; ?>
						</p>
						<div class="wtg_description">
							<?php echo $description; ?>
						</div>
						<?php
						$button = get_field('button');
						if( $button ):
							$button_url = $button['url'];
							$button_title = $button['title'];
							$button_target = $button['target'] ? $button['target'] : '_self';
							?>
							<a class="button" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>
	</div>
</section>
