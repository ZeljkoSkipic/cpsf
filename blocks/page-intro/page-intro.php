<?php

$padding = get_field_object('padding');
$bottom_border = get_field('remove_bottom_border');



$class = 'st_block st_page_intro space_4';
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

if ( $bottom_border ) {
    $class .=  ' ' . 'no_border';
}





?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_page_intro_inner container">
		<div class="left">
			<h2 class="title-1"><?php echo wp_kses_post( get_field('title') ); ?></h2>
		</div>
		<div class="right">
			<?php echo wp_kses_post( get_field('text') ); ?>
		</div>
	</div>
</section>
