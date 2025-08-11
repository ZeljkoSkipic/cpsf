<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package stier
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function stier_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (! is_singular()) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter('body_class', 'stier_body_classes');

// Add a pingback url auto-discovery header for single posts, pages, or attachments.

function stier_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'stier_pingback_header');


// Login Screen

add_filter('login_headerurl', 'my_custom_login_url');
function my_custom_login_url($url)
{
	return '/';
}

function get_custom_logo_url()
{
	$custom_logo_id = get_theme_mod('custom_logo');
	$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

	if (has_custom_logo()) {
		return $logo[0];
	} else {
		return ''; // Return an empty string or a default logo URL if no custom logo is set
	}
}

function custom_login_logo()
{
	$logo_url = get_custom_logo_url();
	if ($logo_url != '') {
?>
		<style type="text/css">
			#login h1 a,
			.login h1 a {
				background-image: url(<?php echo esc_url($logo_url); ?>);

			}
		</style>
<?php
	}
}
add_action('login_enqueue_scripts', 'custom_login_logo');


// Make ACF Imposible to deactivate

add_filter('user_has_cap', 'prevent_plugin_deactivation', 10, 3);

function prevent_plugin_deactivation($allcaps, $cap, $args)
{
	$plugin_file = 'advanced-custom-fields-pro/acf.php';

	if (isset($args[2]) && $args[2] == $plugin_file) {
		if ($args[0] == 'deactivate_plugin') {
			$allcaps[$cap[0]] = false;
		}
	}
	return $allcaps;
}


// Admin footer modification

function dashboard_footer_admin()
{
	echo '<span id="footer-thankyou">Thank you for developing with <a href="https://stierdev.com/" target="_blank">S Tier Dev</a>. Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>.</span> ';
}

add_filter('admin_footer_text', 'dashboard_footer_admin');

