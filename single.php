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
<?php
while ( have_posts() ) :
the_post(); ?>
<main id="primary" class="site-main container">
	<article class="post_main">
		<?php
		the_title( '<h1 class="title-1">', '</h1>' );
		echo wp_kses_post( get_field('intro') );
		echo get_the_date();
		the_content(); ?>
	</article>
	<aside class="post_sidebar">
		This is a post sidebar
	</aside>

</main><!-- #main -->

<div class="container">
	<?php the_post_navigation(
		array(
			'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'stier' ) . '</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'stier' ) . '</span> <span class="nav-title">%title</span>',
		)
	);
	endwhile; // End of the loop.
	?>
</div>

<?php
get_footer();
