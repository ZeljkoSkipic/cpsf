<?php

$class = 'st_block st_nominate st_gas_section st_gas_description container space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$form = get_field('nomination_form');

?>
<section id="nominate" class="<?php echo $class ?>">
	<div class="st_gas_section_inner st_gas_description_inner">
		<div class="gas_section_left">
			<h2 class="title-3"><?php echo wp_kses_post( get_field('nomination_title') ); ?></h2>
		</div>
		<div class="gas_section_right">
			<?php

			// Check if a form is selected.
			if ($form) {
				// Display the form using the form ID.
				echo do_shortcode($form);
			}
			?>
		</div>
	</div>
</section>
