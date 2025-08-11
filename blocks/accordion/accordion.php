<?php

$padding = get_field_object('padding');

$anchor = 'st_accordion';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_accordion';
if ( ! empty( $block['className'] ) ) {
	$class .= ' ' . $block['className'];
}

if ( ! empty( $padding) ) {
	$class .=  ' ' . $padding['value'];
}

?>
<section id="<?php echo $anchor; ?>" class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="st_accordion_inner container">
	<?php get_template_part('components/intro');

		$item=1;?>
		<?php while( have_rows('accordion') ) : the_row();

		$accordion_title = get_sub_field('title');
		$accordion_content = get_sub_field('content');

		if($item == 1 && get_field('first_open') ){

			$open = 'open';
			$display = 'display: block';

			}else{
				$open = '';
				$display = 'display: none';
			}
			?>
			<div class="st_accordion-item <?php echo $open ?>">
				<h3 class="st_accordion-header">
					<?php echo $accordion_title; ?>
					<svg class="closed_icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 1.5V16.5M16.5 9H1.5" stroke="#29353B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					<svg class="open_icon" width="16" height="2" viewBox="0 0 16 2" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1H15" stroke="#29353B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</h3>
				<div class="st_accordion-body" style="<?php echo $display ?>">
					<?php echo $accordion_content; ?>
					<?php
					$toggle_button = get_sub_field('toggle_button');
					if( $toggle_button ):
						$tb_url = $toggle_button['url'];
						$tb_title = $toggle_button['title'];
						$tb_target = $toggle_button['target'] ? $toggle_button['target'] : '_self';
						?>
						<a class="btn-1" href="<?php echo esc_url( $tb_url ); ?>" target="<?php echo esc_attr( $tb_target ); ?>"><?php echo esc_html( $tb_title ); ?></a>
					<?php endif; ?>
				</div>
			</div>

		<?php $item++;?>
		<?php endwhile; ?>
	</div>
</section>
