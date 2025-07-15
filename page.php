<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>

	<main id="primary" class="site-main">
		<article>
			<?php the_content(); ?>
		</article>

	</main><!-- #main -->

<?php
get_footer();
