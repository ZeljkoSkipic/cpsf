<?php

$padding = get_field_object('padding');

$class = 'st_block st_inner_hero';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}


if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}


$title = get_field('title');
$text = get_field('text');

$btn_choice = get_field_object('button_style');
$btn_style = 'btn-1';

if ( !empty($btn_choice) ) {
    $btn_style = $btn_choice['value'];
}


?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_inner_hero_inner container">
		<div class="left">
			<h1 class="page-title">
				<?php if($title) {
					echo $title;
				} else {
					the_title();
				} ?>
			</h1>
			<div class="intro_text">
				<?php echo $text; ?>
			</div>
			<?php
			$button = get_field('button');
			if( $button ):
				$link_url = $button['url'];
				$link_title = $button['title'];
				$link_target = $button['target'] ? $button['target'] : '_self';
				?>
				<a class="<?php echo $btn_style; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
		<div class="right">
			<?php the_post_thumbnail(); ?>
		</div>
	</div>
</section>
