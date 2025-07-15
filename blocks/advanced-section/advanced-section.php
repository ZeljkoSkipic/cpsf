<?php

$padding = get_field_object('padding');
$layout = get_field_object('layout');
$intro_position = get_field_object('intro_position');

$video = get_field('video_link');

$class = 'st_block st_advanced_section';
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

if ( ! empty( $layout) ) {
    $class .=  ' ' . $layout['value'];
}


if ( ! empty( $intro_position) ) {
    $class .=  ' ' . $intro_position['value'];
}

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_advanced_section_inner container">
		<?php get_template_part('components/intro'); ?>
		<div class="info_boxes">
			<?php

			if( have_rows('info_boxes') ): ?>

				<?php while( have_rows('info_boxes') ) : the_row();

					$ib_title = get_sub_field('title');
					$ib_text = get_sub_field('text');
					?>
					<div class="as_info_box">
						<?php
						$icon = get_sub_field('icon');
						$size = 'full';
						if( $icon ) {
							echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) );
						} ?>
						<div class="as_info_box_content">
							<?php if($ib_title) { ?>
								<h3><?php echo $ib_title; ?></h3>
							<?php } ?>

							<?php if($ib_text) { ?>
								<div><?php echo $ib_text; ?></div>
							<?php } ?>
						</div>
					</div>

				<?php endwhile; ?>

			<?php endif; ?>

			<?php
			$button = get_field('button');
			if( $button ):
				$button_url = $button['url'];
				$button_title = $button['title'];
				$button_target = $button['target'] ? $button['target'] : '_self';
				?>
				<a class="btn-3" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
			<?php endif; ?>
		</div>
		<div class="media">
			<?php
			$image = get_field('image');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
			} ?>

			<?php if($video) { ?>
			<a href="<?php echo wp_kses_post( get_field('video_link') ); ?>" aria-label="Watch Video" data-fancybox>
				<div class="video_overlay">
					<svg width="360" height="364" viewBox="0 0 360 364" fill="none" xmlns="http://www.w3.org/2000/svg"><g filter="url(#filter0_d_16006_3970)"><path fill-rule="evenodd" clip-rule="evenodd" d="M120 181.688C120 147.617 146.862 120 180 120C213.138 120 240 147.617 240 181.688C240 215.759 213.138 243.377 180 243.377C146.862 243.377 120 215.759 120 181.688ZM206.302 175.469C207.38 176.086 208.278 176.988 208.903 178.081C209.528 179.175 209.858 180.42 209.858 181.688C209.858 182.957 209.528 184.202 208.903 185.296C208.278 186.389 207.38 187.291 206.302 187.908L171.822 207.604C170.768 208.205 169.58 208.513 168.375 208.498C167.17 208.482 165.99 208.144 164.951 207.516C163.913 206.887 163.051 205.991 162.453 204.916C161.854 203.841 161.539 202.623 161.538 201.384V161.992C161.538 156.57 167.206 153.135 171.822 155.773L206.302 175.469Z" fill="white"/></g></svg>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
</section>


<script>
Fancybox.bind("[data-fancybox]", {
  Carousel: {
    Video: {
      autoplay: true,
    },
  },
});
</script>
