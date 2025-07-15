<?php

$class = 'st_block st_grant_section st_grant_report space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<section id="report" class="<?php echo $class ?>">
	<div class="container st_grant_section_inner st_grant_report_inner">
		<div class="grant_section_left">
			<h2 class="title-3">Report</h2>
		</div>
		<div class="grant_section_right">
			<?php echo wp_kses_post( get_field('grant_report_text') ); ?>
			<?php
			$gr_button = get_field('gr_button');
			if( $gr_button ):
				$link_url = $gr_button['url'];
				$link_title = $gr_button['title'];
				$link_target = $gr_button['target'] ? $gr_button['target'] : '_self';
				?>
				<a class="btn-3 gr_button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
