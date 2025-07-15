<?php
$use_bg = get_field('use_background');
$bg_color = get_field('background_color');
$bg_img = get_field('background_image');
$bg_img_mob = get_field('background_image_mob');
$size = 'full';
?>
<?php if($use_bg) { ?>
<div class="block_bg" style="background-color: <?php echo $bg_color; ?>">
<?php
if( $bg_img ) {
    echo wp_get_attachment_image( $bg_img, $size, "",array( 'class' => 'bg_img desk_bg' ) );
}
if( $bg_img_mob ) {
    echo wp_get_attachment_image( $bg_img_mob, $size, "",array( 'class' => 'bg_img mob_bg' ) );
}

?>

</div>
<?php } ?>
