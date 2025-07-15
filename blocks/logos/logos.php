<?php

$padding = get_field_object('padding');


$class = 'st_block st_logos';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

?>

<section <?php echo $anchor; ?> class="<?php echo $class; ?>">
	<?php get_template_part('components/background'); ?>
		<div class="container">
			<p class="st_logos_title"><?php echo wp_kses_post( get_field('logos_title') ); ?></p>
		<div class="st_logos_inner">
			<?php

			if( have_rows('logos') ): ?>

				<?php while( have_rows('logos') ) : the_row(); ?>

					<figure class="logo">
						<?php
						$logo = get_sub_field('logo');
						$size = 'full';
						if( $logo ) {
							echo wp_get_attachment_image( $logo, $size, "", array( "class" => "logo" ) );
						} ?>
					</figure>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>
	</div>
</section>
