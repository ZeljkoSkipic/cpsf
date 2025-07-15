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
					<?php echo $accordion_title; ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
				</h3>
				<div class="st_accordion-body" style="<?php echo $display ?>">
					<?php echo $accordion_content; ?>
				</div>
			</div>

		<?php $item++;?>
		<?php endwhile; ?>
	</div>
</section>
