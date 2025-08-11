<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>

<main id="primary" class="site-main container">
	<article class="post_main space_2">
		<header>
		<?php
			the_title( '<h1>', '</h1>' ); ?>
			<time> <?php echo get_the_date(); ?> </time>
			<?php the_post_thumbnail();

			?>
		</header>

		<?php the_content(); ?>
	</article>


</main><!-- #main -->

<?php
get_footer();
