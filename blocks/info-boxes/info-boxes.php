<?php
$cols = get_field_object('columns');
$tab_cols = get_field_object('tab_columns');
$mob_cols = get_field_object('mob_columns');

$padding = get_field_object('padding');
$style = get_field_object('ib_style');

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'st_block st_info_boxes';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

if ( ! empty( $cols ) ) {
    $class .=  ' ' . $cols['value'];
}
if ( ! empty( $tab_cols ) ) {
    $class .=  ' ' . $tab_cols['value'];
}
if ( ! empty( $mob_cols ) ) {
    $class .=  ' ' . $mob_cols['value'];
}

if ( ! empty( $padding) ) {
    $class .=  ' ' . $padding['value'];
}

if ( ! empty( $style ) ) {
    $class .=  ' ' . $style['value'];
}

?>

<section <?php echo $anchor; ?> class="<?php echo $class ?>">
<?php get_template_part('components/background'); ?>
	<div class="container">
		<?php get_template_part('components/intro'); ?>
        <div class="st_info_boxes_inner">
        <?php
            // Columns repeater
            if( have_rows('info_boxes') ):

                while( have_rows('info_boxes') ) : the_row();

				$title = get_sub_field('title');
                $text = get_sub_field('text');
				$ib_image = get_sub_field('ib_image');
				$icon = get_sub_field('icons_test');
                $size = 'full'; ?>

                <div class="st_col column">
					<?php
					if( $ib_image ) { ?>
					<figure class="ib_image">
						<?php echo wp_get_attachment_image( $ib_image, $size, "", array( "class" => "ib_image" ) ); ?>
					</figure>

					<?php } else { ?>
						<figure class="ib_icon">
							<?php echo $icon; ?>
						</figure>
					<?php }
					if( $icon ) {

					} ?>
                   <h3 class="st_col_title title-3"><?php echo $title; ?></h3>
                    <div class="st_col_text">
                        <?php echo $text; ?>
                    </div>
                    <?php get_template_part('components/inner-buttons'); ?>
                </div>
                <?php endwhile;
            endif; ?>
        </div>
		<?php
		$button_after_boxes = get_field('button_after_boxes');
		if( $button_after_boxes ):
			$link_url = $button_after_boxes['url'];
			$link_title = $button_after_boxes['title'];
			$link_target = $button_after_boxes['target'] ? $button_after_boxes['target'] : '_self';
			?>
			<a class="button_after_boxes btn-3" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
</section>
