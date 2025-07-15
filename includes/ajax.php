<?php

add_action('wp_ajax_get_campaign_forms', 'acf_populate_campaign_forms');

function acf_populate_campaign_forms()
{
	$campaignID = sanitize_text_field($_POST['campaignID'] ?? '');
	$pageID = sanitize_text_field($_POST['pageID'] ?? '');
	$block_position = sanitize_text_field($_POST['blockPosition'] ?? '');

	if ($campaignID && $pageID && $block_position) {
		$data = [];
		$forms = getCampaignsForms($campaignID);
		$blocks = parse_blocks(get_post_field('post_content', $pageID));
		$cleaned_blocks = array_values(array_filter($blocks, function ($block) {
			return !empty($block['blockName']);
		}));

		if ($cleaned_blocks) {
			foreach ($cleaned_blocks as $position => $block) {

				if ($position == $block_position) {
					$selected_value = isset($block['attrs']['data']['forms']) ? $block['attrs']['data']['forms'] : "";
				}
			}
		}

		if ($forms) {
			foreach ($forms as $form) {
				$formPost = get_post($form->form_id);
				$data[$form->form_id]['label'] = $formPost->post_title;
				$data[$form->form_id]['selected'] = $selected_value === $form->form_id;
			}
		}

		wp_send_json_success($data);
	}

	wp_send_json_error(null, 422);

	wp_die();
}
