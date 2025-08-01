<?php

/**
 * stier functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package s-tier
 */


// Sets up theme defaults and registers support for various WordPress features.


function stier_setup()
{

	// Make theme available for translation.

	load_theme_textdomain('stier', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages.

	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main' => esc_html__('Primary', 'stier'),
			'contribute' => esc_html__('Contribute', 'stier'),
			'grants' => esc_html__('Grants & Scholarship', 'stier'),
			'other' => esc_html__('Other', 'stier'),
			'forms' => esc_html__('Forms', 'stier'),
			'tos' => esc_html__('Footer Bottom', 'stier'),
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Add support for core custom logo.

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 70,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'stier_setup');

// Enqueue scripts and styles.

function stier_scripts()
{
	$css_cache_buster = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/dist/theme.min.css'));
	$js_cache_buster = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/dist/theme.min.js'));

	wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/dist/theme.min.css', array(), $css_cache_buster, 'all');
	wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/dist/theme.min.js', array('jquery'), $js_cache_buster);

	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/dist/vendor/fancybox.js', array(), '6.0.4');
	wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/assets/dist/vendor/fancybox.css', array(), '6.0.4');

	wp_enqueue_style('stier-style', get_stylesheet_uri(), array(), '1.0.0');

	wp_localize_script('theme-script', 'theme', [
		'ajaxUrl' 	=> admin_url('admin-ajax.php'),
		'nonce'	  	=> wp_create_nonce('security'),
		'themeUrl'	=> get_template_directory_uri()
	]);
}
add_action('wp_enqueue_scripts', 'stier_scripts');

// Login Styles
function stier_login_styles()
{
	wp_enqueue_style('login-style', get_template_directory_uri() . '/assets/dist/wp-login.css');
}
add_action('login_head', 'stier_login_styles');

// Admin Styles
function stier_admin_styles()
{
	wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/dist/admin.min.css');
}

add_action('admin_enqueue_scripts', 'stier_admin_styles');


// Include Custom Menu Walker
require get_template_directory() . '/includes/custom-menu-walker.php';


// Custom template tags for this theme.

require get_template_directory() . '/includes/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.

require get_template_directory() . '/includes/template-functions.php';

// Customizer additions.

require get_template_directory() . '/includes/customizer.php';

// Ajax calls.

require get_template_directory() . '/includes/ajax.php';


// Remove Comments

add_action('admin_init', function () {
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url());
		exit;
	}

	// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});

add_filter( 'gform_disable_css', '__return_true' );

/* Change Gravity Forms default ajax spinner */
add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
    // Your custom ajax spinner URL here
    return  '/wp-content/themes/cpsf/assets/icons/loader.svg';
}
