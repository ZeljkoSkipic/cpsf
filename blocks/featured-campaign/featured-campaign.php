<?php

$class = 'st_block st_featured_campaign space_2';
if (! empty($block['className'])) {
	$class .= ' ' . $block['className'];
}

$anchor = '';
if (! empty($block['anchor'])) {
	$anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Get the featured campaign from ACF relationship field
$featured_campaign = get_field('featured_campaign');
$formID = get_field('forms');

// Form fields

$builder_settings = json_decode(getCampaignsFormsMeta($formID, 'formBuilderSettings'));


// Campaign fields
$campaign_id = $featured_campaign;
$campaign = getCampaign($campaign_id);
$campaign_title = $campaign->campaign_title;
$campaign_content = $campaign->short_desc;
$campaign_image = $campaign->campaign_image;
$goal_type_campaign = $campaign->goal_type;
$goal_campaign = $campaign->campaign_goal;


$goal = $builder_settings->goalSource === 'campaign' ? $goal_campaign : $builder_settings->goalAmount;
$type = $builder_settings->goalSource === 'campaign' ? $goal_type_campaign : $builder_settings->goalType;

$amount = 0;
$donations = 0;
$donors = 0;

if ($builder_settings->goalSource === 'campaign') {
	$forms = (array) getCampaignsForms($featured_campaign);

	$formsIDs = array_map(function ($form) {
		return (int) $form->form_id;
	}, $forms);

	$donors = getDonorsCount($formsIDs);

	foreach ($forms as $form) {
		$amount += (float) getCampaignsFormsMeta($form->form_id, '_give_form_earnings');
		$donations += (float) getCampaignsFormsMeta($form->form_id, '_give_form_sales');
	}
} else {
	$amount = getCampaignsFormsMeta($formID, '_give_form_earnings');
	$donations = getCampaignsFormsMeta($formID, '_give_form_sales');
	$donors = getDonorsCount([$formID]);
}

?>
<section <?php echo $anchor; ?> class="<?php echo esc_attr($class); ?>">
	<div class="container st_featured_campaign_inner">
		<div class="fc_left">
			<span class="prefix"><?php esc_html_e('Featured campaign', 'cpsf'); ?></span>
			<h2 class="title-2">Support <?php echo esc_html($campaign_title); ?> Today</h2>
			<div class="campaign_text">
				<?php echo wp_kses_post($campaign_content); ?>
			</div>
			<div class="featured_campaign_bottom">
				<a class="btn-1" href="#" target="_blank"><?php esc_html_e('Donate Now', 'cpsf'); ?></a>
			</div>
		</div>
		<div class="fc_right">

			<?php if ($campaign_image): ?>

				<img src="<?php echo $campaign_image; ?>" alt="Campaign Image">

			<?php endif; ?>

			<div class="goal">
				<div class="goal-details">
					<div class="goal-details-amount">
						<span class="goal-details-current">
							<?php echo format_current($type, $amount, $donations, $donors) ?>
						</span>
						<span class="goal-details-total">
							<?php format_goal($type, $goal); ?>
						</span>
					</div>
				</div>

				<div class="goal-bar">
					<div style="height:10px; width:<?php echo progress_bar($type, $goal, $amount, $donations, $donors) . "%"; ?>" class="goal-progress">

					</div>
				</div>

			</div>
		</div>
	</div>
</section>
