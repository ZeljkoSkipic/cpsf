<?php


$class = 'st_block st_inner_hero_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<div class="st_inner_hero_2_inner space_2">
			<div class="left">
				<?php get_template_part('components/simple-title'); ?>
			</div>
			<div class="right">
				<?php echo wp_kses_post( get_field('text') ); ?>
				<div class="right_bottom">
					<?php
					$button = get_field('button');
					if( $button ):
						$button_url = $button['url'];
						$button_title = $button['title'];
						$button_target = $button['target'] ? $button['target'] : '_self';
						?>
						<a class="btn-3" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
					<?php endif; ?>
					<?php
					$link = get_field('link');
					if( $link ):
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? link['target'] : '_self';
						?>
						<a class="hero-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php the_post_thumbnail(); ?>
	</div>
</section>
