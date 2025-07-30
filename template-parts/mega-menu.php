<div class="st_mega_menu grants_mega_menu">
	<div class="st_mega_menu_inner">
		<!-- First Column: Grant Archive Info -->
		<div class="mm_col mm_overview">
			<?php
			$ga_archive_image = get_field('ga_archive_image', 'option');
			$size = 'full';
			if( $ga_archive_image ) {
				echo wp_get_attachment_image( $ga_archive_image, $size, "", array( "class" => "ga_archive_image" ) );
			}
			?>
			<div class="mm_text">
				<?php echo wp_kses_post( get_field('ga_mm_excerpt', 'option') ); ?>
			</div>
			<a class="mm_link" href="<?php echo esc_url(get_post_type_archive_link('grant')); ?>">
				Learn More
				<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</a>
		</div>

		<!-- Second Column: Grant Posts -->
		<div class="mm_col">
			<?php
			$grant_posts = get_posts(array(
				'post_type' => 'grant',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'orderby' => 'title',
				'order' => 'ASC'
			));

			if ($grant_posts) {
				foreach ($grant_posts as $post) {
					setup_postdata($post); ?>

					<a class="mm_grant_item" href="<?php echo esc_url(get_permalink()); ?>">
						<p class="mm_item_title">
							<?php echo esc_html(get_the_title()); ?>
							<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</p>
						<div class="mm_item_excerpt">
							<?php echo wp_kses_post( get_field('mm_excerpt') ); ?>
						</div>
					</a>

				<?php }
				wp_reset_postdata();
			}
			?>
		</div>

		<!-- Third Column: Award Posts -->
		<div class="mm_col">
			<?php
			$award_posts = get_posts(array(
				'post_type' => 'award',
				'post_status' => 'publish',
				'orderby' => 'title',
				'order' => 'ASC'
			));

			if ($award_posts) {
				foreach ($award_posts as $post) {
					setup_postdata($post); ?>

					<a class="mm_grant_item" href="<?php echo esc_url(get_permalink()); ?>">
						<p class="mm_item_title">
							<?php echo esc_html(get_the_title()); ?>
							<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</p>
						<div class="mm_item_excerpt">
							<?php echo wp_kses_post( get_field('mm_excerpt') ); ?>
						</div>
					</a>

				<?php }
				wp_reset_postdata();
			}
			?>
		</div>

		<!-- Fourth Column: Specific Page -->
		<div class="mm_col">
			<?php
			$specific_page = get_post(632);
			if ($specific_page && $specific_page->post_status === 'publish') { ?>

				<a class="mm_grant_item" href="<?php echo esc_url(get_permalink(632)); ?>">
					<p class="mm_item_title">
						<?php echo esc_html($specific_page->post_title); ?>
						<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</p>
					<div class="mm_item_excerpt">
						<?php echo wp_kses_post( get_field('mm_excerpt', $specific_page) ); ?>
					</div>
				</a>

			<?php }
			?>
		</div>
	</div>
</div>


<!-- Contribute -->

