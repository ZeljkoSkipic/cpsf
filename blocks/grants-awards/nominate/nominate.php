<?php

$class = 'st_block st_grant_section st_grant_description space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$form = get_field('nomination_form');

?>
<section id="nominate" class="<?php echo $class ?>">
	<div class="container st_grant_section_inner st_grant_description_inner">
		<div class="grant_section_left">
			<h2 class="title-3"><?php echo wp_kses_post( get_field('nomination_title') ); ?></h2>
		</div>
		<div class="grant_section_right">
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
