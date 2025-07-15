<?php

$padding = get_field_object('padding');

$class = 'st_block st_cta';
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
	<div class="container st_cta_inner">
		<div class="st_cta_left">
			<p class="title-1 st_cta_title"><?php echo wp_kses_post( get_field('title') ); ?></p>
			<div class="st_cta_text">
				<?php echo wp_kses_post( get_field('text') ); ?>
			</div>
			<?php
			$button = get_field('button');
			if( $button ):
				$link_url = $button['url'];
				$link_title = $button['title'];
				$link_target = $button['target'] ? $button['target'] : '_self';
				?>
				<a class="btn-4" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
		<div class="st_cta_right">
			<?php
			$image = get_field('image');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
			} else { ?>
				<img src="/wp-content/themes/cpsf/assets/images/cta-bg.webp" alt="">
			<?php } ?>
		</div>
	</div>
</section>
