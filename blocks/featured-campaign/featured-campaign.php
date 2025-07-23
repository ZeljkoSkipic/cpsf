<?php

$class = 'st_block st_featured_campaign space_2';
if (! empty($block['className'])) {
	$class .= ' ' . $block['className'];
}

$anchor = '';
if (! empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$image = get_field('image');
$form = get_field('gravity_forms');
$meta_fields = GetGravityFormMetas($form['value']);
$goal = get_field('form_goal');
$goal_type = get_field('goal_type');
$total_field_id = "";
$button = get_field('button_url');

if ($meta_fields) {
	foreach ($meta_fields->fields as $field) {
		if ($field->type === 'total') {
			$total_field_id = $field->id;
			break;
		}
	}
}
?>
<section <?php echo $anchor; ?> class="<?php echo esc_attr($class); ?>">
	<div class="container st_featured_campaign_inner">
		<div class="fc_left">
			<span class="prefix"><?php esc_html_e('Featured campaign', 'cpsf'); ?></span>
			<h2 class="title-2">Support <?php echo esc_html($form['label']); ?> Today</h2>
			<div class="campaign_text">
				<?php echo wp_kses_post($meta_fields->description); ?>
			</div>

			<?php if ($button): ?>
				<div class="featured_campaign_bottom">
					<a class="btn-1" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
						<?php echo esc_html($button['title']); ?>
					</a>
				</div>
			<?php endif; ?>


		</div>
		<div class="fc_right">

			<?php if ($image):
				echo wp_get_attachment_image($image, 'large');
			endif;
			?>

			<?php


			if ($goal && $goal_type === 'total_amount') {
				echo do_shortcode('[gravityforms id="' . $form['value'] . '" action="meter" field="' . $total_field_id . '"  count_label="$%d" goal_label="Goal $%d" goal="' . $goal . '"]');
			}

			if ($goal && $goal_type === 'donations') {
				echo do_shortcode('[gravityforms id="' . $form['value'] . '" action="meter"  count_label="Donations %d" goal_label="Goal %d" goal="' . $goal . '"]');
			}
			?>
		</div>
	</div>
</section>