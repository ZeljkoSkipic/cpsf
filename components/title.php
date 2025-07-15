<?php

$title = get_field('title');

if( $title ) { ?>
<h2 class="intro_title"><?php echo get_field('title'); ?></h2>
<?php }