// Settings pages

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title'    => 'Website Settings',
		'menu_title'    => 'Site Settings',
		'menu_slug'     => 'site-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false,
		'position' => '2.69',
		'icon_url'          => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIHZlcnNpb249IjEuMSI+CjxnIGlkPSJzdXJmYWNlMSI+CjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSAxLjU4MjAzMSA2LjE3OTY4OCBMIDEuNTgyMDMxIDEwLjc3MzQzOCBMIDEuNzIyNjU2IDEwLjc2NTYyNSBMIDEuODU5Mzc1IDEwLjc1MzkwNiBMIDEuODcxMDk0IDYuMzEyNSBMIDEuODc4OTA2IDEuODc4OTA2IEwgMTAuODA0Njg4IDEuODc4OTA2IEwgMTAuODA0Njg4IDEuNTgyMDMxIEwgMS41ODIwMzEgMS41ODIwMzEgWiBNIDEuNTgyMDMxIDYuMTc5Njg4ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gOS40ODQzNzUgNC42MTMyODEgQyA4LjI0NjA5NCA0LjczNDM3NSA3LjM0Mzc1IDUuMjEwOTM4IDYuODIwMzEyIDYuMDIzNDM4IEMgNi4zMzU5MzggNi43ODkwNjIgNi4zMzU5MzggOC4wODU5MzggNi44MjAzMTIgOC45MTc5NjkgQyA2Ljk3NjU2MiA5LjE4MzU5NCA3LjQxMDE1NiA5LjYwOTM3NSA3LjcxODc1IDkuODAwNzgxIEMgOC4wOTc2NTYgMTAuMDMxMjUgOC42NTIzNDQgMTAuMjYxNzE5IDkuNjgzNTk0IDEwLjYwMTU2MiBDIDExLjEyMTA5NCAxMS4wODIwMzEgMTEuNTM5MDYyIDExLjMxNjQwNiAxMS43NjU2MjUgMTEuNzg1MTU2IEMgMTEuODcxMDk0IDExLjk5NjA5NCAxMS44NzUgMTIuMDE1NjI1IDExLjg3NSAxMi40MTc5NjkgQyAxMS44NzUgMTIuOTAyMzQ0IDExLjgyNDIxOSAxMy4xMDE1NjIgMTEuNjM2NzE5IDEzLjM3MTA5NCBDIDExLjM5MDYyNSAxMy43MTg3NSAxMC45NTMxMjUgMTMuOTI5Njg4IDEwLjMwODU5NCAxNCBDIDEwLjExNzE4OCAxNC4wMjM0MzggOS44Mzk4NDQgMTQuMDI3MzQ0IDkuNjgzNTk0IDE0LjAxNTYyNSBDIDguOTIxODc1IDEzLjk1NzAzMSA3Ljk3NjU2MiAxMy42MjUgNy4zMzk4NDQgMTMuMTk5MjE5IEwgNy4xMTcxODggMTMuMDU0Njg4IEwgNi43NTM5MDYgMTMuNjU2MjUgTCA2LjM5NDUzMSAxNC4yNTc4MTIgTCA2LjUxNTYyNSAxNC4zNjMyODEgQyA2Ljk3NjU2MiAxNC43NzM0MzggNy44MzIwMzEgMTUuMTQ0NTMxIDguNzM0Mzc1IDE1LjMzNTkzOCBDIDkuMjg5MDYyIDE1LjQ1MzEyNSAxMC4yMTg3NSAxNS40ODA0NjkgMTAuNzY1NjI1IDE1LjQwMjM0NCBDIDExLjc3MzQzOCAxNS4yNTM5MDYgMTIuNTkzNzUgMTQuODU1NDY5IDEzLjA2NjQwNiAxNC4yOTI5NjkgQyAxMy4yNTM5MDYgMTQuMDYyNSAxMy40ODgyODEgMTMuNTg1OTM4IDEzLjU3MDMxMiAxMy4yNjU2MjUgQyAxMy42OTE0MDYgMTIuNzczNDM4IDEzLjY4NzUgMTIuMDYyNSAxMy41NTQ2ODggMTEuNTQ2ODc1IEMgMTMuMzI4MTI1IDEwLjY3MTg3NSAxMi44MDg1OTQgMTAuMTQ0NTMxIDExLjY5NTMxMiA5LjY0ODQzOCBDIDExLjQ5MjE4OCA5LjU1NDY4OCAxMC44ODY3MTkgOS4zMzU5MzggMTAuMzUxNTYyIDkuMTUyMzQ0IEMgOS4wMzUxNTYgOC43MTA5MzggOC42MjEwOTQgOC40OTYwOTQgOC4zOTg0MzggOC4xNDQ1MzEgQyA4LjIwNzAzMSA3Ljg0NzY1NiA4LjE3OTY4OCA3LjE1NjI1IDguMzQzNzUgNi44MzU5MzggQyA4LjcwMzEyNSA2LjEyNSA5Ljk4NDM3NSA1LjgzMjAzMSAxMS4zMTI1IDYuMTY0MDYyIEMgMTEuNjQwNjI1IDYuMjQ2MDk0IDEyLjI0NjA5NCA2LjUzOTA2MiAxMi40NjQ4NDQgNi43MTQ4NDQgQyAxMi41NTA3ODEgNi43OTI5NjkgMTIuNjM2NzE5IDYuODUxNTYyIDEyLjY1MjM0NCA2Ljg1MTU2MiBDIDEyLjY2NDA2MiA2Ljg1MTU2MiAxMi44NTE1NjIgNi42MjUgMTMuMDYyNSA2LjM0NzY1NiBDIDEzLjI3MzQzOCA2LjA3NDIxOSAxMy40NjA5MzggNS44MjgxMjUgMTMuNDgwNDY5IDUuODA0Njg4IEMgMTMuNTU4NTk0IDUuNzA3MDMxIDEyLjc5Mjk2OSA1LjE0NDUzMSAxMi4zNTE1NjIgNC45NzY1NjIgQyAxMS41NjY0MDYgNC42NzU3ODEgMTAuNDAyMzQ0IDQuNTI3MzQ0IDkuNDg0Mzc1IDQuNjEzMjgxIFogTSA5LjQ4NDM3NSA0LjYxMzI4MSAiLz4KPHBhdGggc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigwJSwwJSwwJSk7ZmlsbC1vcGFjaXR5OjE7IiBkPSJNIDE4LjE0ODQzOCAxMy43MDMxMjUgTCAxOC4xNDg0MzggMTguMTQ4NDM4IEwgOS4yMjI2NTYgMTguMTQ4NDM4IEwgOS4yMjI2NTYgMTguNDQ1MzEyIEwgMTguNDQ1MzEyIDE4LjQ0NTMxMiBMIDE4LjQ0NTMxMiA5LjI1MzkwNiBMIDE4LjE0ODQzOCA5LjI1MzkwNiBaIE0gMTguMTQ4NDM4IDEzLjcwMzEyNSAiLz4KPC9nPgo8L3N2Zz4K'
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'site-general-settings',
	));
	acf_add_options_page( array(
		'page_title' => 'Mega menu',
		'menu_slug' => 'mega-menu',
		'parent_slug' => 'themes.php',
		'position' => '',
		'redirect' => false,
	));
}


