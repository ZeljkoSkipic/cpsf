<?php

$padding = get_field_object('padding');

$class = 'st_block st_campaign';
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

$title = get_field('title');
$description = get_field('description');
$quote = get_field('quote');
$quote_person = get_field('quote_person');

$form = get_field('gravity_forms');
$goal = get_field('form_goal');
$meta_fields = GetGravityFormMetas($form['value'] ?? "");
$total_field_id = "";
$total_donations = 0;
$total_donation_amount = 0;

if ($meta_fields) {
	foreach ($meta_fields->fields as $field) {
		if ($field->type === 'total') {
			$total_field_id = $field->id;
			break;
		}
	}
}

if ($form && $total_field_id) {
	$donations = GFAPI::get_entries($form, ['status' => 'active']);
	if ($donations) {
		$total_donations = count($donations);
		$total_donation_amount = array_reduce($donations, function ($carry, $donation) use ($total_field_id) {
			return $carry + (float) $donation[$total_field_id];
		}, 0);
	}
}

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<p class="prefix"><?php echo wp_kses_post(get_field('prefix')); ?></p>
		<h1 class="gas_title page-title">
			<?php if ($title) {
				echo $title;
			} else { ?>
				Support <?php the_title(); ?> Today
			<?php } ?>
		</h1>
		<div class="st_campaign_inner">
			<div class="st_campaign_left">
				<?php the_post_thumbnail(); ?>

				<?php if ($description) { ?>
					<h2 class="campaign_subtitle">Description</h2>
					<?php echo $description; ?>
				<?php } ?>

				<?php if ($quote) { ?>
					<blockquote>
						<?php echo $quote; ?>
						<?php if ($quote_person) { ?>
							<p class="quote_person">
								- <?php echo $quote_person; ?>
							</p>
						<?php } ?>
					</blockquote>
				<?php } ?>
				<?php
				$images = get_field('sponsor_logos');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if ($images): ?>
					<div class="campaign_sponsors">
						<h2 class="campaign_subtitle">Thanks to these sponsors</h2>
						<div class="campaign_sponsors_logos">
							<?php foreach ($images as $image_id): ?>
								<?php echo wp_get_attachment_image($image_id, $size); ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
			<div class="st_campaign_right">
				<div class="st_campaign_stats">
					<div class="stats_top">
						<div class="raised">
							<?php echo '$' . number_format($total_donation_amount, 0, ','); ?>
							<span class="prefix"><?php esc_html_e('Raised', 'cpsf'); ?></span>
						</div>
						<div class="donations">
							<?php echo $total_donations; ?>
							<span class="prefix"><?php esc_html_e('Donations', 'cpsf'); ?></span>
						</div>

						<?php if ($goal): ?>

							<div class="goal">
							<?php echo $goal ? '$' . number_format($goal, 0, '.', ',') : '$0' ?>
								<span class="prefix"><?php esc_html_e('Goal', 'cpsf'); ?></span>
							</div>

						<?php endif; ?>

					</div>

					<?php if ($form && $goal && $total_field_id): ?>

						<div class="bar">
							<?php echo do_shortcode('[gravityforms id="' . $form['value'] . '" action="meter" field="' . $total_field_id . '"  count_label="US $%d ' . __('amount', 'cpsf') . '" goal_label="US $%d ' . __('amount', 'cpsf') . '" goal="' . $goal . '"]'); ?>
						</div>

					<?php endif; ?>

					<?php
					$button = get_field('button');
					if ($button):
						$link_url = $button['url'];
						$link_title = $button['title'];
						$link_target = $button['target'] ? $button['target'] : '_self';
					?>
						<a class="btn-1 campaign_btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
					<?php endif; ?>
					<div class="badge">
						<svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M7 0.25C5.83968 0.25 4.72688 0.710936 3.90641 1.53141C3.08594 2.35188 2.625 3.46468 2.625 4.625V7.125C1.96196 7.125 1.32607 7.38839 0.857233 7.85723C0.388392 8.32607 0.125 8.96196 0.125 9.625V15.25C0.125 15.913 0.388392 16.5489 0.857233 17.0178C1.32607 17.4866 1.96196 17.75 2.625 17.75H11.375C12.038 17.75 12.6739 17.4866 13.1428 17.0178C13.6116 16.5489 13.875 15.913 13.875 15.25V9.625C13.875 8.96196 13.6116 8.32607 13.1428 7.85723C12.6739 7.38839 12.038 7.125 11.375 7.125V4.625C11.375 2.20833 9.41667 0.25 7 0.25ZM10.125 7.125V4.625C10.125 3.7962 9.79576 3.00134 9.20971 2.41529C8.62366 1.82924 7.8288 1.5 7 1.5C6.1712 1.5 5.37634 1.82924 4.79029 2.41529C4.20424 3.00134 3.875 3.7962 3.875 4.625V7.125H10.125Z" fill="#71BC59" />
						</svg>
						100% Secure Donation
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