<div class="st_mega_menu contribute_mega_menu">
    <div class="st_mega_menu_inner">
        <!-- First Column: Specific Page (ID 468) -->
        <div class="mm_col mm_overview">
            <?php
            $contribute_page = get_post(468);
            if ($contribute_page && $contribute_page->post_status === 'publish') {
                // Get featured image if available
                if (has_post_thumbnail(468)) {
                    echo get_the_post_thumbnail(468, 'full', array('class' => 'ga_archive_image'));
                }
                ?>
                <div class="mm_text">
                    <?php
                    // Get excerpt from ACF field or post excerpt
                    $excerpt = get_field('mm_excerpt', 468);
                    echo wp_kses_post($excerpt);
                    ?>
                </div>
                <a class="mm_link" href="<?php echo esc_url(get_permalink(468)); ?>">
                    Learn More
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            <?php } ?>
        </div>

        <!-- Second Column: Child Pages of Page 468 - Contribute-->
        <div class="mm_col mm_child_column">
            <?php
            $child_pages = get_posts(array(
                'post_type' => 'page',
                'post_parent' => 468,
                'posts_per_page' => 15,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));

            if ($child_pages) {
                foreach ($child_pages as $post) {
                    setup_postdata($post); ?>

                    <a class="mm_grant_item" href="<?php echo esc_url(get_permalink()); ?>">
                        <p class="mm_item_title">
                            <?php echo esc_html(get_the_title()); ?>
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </p>
						<div class="mm_item_excerpt">
							<?php echo wp_kses_post( get_field('mm_excerpt') ); ?>
						</div>
                    </a>

                <?php }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>

<!-- Stories -->

<div class="st_mega_menu stories_mega_menu">
    <div class="st_mega_menu_inner">
        <!-- First Column: Specific Page (ID 658) -->
        <div class="mm_col mm_overview">

			<?php
			$mm_newsletter_image = get_field('mm_newsletter_image', 'option');
			$size = 'full';
			if( $mm_newsletter_image ) {
				echo wp_get_attachment_image( $mm_newsletter_image, $size, "", array( "class" => "mm_newsletter_image" ) );
			} ?>

			<p class="mm_title">Subscribe to our newsletter</p>
			<div class="mm_text">
				<p>Join our newsletter for occasional updates on the difference you’re making - no spam, just meaningful stories.</p>
			</div>
			<input type="text" placeholder="Enter your email">
			<a class="mm_button btn-3" href="#">
				Subscribe
			</a>
        </div>

        <!-- Second Column: Blog and Press Archive -->
        <div class="mm_col mm_child_column">
            <?php
            // Blog Archive
            $blog_page_id = get_option('page_for_posts');
            if ($blog_page_id) {
                $blog_page = get_post($blog_page_id);
                if ($blog_page && $blog_page->post_status === 'publish') { ?>
                    <a class="mm_grant_item" href="<?php echo esc_url(get_permalink($blog_page_id)); ?>">
                        <p class="mm_item_title">
                            <?php echo esc_html($blog_page->post_title); ?>
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </p>
                        <div class="mm_item_excerpt">
                            <?php
                            $excerpt = get_field('mm_excerpt', $blog_page_id);
                            if (!$excerpt) {
                                $excerpt = wp_trim_words($blog_page->post_content, 15, '...');
                            }
                            echo wp_kses_post($excerpt);
                            ?>
                        </div>
                    </a>
                <?php }
            } else {
                // Fallback to default blog archive if no page is set
                ?>
                <a class="mm_grant_item" href="<?php echo esc_url(home_url('/blog')); ?>">
                    <p class="mm_item_title">
                        Blog
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </p>
                    <div class="mm_item_excerpt">
                        <?php echo wp_kses_post( get_field('blog_mm_excerpt', 'option') ); ?>
                    </div>
                </a>
                <?php
            }

            // Page with ID 660
            $press_page = get_post(660);
            if ($press_page && $press_page->post_status === 'publish') { ?>
                <a class="mm_grant_item" href="<?php echo esc_url(get_permalink(660)); ?>">
                    <p class="mm_item_title">
                        <?php echo wp_kses_post( get_field('blog_mm_title', 'option') ); ?>
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </p>
                    <div class="mm_item_excerpt">
                        <?php
                        $excerpt = get_field('mm_excerpt', 660);
                        echo wp_kses_post($excerpt);
                        ?>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</div>


<!-- About -->

<div class="st_mega_menu about_mega_menu">
    <div class="st_mega_menu_inner">
        <!-- First Column: Specific Page (ID 658) -->
        <div class="mm_col mm_overview">
            <?php
            $about_page = get_post(658);
            if ($about_page && $about_page->post_status === 'publish') {
                // Get featured image if available
                if (has_post_thumbnail(658)) {
                    echo get_the_post_thumbnail(658, 'full', array('class' => 'ga_archive_image'));
                }
                ?>
                <div class="mm_text">
                    <?php
                    // Get excerpt from ACF field or post excerpt
                    $excerpt = get_field('mm_excerpt', 658);
                    echo wp_kses_post($excerpt);
                    ?>
                </div>
                <a class="mm_link" href="<?php echo esc_url(get_permalink(658)); ?>">
                    Learn More
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            <?php } ?>
        </div>

        <!-- Second Column: Child Pages of Page 658 - about-->
        <div class="mm_col mm_child_column">
            <?php
            $child_pages = get_posts(array(
                'post_type' => 'page',
                'post_parent' => 658,
                'posts_per_page' => 15,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));

            if ($child_pages) {
                foreach ($child_pages as $post) {
                    setup_postdata($post); ?>

                    <a class="mm_grant_item" href="<?php echo esc_url(get_permalink()); ?>">
                        <p class="mm_item_title">
                            <?php echo esc_html(get_the_title()); ?>
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </p>
						<div class="mm_item_excerpt">
							<?php echo wp_kses_post( get_field('mm_excerpt') ); ?>
						</div>
                    </a>

                <?php }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>
