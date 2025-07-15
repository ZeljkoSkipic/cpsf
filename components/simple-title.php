<?php

$title = get_field('title'); ?>

<h1 class="grants_title page-title">
	<?php if($title) {
		echo $title;
	} else {
		the_title();
	} ?>
</h1>
