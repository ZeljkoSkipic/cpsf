<?php

$padding = get_field_object('padding');
$form = get_field('contact_form');

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_contact_block';
if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_contact_block_inner container">
		<div class="left">
			<?php get_template_part('components/intro'); ?>
		</div>
		<div class="right">
			<?php

			// Check if a form is selected.
			if ($form) {
				// Display the form using the form ID.
				echo do_shortcode('[wpforms id="' . $form->ID . '"]');
			}
			?>
		</div>
	</div>
</section>
