<?php
$layout = get_field_object('layout');
$stack = get_field_object('stack');


$class = 'st_block st_section';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$sec_in_class = 'st_section_inner container';
if ( ! empty( $layout ) ) {
    $sec_in_class .=  ' ' . $layout['value'];
}

if ( ! empty( $stack ) ) {
    $sec_in_class .=  ' ' . $stack['value'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


?>

<section <?php echo $anchor; ?> class="<?php echo $class; ?>">
	<?php get_template_part('components/background'); ?>
	<div class="<?php echo $sec_in_class ?>">
		<?php
		$title = get_field('title');
		$text = get_field('text'); ?>

		<div class="left">
			<h3 class="st_section_title title-3"><?php echo $title; ?></h3>
			<div class="st_section_text"><?php echo $text ?></div>
			<?php get_template_part('components/buttons'); ?>
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
