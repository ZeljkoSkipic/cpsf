<?php

$class = 'st_block st_gas_section st_gas_resources container space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<section id="resources" class="<?php echo $class ?>">
	<div class="st_gas_section_inner st_gas_resources_inner">
		<div class="gas_section_left">
			<h2 class="title-3">Resources</h2>
		</div>
		<div class="gas_section_right">
			<?php echo wp_kses_post( get_field('grant_resources_text') ); ?>
			<?php

			if( have_rows('resources') ): ?>

				<?php while( have_rows('resources') ) : the_row(); ?>

					<?php
					$file = get_sub_field('resource');
					if( $file ):
						// Get file extension
						$file_ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
						// Convert to uppercase for display
						$file_type = strtoupper($file_ext);
						// Get the display name - use title if available, otherwise use filename
    					$display_name = !empty($file['title']) ? $file['title'] : $file['filename'];
					?>
						<div class="gas_resource">
							<div class="resource_info">
								<svg width="28" height="36" viewBox="0 0 28 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.5 21.75V17.375C26.5 15.8832 25.9074 14.4524 24.8525 13.3975C23.7976 12.3426 22.3668 11.75 20.875 11.75H18.375C17.8777 11.75 17.4008 11.5525 17.0492 11.2008C16.6975 10.8492 16.5 10.3723 16.5 9.875V7.375C16.5 5.88316 15.9074 4.45242 14.8525 3.39752C13.7976 2.34263 12.3668 1.75 10.875 1.75H7.75M7.75 23H20.25M7.75 28H14M11.5 1.75H3.375C2.34 1.75 1.5 2.59 1.5 3.625V32.375C1.5 33.41 2.34 34.25 3.375 34.25H24.625C25.66 34.25 26.5 33.41 26.5 32.375V16.75C26.5 12.7718 24.9196 8.95644 22.1066 6.1434C19.2936 3.33035 15.4782 1.75 11.5 1.75Z" stroke="#F26522" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
								<div class="resource_file">
									<span class="filename"><?php echo esc_html($display_name); ?></span>
									<span class="filetype"><?php echo $file_type; ?></span>
								</div>
							</div>
							<a href="<?php echo $file['url']; ?>" download>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 14.5V16.75C1 17.3467 1.23705 17.919 1.65901 18.341C2.08097 18.7629 2.65326 19 3.25 19H16.75C17.3467 19 17.919 18.7629 18.341 18.341C18.7629 17.919 19 17.3467 19 16.75V14.5M14.5 10L10 14.5M10 14.5L5.5 10M10 14.5V1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Download the file
							</a>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>

			<?php endif; ?>
		</div>
	</div>
</section>
