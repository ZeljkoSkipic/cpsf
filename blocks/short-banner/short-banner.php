<?php

$padding = get_field_object('padding');

$class = 'st_block st_short_banner';
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
	<div class="st_short_banner_inner container" style="background-color:<?php echo get_field('background'); ?>">
		<?php
		$preview_image = get_field('preview_image');
		$size = 'full';
		$file = get_field('pdf');
		if( $preview_image ) { ?>
		<figure class="short_banner_preview">
			<?php echo wp_get_attachment_image( $preview_image, $size, "", array( "class" => "preview_image" ) ); ?>
			</figure>
		<?php } ?>
		<div class="short_banner_content">
			<h2 class="title-3">
				<?php echo wp_kses_post( get_field('title') ); ?>
			</h2>
			<?php echo wp_kses_post( get_field('text') ); ?>
		</div>
		<div class="short_banner_file">
			<a href="<?php echo $file['url']; ?>" download>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14.5V16.75C1 17.3467 1.23705 17.919 1.65901 18.341C2.08097 18.7629 2.65326 19 3.25 19H16.75C17.3467 19 17.919 18.7629 18.341 18.341C18.7629 17.919 19 17.3467 19 16.75V14.5M14.5 10L10 14.5M10 14.5L5.5 10M10 14.5V1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				Download the PDF
			</a>
		</div>
	</div>
</section>
