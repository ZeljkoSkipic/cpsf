<?php

$class = 'st_block st_grant_section st_grant_description space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<section id="description" class="<?php echo $class ?>">
	<div class="container st_grant_section_inner st_grant_description_inner">
		<div class="grant_section_left">
			<h2 class="title-3"><?php echo wp_kses_post( get_field('grant_description_title') ); ?></h2>
		</div>
		<div class="grant_section_right">
			<?php echo wp_kses_post( get_field('grant_description') ); ?>
		</div>
	</div>
</section>
