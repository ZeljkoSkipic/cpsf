<?php

$padding = get_field_object('padding');

$class = 'st_block st_partner_with_us';
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
	<div class="container st_pwu_inner">
		<div class="left">
			<h2 class="title-1 pwu_title">
				<?php echo wp_kses_post( get_field('pwu_title') ); ?>
			</h2>
			<?php echo wp_kses_post( get_field('pwu_text') ); ?>
			<div class="pwu_buttons">
				<?php
				$button = get_field('button');
				$file = get_field('download_button');
				if( $button ):
					$link_url = $button['url'];
					$link_title = $button['title'];
					$link_target = $button['target'] ? $button['target'] : '_self';
					?>
					<a class="btn-3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
			<a class="download_btn" href="<?php echo $file['url']; ?>" download>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14.5V16.75C1 17.3467 1.23705 17.919 1.65901 18.341C2.08097 18.7629 2.65326 19 3.25 19H16.75C17.3467 19 17.919 18.7629 18.341 18.341C18.7629 17.919 19 17.3467 19 16.75V14.5M14.5 10L10 14.5M10 14.5L5.5 10M10 14.5V1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				Download the form
			</a>
			</div>
		</div>
		<div class="right">
			<?php
			$image = get_field('image');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
			} ?>
		</div>
	</div>
</section>
