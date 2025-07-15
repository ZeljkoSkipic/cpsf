<?php
$title = get_the_title();
$image = get_the_post_thumbnail(get_the_id(), 'large');
$excerpt = get_the_excerpt();


?>

<article class="grid_item">
    <figure class="gi_image">
        <?php if ($image) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php echo $image; ?>
            </a>
        <?php endif; ?>
	</figure>

    <?php if ($title) : ?>
		<h2 class="gi_title">
			<a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
		</h2>
    <?php endif; ?>
    <?php if ($excerpt) :
         if (strlen($excerpt) <= 100){
            // Outputs the whole post content
           $trimmed_excerpt = $excerpt;
        }else{
            $trimmed_excerpt = substr($excerpt, 0, strpos($excerpt, ' ', 60));
            $trimmed_excerpt.="...";
        }
          ?>
        <div class="entry-content"> <?php echo $trimmed_excerpt;  ?> </div>
		<a href="<?php get_the_permalink(); ?>">Read More</a>
    <?php endif; ?>

</article>
