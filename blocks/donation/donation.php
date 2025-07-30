<?php

$padding = get_field_object('padding');

$class = 'st_block st_donation';
if (! empty($block['className'])) {
	$class .= ' ' . $block['className'];
}

$anchor = '';
if (! empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}


if (! empty($padding)) {
	$class .=  ' ' . $padding['value'];
}

$form = get_field('gravity_forms');

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<?php get_template_part('components/background'); ?>
	<div class="container">
		<div class="st_donation_intro">
			<div class="left">
				<?php get_template_part('components/intro'); ?>
			</div>
			<?php if(has_post_thumbnail()) { ?>
			<div class="right">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php } ?>
		</div>

		<?php if ($form): ?>

			<div class="st_donation_form">
				<?php echo do_shortcode('[gravityform id="' . $form . '" title="true"]'); ?>
			</div>

		<?php endif; ?>

	</div>
</section>
