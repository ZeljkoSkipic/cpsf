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