// Block Category and placement of it

add_filter('block_categories_all', 'stier_block_category');

function stier_block_category($cats)
{

	// create a new array element with anything as its index
	$new = array(
		'cpsf_block_cat' => array(
			'slug'  => 'cpsf',
			'title' => 'CPSF'
		)
	);
	$new2 = array(
		'cpsf_grant' => array(
			'slug'  => 'cpsf-grant',
			'title' => 'Grant/Awards/Scholarships'
		)
	);
	$position = 0.1; //

	$cats = array_slice($cats, 0, $position, true) + $new + $new2  + array_slice($cats, $position, null, true);

	// reset array indexes
	$cats = array_values($cats);

	return $cats;
}

// Get forms from Gravity Form Plugin

function getGravityForms()
{
	global $wpdb;
	$table = $wpdb->prefix . 'gf_form';
	$sql = $wpdb->prepare("SELECT id,title FROM $table");
	return  $wpdb->get_results($sql);
}

// Get form meta Gravity form plugin

function GetGravityFormMetas($formID)
{
	global $wpdb;
	$table = $wpdb->prefix . 'gf_form_meta';
	$sql = $wpdb->prepare("SELECT display_meta FROM $table WHERE form_id=" . $formID);

	$results = $wpdb->get_results($sql);

	if(is_array($results) && !empty($results)) {
		return json_decode($results[0]->display_meta);
	}

	return null;

}

function acf_populate_gravity_forms($field)
{


	$field['choices'] = array();
	$forms = getGravityForms();

	if (is_array($forms)) {
		foreach ($forms as $form) {
			$field['choices'][$form->id] = $form->title;
		}
	}

	return $field;
}

add_filter('acf/load_field/name=gravity_forms',  'acf_populate_gravity_forms');

// Blocks

add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{
	register_block_type(__DIR__ . '/../blocks/home-hero');
	register_block_type(__DIR__ . '/../blocks/info-boxes');
	register_block_type(__DIR__ . '/../blocks/testimonial');
	register_block_type(__DIR__ . '/../blocks/featured-event');
	register_block_type(__DIR__ . '/../blocks/counters');
	register_block_type(__DIR__ . '/../blocks/featured-campaign-cta');
	register_block_type(__DIR__ . '/../blocks/instagram');
	register_block_type(__DIR__ . '/../blocks/cta');
	register_block_type(__DIR__ . '/../blocks/inner-hero');
	register_block_type(__DIR__ . '/../blocks/inner-hero-alt');
	register_block_type(__DIR__ . '/../blocks/advanced-section');
	register_block_type(__DIR__ . '/../blocks/ways-to-give');
	register_block_type(__DIR__ . '/../blocks/logos');
	register_block_type(__DIR__ . '/../blocks/donation');
	register_block_type(__DIR__ . '/../blocks/featured-campaign');
	register_block_type(__DIR__ . '/../blocks/campaign');
	register_block_type(__DIR__ . '/../blocks/page-intro');
	register_block_type(__DIR__ . '/../blocks/short-banner');
	register_block_type(__DIR__ . '/../blocks/team');
	register_block_type(__DIR__ . '/../blocks/partner-with-us');

	register_block_type(__DIR__ . '/../blocks/gas/grant-hero');
	register_block_type(__DIR__ . '/../blocks/gas/grant-anchors');
	register_block_type(__DIR__ . '/../blocks/gas/grant-description');
	register_block_type(__DIR__ . '/../blocks/gas/grant-report');
	register_block_type(__DIR__ . '/../blocks/gas/grant-resources');
	register_block_type(__DIR__ . '/../blocks/gas/nominate');
	register_block_type(__DIR__ . '/../blocks/gas/past-grant-winners');
	register_block_type(__DIR__ . '/../blocks/gas/past-award-winners');

	register_block_type(__DIR__ . '/../blocks/accordion');
	register_block_type(__DIR__ . '/../blocks/tabs');
	register_block_type(__DIR__ . '/../blocks/basic-section');
	register_block_type(__DIR__ . '/../blocks/contact');
	register_block_type(__DIR__ . '/../blocks/carousel');
}
