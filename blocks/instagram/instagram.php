<?php

$padding = get_field_object('padding');

$class = 'st_block st_instagram';
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
		<div class="st_instagram_top">
			<p class="title-2"><?php echo wp_kses_post( get_field('title') ); ?></p>
			<?php
			$profile_url = get_field('profile_url');
			if( $profile_url ):
				$link_url = $profile_url['url'];
				$link_title = $profile_url['title'];
				$link_target = $profile_url['target'] ? $profile_url['target'] : '_self';
				?>
				<a class="profile_url btn-3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>

		<div class="st_instagram_images">
			<?php
			$images = get_field('images');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			if( $images ): ?>
				<?php foreach( $images as $image_id ): ?>
					<figure>
						<?php echo wp_get_attachment_image( $image_id, $size ); ?>
					</figure>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
