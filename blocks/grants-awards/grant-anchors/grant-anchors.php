<?php

$padding = get_field_object('padding');

$class = 'st_block st_grant_anchors';
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

 ?>
<section <?php echo $anchor; ?> class="<?php echo $class ?>">
	<div class="container st_grant_anchors_inner">
		<?php
			$grant_anchor_links = get_field('grant_anchor_links');
			if( $grant_anchor_links ): ?>
				<?php foreach( $grant_anchor_links as $anchor_link ): ?>
					<a class="<?php echo $anchor_link['value']; ?>" href="#<?php echo $anchor_link['value']; ?>"><?php echo $anchor_link['label']; ?></a>
				<?php endforeach; ?>
		<?php endif; ?>
	</div>
</section>
