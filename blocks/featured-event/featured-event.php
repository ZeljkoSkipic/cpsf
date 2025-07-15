<?php

$class = 'st_block st_featured_event space_2';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Get the featured event from ACF relationship field
$featured_event = get_field('featured_event');

// Check if an event is selected
if (!empty($featured_event)) {
    // If it's an array of events, get the first one
    if (is_array($featured_event)) {
        $featured_event = $featured_event[0];
    }

    $event_id = $featured_event;

    // Get event details
    $event_title = get_the_title($event_id);
    $event_content = get_the_excerpt($event_id);

    // If excerpt is empty, get content and trim it
    if (empty($event_content)) {
        $event_content = wp_trim_words(get_post_field('post_content', $event_id), 20, '...');
    }

    // Get event link
    $event_link = get_field('register_link', $event_id);

    // Get event featured image
    if (has_post_thumbnail($event_id)) {
        $event_image = get_the_post_thumbnail_url($event_id, 'large');
        $event_image_alt = get_post_meta(get_post_thumbnail_id($event_id), '_wp_attachment_image_alt', true);

        if (empty($event_image_alt)) {
            $event_image_alt = $event_title;
        }
    }
}
?>
<section <?php echo $anchor; ?> class="<?php echo esc_attr($class); ?>">
    <div class="container st_featured_event_inner">
        <div class="fe_left">
            <span class="prefix">Featured Event</span>
            <h2 class="title-2"><?php echo esc_html($event_title); ?></h2>
            <div class="event_text">
                <?php echo wp_kses_post($event_content); ?>
            </div>
            <div class="featured_event_bottom">
                <div class="left">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 0C6.26522 0 6.51957 0.105357 6.70711 0.292893C6.89464 0.480429 7 0.734784 7 1V3H19V1C19 0.734784 19.1054 0.480429 19.2929 0.292893C19.4804 0.105357 19.7348 0 20 0C20.2652 0 20.5196 0.105357 20.7071 0.292893C20.8946 0.480429 21 0.734784 21 1V3H22C23.0609 3 24.0783 3.42143 24.8284 4.17157C25.5786 4.92172 26 5.93913 26 7V22C26 23.0609 25.5786 24.0783 24.8284 24.8284C24.0783 25.5786 23.0609 26 22 26H4C2.93913 26 1.92172 25.5786 1.17157 24.8284C0.421427 24.0783 0 23.0609 0 22V7C0 5.93913 0.421427 4.92172 1.17157 4.17157C1.92172 3.42143 2.93913 3 4 3H5V1C5 0.734784 5.10536 0.480429 5.29289 0.292893C5.48043 0.105357 5.73478 0 6 0ZM24 12C24 11.4696 23.7893 10.9609 23.4142 10.5858C23.0391 10.2107 22.5304 10 22 10H4C3.46957 10 2.96086 10.2107 2.58579 10.5858C2.21071 10.9609 2 11.4696 2 12V22C2 22.5304 2.21071 23.0391 2.58579 23.4142C2.96086 23.7893 3.46957 24 4 24H22C22.5304 24 23.0391 23.7893 23.4142 23.4142C23.7893 23.0391 24 22.5304 24 22V12Z" fill="#F26522"/></svg>
                    <div class="when">
                        <span class="prefix">When</span>
                        <time><?php echo esc_html ( get_field( 'date', $event_id ) ); ?></time>
                    </div>
                </div>
                <div class="right">
                    <a class="btn-3" href="<?php echo esc_url($event_link); ?>" target="_blank">Register</a>
                </div>
            </div>
        </div>
        <div class="fe_right">
            <img src="<?php echo esc_url($event_image); ?>" alt="<?php echo esc_attr($event_image_alt); ?>">
        </div>
    </div>
</section>
