<?php

$class = 'st_block st_home_hero space_1';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$VimeoVideoId = get_field('video_id');

?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container">
		<h1 class="title-1"><?php echo wp_kses_post( get_field('title') ); ?></h1>
		<div class="home_hero_text">
			<?php echo wp_kses_post( get_field('text') ); ?>
		</div>
		<?php
		$button = get_field('button');
		if( $button ):
			$link_url = $button['url'];
			$link_title = $button['title'];
			$link_target = $button['target'] ? $button['target'] : '_self';
			?>
			<a class="btn-1" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
		<?php

		if( have_rows('checkmarks') ): ?>
			<ul class="checkmarks space_1">
			<?php while( have_rows('checkmarks') ) : the_row(); ?>

				<?php
				$checkmark = get_sub_field('checkmark'); ?>
				<li>
					<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.21875 12.5C0.21875 5.99312 5.49312 0.71875 12 0.71875C18.5069 0.71875 23.7812 5.99312 23.7812 12.5C23.7812 19.0069 18.5069 24.2812 12 24.2812C5.49312 24.2812 0.21875 19.0069 0.21875 12.5ZM16.3621 10.3081C16.4346 10.2115 16.487 10.1014 16.5164 9.98419C16.5457 9.86702 16.5513 9.74517 16.5329 9.6258C16.5145 9.50643 16.4723 9.39195 16.409 9.28909C16.3457 9.18623 16.2625 9.09706 16.1642 9.02683C16.066 8.95659 15.9547 8.90671 15.8368 8.88011C15.719 8.85351 15.5971 8.85073 15.4782 8.87193C15.3593 8.89314 15.2458 8.9379 15.1444 9.00358C15.0431 9.06926 14.9558 9.15455 14.8879 9.25442L10.9778 14.7282L9.01542 12.7658C8.84362 12.6058 8.6164 12.5186 8.38162 12.5227C8.14684 12.5269 7.92283 12.622 7.75679 12.788C7.59075 12.9541 7.49564 13.1781 7.4915 13.4129C7.48735 13.6476 7.5745 13.8749 7.73458 14.0467L10.4533 16.7654C10.5464 16.8584 10.6585 16.93 10.782 16.9752C10.9055 17.0205 11.0373 17.0384 11.1684 17.0275C11.2994 17.0167 11.4266 16.9775 11.541 16.9127C11.6554 16.8478 11.7543 16.7588 11.8308 16.6518L16.3621 10.3081Z" fill="#CCD4D6"/></svg>
					<?php echo $checkmark; ?>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>

	<div class="home_hero_video c-wide">
		<a href="https://vimeo.com/<?php echo $VimeoVideoId ?>" aria-label="Watch Video" data-fancybox>
			<div class="play-overlay">
				<svg width="98" height="98" viewBox="0 0 98 98" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 49C0.25 22.075 22.075 0.25 49 0.25C75.925 0.25 97.75 22.075 97.75 49C97.75 75.925 75.925 97.75 49 97.75C22.075 97.75 0.25 75.925 0.25 49ZM70.37 44.085C71.2459 44.5725 71.9755 45.2852 72.4836 46.1493C72.9916 47.0134 73.2594 47.9976 73.2594 49C73.2594 50.0024 72.9916 50.9866 72.4836 51.8507C71.9755 52.7148 71.2459 53.4275 70.37 53.915L42.355 69.48C41.4989 69.9552 40.5337 70.1987 39.5547 70.1865C38.5757 70.1742 37.6168 69.9066 36.7729 69.4102C35.929 68.9138 35.2293 68.2056 34.743 67.3559C34.2566 66.5061 34.0005 65.5441 34 64.565V33.435C34 29.15 38.605 26.435 42.355 28.52L70.37 44.085Z" fill="white"/></svg>
			</div>
			<?php
				$placeholder_image = get_field('placeholder_image');
				$size = 'full';
				if( $placeholder_image ) {
					echo wp_get_attachment_image( $placeholder_image, $size, "", array( "class" => "placeholder_image" ) );
			} ?>
		</a>
	</div>
</section>

<script>
Fancybox.bind("[data-fancybox]", {
  Carousel: {
    Video: {
      autoplay: true,
    },
  },
});
</script>
