<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>

<div class="grant_winner_item">
						<div class="grant_winner_content">
							<?php

							if( have_rows('school') ): ?>
								<div class="grant_schools_wrapper">
									<?php while( have_rows('school') ) : the_row(); ?>
										<div class="grant_school_item">
											test
											<?php

											if( have_rows('school_grants') ): ?>
												<div class="school_grants_wrapper">
													<?php while( have_rows('school_grants') ) : the_row(); ?>
														<?php
														$grant_name = get_sub_field('grant_name');
														$grant_value = get_sub_field('grant_value');
														$grant_description = get_sub_field('grant_description');
														?>
test
														<div class="individual_grant">
															<?php if ($grant_name) : ?>
																<h5 class="grant_name"><?php echo esc_html($grant_name); ?></h5>
															<?php endif; ?>

															<?php if ($grant_value) : ?>
																<p class="grant_value"><strong>Value:</strong> <?php echo esc_html($grant_value); ?></p>
															<?php endif; ?>

															<?php if ($grant_description) : ?>
																<div class="grant_description">
																	<?php echo wp_kses_post($grant_description); ?>
																</div>
															<?php endif; ?>
														</div>

													<?php endwhile; ?>
												</div>

											<?php endif; ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>

							<a href="<?php the_permalink(); ?>" class="grant_winner_link">
								Read More
								<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 13L7 7L1 1" stroke="#007F9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
                    </div>

					<?php
get_footer();
